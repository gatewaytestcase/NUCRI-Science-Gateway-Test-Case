/* GISolve's map overlay library based on google map
 * Functions:
 * - load an image on google map as overlay
 * - auto image zoom and move
 * 
 */

/* gisolveImageOverlay object */
function gisolverlay (mapid) {
	// create map object
	this.gmap = new GMap2(document.getElementById(mapid));
	this.gid = "gisolverlay-"+mapid;
	this.gmap.addControl(new GLargeMapControl());
	// set map size and center
	this.gbounds = new GLatLngBounds(new GLatLng(24.0, -128.0),new GLatLng(50,-65));
	this.gmap.setCenter(this.gbounds.getCenter(), this.gmap.getBoundsZoomLevel(this.gbounds));
	this.event_zoomend = null;
	this.event_moveend = null;
}

/* render map overlay */
gisolverlay.prototype.putOverlay = function(imageUrl) {
	this.gmap.clearOverlays();
	this.removeOverlay();
	this.createOverlay(imageUrl);

}
gisolverlay.prototype.createOverlay = function(imageUrl) {
	var imgElement = document.createElement("img");
	imgElement.style.display = 'block';
	imgElement.setAttribute('id',this.gid);
	imgElement.setAttribute('src',imageUrl);
	imgElement.style.position = 'absolute';
	imgElement.style.zIndex = 1;
	imgElement.setAttribute('west',-128.1);
	imgElement.setAttribute('south',22.69);
	imgElement.setAttribute('east',-65.04);
	imgElement.setAttribute('north',49.93);
	
	this.gmap.getPane(G_MAP_MAP_PANE).appendChild(imgElement);
	this.zoomend = GEvent.bind(this.gmap, "zoomend", this, function(){this.setImageLocation(this.gid)});
	this.moveend = GEvent.bind(this.gmap, "moveend", this, function(){this.setImageLocation(this.gid)});
	
	// set image opacity
	var opacity=50;
	var c=opacity/100;
	var x=document.getElementById(this.gid);
	if(typeof(x.style.filter)=='string'){x.style.filter='alpha(opacity:'+opacity+')';}
	if(typeof(x.style.KHTMLOpacity)=='string'){x.style.KHTMLOpacity=c;}
	if(typeof(x.style.MozOpacity)=='string'){x.style.MozOpacity=c;}
	if(typeof(x.style.opacity)=='string'){x.style.opacity=c;} 
	
	// set image position  
	this.setImageLocation(this.gid);
}
gisolverlay.prototype.removeOverlay = function() {
	var imgElement = document.getElementById(this.gid);
	if (imgElement != null) {
/*
		if (this.zoomend != null) {
			GEvent.removeListener(this.zoomend);
		}
		if (this.moveend != null) {
			GEvent.removeListener(this.moveend);
		}
*/
		GEvent.clearListeners(this.gmap, "zoomend");
		GEvent.clearListeners(this.gmap, "moveend");
		this.gmap.getPane(G_MAP_MAP_PANE).removeChild(imgElement);
		document.removeElement(imgElement);
	}
}
gisolverlay.prototype.setImageLocation = function(id) {
    var ie = document.getElementById(id);
    var nw; var se;
    nw = this.gmap.fromLatLngToDivPixel(new GLatLng(ie.getAttribute('north'), ie.getAttribute('west')));
    se = this.gmap.fromLatLngToDivPixel(new GLatLng(ie.getAttribute('south'), ie.getAttribute('east')));
    ie.style.top=nw.y+'px';
    ie.style.left=nw.x+'px';
    ie.style.width=se.x-nw.x+'px';
    ie.style.height=se.y-nw.y+'px'; 
}

// longitude to metres
// http://www.uwgb.edu/dutchs/UsefulData/UTMFormulas.HTM
// "A degree of longitude at the equator is 111.2km... For other latitudes,
// multiply by cos(lat)"
// assumes the earth is a sphere but good enough for our purposes

function lonToMetres (lon,lat) {
  return lon * 111200 * Math.cos(lat * (Math.PI/180));
}

function metresToLon(m,lat) {
  return m / (111200*Math.cos(lat * (Math.PI/180)));
}

