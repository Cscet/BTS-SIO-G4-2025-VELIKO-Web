<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MapController extends AbstractController
{
    #[Route('/', name: 'app_map')]

        public function execute(Request $request): Response
    {



        $curl1 = curl_init();

        curl_setopt_array($curl1, [
            CURLOPT_PORT => "9042",
            CURLOPT_URL => "http://localhost:9042/api/stations",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 20,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_SSL_VERIFYPEER => false

        ]);

        $response1 = curl_exec($curl1);
        $err1 = curl_error($curl1);

        curl_close($curl1);

        $response1 =  json_decode($response1,true);

//        foreach ($response['data']['stations'] as $station) {
//            $latitude = $station['lat'];
//            $longitude = $station['lon'];
//
//            echo "Latitude: $latitude, Longitude: $longitude <br>";
//        }


//        if ($err1) {
//            echo "cURL Error #:" . $err1;
//        } else {
//            echo $response1;
//        }
        //echo $response['data']['stations'][0]['lat'];


        $curl2 = curl_init();

        curl_setopt_array($curl2, [
            CURLOPT_PORT => "9042",
            CURLOPT_URL => "http://localhost:9042/api/stations/status",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 20,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_SSL_VERIFYPEER => false
        ]);

        $response2 = curl_exec($curl2);
        $err2 = curl_error($curl2);

        curl_close($curl2);

        $response2 =  json_decode($response2,true);

        $stations = [];




        for ($i1 = 0; $i1 < count($response1); $i1++){
            $stations_data = [];
            for ($i2 = 0;  $i2 < count($response2); $i2++){
                if ($response1[$i1]['station_id'] == $response2[$i2]['station_id']){
                    $stations_data = [
                        "name" => $response1[$i1]['name'],
                        "lon" => $response1[$i1]['lon'],
                        "lat" => $response1[$i1]['lat'],
                        "velo_electrique" => $response2[$i2]['num_bikes_available_types'][1]['ebike'],
                        "velo_mecanique" => $response2[$i2]['num_bikes_available_types'][0]['mechanical'],
                        "capacite" => $response1[$i1]['capacity']
                    ];

                    $stations[] = $stations_data;

                }
            }

        }


//        foreach ($response1['data']['stations'] as $station1) {
//            $stations_data = [];
//
//            foreach ($response2['data']['stations'] as $station2) {
//                if ($station1['station_id'] == $station2['station_id']) {
//
//                    $stations_data = [
//                        "name" => $station1['name'],
//                        "lon" => $station1['lon'],
//                        "lat" => $station1['lat'],
//                        "velo_electrique" => $station2['num_bikes_available_types'][1]['ebike'],
//                        "velo_mecanique" => $station2['num_bikes_available_types'][0]['mechanical'],
//                        "capacite" => $station1['capacity']
//                    ];
//
//                    $stations[] = $stations_data;
//                }
//            }
//        }


        //var_dump($stations);

        //var_dump($response2['data']['stations'][0]['num_bikes_available_types'][1]['ebike']);






        return $this->render('map/index.html.twig',
            [
                "titre"   => 'MapController',
                "request" => $request,
                "response1" => $response1,
                "response2" => $response2,
                "stations" => $stations
            ]
        );
    }

}
