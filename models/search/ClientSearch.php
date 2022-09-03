<?php

namespace app\models\search;

use yii\data\ActiveDataProvider;
use app\models\Client;

/**
 * AccountsSearch represents the model behind the search form of `app\models\Accounts`.
 */
class ClientSearch extends Client
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pin', 'sex', 'shop'], 'integer'],
            [['date_of_birth', 'email'], 'string'],
        ];
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
        $query = Client::find();
        $query->joinWith(['shop']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider(['query' => $query]);

        $this->load($params);

        if (!$this->validate()) return $dataProvider;

        // grid filtering conditions
        $query->andFilterWhere(['sex' => $this->sex]);
        $query->andFilterWhere(['like', 'pin', $this->pin]);
        $query->andFilterWhere(['like', 'email', $this->email]);
        $query->andFilterWhere(['shop_id' => $this->shop]);

        if ($this->date_of_birth) {
            $date_start = strtotime($this->date_of_birth . ' 00:00:00');
            $date_end = strtotime($this->date_of_birth . ' 23:59:59');
            $query->andWhere(['between', 'date_of_birth', $date_start, $date_end]);
        }

//        die($query->createCommand()->getRawSql());

        return $dataProvider;
    }
}
