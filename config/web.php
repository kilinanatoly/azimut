<?php
$params = require(__DIR__ . '/params.php');

$config = [
    'language'=>'ru',
    'charset'=>'utf-8',
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'ipgeobase' => [
            'class' => 'himiklab\ipgeobase\IpGeoBase',
            'useLocalDB' => true,
        ],
        'authManager'  => [
            'class'        => 'yii\rbac\DbManager',
            //            'defaultRoles' => ['guest'],
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '12345',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
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
        'urlManager'=>[
            'showScriptName' => false,
            'enablePrettyUrl' => true,
            'rules' => [
                '/admin'=>'/tree/admin',
                '/emailto'=>'/products/emailto',
                '/'=>'/site/index',
                '/catalog'=>'/site/catalog',
                '/catalog/<item:\S+>' => '/site/catalog',

                //'<city:\D+>' => 'arenda/default/index',
            ],
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
        'db' => require(__DIR__ . '/db.php'),

    ],
    'modules' => [
        'permit' => [
            'class' => 'developeruz\db_rbac\Yii2DbRbac',
            'params' => [
                'userClass' => 'app\models\User'
            ]
        ],
        'regions' => [
            'class' => 'app\modules\regions\regions',
        ],
        'tree' => [
            'class' => 'app\modules\Tree\Tree',
        ],
        'arenda' => [
            'class' => 'app\modules\arenda\arenda',
        ],

    ],

    'params' => $params,

];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
