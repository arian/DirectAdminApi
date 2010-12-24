<?php

include_once dirname(__FILE__) . '/../HTTPSocket.php';

abstract class DA_Api {

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
	public function __construct(HTTPSocket $sock, $domain = null){
		$this->sock = $sock;
		$this->domain = $domain;
	}

	public function setDomain($domain){
		$this->domain = $domain;
	}

	public function getDomain($domain = null){
		if (!$domain) $domain = $this->domain;
		if (empty($domain)){
			include_once dirname(__FILE__) . '/Exception.php';
			throw new DA_Exception('No domain set, use the setDomain method to set one!');
		}
		return $domain;
	}

}
