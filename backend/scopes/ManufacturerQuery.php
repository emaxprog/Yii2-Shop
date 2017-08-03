<?php

namespace backend\scopes;

/**
 * This is the ActiveQuery class for [[\backend\models\Manufacturer]].
 *
 * @see \backend\models\Manufacturer
 */
class ManufacturerQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \backend\models\Manufacturer[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \backend\models\Manufacturer|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
