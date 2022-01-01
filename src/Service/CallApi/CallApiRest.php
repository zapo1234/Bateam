<?php
namespace App\Service\CallApi;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class CallApiRest

{
private $client;

public function __construct(HttpClientInterface $client)
{
$this->client = $client;
}

public function fetchGitHub()
{
// renvoyer les datas
$response = $this->client->request(
    'GET',
    'https://coronavirusapifr.herokuapp.com/data/live/france',
    );
// renvoi sous forme de tableau le resultat
return $response->toArray();

}
}











