<?php

return [
    'username' => $faker->name,
    'auth_key' => Yii::$app->security->generateRandomString(),
    //password_0
    'password_hash' => Yii::$app->security->generatePasswordHash('password_' . $index),
    'password_reset_token' => null,
    'email' => $faker->email,
    'name' => $faker->name,
    'surname' => $faker->lastName,
    'phone' => $faker->phoneNumber,
    'status' => 10,
    'created_at' => $faker->unixTime,
    'updated_at' => $faker->unixTime,
];
