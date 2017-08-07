<?php

namespace backend\scopes;

/**
 * This is the ActiveQuery class for [[\backend\models\Delivery]].
 *
 * @see \backend\models\Delivery
 */
class DeliveryQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \backend\models\Delivery[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \backend\models\Delivery|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
