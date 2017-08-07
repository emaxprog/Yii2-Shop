<?php

namespace backend\scopes;

/**
 * This is the ActiveQuery class for [[\backend\models\Payment]].
 *
 * @see \backend\models\Payment
 */
class PaymentQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \backend\models\Payment[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \backend\models\Payment|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
