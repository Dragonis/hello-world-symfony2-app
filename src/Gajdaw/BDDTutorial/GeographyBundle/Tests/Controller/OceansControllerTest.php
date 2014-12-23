<?php

namespace Gajdaw\BDDTutorial\GeographyBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class OceansControllerTest extends WebTestCase
{
    public function testPacific()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/geography/oceans/pacific');
    }

}
