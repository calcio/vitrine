<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'vitrine',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'language' => 'pt-br',
    'timezone' => 'America/Sao_Paulo',
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Admin',
            'layout' => '@app/views/layouts/admin',
        ],
    ],
    'components' => [
        'request' => [
            'cookieValidationKey' => 'LIvbC6NRcUZBbv-kaaQBCCEBTOmt5uCc',
        ],
        'formatter' => [
            'class' => 'app\components\formatters\BrazilianFormatter',
            'dateFormat' => 'php:d/m/Y',
            'datetimeFormat' => 'php:d/m/Y H:i:s',
            'timeFormat' => 'php:H:i:s',
            'decimalSeparator' => ',',
            'thousandSeparator' => '.',
            'currencyCode' => 'R$ ',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            /**
            * Call the model will implement IdentityInterface interface
            * and authenticate methods.
            * ==============================================================
            * Chama o model que ira implementar a interface IdentityInterface 
            * e os métodos de autenticação.
            */
            'identityClass' => 'app\modules\admin\models\User',
            /**
            * It's responsibly to define the default route (URL) login
            * ==============================================================
            * É responsável por definir a rota (URL) padrão de login
            */
            'loginUrl' => ['admin/default/index'],
            'enableAutoLogin' => true,
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
        'db' => require(__DIR__ . '/db.php'),
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
