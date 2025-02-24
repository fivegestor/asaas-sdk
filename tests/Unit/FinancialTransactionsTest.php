<?php

namespace FiveGestor\Test\Unit;

use Exception;
use FiveGestor\Asaas\Facade\Asaas;
use FiveGestor\Test\TestCase;

class FinancialTransactionsTest extends TestCase
{
    public function testFindFinancialTransactions()
    {
        $this->expectException(Exception::class); //api fault

        $result = Asaas::financialTransactions()->find();
    }
}
