<?php

namespace Alegra\SDK\Tests\Api;

use PHPUnit\Framework\TestCase;
use Alegra\SDK\Api\ContactApi;
use Alegra\SDK\Request;

class ContactApiTest extends TestCase
{
	public function testFindContactById()
	{
		$request = new Request();
		$contact = new ContactApi($request);
		$Contact = $contact->findById(6);

		$this->assertEquals($Contact->id, 6);
	}

	public function testFindAllContacts()
	{
		$request = new Request();
		$contact = new ContactApi($request);
		$Contacts = $contact->findAll([
			'start' => 0,
			'limit' => 10
		]);

		$this->assertIsArray($Contacts);
	}

	public function testCreateContact()
	{
		$request = new Request();
		$contact = new ContactApi($request);
		$Contact = $contact->create([
			'name' => [
				'firstName' => 'Pepito',
				'secondName' => 'Antonio',
				'lastName' => 'Perez'
			],
			'identificationObject' => [
				'type' => 'CC',
				'number' => '1122334455'
			],
			'address' => [
				'description' => 'Calle 123',
				'city' => 'Bogotá D.C',
				'country' => 'Colombia',
				'department' => 'Cundinamarca'
			],
			'kindOfPerson' => 'PERSON_ENTITY'
		]);

		$this->assertIsObject($Contact);
	}

	public function testUpdateContact()
	{
		$request = new Request();
		$contact = new ContactApi($request);
		$Contact = $contact->update(115, [
			'address' => [
				'description' => 'Calle 123',
				'city' => 'Bogotá D.C',
				'country' => 'Colombia',
				'department' => 'Cundinamarca'
			],
			'email' => 'email@email.com',
			'mobile' => '9999999'
		]);

		$this->assertIsObject($Contact);
	}

	public function testDeleteContact()
	{
		$request = new Request();
		$contact = new ContactApi($request);
		$Contact = $contact->delete(115);

		$this->assertIsObject($Contact);
	}
}
