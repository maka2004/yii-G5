<?php

namespace app\models;

use yii\base\Model;

class LuckyNumber extends Model
{
    const NUMBER_UNITS = 6;

    public $from = 0;
    public $to = 0;
    public $counter;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['from', 'to'], 'required'],
            [['counter'], 'integer'],
            [['from', 'to'], 'integer', 'min' => 0, 'max' => 999999],
            ['from', 'compare', 'compareAttribute' => 'to', 'operator' => '<=', 'message' => 'From cannot be greater than To'],
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

    public function countLuckyNumbers(): void
    {
        $counter = 0;

        for ($i = $this->from; $i <= $this->to; $i++) {
            // get left and right part
            $left = self::splitNumber($i)[0];
            $right = self::splitNumber($i)[1];

            // get numbers sum
            $left_counter = self::getDigitsSum($left);
            $right_counter = self::getDigitsSum($right);

            // compare and set counter
            if ($left_counter == $right_counter) {
                $counter++;
            }
        }
        $this->counter = $counter;
    }

    public static function splitNumber(int $number): array
    {
        $str = self::getProperStringFormat($number);
        $left_part = substr($str, 0, 3);
        $right_part = substr($str, 3, 3);

        return [$left_part, $right_part];
    }

    public static function getProperStringFormat(int $number): string
    {
        $str = (string)$number;
        while (count(str_split($str)) < self::NUMBER_UNITS) {
            $str = '0' . $str;
        }

        return $str;
    }

    public static function getDigitsSum(string $str_number): int
    {
        $arr = str_split($str_number);

        $result = 0;
        foreach ($arr as $item)
        {
            $result += $item;
        }

        if ($result > 9) {
            $result = self::getDigitsSum((string)$result);
        }

        return $result;
    }

}