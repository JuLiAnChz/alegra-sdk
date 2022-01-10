<?php

namespace Alegra\SDK\Api;

use Alegra\SDK\Configuration;
use Alegra\SDK\Exceptions\ApiException;
use Alegra\SDK\Request;
use GuzzleHttp\Psr7\Uri;
use InvalidArgumentException;

class InvoiceApi
{
	protected $request;

	public function __construct(Request $request = null)
	{
		$this->request = $request ?: new Request();
		$this->request->setPath('invoices');
	}

	public function getConfig(): Configuration
	{
		return $this->config;
	}

	public function findById(int $invoiceId)
	{
		try {
			$Invoice = $this->request->findById($invoiceId);
			return $Invoice;
		} catch (ApiException $e) {
			throw $e;
		}
	}

	public function findAll($parameters = [])
	{
		try {
			$Invoices = $this->request->findAll($parameters);
			return $Invoices;
		} catch (ApiException $e) {
			throw $e;
		}
	}

	public function create($body)
	{
		try {
			$Invoice = $this->request->create($body);
			return $Invoice;
		} catch (ApiException $e) {
			throw $e;
		}
	}

	public function update(int $invoiceId, $bodyParams = [])
	{
		try {
			$Invoice = $this->request->update($invoiceId, $bodyParams);
			return $Invoice;
		} catch (ApiException $e) {
			throw $e;
		}
	}

	public function sendEmail(int $invoiceId, $bodyParams = [])
	{
		try {
			$Invoice = $this->sendEmailInvoiceRequest($invoiceId, $bodyParams);
			return $Invoice;
		} catch (ApiException $e) {
			throw $e;
		}
	}

	protected function sendEmailInvoiceRequest($invoiceId, $bodyParams)
	{
		if (!$invoiceId) throw new InvalidArgumentException('Missing the required parameter $invoiceId when calling sendEmailInvoice');
		if (count($bodyParams) === 0) throw new InvalidArgumentException('Missing the required parameter $bodyParams when calling sendEmailInvoice');

		$headers = $this->headers->headers();

		if ($this->config->getAccessToken()) {
			$headers['Authorization'] = $this->config->getAuthorization();
		}

		$uri = new Uri($this->config->getHost() . '/invoices/' . $invoiceId . '/email');

		$response = $this->client->request('POST', $uri, [
			'headers' => $headers,
			\GuzzleHttp\RequestOptions::JSON => $bodyParams
		]);

		$responseBody = json_decode($response->getBody());
		return $responseBody;
	}

	public function delete(int $invoiceId)
	{
		try {
			$Invoice = $this->request->delete($invoiceId);
			return $Invoice;
		} catch (ApiException $e) {
			throw $e;
		}
	}
}
