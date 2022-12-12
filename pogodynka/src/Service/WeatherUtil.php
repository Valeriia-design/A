<?php

namespace App\Service;

use App\Repository\MeasurementRepository;
use App\Repository\LocationRepository;

class WeatherUtil
{
    private $locationRepository;
    private $measurementRepository;

    public function __construct(LocationRepository $locationRepository, MeasurementRepository $measurementRepository)
    {
        $this->locationRepository = $locationRepository;
        $this->measurementRepository = $measurementRepository;
    }

    public function getWeatherForCountryAndCity($city)
    {
        $location = $this->locationRepository->findByLocation($city);
        $locationId = $this->locationRepository->findId($location);
        $measurements = $this->getWeatherForLocation($locationId);
        $result = [
            "location" => $city,
            "measurements" => $measurements
        ];
        return $result;
    }

    public function getWeatherForLocation($location)
    {
        return $this->measurementRepository->findByLocation($location);
    }
}

