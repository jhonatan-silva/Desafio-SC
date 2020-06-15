<?php

namespace App\Repositories;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class ApiRepository
{
    /**
     * @param $uri
     * @param $headers
     * @return mixed|\Psr\Http\Message\ResponseInterface|string
     */
    public function connect($uri, $headers)
    {
        $client = new Client();

        try {
            $result = $client->get($uri, [
                'headers' => $headers
            ]);

            if ($result) {
                $result = json_decode($result->getBody()->getContents(), true);

                if ($result) {
                    return $result;
                }
            }

            return 'Sem resultados da API';
        } catch (RequestException $e) {
            return $e->getMessage();
        }
    }
}
