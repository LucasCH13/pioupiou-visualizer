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
   
   public function getAllDataLive(): array {
    return $this->getApi('live-with-meta/all');
   }
   public function getDataLiveById(int $id): array {
    return $this->getApi('live-with-meta/' . $id);
   }
   public function getDataArchivedById(int $id): array {
    return $this->getApi('archive/' . $id . '?start=last-day&stop=now');
   }
   public function getApi(string $var) {
    $response = $this->client->request(
        'GET',
        'http://api.pioupiou.fr/v1/' . $var
    );
    return $response->toArray();
    
   }
}