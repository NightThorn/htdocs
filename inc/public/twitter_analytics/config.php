<?php
return [
    'id' => 'twitter_analytics',
    'name' => 'Twitter analytics',
    'author' => 'Stackcode',
    'author_uri' => 'https://stackposts.com',
    'version' => '1.0',
    'desc' => '',
    'icon' => 'fab fa-twitter',
    'color' => '#00acee',
    'pricing' => true,
    'menu' => [
    	'tab' => 2,
        'position' => 990,
        'name' => 'Twitter',
        'sub_menu' => [
            'position' => 3000,
            'id' => 'twitter_analytics',
            'name' => 'Analytics'
        ]
    ],
    'css' => [
        'assets/css/twitter_analytics.css'
    ],
    'js' => [
        'assets/js/twitter_analytics.js'
    ]
];