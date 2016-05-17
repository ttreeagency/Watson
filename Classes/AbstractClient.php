<?php
namespace Ttree\Watson;

/*
 * This file is part of the Ttree.Watson package.
 *
 * (c) Build with love by ttree agency - www.neos.io
 *
 * This package is Open Source Software. For the full copyright and license
 * information, please view the LICENSE file which was distributed with this
 * source code.
 */

use GuzzleHttp\Client;
use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;

/**
 * Abstract Client
 */
abstract class AbstractClient
{
    const BASE_URI = 'https://gateway.watsonplatform.net';

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $password;

    /**
     * @param string $username
     * @param string $password
     * @param array $additionalConfig
     */
    public function __construct($username, $password, array $additionalConfig = [])
    {
        $this->username = $username;
        $this->password = $password;
        $this->client = new Client(array_merge([
            'base_uri' => self::BASE_URI,
            'timeout' => 30.0
        ], $additionalConfig));
    }

    /**
     * @param string $method
     * @param string|null $uri
     * @param array $options
     * @return ResponseInterface
     */
    protected function request($method = 'POST', $uri = null, array $options = [])
    {
        $options = array_merge_recursive([
            RequestOptions::AUTH => [
                $this->username,
                $this->password
            ],
            RequestOptions::HEADERS => [
                'Content-Type' => 'application/json'
            ]
        ], $options);

        return $this->client->request($method, $uri, $options);
    }
}
