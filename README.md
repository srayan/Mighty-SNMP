Mighty-SNMP
===========

Simple Network Management Protocol. 
SNMP is anything but Simple!

Getting system information through SNMP.
Currently deployed and being tested on an Arch Linux platform.

#Installation
pacman -S net-snmp
systemctl enable snmpd

mkdir /etc/snmp/

#Configuring the snmp daemon configuration file.
echo rocommunity read_only_user >> /etc/snmp/snmpd.conf
echo rwcommunity read_write_user >> /etc/snmp/snmpd.conf

systemctl start snmpd


#All system MIB information -- master command, streamline from here
snmpwalk -v 1 -c read_only_user localhost | less 

#Command to write all MIB information into a text file located at /mnt/usbstick/snmpmib.txt
snmpwalk -v 1 -c read_only_user localhost >> /mnt/usbstick/snmpmib.txt


#More detailed information
snmpwalk -v 1 -c read_only_user localhost .iso | less 


#Specific information, from subset of snmpwalk --without the .0 extension in the end the command will not work (results in packet error)
snmpget -v 1 -c read_only_user localhost system.sysUpTime.0
snmpwalk -v 1 -c read_only_user localhost sysDescr.0

snmpwalk -v 1 -c read_only_user localhost RFC-1215


#Sending UDP packets to router
snmpwalk -d 162.232.102.191

#To debug
snmpwalk -D ALL



#MIB directories (for adding new MIB files, add all modules to these two directories)
/root/.snmp/mibs
AND
/usr/share/snmp/mibs

#For UPS
Download and copy MIB file
from -> http://tools.ietf.org/html/rfc1628
to -> /usr/share/snmp/mibs

#How to retrieve it? --WORKING ON THIS


Need to check:
https://www.zabbix.com/forum/showthread.php?t=26792


#Example result from snmpwalk:
IP-MIB::ipForwarding.0 = INTEGER: notForwarding(2)


Here IP-MIB is a MIB entry file located at /usr/share/snmp/mibs under the name: IP-MIB.txt

Following are the Objects (that we can perform individual snmpget with):
ipForwarding.0
notForwarding(2)

An example would be: snmpget -v 1 -c read_only_user localhost ipForwarding.0







#Sample commands to test:
snmpget -v 1 -c localhost CISCO-RHINO-MIB::ciscoLS1010ChassisFanLed
snmptranslate -On CISCO-RHINO-MIB::clsEnetPortDuplex

snmpget -v 1 -c localhost 1.3.6.1.4.1.9.5.11.1.1.12


snmpget -v1 -c localhost 162.227.102.191 .1.3.6.1.4.1.9.5.11.1.1.12


snmptranslate -m +powernet407 -IR -On powernet407::mfiletransferConfigFTPServerAddress

snmptranslate -m +powernet407 -IR -On mfiletransferConfigFTPServerAddress


snmptranslate -m +stdupsv1 -IR -On upsIdentManufacturer
