<?php

namespace Alegra\SDK\Tests\Api;

use PHPUnit\Framework\TestCase;
use Alegra\SDK\Api\InvoiceApi;
use Alegra\SDK\Request;

class InvoiceApiTest extends TestCase
{
	public function testFindInvoiceById()
	{
		$request = new Request();
		$invoice = new InvoiceApi($request);
		$Invoice = $invoice->findById(823);

		$this->assertEquals($Invoice->id, 823);
	}

	public function testFindAllInvoices()
	{
		$request = new Request();
		$invoice = new InvoiceApi($request);
		$Invoices = $invoice->findAll([
			'start' => 0,
			'limit' => 10
		]);

		$this->assertIsArray($Invoices);
	}

	public function testCreateInvoice()
	{
		$request = new Request();
		$invoice = new InvoiceApi($request);
		$Invoice = $invoice->create([
			'date' => '2022-01-08',
			'dueDate' => '2022-01-08',
			'client' => 6,
			'items' => [
				[
					'id' => 14,
					'price' => 10000,
					'quantity' => 1,
				]
			],
			'paymentForm' => 'CASH',
			'paymentMethod' => 'CASH',
			'stamp' => false,
		]);

		$this->assertIsObject($Invoice);
	}

	public function testEditInvoice()
	{
		$request = new Request();
		$invoice = new InvoiceApi($request);
		$Invoice = $invoice->update(824, [
			'dueDate' => '2022-01-09',
			'paymentForm' => 'CASH',
			'paymentMethod' => 'CREDIT_CARD',
		]);

		$this->assertIsObject($Invoice);
	}

	public function testSendEmailInvoice()
	{
		$request = new Request();
		$invoice = new InvoiceApi($request);
		$Invoice = $invoice->sendEmail(824, ['emails' => ['email@email.com']]);

		$this->assertIsObject($Invoice);
	}

	public function testDeleteInvoice()
	{
		$request = new Request();
		$invoice = new InvoiceApi($request);
		$Invoice = $invoice->delete(824);

		$this->assertIsObject($Invoice);
	}
}
