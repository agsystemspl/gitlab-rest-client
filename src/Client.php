<?php

namespace AGSystems\GitLab\REST;

use AGSystems\REST\AbstractClient;

class Client extends AbstractClient
{
    protected $apiToken;
    protected $baseUri;

    public function __construct($apiToken, $baseUri = 'https://gitlab.com/api/v4')
    {
        $this->apiToken = $apiToken;
        $this->baseUri = $baseUri;
    }

    protected function clientOptions()
    {
        return [
            'base_uri' => $this->baseUri,
            'headers' => [
                'private-token' => $this->apiToken,
            ],
        ];
    }

    protected function handleResponse(callable $callback)
    {
        $response = call_user_func($callback);
        $result = \GuzzleHttp\json_decode($response->getBody()->getContents());
        return $result;
    }
}
