<?php

$cardOptions = "card-outline card-primary";

return [
    'adminEmail' => 'admin@example.com',
    'senderEmail' => 'noreply@example.com',
    'senderName' => 'Example.com mailer',
    'bsVersion' => '4.x',

    'hail812/yii2-adminlte3' => [
        'pluginMap' => [
            'sweetalert2' => [
                'css' => 'sweetalert2-theme-bootstrap-4/bootstrap-4.min.css',
                'js' => 'sweetalert2/sweetalert2.min.js'
            ]
        ]
    ],

    'cardOptions' => $cardOptions,
];
