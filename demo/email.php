<?php

echo '<pre>';

include '../Source/DA/Emails.php';

// Optional, you can pass these as arguments of the class constructor too
$socket = new HTTPSocket();
$socket->connect('topdomain.nl', 2222);
$socket->set_login('user', 'pass');

DA_Api::$DEFAULT_SOCKET = $socket;
DA_Api::$DEFAULT_DOMAIN = 'domain.nl';

// new DA_Emails instance
$emails = new DA_Emails();

// displays the users
print_r($emails->fetch());

// creates a new user, should return true
var_dump($emails->create(
	'testing',
	'test_pass',
	20
));

// fetches the data, quota and usage, of one user
print_r($emails->fetchUserQuota('testing'));

// sets a new password and quota
var_dump($emails->modify(
	'testing',
	'new_test_pass',
	30
));

// fetches all data, including quotas and usage
print_r($emails->fetchQuotas());

// deletes the test user, should be true
var_dump($emails->delete('testing'));
