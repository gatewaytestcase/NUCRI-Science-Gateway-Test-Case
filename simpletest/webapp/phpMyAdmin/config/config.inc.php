<?php
/*
 * Generated configuration file
 * Generated by: phpMyAdmin 2.11.11.3 setup script by Michal Čihař <michal@cihar.com>
 * Version: $Id$
 * Date: Tue, 22 Mar 2011 21:34:32 GMT
 */

/* Servers configuration */
$i = 0;

/* Server localhost (cookie) [1] */
$i++;
$cfg['Servers'][$i]['host'] = 'localhost';
$cfg['Servers'][$i]['extension'] = 'mysqli';
$cfg['Servers'][$i]['connect_type'] = 'tcp';
$cfg['Servers'][$i]['compress'] = false;
$cfg['Servers'][$i]['auth_type'] = 'cookie';

$cfg['Servers'][$i]['AllowDeny']['order'] = '';

$cfg['Servers'][$i]['AllowDeny']['rules'] = array();



/* End of servers configuration */

$cfg['blowfish_secret'] = '4d89140d02e263.98648891';
$cfg['UploadDir'] = '/opt/simplegrid2/webapp/phpMyAdmin/upload';
$cfg['SaveDir'] = '/opt/simplegrid2/webapp/phpMyAdmin/save';
?>
