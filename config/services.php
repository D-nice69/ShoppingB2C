<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'facebook' => [
        'client_id' => '4439303076139621',  //client face của bạn
        'client_secret' => 'b85e70ca12dd9568f901ba9f731f01c2',  //client app service face của bạn
        'redirect' => 'http://localhost:8000/admin/callback' //callback trả về
    ],
    'google' => [
        'client_id' => '506830848190-1hv57t687s3fb0op7aha2fo86tb6pl0n.apps.googleusercontent.com',
        'client_secret' => 'u2Z4Ddlvrbi57gul_tFSofIg',
        'redirect' => 'http://localhost:8000/google/callback' 
    ],


];
