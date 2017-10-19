<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'google' => [
        'client_id' => '313908176944-p6v4c1o9cne80q3tii8qgglrrhjln1n2.apps.googleusercontent.com',
        'client_secret' => '4ughrR-h8GYoOJSsz8DR3BQv',
        'redirect' => 'http://localhost:8000/auth/google/fallback',
    ],

    // 'facebook' => [
    //     'client_id' => 'your-github-app-id',
    //     'client_secret' => 'your-github-app-secret',
    //     'redirect' => 'http://your-callback-url',
    // ],

    // 'github' => [
    //     'client_id' => 'your-github-app-id',
    //     'client_secret' => 'your-github-app-secret',
    //     'redirect' => 'http://your-callback-url',
    // ],


];
