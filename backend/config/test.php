<?php
return [
    'id' => 'app-backend-tests',
    'components' => [
        'assetManager' => [
            'basePath' => Yii::getAlias('@web') . '/admin/assets',
        ],
        'urlManager' => [
            'showScriptName' => true,
        ],
    ],
];
