<?php

require __DIR__ . "/../vendor/autoload.php";

$dotenv = new Dotenv\Dotenv('.');
$dotenv->load();

$client = new \AGSystems\GitLab\REST\Client(
    getenv('PRIVATE_TOKEN'),
    getenv('API_ENDPOINT')
);

var_export(
    array_map(function ($o) {
        return [
            'id' => $o->id,
            'name' => $o->name,
            'namespace' => (object)[
                'id' => $o->namespace->id,
                'name' => $o->namespace->name,
            ],
        ];
    }, $client->projects->get())
);
