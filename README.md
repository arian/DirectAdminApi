PHP Direct Admin API
====================

This is a set of classes to communicate with Direct Admin (DA)
via the Direct Admin API to configurate some things in 
for your webserver without login in to Direct Admin itself.

With this library you can control your webserver in your own
environmet, for example  your very own CMS.

This library is far from complete and it currently has only support
for:
1. POP Email addresses
2. Email Forwarders
3. Email Auto Responders

It would be great to add more features to create a simple to use PHP 
implementation of the Direct Admin API

How to use
=========

See demo/example.php for more examples.
You can browse the source code as well and try things out for the right
usage.

Connect
-------

First we have to connect to Direct admin trough a HTTP Socket

	include_once 'HTTPSocket.php';
	
	$sock = new HTTPSocket();
	$sock->connect('domain.nl',2222);
	$sock->set_login('DirectAdminUsername','DirectAdminPassword');

You have to fill your own DA username, password and domain. This is the 
domain you to to if you want to go to DA: www.domain.com:2222.
The username and password are the username and password you fill in the 
form at www.domain.com:2222

Fetch
-----

Then we want to fetch some data. For example the POP3 Email list

	include_once 'DA_Emails.php';
	
	$emails = new DA_Emails($sock,'domain.com');
	
	try {
		$list = $emails->fetch();
	}catch(DA_Exception $e){
		echo $e->getMessage();
	}

First, we have to set a domain. Most of the times this is the same domain
we have connected to. 

Secondly we create a try-catch blog. This is because the classes can throw 
DA_Exceptions.

Finally we fetch the list of emails with $emails->fetch() and assign it to $list.

This is pretty most the same for other classes like DA_Forwarders and DA_Autoresponders

Create and Modify
-----------------

If we use the same setup as above with the fetch method, the only thing we 
have to change is this:

	$emails->create('user','password');

Modify goes the same way

	$emails->modify('user','password');

Delete
------

	$emails->delete('username');
	

	