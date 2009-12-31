<?php

/**
 * http://www.directadmin.com/api.html#email
 */

class DA_Forwarders extends DA_API {
	
	/**
	 * Fetch all the forwarders
	 * @param string $domain
	 * @return array array(array('user' => 'destination email'))
	 */
	public function fetch($domain=null){
		$domain = $this->getDomain($domain);
		
		$this->sock->query('/CMD_API_EMAIL_FORWARDERS',array(
			'action' => 'list',
			'domain' => $domain
		));
		return $this->sock->fetch_parsed_body();
	}
	
	/**
	 * Fetch the destination url of a forwarder
	 * @param string $user
	 * @param string $domain
	 * @return string 
	 */
	public function fetchUser($user,$domain=null){
		$users = $this->fetch($domain);
		return isset($users[$user]) ? $users[$user] : null;
	}
	
	/**
	 * Create a forwarder
	 * @param string $user
	 * @param string $email
	 * @param string $domain
	 * @return bool
	 */
	public function create($user,$email,$domain=null){
		$domain = $this->getDomain($domain);
		
		$this->sock->query('/CMD_API_EMAIL_FORWARDERS',array(
			'action' 	=> 'create',
			'domain' 	=> $domain,
			'user'		=> $user,
			'email'		=> $email,
		));
		
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
	public function modify($user,$email,$domain=null){
		$domain = $this->getDomain($domain);

		$this->sock->query('/CMD_API_EMAIL_FORWARDERS',array(
			'action'	=> 'modify',
			'domain' 	=> $domain,
			'user'		=> $user,
			'email'		=> $email,
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
				
		$this->sock->query('/CMD_API_EMAIL_FORWARDERS',array(
			'action'	=> 'delete',
			'domain' 	=> $domain,
			'user'		=> $user,
			'select0'	=> $user
		));
		
		$ret = $this->sock->fetch_parsed_body();
		return isset($ret['error']) && $ret['error'] == 0;
	}
	
}
