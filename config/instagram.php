<?php

return [
    'access_token' => env('INSTAGRAM_ACCESS_TOKEN'),
    'user_id' => env('INSTAGRAM_USER_ID'),
    'username' => env('INSTAGRAM_USERNAME', 'suicidesquad11.5'),
    'limit' => (int) env('INSTAGRAM_FEED_LIMIT', 25),
    'cache_ttl' => (int) env('INSTAGRAM_CACHE_TTL', 3600),
];
