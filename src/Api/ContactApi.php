<?php

namespace Alegra\SDK\Api;

use Alegra\SDK\Request;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use InvalidArgumentException;
use Exception;

class ContactApi
{
	protected $request;

	public function __construct(Request $request = null)
	{
		$this->request = $request ?: new Request();
		$this->request->setPath('contacts');
	}

	public function findById(int $contactId)
	{
		try {
			$Contact = $this->request->findById($contactId);
			return $Contact;
		} catch (InvalidArgumentException $e) {
			throw $e;
		} catch (RequestException $e) {
			throw $e;
		} catch (Exception $e) {
			throw $e;
		} catch (ClientException $e) {
			throw $e;
		}
	}

	public function findAll($parameters = [])
	{
		try {
			$Contacts = $this->request->findAll($parameters);
			return $Contacts;
		} catch (InvalidArgumentException $e) {
			throw $e;
		} catch (RequestException $e) {
			throw $e;
		} catch (Exception $e) {
			throw $e;
		} catch (ClientException $e) {
			throw $e;
		}
	}

	public function create($contact)
	{
		try {
			$Contact = $this->request->create($contact);
			return $Contact;
		} catch (InvalidArgumentException $e) {
			throw $e;
		} catch (RequestException $e) {
			throw $e;
		} catch (Exception $e) {
			throw $e;
		} catch (ClientException $e) {
			throw $e;
		}
	}

	public function update(int $contactId, $bodyParams = [])
	{
		try {
			$Contact = $this->request->update($contactId, $bodyParams);
			return $Contact;
		} catch (InvalidArgumentException $e) {
			throw $e;
		} catch (RequestException $e) {
			throw $e;
		} catch (Exception $e) {
			throw $e;
		} catch (ClientException $e) {
			throw $e;
		}
	}

	public function delete(int $contactId)
	{
		try {
			$Contact = $this->request->delete($contactId);
			return $Contact;
		} catch (InvalidArgumentException $e) {
			throw $e;
		} catch (RequestException $e) {
			throw $e;
		} catch (Exception $e) {
			throw $e;
		} catch (ClientException $e) {
			throw $e;
		}
	}
}
