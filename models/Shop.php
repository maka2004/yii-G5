<?php

namespace app\models;

use yii\base\Model;

class Shop extends Model
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'address', 'phone'], 'required'],
            [['address'], 'string', 'max' => 150],
            [['area', 'phone'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Name',
            'address' => 'Address',
            'area' => 'Area',
            'phone' => 'Phone',
        ];
    }

}