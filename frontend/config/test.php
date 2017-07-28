<?php
return [
    'id' => 'app-frontend-tests',
    'components' => [
        'assetManager' => [
            'basePath' => Yii::getAlias('@web') . '/assets',
        ],
        'urlManager' => [
            'showScriptName' => true,
        ],
    ],
];
