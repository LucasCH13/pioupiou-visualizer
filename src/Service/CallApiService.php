<?php

namespace App\Service;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class CallApiService 
{
   private $client;

   public function __construct(HttpClientInterface $client) {
    $this->client = $client;
   }

   public function getAllData(): array {
    return $this->getApi('all');
   }
   public function getDataLiveById(int $id): array {
    return $this->getApi('live/' . $id);
   }

   public function getApi(string $var) {
    $response = $this->client->request(
        'GET',
        'http://api.pioupiou.fr/v1/' . $var
    );
    return $response->toArray();
   }
}