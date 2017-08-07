<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Product;
use yii\helpers\ArrayHelper;

/**
 * ProductSearch represents the model behind the search form about `backend\models\Product`.
 */
class ProductSearch extends Product
{
    public $priceFrom;
    public $priceTo;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                [
                    'id',
                    'category_id',
                    'manufacturer_id',
                    'code',
                    'is_new',
                    'is_recommended',
                    'is_popular',
                    'visibility',
                    'amount',
                    'priceFrom',
                    'priceTo'
                ],
                'integer'
            ],
            [['name'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'priceFrom' => 'Цена от',
            'priceTo' => 'Цена до',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Product::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'category_id' => $this->category_id,
            'manufacturer_id' => $this->manufacturer_id,
            'code' => $this->code,
            'is_new' => $this->is_new,
            'is_recommended' => $this->is_recommended,
            'is_popular' => $this->is_popular,
            'visibility' => $this->visibility,
            'amount' => $this->amount,
        ]);

        $query->andFilterWhere(['>=', 'price', $this->priceFrom]);
        $query->andFilterWhere(['<=', 'price', $this->priceTo]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
