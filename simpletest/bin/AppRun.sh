#!/bin/bash
####################################################################
# Copyright (c) 2007-2009 CyberInfrastructure and Geospatial       #
#                         Information Laboratory (CIGI)            #
# University of Illinois at Urbana-Champaign, All Rights Reserved. #
####################################################################

if [ -z "$SIMPLEGRID_HOME" ]; then
  echo "Please source simplegrid-env.sh first, e.g., '. $HOME/simpletest/etc/simplegrid-env.sh' for bash environment."
  exit 1
fi
curdir=`pwd`
cd $SIMPLEGRID_HOME/java/build/classes
# globus needs this file to run
if [ ! -f "./client-config.wsdd" ]; then
  cp $SIMPLEGRID_HOME/java/client-config.wsdd .
fi
#. ${GLOBUS_LOCATION}/etc/globus-devel-env.sh
MYCP="."
LIBHOMES="../../lib"
for LIBHOME in $LIBHOMES
do
  SUBLIBLIST=`ls $LIBHOME/*.jar`
  for ALIB in $SUBLIBLIST
  do
    MYCP="$MYCP:$ALIB"
  done
done
#echo "$MYCP"

java -classpath $MYCP org.simplegrid.app.testapp.AppRun mytest

cd $curdir
