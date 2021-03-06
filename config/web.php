<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'project-monitoring',
    'name' => 'Project Monitoring',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'timeZone' => 'Asia/Jakarta',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        // custom formatter
        'formatter' => [
            'locale' => 'in-ID',
            'defaultTimeZone' => 'Asia/Jakarta',
            'nullDisplay' => '',
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '#cxAenIMmJip0ej9URGSiLxGtUirRU1w',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\apps\User',
            'enableAutoLogin' => false,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [],
        ],

        // Admin Lte 3 Theme
        // 'view' => [
        //     'theme' => [
        //         'pathMap' => [
        //             '@app/views' => '@vendor/hail812/yii2-adminlte3/src/views'
        //         ],
        //     ],
        // ],
    ],
    'params' => $params,
    'on beforeAction' => function ($event) {
        $user = Yii::$app->user;
        $excepController = ['site', 'user', 'ajax'];
        $excepAction = ['change-password', 'profile'];

        if (!$user->isGuest && !in_array(0, $user->identity->yRoleIDs)) {
            $hasAccess = false;
            $controller = $event->action->controller->id;

            if (in_array($controller, $excepController)) {
                $hasAccess = true;
                if ($controller == 'user' && !in_array($event->action->id, $excepAction)) {
                    $hasAccess = false;
                }
            }

            $roleMenus = \app\models\apps\YRoleMenu::find()->where(['in', 'y_role_id', $user->identity->yRoleIDs])->orderBy('y_menu_id')->all();
            foreach ($roleMenus as $k => $v) {
                if (strpos($v->yMenu->attributes['url'], $controller) !== false) {
                    $hasAccess = true;
                }
            }
            if (!$hasAccess) {
                Yii::$app->controller->redirect(['site/error']);
            }
        }
    },
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    // custom gii crud
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'generators' => [ //here
            'crud' => [
                'class' => 'yii\gii\generators\crud\Generator',
                'templates' => [
                    'customCrud' => '@app/widgets/gii/templates/crud/simple',
                ]
            ],
        ],
    ];
}

return $config;
