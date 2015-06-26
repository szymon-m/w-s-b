<?php

namespace WsbPozBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdminControllerTest extends WebTestCase
{
    public function testNowy_film()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/admin/nowy_film');
    }

    public function testUsun_film()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/admin/usun_film');
    }

    public function testZmien_obsade()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/admin/zmien_obsade');
    }

    public function testDodaj_aktora()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/admin/dodaj_aktora');
    }

    public function testUsun_aktora()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/admin/usun_aktora');
    }

}
