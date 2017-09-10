<?php

namespace backend\models;

/**
 * This is the model class for table "{{%user}}".
 */
class User extends \common\models\User
{
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if (!$insert) {
                if ($this->new_password) {
                    $this->setPassword($this->new_password);
                    $this->generateAuthKey();
                }
            }
            return true;
        }
        return false;
    }

    /**
     * @inheritdoc
     * @return \backend\scopes\UserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\scopes\UserQuery(get_called_class());
    }
}
