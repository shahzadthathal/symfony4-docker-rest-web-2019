<?php
// tests/Controller/ContentControllerTest.php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ContentControllerTest extends WebTestCase
{
    public function testShowContent()
    {
        $client = static::createClient();
		$client->request(
	        'GET',
	        '/api/content/3',
	        [],
	        [],
	        [
	            'HTTP_X-AUTH-TOKEN' => 'xyz',
	        ]
	    );

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }


    public function testShowAllContents()
    {
        $client = static::createClient();
        $client->request(
	        'GET',
	        '/api/contents',
	        [],
	        [],
	        [
	            'HTTP_X-AUTH-TOKEN' => 'xyz',
	        ]
	    );

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testAddContent()
    {
        $client = static::createClient();
		$client->request(
	        'POST',
	        '/api/content',
	        [],
	        [],
	        [
	        	'CONTENT_TYPE' => 'application/json',
	            'HTTP_X-AUTH-TOKEN' => 'xyz',
	        ],
	        '{"title":"My title from unit test","description":"My description from unit test","content":"My content from unit test","email":"xyz@app.com"}'
	    );
		
        $this->assertEquals(201, $client->getResponse()->getStatusCode());
    }
}