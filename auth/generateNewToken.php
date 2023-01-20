<?php

require 'config/sfAuth.php';

function generateNewToken($db)
{

    $curl = curl_init();

    curl_setopt_array($curl, [
        //calling the oauth endpoint to get a valid token from Salesforce. You should replace it with your Salesforce instance url
        CURLOPT_URL => 'https://test.salesforce.com/services/oauth2/token',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $fields = [
            'grant_type' => 'password',
            'client_id' => SF_CLIENT_ID,
            'client_secret' => SF_CLIENT_SECRET,
            'username' => SF_USERNAME,
            'password' => SF_PASSWORD
        ],
    ]);

    $response = curl_exec($curl);
    curl_close($curl);


    function getToken($string)
    {
        $array = explode('"', $string);
        $access_token = str_replace('"', '', $array[3]);
        return $access_token;
    }

    $token = getToken($response);

    $tokenData = [
        'token' => $token,
        'datahora' => time()
    ];

    //inserting token and date/time grant so we can control later
    $sql = $db->prepare("INSERT INTO auth (token, date_inserted) VALUES (:token, :datahora)");
    $sql->bindValue(':token', $tokenData['token']);
    $sql->bindValue(':datahora', $tokenData['datahora']);
    $sql->execute();
}
