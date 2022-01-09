<?php

namespace Alegra\SDK\Api;

use Alegra\SDK\Request;
use Exception;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use InvalidArgumentException;

class ProductServiceApi
{
	protected $request;

	public function __construct(Request $request = null)
	{
		$this->request = $request ?: new Request();
		$this->request->setPath('items');
	}

	public function findById(int $productId)
	{
		try {
			$Item = $this->request->findById($productId);
			return $Item;
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
			$Items = $this->request->findAll($parameters);
			return $Items;
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

	public function create($item)
	{
		try {
			$Item = $this->request->create($item);
			return $Item;
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

	public function update(int $itemId, $bodyParams = [])
	{
		try {
			$Item = $this->request->update($itemId, $bodyParams);
			return $Item;
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

	public function delete(int $itemId)
	{
		try {
			$Item = $this->request->delete($itemId);
			return $Item;
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
