<?php

namespace Alegra\SDK;

class Configuration
{
	protected $host;
	protected $accessToken;
	protected $authorization;

	public function __construct()
	{
		$this->host = config('alegra.base_uri', '');
		$this->accessToken = config('alegra.access_token');
		$this->authorization = config('alegra.authorization');
	}

	public function setAccessToken($token)
	{
		$this->accessToken = $token;
		return $this;
	}

	public function getAccessToken()
	{
		return $this->accessToken ?: null;
	}

	public function setHost($host)
	{
		$this->host = $host;
		return $this;
	}

	public function getHost()
	{
		return $this->host ?: null;
	}

	public function getAuthorization()
	{
		return $this->authorization . ' ' . $this->getAccessToken();
	}
}
