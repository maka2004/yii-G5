<?php

namespace tests\unit\models;

use app\controllers\LuckyNumbersController;

class LuckyNumbersTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    public $tester;

    public function testLuckyNumbersDeterminator()
    {
        $data = [
            ['from' => 0, 'to' => 0, 'counter' => 1],
            ['from' => 1000, 'to' => 1050, 'counter' => 6],
            ['from' => 0, 'to' => 999999, 'counter' => 110890],
        ];

        foreach ($data as $data_set) {
            $counter = LuckyNumbersController::getLuckyNumbersCounter($data_set['from'], $data_set['to']);
            expect($counter == $data_set['counter']);
        }
    }
}
