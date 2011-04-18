####################################################################
# Copyright (c) 2007-2009 CyberInfrastructure and Geospatial       #
#                         Information Laboratory (CIGI)            #
# University of Illinois at Urbana-Champaign, All Rights Reserved. #
####################################################################

# Grid environment
export GLOBUS_TCP_PORT_RANGE=40000,51000

# JAVA, ANT, and Tomcat environment
export JAVA_HOME=/opt/jdk1.6.0_22
export ANT_HOME=/opt/apache-ant-1.6.5
export AXIS2_HOME=/opt/axis2-1.5.1
export CATALINA_HOME=/opt/apache-tomcat-5.5.31
export PATH=${JAVA_HOME}/bin:${ANT_HOME}/bin:$PATH

# increase memory for production use
export JAVA_OPTS="-Xmx384m"

# SimpleGrid home
export SIMPLEGRID_HOME=/opt/simpletest
