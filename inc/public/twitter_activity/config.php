<?php
return [
    'id' => 'twitter_activity',
    'name' => 'Twitter activity',
    'author' => 'SocialJutsu',
    'author_uri' => 'https://socialjutsu.com',
    'version' => '1.0',
    'desc' => '',
    'icon' => 'fab fa-twitter',
    'color' => '#00acee',
    'pricing' => true,
    'menu' => [
    	'tab' => 2,
        'position' => 995,
        'name' => 'Twitter',
        'sub_menu' => [
            'position' => 3000,
            'id' => 'twitter_activity',
            'name' => 'Activity'
        ]
    ],
    'css' => [
        'assets/css/twitter_activity.css'
    ],
    'js' => [
        'assets/js/twitter_activity.js'
    ]
];