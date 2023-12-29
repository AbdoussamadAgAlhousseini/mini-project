<?php

require 'vendor/autoload.php'; // En supposant que vous avez installé Guzzle via Composer

use GuzzleHttp\Client;

// Remplacez ceci par vos identifiants réels
$clientId = 'VOTRE_ID_CLIENT';
$clientSecret = 'VOTRE_SECRET_CLIENT';

// Points de terminaison de l'API Amadeus
$baseUrl = 'https://api.amadeus.com/';
$tokenEndpoint = 'v1/security/oauth2/token';
$searchEndpoint = 'v2/shopping/flight-offers'; // Point de terminaison de la recherche d'offres de vols

// Configuration du client HTTP
$client = new Client([
    'base_uri' => $baseUrl,
]);

// Obtention d'un jeton d'accès
$response = $client->post($tokenEndpoint, [
    'form_params' => [
        'grant_type' => 'client_credentials',
        'client_id' => $clientId,
        'client_secret' => $clientSecret,
    ],
]);

$data = json_decode($response->getBody(), true);
$accessToken = $data['access_token'];

// Paramètres de recherche de vol
$codeAeroportDepart = 'JFK'; // Remplacez par le code de l'aéroport de départ
$codeAeroportArrivee = 'LAX'; // Remplacez par le code de l'aéroport d'arrivée
$dateDepart = '2023-12-01'; // Remplacez par la date de départ

// Requête à l'API de recherche d'offres de vols
$response = $client->get($searchEndpoint, [
    'headers' => [
        'Authorization' => 'Bearer ' . $accessToken,
    ],
    'query' => [
        'originLocationCode' => $codeAeroportDepart,
        'destinationLocationCode' => $codeAeroportArrivee,
        'departureDate' => $dateDepart,
        // Ajoutez plus de paramètres au besoin en fonction de la documentation de l'API
    ],
]);

// Traitement de la réponse de l'API selon vos besoins
var_dump(json_decode($response->getBody(), true));
