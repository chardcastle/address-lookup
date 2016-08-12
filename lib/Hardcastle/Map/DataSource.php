<?php

namespace Hardcastle\Map;
use Hardcastle\Map\Result;


/**
 * A simple class designed to provide
 * access to the Google Map API
 */
class DataSource
{
	protected $data = null;

	protected $term = null;

	const SERVICE_URL = 'https://maps.googleapis.com/maps/api/geocode/json?address=';

	/**
	 * Acceps a string as a term upon which 
	 * the search can be made.
	 * 
	 * @param  string $term Single line of address
	 * @return object       Instance of oneself
	 */
	public function search($term = null)
	{
		$this->data = null;

		if (is_null($term) || strlen($term) <= 0)
		{
			return $this;
		}
		$source = new self;
		$client = new \GuzzleHttp\Client();
		$res    = $client->request('GET', self::SERVICE_URL . urlencode($term));
		$output = $res->getBody()->getContents();
		$data   = json_decode($output, false);

		if (isset($data->results) && ! empty($data->results))
		{
			$this->data = $output;	
		}
		$this->term = $term;

		return $this;
	}

	/**
	 * Returns a result object, from which, a
	 * results can be inspected.
	 * 
	 * @return object Object of class Result
	 */
	public function getResult()
	{
		$result = new Result;

		if ($this->hasResult())
		{
			$data = json_decode($this->data, false);
			$results = array_shift($data->results);
			if (empty($results->address_components))
			{
				return $result;
			}
			foreach ($results->address_components as $component)
			{
				if (in_array('postal_code', $component->types))
				{
					$result->setPostCode($component->short_name);
				}
			}
						
			$result->setTerm($this->term);
			$result->setPlaceId($results->place_id);
			$result->setLatitude($results->geometry->location->lat);
			$result->setLongitude($results->geometry->location->lng);			

		}

		return $result;
	}

	public function getRaw()
	{
		return print_r($this->data, true);
	}

	public function hasResult()
	{
		return ( ! is_null($this->data));
	}

}