<?php
return [
    'id' => 'reddit_post',
    'name' => 'Reddit Post',
    'author' => 'SocialJutsu',
    'author_uri' => 'https://socialjutsu.com',
    'version' => '1.0',
    'desc' => '',
    'icon' => 'fab fa-reddit',
    'color' => '#f25206',
    'menu' => [
        'tab' => 2,
        'position' => 930,
        'name' => 'Reddit',
        'sub_menu' => [
            'position' => 1000,
            'id' => 'reddit_post',
            'name' => 'Post'
        ]
    ],
    'css' => [
        'assets/css/reddit_post.css'
    ],
    'js' => [
        'assets/js/reddit_post.js'
    ]
];
