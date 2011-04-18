
/**
 * TESTAPPMessageReceiverInOut.java
 *
 * This file was auto-generated from WSDL
 * by the Apache Axis2 version: 1.5.1  Built on : Oct 19, 2009 (10:59:00 EDT)
 */
        package org.simplegrid.app.testapp;

        /**
        *  TESTAPPMessageReceiverInOut message receiver
        */

        public class TESTAPPMessageReceiverInOut extends org.apache.axis2.receivers.AbstractInOutMessageReceiver{


        public void invokeBusinessLogic(org.apache.axis2.context.MessageContext msgContext, org.apache.axis2.context.MessageContext newMsgContext)
        throws org.apache.axis2.AxisFault{

        try {

        // get the implementation class for the Web Service
        Object obj = getTheImplementationObject(msgContext);

        TESTAPPSkeletonInterface skel = (TESTAPPSkeletonInterface)obj;
        //Out Envelop
        org.apache.axiom.soap.SOAPEnvelope envelope = null;
        //Find the axisOperation that has been set by the Dispatch phase.
        org.apache.axis2.description.AxisOperation op = msgContext.getOperationContext().getAxisOperation();
        if (op == null) {
        throw new org.apache.axis2.AxisFault("Operation is not located, if this is doclit style the SOAP-ACTION should specified via the SOAP Action to use the RawXMLProvider");
        }

        java.lang.String methodName;
        if((op.getName() != null) && ((methodName = org.apache.axis2.util.JavaUtils.xmlNameToJavaIdentifier(op.getName().getLocalPart())) != null)){

        

            if("getStatus".equals(methodName)){
                
                org.simplegrid.app.testapp.GetStatusResponse getStatusResponse7 = null;
	                        org.simplegrid.app.testapp.GetStatus wrappedParam =
                                                             (org.simplegrid.app.testapp.GetStatus)fromOM(
                                    msgContext.getEnvelope().getBody().getFirstElement(),
                                    org.simplegrid.app.testapp.GetStatus.class,
                                    getEnvelopeNamespaces(msgContext.getEnvelope()));
                                                
                                               getStatusResponse7 =
                                                   
                                                   
                                                         skel.getStatus(wrappedParam)
                                                    ;
                                            
                                        envelope = toEnvelope(getSOAPFactory(msgContext), getStatusResponse7, false);
                                    } else 

            if("getResult".equals(methodName)){
                
                org.simplegrid.app.testapp.GetResultResponse getResultResponse9 = null;
	                        org.simplegrid.app.testapp.GetResult wrappedParam =
                                                             (org.simplegrid.app.testapp.GetResult)fromOM(
                                    msgContext.getEnvelope().getBody().getFirstElement(),
                                    org.simplegrid.app.testapp.GetResult.class,
                                    getEnvelopeNamespaces(msgContext.getEnvelope()));
                                                
                                               getResultResponse9 =
                                                   
                                                   
                                                         skel.getResult(wrappedParam)
                                                    ;
                                            
                                        envelope = toEnvelope(getSOAPFactory(msgContext), getResultResponse9, false);
                                    } else 

            if("submit".equals(methodName)){
                
                org.simplegrid.app.testapp.SubmitResponse submitResponse11 = null;
	                        org.simplegrid.app.testapp.Submit wrappedParam =
                                                             (org.simplegrid.app.testapp.Submit)fromOM(
                                    msgContext.getEnvelope().getBody().getFirstElement(),
                                    org.simplegrid.app.testapp.Submit.class,
                                    getEnvelopeNamespaces(msgContext.getEnvelope()));
                                                
                                               submitResponse11 =
                                                   
                                                   
                                                         skel.submit(wrappedParam)
                                                    ;
                                            
                                        envelope = toEnvelope(getSOAPFactory(msgContext), submitResponse11, false);
                                    
            } else {
              throw new java.lang.RuntimeException("method not found");
            }
        

        newMsgContext.setEnvelope(envelope);
        }
        }
        catch (java.lang.Exception e) {
        throw org.apache.axis2.AxisFault.makeFault(e);
        }
        }
        
        //
            private  org.apache.axiom.om.OMElement  toOM(org.simplegrid.app.testapp.GetStatus param, boolean optimizeContent)
            throws org.apache.axis2.AxisFault {

            
                        try{
                             return param.getOMElement(org.simplegrid.app.testapp.GetStatus.MY_QNAME,
                                          org.apache.axiom.om.OMAbstractFactory.getOMFactory());
                        } catch(org.apache.axis2.databinding.ADBException e){
                            throw org.apache.axis2.AxisFault.makeFault(e);
                        }
                    

            }
        
            private  org.apache.axiom.om.OMElement  toOM(org.simplegrid.app.testapp.GetStatusResponse param, boolean optimizeContent)
            throws org.apache.axis2.AxisFault {

            
                        try{
                             return param.getOMElement(org.simplegrid.app.testapp.GetStatusResponse.MY_QNAME,
                                          org.apache.axiom.om.OMAbstractFactory.getOMFactory());
                        } catch(org.apache.axis2.databinding.ADBException e){
                            throw org.apache.axis2.AxisFault.makeFault(e);
                        }
                    

            }
        
            private  org.apache.axiom.om.OMElement  toOM(org.simplegrid.app.testapp.GetResult param, boolean optimizeContent)
            throws org.apache.axis2.AxisFault {

            
                        try{
                             return param.getOMElement(org.simplegrid.app.testapp.GetResult.MY_QNAME,
                                          org.apache.axiom.om.OMAbstractFactory.getOMFactory());
                        } catch(org.apache.axis2.databinding.ADBException e){
                            throw org.apache.axis2.AxisFault.makeFault(e);
                        }
                    

            }
        
            private  org.apache.axiom.om.OMElement  toOM(org.simplegrid.app.testapp.GetResultResponse param, boolean optimizeContent)
            throws org.apache.axis2.AxisFault {

            
                        try{
                             return param.getOMElement(org.simplegrid.app.testapp.GetResultResponse.MY_QNAME,
                                          org.apache.axiom.om.OMAbstractFactory.getOMFactory());
                        } catch(org.apache.axis2.databinding.ADBException e){
                            throw org.apache.axis2.AxisFault.makeFault(e);
                        }
                    

            }
        
            private  org.apache.axiom.om.OMElement  toOM(org.simplegrid.app.testapp.Submit param, boolean optimizeContent)
            throws org.apache.axis2.AxisFault {

            
                        try{
                             return param.getOMElement(org.simplegrid.app.testapp.Submit.MY_QNAME,
                                          org.apache.axiom.om.OMAbstractFactory.getOMFactory());
                        } catch(org.apache.axis2.databinding.ADBException e){
                            throw org.apache.axis2.AxisFault.makeFault(e);
                        }
                    

            }
        
            private  org.apache.axiom.om.OMElement  toOM(org.simplegrid.app.testapp.SubmitResponse param, boolean optimizeContent)
            throws org.apache.axis2.AxisFault {

            
                        try{
                             return param.getOMElement(org.simplegrid.app.testapp.SubmitResponse.MY_QNAME,
                                          org.apache.axiom.om.OMAbstractFactory.getOMFactory());
                        } catch(org.apache.axis2.databinding.ADBException e){
                            throw org.apache.axis2.AxisFault.makeFault(e);
                        }
                    

            }
        
                    private  org.apache.axiom.soap.SOAPEnvelope toEnvelope(org.apache.axiom.soap.SOAPFactory factory, org.simplegrid.app.testapp.GetStatusResponse param, boolean optimizeContent)
                        throws org.apache.axis2.AxisFault{
                      try{
                          org.apache.axiom.soap.SOAPEnvelope emptyEnvelope = factory.getDefaultEnvelope();
                           
                                    emptyEnvelope.getBody().addChild(param.getOMElement(org.simplegrid.app.testapp.GetStatusResponse.MY_QNAME,factory));
                                

                         return emptyEnvelope;
                    } catch(org.apache.axis2.databinding.ADBException e){
                        throw org.apache.axis2.AxisFault.makeFault(e);
                    }
                    }
                    
                         private org.simplegrid.app.testapp.GetStatusResponse wrapgetStatus(){
                                org.simplegrid.app.testapp.GetStatusResponse wrappedElement = new org.simplegrid.app.testapp.GetStatusResponse();
                                return wrappedElement;
                         }
                    
                    private  org.apache.axiom.soap.SOAPEnvelope toEnvelope(org.apache.axiom.soap.SOAPFactory factory, org.simplegrid.app.testapp.GetResultResponse param, boolean optimizeContent)
                        throws org.apache.axis2.AxisFault{
                      try{
                          org.apache.axiom.soap.SOAPEnvelope emptyEnvelope = factory.getDefaultEnvelope();
                           
                                    emptyEnvelope.getBody().addChild(param.getOMElement(org.simplegrid.app.testapp.GetResultResponse.MY_QNAME,factory));
                                

                         return emptyEnvelope;
                    } catch(org.apache.axis2.databinding.ADBException e){
                        throw org.apache.axis2.AxisFault.makeFault(e);
                    }
                    }
                    
                         private org.simplegrid.app.testapp.GetResultResponse wrapgetResult(){
                                org.simplegrid.app.testapp.GetResultResponse wrappedElement = new org.simplegrid.app.testapp.GetResultResponse();
                                return wrappedElement;
                         }
                    
                    private  org.apache.axiom.soap.SOAPEnvelope toEnvelope(org.apache.axiom.soap.SOAPFactory factory, org.simplegrid.app.testapp.SubmitResponse param, boolean optimizeContent)
                        throws org.apache.axis2.AxisFault{
                      try{
                          org.apache.axiom.soap.SOAPEnvelope emptyEnvelope = factory.getDefaultEnvelope();
                           
                                    emptyEnvelope.getBody().addChild(param.getOMElement(org.simplegrid.app.testapp.SubmitResponse.MY_QNAME,factory));
                                

                         return emptyEnvelope;
                    } catch(org.apache.axis2.databinding.ADBException e){
                        throw org.apache.axis2.AxisFault.makeFault(e);
                    }
                    }
                    
                         private org.simplegrid.app.testapp.SubmitResponse wrapsubmit(){
                                org.simplegrid.app.testapp.SubmitResponse wrappedElement = new org.simplegrid.app.testapp.SubmitResponse();
                                return wrappedElement;
                         }
                    


        /**
        *  get the default envelope
        */
        private org.apache.axiom.soap.SOAPEnvelope toEnvelope(org.apache.axiom.soap.SOAPFactory factory){
        return factory.getDefaultEnvelope();
        }


        private  java.lang.Object fromOM(
        org.apache.axiom.om.OMElement param,
        java.lang.Class type,
        java.util.Map extraNamespaces) throws org.apache.axis2.AxisFault{

        try {
        
                if (org.simplegrid.app.testapp.GetStatus.class.equals(type)){
                
                           return org.simplegrid.app.testapp.GetStatus.Factory.parse(param.getXMLStreamReaderWithoutCaching());
                    

                }
           
                if (org.simplegrid.app.testapp.GetStatusResponse.class.equals(type)){
                
                           return org.simplegrid.app.testapp.GetStatusResponse.Factory.parse(param.getXMLStreamReaderWithoutCaching());
                    

                }
           
                if (org.simplegrid.app.testapp.GetResult.class.equals(type)){
                
                           return org.simplegrid.app.testapp.GetResult.Factory.parse(param.getXMLStreamReaderWithoutCaching());
                    

                }
           
                if (org.simplegrid.app.testapp.GetResultResponse.class.equals(type)){
                
                           return org.simplegrid.app.testapp.GetResultResponse.Factory.parse(param.getXMLStreamReaderWithoutCaching());
                    

                }
           
                if (org.simplegrid.app.testapp.Submit.class.equals(type)){
                
                           return org.simplegrid.app.testapp.Submit.Factory.parse(param.getXMLStreamReaderWithoutCaching());
                    

                }
           
                if (org.simplegrid.app.testapp.SubmitResponse.class.equals(type)){
                
                           return org.simplegrid.app.testapp.SubmitResponse.Factory.parse(param.getXMLStreamReaderWithoutCaching());
                    

                }
           
        } catch (java.lang.Exception e) {
        throw org.apache.axis2.AxisFault.makeFault(e);
        }
           return null;
        }



    

        /**
        *  A utility method that copies the namepaces from the SOAPEnvelope
        */
        private java.util.Map getEnvelopeNamespaces(org.apache.axiom.soap.SOAPEnvelope env){
        java.util.Map returnMap = new java.util.HashMap();
        java.util.Iterator namespaceIterator = env.getAllDeclaredNamespaces();
        while (namespaceIterator.hasNext()) {
        org.apache.axiom.om.OMNamespace ns = (org.apache.axiom.om.OMNamespace) namespaceIterator.next();
        returnMap.put(ns.getPrefix(),ns.getNamespaceURI());
        }
        return returnMap;
        }

        private org.apache.axis2.AxisFault createAxisFault(java.lang.Exception e) {
        org.apache.axis2.AxisFault f;
        Throwable cause = e.getCause();
        if (cause != null) {
            f = new org.apache.axis2.AxisFault(e.getMessage(), cause);
        } else {
            f = new org.apache.axis2.AxisFault(e.getMessage());
        }

        return f;
    }

        }//end of class
    