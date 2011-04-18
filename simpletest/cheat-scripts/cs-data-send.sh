#!/bin/bash
# transfer input dataset to a TG cluster
cluster="abe"
localuser=`id -un`
localhome="$HOME"
uconfiglist="/opt/software/tg10config"
#config format: localuser tguser abe_home qb_home cigi_home
tguser=`grep "$localuser " $uconfiglist | awk '{print $2}'`
tghome=`grep "$localuser " $uconfiglist | awk '{print $3}'`

tctenv=/opt/software/tg-client-env.sh
if [ -z "$GLOBUS_LOCATION" ]; then
	. $tctenv
fi

grid-proxy-info > /dev/null
if [ $? -eq 1 ]; then
	echo "Please get a valid Grid proxy first (myproxy-logon)"
	exit
fi 

localfile="$localhome/simplegrid2/tmp/sample"
if [ ! -f "$localfile" ]; then
	echo "Get SimpleGrid installed first (simplegrid2-install.sh)"
	exit
fi

remotefile="$tghome/tutorial/$localuser.dat"
gridftp_contact=`tginfo gridftp on $cluster | grep gridftp-default-server | awk '{print $3}'`

echo "The command to be used to send local data to TeraGrid $cluster cluster is:"
echo "globus-url-copy file://$localfile ${gridftp_contact}$remotefile"
echo "Transferring..."
globus-url-copy file://$localfile ${gridftp_contact}$remotefile
