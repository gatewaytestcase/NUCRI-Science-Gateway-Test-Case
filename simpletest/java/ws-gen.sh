#!/bin/bash

if [ -z "$SIMPLEGRID_HOME" ]; then
	. ../etc/simplegrid-env.sh
fi

echo "----------1. compile application code---------"
../bin/AppCompile.sh

echo "----------2. setup axis2 environment---------"
export PATH=${AXIS2_HOME}/bin:$PATH

echo "----------3. generate ws definition in WSDL format---------"
java2wsdl.sh -o . -of TESTAPP.wsdl -sn TESTAPP -cp ./build/classes -cn org.simplegrid.app.testapp.TESTAPP

echo "----------4. generate ws codes---------"
if [ ! -d "./tmp" ]; then
	mkdir tmp 
fi
wsdl2java.sh -o ./tmp -ss -sd -g -ssi -ap -or -uri ./TESTAPP.wsdl

echo "----------5. implement skeleton code---------"
java -classpath ./build/classes org.simplegrid.util.SkeletonGen org.simplegrid.app.testapp.TESTAPP ./tmp/src/org/simplegrid/app/testapp/TESTAPPSkeleton.java

echo "----------6. compile WS code---------"
AXIS2JARS=""
for ALIB in `ls $AXIS2_HOME/lib/*.jar`
do
  AXIS2JARS="$AXIS2JARS:$ALIB"
done
javac -d ./aar -classpath ./build/classes:$AXIS2JARS ./tmp/src/org/simplegrid/app/testapp/*.java



echo "----------7. build WS aar---------"
cp -r ./build/classes/* ./aar/
cp -r ./lib ./aar/
cp -r ./tmp/resources ./aar/META-INF
cd ./aar
jar cf ../TESTAPP.aar *
cd ..
