<?php

namespace app\models;

use yii\db\ActiveRecord;
//use yii\base\Model;
use app\models\Shop;

class Client extends ActiveRecord
{
    const SEX_MALE = 1;
    const SEX_FEMALE = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'client';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'date_of_birth'], 'required'],
            [['first_name', 'last_name', 'middle_name'], 'string', 'max' => 20],
            [['address'], 'string'],
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
            'address' => 'Address',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return $this->first_name . ' ' . ($this->middle_name) ? $this->middle_name . ' ' : '' . $this->last_name;
    }

    /**
     * {@inheritdoc}
     */
    public function getShop()
    {
        return $this->hasOne(Shop::class, ['id' => 'shop_id']);
    }
}