<?php

namespace app\models;

use yii\base\Model;
use app\models\Shop;

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
            ['sex', 'in', 'array' => [static::SEX_MALE, static::SEX_FEMALE]],
            ['email', 'email']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Name',
            'date_of_birth' => 'Birth Date',
            'pin' => 'PIN',
            'sex' => 'Sex',
            'email' => 'Email',
            'shop' => 'Shop',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return $this->firstName . ' ' . ($this->middleName) ? $this->middleName . ' ' : '' . $this->lastName;
    }

    /**
     * {@inheritdoc}
     */
    public function getShop(): Shop
    {
        return $this->hasOne(Shop::className(), ['id' => 'shop_id']);
    }
}