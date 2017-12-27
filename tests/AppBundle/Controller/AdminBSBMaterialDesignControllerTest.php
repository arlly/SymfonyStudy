<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdminBSBMaterialDesignControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/bmb/index');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
