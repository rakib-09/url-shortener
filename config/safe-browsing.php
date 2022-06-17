<?php

return [
    'google' => [
        'url' => env(
            'SAFE_BROWSING_GOOGLE_URL',
            'https://safebrowsing.googleapis.com/v4/threatMatches:find?key='
        ),
        'api_key' => env('SAFE_BROWSING_GOOGLE_API_KEY', null),
        'timeout' => 30,
        'threatTypes' => [
            'THREAT_TYPE_UNSPECIFIED',
            'MALWARE',
            'SOCIAL_ENGINEERING',
            'UNWANTED_SOFTWARE',
            'POTENTIALLY_HARMFUL_APPLICATION',
        ],

        'threatPlatforms' => [
            'ANY_PLATFORM'
        ],
        'clientId' => env('SAFE_BROWSING_GOOGLE_CLIENT_ID', 'url-shortener'),
        'clientVersion' => env('SAFE_BROWSING_GOOGLE_CLIENT_VERSION', '1.5.2'),
    ]
];
