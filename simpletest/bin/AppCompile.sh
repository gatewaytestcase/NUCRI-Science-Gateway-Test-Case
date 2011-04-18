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
cd $SIMPLEGRID_HOME/java/src
#. ${GLOBUS_LOCATION}/etc/globus-devel-env.sh
MYCP="."
LIBHOMES="../lib"
for LIBHOME in $LIBHOMES
do
  SUBLIBLIST=`ls $LIBHOME/*.jar`
  for ALIB in $SUBLIBLIST
  do
    MYCP="$MYCP:$ALIB"
  done
done
AXIS2LIBHOME="$AXIS2_HOME/lib"
AXIS2LIBLIST=`ls $AXIS2LIBHOME/*.jar`
for ALIB in $AXIS2LIBLIST
do
  MYCP="$MYCP:$ALIB"
done
#echo "$MYCP"

if [ -d "$SIMPLEGRID_HOME/java/build/classes/org" ]; then
  rm -fr $SIMPLEGRID_HOME/java/build/classes/org
fi

javac -d $SIMPLEGRID_HOME/java/build/classes -classpath $MYCP org/simplegrid/util/*.java org/simplegrid/grid/security/*.java org/simplegrid/grid/data/*.java org/simplegrid/grid/job/*.java org/simplegrid/app/testapp/*.java
cp $SIMPLEGRID_HOME/java/client-config.wsdd $SIMPLEGRID_HOME/java/build/classes/

cd $curdir
