<?php
require_once 'vendor/autoload.php';
 
$config = [
    'callback' => 'http://na4nnstudentprojects.com/na4nnSSOS20/index.php',
    'keys'     => [
                    'id' => '',
                    'secret' => ''
                ],
    'scope'    => 'https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email',
    'authorize_url_parameters' => [
            'approval_prompt' => 'force', // to pass only when you need to acquire a new refresh token.
            'access_type' => 'offline'
    ]
];
 
$adapter = new Hybridauth\Provider\Google( $config );
