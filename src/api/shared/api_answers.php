<?php

function http200() {
    http_response_code(200);
}

function http400() {
    http_response_code(400);
    echo json_encode(array("error" => "Ο server δεν κατάλαβε το αίτημα."));
}

function http404(): array
{
    http_response_code(404);
    return array("error" => "Δεν βρέθηκαν αποτελέσματα.");
}

function http405() {
    http_response_code(405);
    echo json_encode(array("error" => "Δεν επιτρέπεται αυτό το αίτημα."));
}

function http500() {
    http_response_code(500);
    echo json_encode(array("error" => "Σφάλμα του server."));
}

function apiCall($url) {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($curl);
    $result = json_decode($result, true);
    return $result;
}
