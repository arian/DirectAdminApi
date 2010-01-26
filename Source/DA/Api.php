<?php

include_once 'HTTPSocket.php';

abstract class DA_API {

	/**
	 * @var HTTPSocket
	 */
	protected $sock;

	/**
	 * The default domain
	 * @var string
	 */
	protected $domain;

	/**
	 *
	 * @param HTTPSocket $sock
	 * @return
	 */
	public function __construct(HTTPSocket $sock,$domain=null){
		$this->sock = $sock;
		$this->domain = $domain;
	}

	public function setDomain($domain){
		$this->domain = $domain;
	}

	public function getDomain($domain=null){
		$domain = $domain ? $domain : $this->domain;
		if(empty($domain)){
			include_once 'Exception.php';
			throw new DA_Exception('No Domain is set!');
		}
		return $domain;
	}

}
