<?php
$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
     // Установка русского языка по умолчанию (без этой строчки сообщения об ошибках будут отображены на английском языке)
     'language' => 'ru-RU',
    'bootstrap' => ['log'],

    'components' => [
        'request' => [
            // Обязательно для установления
            'cookieValidationKey' => 'GFDfgdf',
            // Обязателен для заполнения
            'baseUrl' => ''
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\UserIdentity',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        // Компонент для отправки писем
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // Отвечаем за локальную отправку писем, т.е в папку на сайте
            // Чтобы включить реальную отправку данных, необходимо установить useFileTransport => false
            'useFileTransport' => false,
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
        // Компонент для формирования красивых ссылок
        'urlManager' => [
            'enablePrettyUrl' => true, // Включаем компонент
            'showScriptName' => false,// Исключаем точку входа (index.php) из ссылок
            'rules' => [ // Описываем шаблоны url и соответсвующие им контроллеры и действия
            // Массив маршрутов
                '/' => 'site/index',
                'login' => 'site/login',
                'logout' => 'site/logout',
                'profile' => 'site/profile',
                'reg' => 'site/reg',
                'add/comment' => 'site/addcomment',
                'delete/<id:\d+>' => 'site/delete',
                'change/<id:\d+>' => 'site/change',
                'admin' => 'admin/default/index',
                'admin/logout' => 'site/logout',
                'admin/users' => 'admin/users',
                'admin/messages' => 'admin/messages',
            ],
        ],
        
    ],
    'modules' => [
    'admin' => [
            'class' => 'app\modules\admin\Module',
        ],
    ],
    'params' => $params,
];

// Константа YII_ENV_DEV отвечает за режим разработки
if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

// Модуль, отвечающий за генератор кода GII
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
