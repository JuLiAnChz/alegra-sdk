<?php

namespace Alegra\SDK\Tests\Api;

use PHPUnit\Framework\TestCase;
use Alegra\SDK\Api\ProductServiceApi;
use Alegra\SDK\Request;

class ProductServiceApiTest extends TestCase
{
	public function testFindItemById()
	{
		$request = new Request();
		$item = new ProductServiceApi($request);
		$Item = $item->findById(51);

		$this->assertEquals($Item->id, 51);
	}

	public function testFindAllItems()
	{
		$request = new Request();
		$item = new ProductServiceApi($request);
		$Item = $item->findAll([
			'start' => 0,
			'limit' => 10
		]);

		$this->assertIsArray($Item);
	}

	public function testCreateItem()
	{
		$request = new Request();
		$item = new ProductServiceApi($request);
		$Item = $item->create([
			'name' => 'Producto de prueba',
			'price' => '100',
		]);

		$this->assertIsObject($Item);
	}

	public function testUpdateItem()
	{
		$request = new Request();
		$item = new ProductServiceApi($request);
		$Item = $item->update(93, [
			'price' => '5000',
		]);

		$this->assertIsObject($Item);
	}

	public function testDeleteItem()
	{
		$request = new Request();
		$item = new ProductServiceApi($request);
		$Item = $item->delete(93);

		$this->assertIsObject($Item);
	}
}
