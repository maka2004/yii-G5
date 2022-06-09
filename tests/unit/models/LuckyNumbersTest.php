<?php

namespace tests\unit\models;

use app\models\LuckyNumber;

class LuckyNumbersTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    public $tester;

    public function testLuckyNumbersDeterminator()
    {
        $result = true;
        $data = [
            ['from' => 0, 'to' => 0, 'counter' => 1],
            ['from' => 1000, 'to' => 1050, 'counter' => 6],
            ['from' => 0, 'to' => 999999, 'counter' => 110890],
            ['from' => -2, 'to' => 999999, 'counter' => 0],
            ['from' => -12, 'to' => -5, 'counter' => 0],
            ['from' => 150, 'to' => 13, 'counter' => 0],
            ['from' => 1222999, 'to' => 0, 'counter' => 0],
            ['from' => 0, 'to' => 1000555, 'counter' => 0],
        ];

        foreach ($data as $data_set) {
            $model = new LuckyNumber();
            $model->from = $data_set['from'];
            $model->to = $data_set['to'];
            $model->validate();
            if (empty($model->errors)) {
                $model->countLuckyNumbers();
            }
            if ($data_set['from'] < 0 || $data_set['to'] < 0) {
                $result = self::getContentPosition($model->errors, 'must be no less than');
            } elseif ($data_set['from'] > 999999 || $data_set['to'] > 999999) {
                $result = self::getContentPosition($model->errors, 'must be no greater than');
            } elseif ($data_set['from'] > $data_set['to']) {
                $result = self::getContentPosition($model->errors, 'cannot be greater than');
            } else {
                $result = $model->counter == $data_set['counter'];
            }

            if (!$result) break;
        }
        expect_that($result == true);
    }

    public static function getContentPosition($errors, string $str): bool
    {
        return strpos(json_encode($errors), $str);
    }
}
