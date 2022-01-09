<?php

namespace Alegra\SDK\Exceptions;

use \Exception;

class ApiException extends Exception
{
	protected $responseBody;
	protected $responseHeaders;
	protected $responseObject;

	public function __construct($message = '', $code = 0, $responseHeaders, $responseBody)
	{
		parent::__construct($message, $code);
		$this->responseHeaders = $responseHeaders;
		$this->responseBody = $responseBody;
	}

	public function getResponseHeaders()
	{
		return $this->responseHeaders;
	}

	public function getResponseBody()
	{
		return $this->responseBody;
	}

	public function responseObject()
	{
		return $this->responseObject;
	}

	public function setResponseObject($obj)
	{
		$this->responseObject = $obj;
	}
}
