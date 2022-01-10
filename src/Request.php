<?php

namespace Alegra\SDK;

use Alegra\SDK\Exceptions\ApiException;
use Alegra\SDK\Models\AlegraLog;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Uri;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ClientException;
use InvalidArgumentException;
use Exception;

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
		// Generate log FIXME: unorthodox
		$AlegraLog = new AlegraLog();
		$AlegraLog->service = $uri->getPath();
		$AlegraLog->save();

		$AlegraLog->request = json_encode([
			'headers' => $headers
		]);

		try {
			$response = $this->client->request('GET', $uri, [
				'headers' => $headers
			]);

			$statusCode = $response->getStatusCode();


			$AlegraLog->status_code = $statusCode;
			$AlegraLog->response = $response->getBody();
			$AlegraLog->save();

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
		} catch (RequestException $e) {
			$AlegraLog->status_code = $e->getCode();
			$AlegraLog->response = $e->getResponse()->getBody();
			$AlegraLog->save();
			throw $e;
		} catch (Exception $e) {
			$AlegraLog->status_code = $e->getCode();
			$AlegraLog->response = $e->getMessage();
			$AlegraLog->save();
			throw $e;
		} catch (ClientException $e) {
			$AlegraLog->status_code = $e->getCode();
			$AlegraLog->response = $e->getResponse()->getBody();
			$AlegraLog->save();
			throw $e;
		}
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
		// Generate log FIXME: unorthodox
		$AlegraLog = new AlegraLog();
		$AlegraLog->service = $uri->getPath();
		$AlegraLog->save();

		$AlegraLog->request = json_encode([
			'headers' => $headers
		]);

		try {
			$response = $this->client->request('GET', $uri, [
				'headers' => $headers
			]);

			$statusCode = $response->getStatusCode();

			$AlegraLog->status_code = $statusCode;
			$AlegraLog->response = $response->getBody();
			$AlegraLog->save();

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
		} catch (RequestException $e) {
			$AlegraLog->status_code = $e->getCode();
			$AlegraLog->response = $e->getResponse()->getBody();
			$AlegraLog->save();
			throw $e;
		} catch (Exception $e) {
			$AlegraLog->status_code = $e->getCode();
			$AlegraLog->response = $e->getMessage();
			$AlegraLog->save();
			throw $e;
		} catch (ClientException $e) {
			$AlegraLog->status_code = $e->getCode();
			$AlegraLog->response = $e->getResponse()->getBody();
			$AlegraLog->save();
			throw $e;
		}
	}

	public function create($body = null)
	{
		if (!$body) throw new InvalidArgumentException('Missing the required parameter $body when calling createInvoice');

		$headers = $this->headers->headers();

		if ($this->config->getAccessToken()) {
			$headers['Authorization'] = $this->config->getAuthorization();
		}

		$uri = new Uri($this->config->getHost() . "/{$this->path}");

		// Generate log FIXME: unorthodox
		$AlegraLog = new AlegraLog();
		$AlegraLog->service = $uri->getPath();
		$AlegraLog->save();

		$AlegraLog->request = json_encode([
			'headers' => $headers,
			\GuzzleHttp\RequestOptions::JSON => $body
		]);

		try {
			$response = $this->client->request('POST', $uri, [
				'headers' => $headers,
				\GuzzleHttp\RequestOptions::JSON => $body
			]);

			$statusCode = $response->getStatusCode();

			$AlegraLog->status_code = $statusCode;
			$AlegraLog->response = $response->getBody();
			$AlegraLog->save();

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
		} catch (RequestException $e) {
			$AlegraLog->status_code = $e->getCode();
			$AlegraLog->response = $e->getResponse()->getBody();
			$AlegraLog->save();
			throw $e;
		} catch (Exception $e) {
			$AlegraLog->status_code = $e->getCode();
			$AlegraLog->response = $e->getMessage();
			$AlegraLog->save();
			throw $e;
		} catch (ClientException $e) {
			$AlegraLog->status_code = $e->getCode();
			$AlegraLog->response = $e->getResponse()->getBody();
			$AlegraLog->save();
			throw $e;
		}
	}

	public function update(int $id, $bodyParams = [])
	{
		if (!$id) throw new InvalidArgumentException('Missing the required parameter $id when calling editInvoice');

		$headers = $this->headers->headers();

		if ($this->config->getAccessToken()) {
			$headers['Authorization'] = $this->config->getAuthorization();
		}

		$uri = new Uri($this->config->getHost() . "/{$this->path}/" . $id);

		// Generate log FIXME: unorthodox
		$AlegraLog = new AlegraLog();
		$AlegraLog->service = $uri->getPath();
		$AlegraLog->save();

		$AlegraLog->request = json_encode([
			'headers' => $headers,
			\GuzzleHttp\RequestOptions::JSON => $bodyParams
		]);

		try {
			$response = $this->client->request('PUT', $uri, [
				'headers' => $headers,
				\GuzzleHttp\RequestOptions::JSON => $bodyParams
			]);

			$statusCode = $response->getStatusCode();

			$AlegraLog->status_code = $statusCode;
			$AlegraLog->response = $response->getBody();
			$AlegraLog->save();

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
		} catch (RequestException $e) {
			$AlegraLog->status_code = $e->getCode();
			$AlegraLog->response = $e->getResponse()->getBody();
			$AlegraLog->save();
			throw $e;
		} catch (Exception $e) {
			$AlegraLog->status_code = $e->getCode();
			$AlegraLog->response = $e->getMessage();
			$AlegraLog->save();
			throw $e;
		} catch (ClientException $e) {
			$AlegraLog->status_code = $e->getCode();
			$AlegraLog->response = $e->getResponse()->getBody();
			$AlegraLog->save();
			throw $e;
		}
	}

	public function delete(int $id)
	{
		if (!$id) throw new InvalidArgumentException('Missing the required parameter $id when calling deleteInvoice');

		$headers = $this->headers->headers();

		if ($this->config->getAccessToken()) {
			$headers['Authorization'] = $this->config->getAuthorization();
		}

		$uri = new Uri($this->config->getHost() . "/{$this->path}/" . $id);

		// Generate log FIXME: unorthodox
		$AlegraLog = new AlegraLog();
		$AlegraLog->service = $uri->getPath();
		$AlegraLog->save();

		$AlegraLog->request = json_encode([
			'headers' => $headers
		]);

		try {
			$response = $this->client->request('DELETE', $uri, [
				'headers' => $headers
			]);

			$statusCode = $response->getStatusCode();

			$AlegraLog->status_code = $statusCode;
			$AlegraLog->response = $response->getBody();
			$AlegraLog->save();

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
		} catch (RequestException $e) {
			$AlegraLog->status_code = $e->getCode();
			$AlegraLog->response = $e->getResponse()->getBody();
			$AlegraLog->save();
			throw $e;
		} catch (Exception $e) {
			$AlegraLog->status_code = $e->getCode();
			$AlegraLog->response = $e->getMessage();
			$AlegraLog->save();
			throw $e;
		} catch (ClientException $e) {
			$AlegraLog->status_code = $e->getCode();
			$AlegraLog->response = $e->getResponse()->getBody();
			$AlegraLog->save();
			throw $e;
		}
	}
}
