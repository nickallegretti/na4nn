<?php
require_once 'vendor/autoload.php';
 
$config = [
    'callback' => 'http://na4nnstudentprojects.com/na4nnCCS20/login.php',
    'keys'     => [
                    'id' => '412446641903-hjsrm8bpm15c6128lvaunenij21oo7s4.apps.googleusercontent.com',
                    'secret' => 'FEWBOe-7MuAqVfx6M9y0pFkf'
                ],
    'scope'    => 'https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email',
    'authorize_url_parameters' => [
            'approval_prompt' => 'force', // to pass only when you need to acquire a new refresh token.
            'access_type' => 'offline'
    ]
];
 
$adapter = new Hybridauth\Provider\Google( $config );
?>