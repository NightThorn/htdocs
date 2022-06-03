<?php
return [
    'id' => 'twitter_direct_message',
    'name' => 'Twitter Inbox',
    'author' => 'Stackcode',
    'author_uri' => 'https://stackposts.com',
    'version' => '1.0',
    'desc' => '',
    'icon' => 'fab fa-twitter',
    'color' => '#00acee',
    'pricing' => true,
    'menu' => [
    	'tab' => 2,
        'position' => 980,
        'name' => 'Twitter',
        'sub_menu' => [
            'position' => 3000,
            'id' => 'twitter_direct_message',
            'name' => 'Direct Message'
        ]
    ],
    'css' => [
        'assets/css/twitter_direct_message.css'
    ],
    'js' => [
        'assets/js/twitter_direct_message.js'
    ]
];