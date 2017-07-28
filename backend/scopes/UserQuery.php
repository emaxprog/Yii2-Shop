<?php

namespace backend\scopes;

/**
 * This is the ActiveQuery class for [[\backend\models\User]].
 *
 * @see \backend\models\User
 */
class UserQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \backend\models\User[]|array
     */
    public function all($db = null)
    {
        $this->notAdmin();
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \backend\models\User|array|null
     */
    public function one($db = null)
    {
        $this->notAdmin();
        return parent::one($db);
    }

    public function notAdmin()
    {
        return $this->andWhere(['!=', 'username', 'admin']);
    }
}
