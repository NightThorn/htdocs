<?php
return [
    'id' => 'twitter_trend',
    'name' => 'Twitter trend',
    'author' => 'Stackcode',
    'author_uri' => 'https://stackposts.com',
    'version' => '1.0',
    'desc' => '',
    'icon' => 'fab fa-twitter',
    'color' => '#00acee',
    'pricing' => true,
    'menu' => [
    	'tab' => 2,
        'position' => 970,
        'name' => 'Twitter',
        'sub_menu' => [
            'position' => 3000,
            'id' => 'twitter_trend',
            'name' => 'Trend'
        ]
    ],
    'css' => [
        'assets/css/twitter_trend.css'
    ],
];