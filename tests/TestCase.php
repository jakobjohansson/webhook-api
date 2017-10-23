<?php

namespace Hook\Tests;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase as BaseTest;

abstract class TestCase extends BaseTest
{
    /**
     * The HTTP client.
     *
     * @var \GuzzleHttp\Client
     */
    public $client;

    /**
     * The payload to send.
     *
     * @var string
     */
    public $payload;

    /**
     * The map of pre defined GitHub payloads.
     *
     * @var array
     */
    public $gitHub;

    /**
     * The headers for the request.
     *
     * @var array
     */
    public $headers = [
        'Content-Type' => 'application/json',
    ];

    /**
     * Set up a client when constructing the test.
     */
    public function setUp()
    {
        parent::setUp();

        $this->client = new Client(['base_uri' => 'http://hook.dev']);
        $this->gitHub = PayloadMap::GitHub();
    }

    /**
     * Set the payload to send.
     *
     * @param array $payload
     *
     * @return $this
     */
    public function payload($payload)
    {
        $this->payload = $payload;

        return $this;
    }

    /**
     * Set the event header.
     *
     * @param string $event
     *
     * @return $this
     */
    public function event($event)
    {
        $this->headers['X-GitHub-Event'] = $event;

        return $this;
    }

    /**
     * Set the signature header.
     *
     * @param string $signature
     *
     * @return $this
     */
    public function signature($signature)
    {
        $this->headers['X-GitHub-Signature'] = $signature;

        return $this;
    }

    /**
     * Perform a request.
     *
     * @return string
     */
    public function response()
    {
        return (string) $this->client->request('POST', '', [
            'headers' => $this->headers,
            'json'    => json_decode($this->payload, true),
        ])->getBody();
    }
}