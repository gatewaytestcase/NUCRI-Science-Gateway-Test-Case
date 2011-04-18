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

rsltemp="$localhome/simplegrid2/tmp/samplejob.template"
if [ ! -f "$rsltemp" ]; then
	echo "Get SimpleGrid installed first (simplegrid2-install.sh)"
	exit
fi

inputdataset="$tghome/tutorial/$localuser.dat"
outputdataset="$tghome/tutorial/${localuser}-result.dat"
stdoutput="$tghome/tutorial/${localuser}.stdout"
stderror="$tghome/tutorial/${localuser}.stderr"
tmprslfile=/tmp/$localuser.$RANDOM.rsl
sed -e "s|TGHOME|$tghome|g" $rsltemp | sed -e "s|INPUTDATASET|$inputdataset|g" | sed -e "s|OUTPUTDATASET|$outputdataset|g" | sed -e "s|STDOUT|$stdoutput|g" | sed -e "s|STDERR|$stderror|g" > $tmprslfile

gram2_contact=`tginfo gram2 on $cluster | grep prews-gram-pbs | awk '{print $3}'`
echo "The job description file should be:"
cat $tmprslfile
echo ""
echo "The command to submit job to TeraGrid $cluster cluster is:"
echo "globusrun -b -f $tmprslfile -r $gram2_contact"
echo "Submitting..."
globusrun -b -f $tmprslfile -r $gram2_contact
