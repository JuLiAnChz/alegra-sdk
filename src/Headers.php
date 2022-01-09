<?php

namespace Alegra\SDK;

use Exception;

class Headers
{
	public function headers()
	{
		$headers = [];
		$headers['Content-Type'] = $this->contentTypeHeader();
		$headers['Accept'] = $this->acceptHeader();

		if($this->authorization()) {
			$headers['Authorization'] = $this->authorization();
		}

		return $headers;
	}

	private function authorization($authorization = null)
	{
		return $authorization ?: null;
	}

	private function acceptHeader($accept = null)
	{
		return $accept ?: 'application/json';
	}

	private function contentTypeHeader($contentType = null)
	{
		return $contentType ?: 'application/json';
	}
}
