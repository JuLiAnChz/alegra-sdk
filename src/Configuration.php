<?php

namespace Alegra\SDK;

$GLOBALS['version'] = '1.0.0';

class Configuration
{
	protected $host = 'https://api.alegra.com/api/v1';
	protected $accessToken = '';
	protected $authorization = 'Basic';

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
