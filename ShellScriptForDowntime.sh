#!/bin/sh

#########################
#########################
# Author: Himanshu Joshi#
# Created on: 02/24/2016#
# Synopsys Copyright (c)#
# All Rights Reserved   #
#########################

host=$1
for i in `cat $host`; do  
depot=`rsh $i  /etc/synopsys/local_health_check/agent/depot.sh -c | awk '{print $2}'` 
automount=` rsh $i /etc/synopsys/local_health_check/agent/automount.sh -c | awk '{print $3}'`
ping=`ping -c 1 $i &> /dev/null && echo  OK || echo   NOK`



done

rsh=`rsh $host cat /etc/issue | awk '{print $2}'`
DATABASE="gms"
HOSTNAME="gmsmaster-vm1"
USERNAME="gmsadmin"

psql -h $HOSTNAME -U $USERNAME $DATABASE << EOF
insert into finalproject3 (machinename,"PingCheck","AutoFSCheck","DepotCheck",status_description,comments,status2,author)values('$i','$ping','$automount','$depot','WellDone','good','','')
EOF

