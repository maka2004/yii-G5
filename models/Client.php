<?php

namespace app\models;

use yii\base\Model;

class Client extends Model
{
    const SEX_MALE = 1;
    const SEX_FEMALE = 2;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'date_of_birth'], 'required'],
            [['first_name', 'last_name', 'middle_name'], 'string', 'max' => 20],
            [['date_of_birth'], 'integer'],
//            ['from', 'compare', 'compareAttribute' => 'to', 'operator' => '<=', 'message' => 'From cannot be greater than To'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'from' => 'From',
            'to' => 'To',
            'counter' => 'Counter',
        ];
    }

}