<?php
// tests/Controller/ContentControllerTest.php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ContentControllerTest extends WebTestCase
{
    public function testShowConent()
    {
        $client = static::createClient();

        $client->request('GET', '/api/content/3');

         $client->request(
	        'GET',
	        '/api/content/3',
	        [],
	        [],
	        [
	            #'HTTP_Host'            => 'sf4.local',
	            #'REMOTE_ADDR'          => '127.0.0.1',
	            'x-auth-token' => 'xyz',
	        ]
	    );


        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}