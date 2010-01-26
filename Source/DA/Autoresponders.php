<?php

/**
 * http://www.directadmin.com/api.html#email
 * http://www.directadmin.com/features.php?id=348
 */

include_once 'Api.php';

class DA_Autoresponders extends DA_API {

	/**
	 * Fetch all the Autoresponders
	 * @param string $domain
	 * @return array array(array('user' => 'destination email'))
	 */
	public function fetch($domain=null){
		$domain = $this->getDomain($domain);

		$this->sock->query('/CMD_API_EMAIL_AUTORESPONDER',array(
			'domain' => $domain
		));
		$rows = $this->sock->fetch_parsed_body();
		$keys = array_keys($rows);
		if(isset($keys[1]) && $keys[1] == '#95API'){
			$rows = array();
		}
		return $rows;
	}

	/**
	 * Fetch the destination url of a forwarder
	 * @param string $user
	 * @param string $domain
	 * @return string
	 */
	public function fetchUser($user,$domain=null){
		$domain = $this->getDomain($domain);

		$this->sock->query('/CMD_API_EMAIL_AUTORESPONDER_MODIFY',array(
			'domain'	=> $domain,
			'user'		=> $user
		));
		return $this->sock->fetch_parsed_body();
	}

	/**
	 * Create a forwarder
	 * @param string $user
	 * @param string $email
	 * @param string $domain
	 * @return bool
	 */
	public function create($user,$msg,$email=null,$domain=null){
		$domain = $this->getDomain($domain);

		$data = array(
			'action' 	=> 'create',
			'domain' 	=> $domain,
			'user'		=> $user,
			'text'		=> $msg,
			'cc'		=> empty($email) ? 'OFF' : 'ON',
			'email'		=> $email,
			'create'	=> 'Create'
		);
		$this->sock->query('/CMD_API_EMAIL_AUTORESPONDER',$data);

		$ret = $this->sock->fetch_parsed_body();
		return isset($ret['error']) && $ret['error'] == 0;
	}

	/**
	 * Set the password of an emailaddress
	 * @param string $user
	 * @param string $pass
	 * @param string $domain
	 * @return bool
	 */
	public function modify($user,$msg,$email,$domain=null){
		$domain = $this->getDomain($domain);

		$this->sock->query('/CMD_API_EMAIL_AUTORESPONDER',array(
			'action'	=> 'modify',
			'domain' 	=> $domain,
			'user'		=> $user,
			'text'		=> $msg,
			'cc'		=> empty($email) ? 'OFF' : 'ON',
			'email'		=> $email,
			'create'	=> 'Create'
		));

		$ret = $this->sock->fetch_parsed_body();
		return isset($ret['error']) && $ret['error'] == 0;
	}

	/**
	 * Delete an user
	 * @param string $user
	 * @param string $domain
	 * @return bool
	 */
	public function delete($user,$domain=null){
		$domain = $this->getDomain($domain);

		$this->sock->query('/CMD_API_EMAIL_AUTORESPONDER',array(
			'action'	=> 'delete',
			'domain' 	=> $domain,
			'user'		=> $user,
			'select0'	=> $user
		));

		$ret = $this->sock->fetch_parsed_body();
		return isset($ret['error']) && $ret['error'] == 0;
	}

}
