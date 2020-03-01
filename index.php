<?php

require_once './vendor/autoload.php';

use Goutte\Client;
$client = new Client();

$array = [];

for ($i=0; $i<3; $i++) {
    $crawler = $client->request('GET', 'https://www.livebu.com/search?p=1');
    $crawler->filter('.res_box .res_box_name a')->each(function ($node) use (&$array) {
        $array[] = $node->text();
    });
    
    $link = $crawler->selectLink("次の20件")->link();
    $crawler = $client->click($link);

    sleep(3);
}

var_dump($array);