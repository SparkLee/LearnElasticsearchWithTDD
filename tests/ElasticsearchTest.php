<?php

namespace Tests;

use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;

class ElasticsearchTest extends TestCase
{
    /**
     * @var Client
     */
    private $client;

    /**
     * ElasticsearchTest constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->client = $this->buildEsClient();
    }

    /**
     * @return Client
     */
    protected function buildEsClient(): Client
    {
        return ClientBuilder::create()
            ->setHosts(['http://114.116.105.109:9200'])
            ->build();
    }

    public function test_es()
    {
        $res = $this->client->indices()
            ->delete([
                'index' => 'test_index'
            ]);
        $this->assertEquals($res, ['acknowledged' => true]);

        $res = $this->client->index([
            'index' => 'test_index',
            'id' => '001',
            'body' => [
                'name' => 'Spark Lee',
                'age' => 10,
                'addr' => '岳麓区新长海中心B1栋8A03室',
            ]
        ]);
        $this->assertEquals('created', $res['result']);

        $res = $this->client->index([
            'index' => 'test_index',
            'id' => '002',
            'body' => [
                'name' => 'Wei Lee',
                'age' => 10,
                'addr' => 'chang sha',
            ]
        ]);
        $this->assertEquals('created', $res['result']);

        $res = $this->client->get([
            'index' => 'test_index',
            'id' => '001',
        ]);
        $this->assertTrue($res['found']);
        $this->assertEquals('Spark Lee', $res['_source']['name']);

        $res = $this->client->search([
            'index' => 'test_index',
            'body' => [
                'query' => [
                    'match' => [
                        'name' => 'Wei'
                    ]
                ]
            ]
        ]);

        $res = $this->client->delete([
            'index' => 'test_index',
            'id' => '001',
        ]);
        $this->assertEquals('deleted', $res['result']);
    }
}
