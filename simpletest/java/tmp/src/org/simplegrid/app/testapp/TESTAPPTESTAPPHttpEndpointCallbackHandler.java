
/**
 * TESTAPPTESTAPPHttpEndpointCallbackHandler.java
 *
 * This file was auto-generated from WSDL
 * by the Apache Axis2 version: 1.5.1  Built on : Oct 19, 2009 (10:59:00 EDT)
 */

    package org.simplegrid.app.testapp;

    /**
     *  TESTAPPTESTAPPHttpEndpointCallbackHandler Callback class, Users can extend this class and implement
     *  their own receiveResult and receiveError methods.
     */
    public abstract class TESTAPPTESTAPPHttpEndpointCallbackHandler{



    protected Object clientData;

    /**
    * User can pass in any object that needs to be accessed once the NonBlocking
    * Web service call is finished and appropriate method of this CallBack is called.
    * @param clientData Object mechanism by which the user can pass in user data
    * that will be avilable at the time this callback is called.
    */
    public TESTAPPTESTAPPHttpEndpointCallbackHandler(Object clientData){
        this.clientData = clientData;
    }

    /**
    * Please use this constructor if you don't want to set any clientData
    */
    public TESTAPPTESTAPPHttpEndpointCallbackHandler(){
        this.clientData = null;
    }

    /**
     * Get the client data
     */

     public Object getClientData() {
        return clientData;
     }

        
           /**
            * auto generated Axis2 call back method for getStatus method
            * override this method for handling normal response from getStatus operation
            */
           public void receiveResultgetStatus(
                    org.simplegrid.app.testapp.GetStatusResponse result
                        ) {
           }

          /**
           * auto generated Axis2 Error handler
           * override this method for handling error response from getStatus operation
           */
            public void receiveErrorgetStatus(java.lang.Exception e) {
            }
                
           /**
            * auto generated Axis2 call back method for getResult method
            * override this method for handling normal response from getResult operation
            */
           public void receiveResultgetResult(
                    org.simplegrid.app.testapp.GetResultResponse result
                        ) {
           }

          /**
           * auto generated Axis2 Error handler
           * override this method for handling error response from getResult operation
           */
            public void receiveErrorgetResult(java.lang.Exception e) {
            }
                
           /**
            * auto generated Axis2 call back method for submit method
            * override this method for handling normal response from submit operation
            */
           public void receiveResultsubmit(
                    org.simplegrid.app.testapp.SubmitResponse result
                        ) {
           }

          /**
           * auto generated Axis2 Error handler
           * override this method for handling error response from submit operation
           */
            public void receiveErrorsubmit(java.lang.Exception e) {
            }
                


    }
    