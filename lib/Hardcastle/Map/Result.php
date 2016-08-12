<?php

namespace Hardcastle\Map;

/**
 * Simple file to represent the 
 * results of a Google Map API 
 * look up
 */
class Result {
	
	protected $term = null;
	protected $postCode = null;
	protected $placeId = null;
	protected $latitude = null;
	protected $longitude = null;

	public function getTerm()
	{
		return $this->term;
	}

	public function setTerm($value)
	{
		$this->term = $value;
		return $this;
	}

	public function getPostCode()
	{
		return $this->postCode;
	}

	public function setPostCode($value)
	{
		$this->postCode = $value;
		return $this;
	}

	public function getPlaceId()
	{
		return $this->placeId;
	}

	public function setPlaceId($value)
	{
		$this->placeId = $value;
		return $this;
	}

	public function getLatitude()
	{
		return $this->latitude;
	}

	public function setLatitude($value)
	{
		$this->latitude = $value;
		return $this;
	}

	public function getLongitude()
	{
		return $this->longitude;
	}

	public function setLongitude($value)
	{
		$this->longitude = $value;
		return $this;
	}
	
	private function toCsvHeader()
	{
		return [
			"PostCode",
			"PlaceId",
			"Latitude",
			"Longitude",
		];
	}
	private function toCsvLineItem()
	{
		return [
			$this->getPostCode(),
			$this->getPlaceId(),
			$this->getLatitude(),
			$this->getLongitude()
		];
	}

	public function save($fileName = 'results.csv')
	{
		$destination = __DIR__ . '/../../../data/' . $fileName;
		if ( ! file_exists($destination))
		{
			$fp   = fopen($destination, 'a');
			fputcsv($fp, $this->toCsvHeader());
			$isOk = fputcsv($fp, $this->toCsvLineItem());
		} else {
			$fp   = fopen($destination, 'a');
			$isOk = fputcsv($fp, $this->toCsvLineItem());
		}

		fclose($fp);
		return ($isOk !== FALSE);
	}

}