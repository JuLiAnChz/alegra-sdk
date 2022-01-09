<?php

namespace Alegra\SDK;

use Alegra\SDK\Exceptions\ApiException;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Uri;
use InvalidArgumentException;

class Request
{
	protected $config;
	protected $client;
	protected $headers;
	protected $path;

	public function __construct(Configuration $config = null, ClientInterface $client = null, Headers $headers = null)
	{
		$this->config = $config ?: new Configuration();
		$this->client = $client ?: new Client(['verify' => false]);
		$this->headers = $headers ?: new Headers();
	}

	public function setPath(string $path)
	{
		$this->path = $path;
		return $this;
	}

	public function getConfig(): Configuration
	{
		return $this->config;
	}

	public function findById(int $id)
	{
		if (!$id) throw new InvalidArgumentException('Missing the required parameter $id when calling getInvoiceById');

		$headers = $this->headers->headers();

		if ($this->config->getAccessToken()) {
			$headers['Authorization'] = $this->config->getAuthorization();
		}

		$uri = new Uri($this->config->getHost() . "/{$this->path}/" . $id);

		$response = $this->client->request('GET', $uri, [
			'headers' => $headers
		]);

		$statusCode = $response->getStatusCode();

		if ($statusCode < 200 || $statusCode > 299) {
			throw new ApiException(
				sprintf('[%d] Error connecting to the API (%s)', $statusCode, $uri->getPath()),
				$statusCode,
				$response->getHeaders(),
				$response->getBody()
			);
		}

		$responseBody = json_decode($response->getBody());

		return $responseBody;
	}

	public function findAll($parameters = [])
	{
		$headers = $this->headers->headers();

		if ($this->config->getAccessToken()) {
			$headers['Authorization'] = $this->config->getAuthorization();
		}

		$uri = new Uri($this->config->getHost() . "/{$this->path}");

		if (count($parameters) > 0) {
			$uri = $uri->withQuery(http_build_query($parameters));
		}

		$response = $this->client->request('GET', $uri, [
			'headers' => $headers
		]);

		$statusCode = $response->getStatusCode();

		if ($statusCode < 200 || $statusCode > 299) {
			throw new ApiException(
				sprintf('[%d] Error connecting to the API (%s)', $statusCode, $uri->getPath()),
				$statusCode,
				$response->getHeaders(),
				$response->getBody()
			);
		}

		$responseBody = json_decode($response->getBody());
		return $responseBody;
	}

	public function create($body = null)
	{
		if (!$body) throw new InvalidArgumentException('Missing the required parameter $body when calling createInvoice');

		$headers = $this->headers->headers();

		if ($this->config->getAccessToken()) {
			$headers['Authorization'] = $this->config->getAuthorization();
		}

		$uri = new Uri($this->config->getHost() . "/{$this->path}");

		$response = $this->client->request('POST', $uri, [
			'headers' => $headers,
			\GuzzleHttp\RequestOptions::JSON => $body
		]);

		$statusCode = $response->getStatusCode();

		if ($statusCode < 200 || $statusCode > 299) {
			throw new ApiException(
				sprintf('[%d] Error connecting to the API (%s)', $statusCode, $uri->getPath()),
				$statusCode,
				$response->getHeaders(),
				$response->getBody()
			);
		}

		$responseBody = json_decode($response->getBody());
		return $responseBody;
	}

	public function update(int $id, $bodyParams = [])
	{
		if (!$id) throw new InvalidArgumentException('Missing the required parameter $id when calling editInvoice');

		$headers = $this->headers->headers();

		if ($this->config->getAccessToken()) {
			$headers['Authorization'] = $this->config->getAuthorization();
		}

		$uri = new Uri($this->config->getHost() . "/{$this->path}/" . $id);

		$response = $this->client->request('PUT', $uri, [
			'headers' => $headers,
			\GuzzleHttp\RequestOptions::JSON => $bodyParams
		]);

		$statusCode = $response->getStatusCode();

		if ($statusCode < 200 || $statusCode > 299) {
			throw new ApiException(
				sprintf('[%d] Error connecting to the API (%s)', $statusCode, $uri->getPath()),
				$statusCode,
				$response->getHeaders(),
				$response->getBody()
			);
		}

		$responseBody = json_decode($response->getBody());
		return $responseBody;
	}

	public function delete(int $id)
	{
		if (!$id) throw new InvalidArgumentException('Missing the required parameter $id when calling deleteInvoice');

		$headers = $this->headers->headers();

		if ($this->config->getAccessToken()) {
			$headers['Authorization'] = $this->config->getAuthorization();
		}

		$uri = new Uri($this->config->getHost() . "/{$this->path}/" . $id);

		$response = $this->client->request('DELETE', $uri, [
			'headers' => $headers
		]);

		$statusCode = $response->getStatusCode();

		if ($statusCode < 200 || $statusCode > 299) {
			throw new ApiException(
				sprintf('[%d] Error connecting to the API (%s)', $statusCode, $uri->getPath()),
				$statusCode,
				$response->getHeaders(),
				$response->getBody()
			);
		}

		$responseBody = json_decode($response->getBody());
		return $responseBody;
	}
}
