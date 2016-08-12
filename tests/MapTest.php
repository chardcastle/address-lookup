<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use Hardcastle\Map\DataSource;
use Hardcastle\Map\Result;

class MapTest extends TestCase
{

    /**
     * /usr/local/bin/phpunit --filter it_can_find_an_address tests/MapTest.php
     * @test
     */
    public function it_can_find_an_address()
    {
        // GIVEN
        // An address
        $term = urlencode('31 Chertsey Street');

        // WHEN
        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', 'https://maps.googleapis.com/maps/api/geocode/json?address=' . $term);

        // THEN
        // Description of it being tested
        $this->assertEquals(200, $res->getStatusCode());
        $this->assertContains("Chertsey Street", $res->getBody()->getContents());

    }

    /**
     * /usr/local/bin/phpunit --filter it_can_load_an_address_result tests/MapTest.php
     * @test
     */
    public function it_can_load_an_address_result()
    {
        // GIVEN
        // An address
        $term = urlencode('31 Chertsey Street');

        // WHEN
        $mapDataSource = new Hardcastle\Map\DataSource;
        $mapDataSource->search($term);

        // THEN
        // Description of it being tested
        $results = $mapDataSource->getResult();

        $this->assertEquals("GU1 4HD", $results->getPostCode());
        $this->assertEquals(51.2384662, $results->getLatitude());
        $this->assertEquals(-0.5709511, $results->getLongitude());
        $this->assertEquals('ChIJ7wVBSpjQdUgR0imcplgulFI', $results->getPlaceId());
    }

    /**
     * /usr/local/bin/phpunit --filter it_can_save_a_result_to_csv_file tests/MapTest.php
     * @test
     */
    public function it_can_save_a_result_to_csv_file()
    {       
        // GIVEN
        // Result object
        $faker = Faker\Factory::create();
        $result = new Hardcastle\Map\Result;
        $result->setTerm(urlencode($faker->streetAddress));
        $result->setPostCode($faker->postcode);
        $result->setLatitude($faker->latitude);
        $result->setLongitude($faker->longitude);
        // 27 random characters for place ID
        $result->setPlaceId(substr(md5($faker->streetAddress), 0, 27));

        // WHEN
        // Result save is called
        $result->save('test.csv');

        // THEN
        // We see the entry in the file
        $csvFile = file_get_contents(__DIR__ . '/../data/test.csv');
        $this->assertContains($result->getPostCode(), $csvFile);
        
    }

}