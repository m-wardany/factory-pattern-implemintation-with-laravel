<?php
return [
    'key' => env('JWT_KEY', env('APP_KEY')),
    'algorithm' => env('JWT_ALGORITHM', 'HS256'),
];