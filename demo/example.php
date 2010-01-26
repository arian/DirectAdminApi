<?php

echo '<pre>';

include_once '../Source/HTTPSocket.php';

$sock = new HTTPSocket();
$sock->connect('domain.nl',2222);
$sock->set_login('DirectAdminUsername','DirectAdminPassword');

include_once '../Source/DA/Emails.php';
$emails = new DA_Emails($sock,'domain.com');

try {
	// Fetch a list of users (before the @ sign) or pop emails
	print_r($emails->fetch());

	// Fetch a list of users and their usage and quota
	print_r($emails->fetchQuotas());

	// Fetch the quota and usage for a single user
	print_r($emails->fetchUserQuota('username'));

	// Create a user email => username - password - quota (MiB)
	var_dump($emails->create('username','pass',50));

	// Modify a user email => username - password - quota (MiB)
	var_dump($emails->modify('username'));

	// Delete a user email
	var_dump($emails->delete('username'));

}catch(DA_Exception $e){
	echo $e->getMessage();
}

include_once '../Source/DA/Forwarders.php';
$fwd = new DA_Forwarders($sock);
$fwd->setDomain('refox.nl');

try {
	// Fetch a list of users and their forward emails
	print_r($fwd->fetch());
	/*
	(
	    [user1] => first@domain.com
	    [other] => second@otherdomain.com
	    [user3] => forward@email.com
	)
	*/

	// Fetch forward email address of an user
	print_r($fwd->fetchUser('username'));

	// Create a forward email => username - forward email
	var_dump($fwd->create('username','info@mydomain.com'));

	// Modify a forward email => username - forward email
	var_dump($fwd->modify('username','other@email.com'));

	// Delete a forward email
	var_dump($fwd->delete('username'));

}catch(DA_Exception $e){
	echo $e->getMessage();
}

// Auto Responders works much the same
include_once '../Source/DA/Autoresponders.php';
$resp = new DA_Autoresponders($sock,'mydomain.com');

try {
	print_r($resp->fetch());

	print_r($resp->fetchUser('username'));

	var_dump($resp->create('username','respond message','cc@email.com'));

	var_dump($resp->modify('username','Hi there, i will reply you soon!'));

	var_dump($resp->delete('username'));

}catch(DA_Exception $e){
	echo $e->getMessage();
}
