<?php

namespace common\models;

use mdm\admin\models\User as UserModel;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends UserModel
{
    public function getPhone()
    {
        return $this->hasOne(Phone::className(), ['id' => 'user_id'])->inverseOf('user');
    }

    public function getAddress()
    {
        return $this->hasOne(Address::className(), ['id' => 'user_id'])->inverseOf('user');
    }
}
