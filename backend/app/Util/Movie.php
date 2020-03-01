<?php
namespace App\Util;

use GuzzleHttp\Client;

class Movie
{
	protected $api_key;
	protected $client;

	public function __construct(Client $client)
	{
		$this->client = $client;
		$this->api_key = env('THE_MOVIE_DB_API_KEY');
	}

	public function all()
	{
		return $this->endpointRequest('/get');
	}

	public function topRated($page)
	{
		return $this->endpointRequest('movie/top_rated', $page);
	}

	public function findById($id)
	{
		return $this->endpointRequest('movie/'.$id);
	}

	public function endpointRequest($url, $page = null)
	{	
		$pagination = '';
		
		if ($page) {
			$pagination ='&page='.$page;
		}
		try {
			$response = $this->client->request('GET', $url.'?api_key='.$this->api_key.$pagination);
		} catch (\Exception $e) {
            return [];
		}

		return $this->response_handler($response->getBody()->getContents());
	}

	public function response_handler($response)
	{
		if ($response) {
			return json_decode($response);
		}
		
		return [];
	}
}