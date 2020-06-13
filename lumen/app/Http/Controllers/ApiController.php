<?php

namespace App\Http\Controllers;

use App\Repositories\ApiRepository;

class ApiController extends Controller
{
    protected $apiRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ApiRepository $apiRepository)
    {
        $this->apiRepository = $apiRepository;
    }

    public function baseA()
    {
        $uri = 'https://raw.githubusercontent.com/jhonatan-silva/desafio_sc/master/api_bases/a.json';
        $headers = [
            'Content-Type' => 'application/json',
        ];

        return $this->apiRepository->connect($uri, $headers);
    }

    public function baseB()
    {
        $uri = 'https://raw.githubusercontent.com/jhonatan-silva/desafio_sc/master/api_bases/b.json';
         $headers = [
            'Content-Type' => 'application/json',
        ];

        return $this->apiRepository->connect($uri, $headers);
    }

    public function baseC()
    {
        $uri = 'https://raw.githubusercontent.com/jhonatan-silva/desafio_sc/master/api_bases/c.json';
         $headers = [
            'Content-Type' => 'application/json',
        ];

        return $this->apiRepository->connect($uri, $headers);
    }
}
