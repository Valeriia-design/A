<?php // src/Controller/WeatherController.php

namespace App\Controller;

use App\Repository\LocationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Location;
use App\Repository\MeasurementRepository;
use App\Service\WeatherUtil;

class WeatherController extends AbstractController
{
    public function idAction(Location $location, MeasurementRepository $measurementRepository): Response
    {
        $measurements = $measurementRepository->findByLocation($location);

        return $this->render('weather/city.html.twig', [
            'location' => $location,
            'measurements' => $measurements,
        ]);
    }

    public function cityAction(Location $city, WeatherUtil $weatherUtil): Response
    {
        $renderData = $weatherUtil->getWeatherForCountryAndCity($city);
        return $this->render('weather/city.html.twig', $renderData);
    }
}