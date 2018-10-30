<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager', //clase UrlManager
            //'showScriptName' => false, //eliminar index.php
            //'enablePrettyUrl' => true //urls amigables
             # utiliza mod_rewrite para soporte de URLs amigables
             # RewriteEngine on
             # Si el directorio o archivo existe, utiliza la petición directamente
             # RewriteCond %{REQUEST_FILENAME} !-f
             # RewriteCond %{REQUEST_FILENAME} !-d
             # Sino, redirige la petición a index.php
             # RewriteRule . index.php
        ],
    ],
];
