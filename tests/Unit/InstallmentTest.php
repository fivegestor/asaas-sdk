<?php

namespace FiveGestor\Test\Unit;

use FiveGestor\Asaas\Facade\Asaas;
use FiveGestor\Test\TestCase;

class InstallmentTest extends TestCase
{
    public function testFindInstallmentById()
    {
        $result = Asaas::installment()->find('1');

        $this->assertEquals($result->getStatusCode(), 200);
    }

    public function testFindAllInstallments()
    {
        $result = Asaas::installment()->find();

        $this->assertEquals($result->getStatusCode(), 200);
    }

    public function testRemoveInstallment()
    {
        $result = Asaas::installment()->remove('1');

        $this->assertEquals($result->getStatusCode(), 200);
    }

    public function testReverseInstallment()
    {
        $result = Asaas::installment()->reversePayment('1');

        $this->assertEquals($result->getStatusCode(), 200);
    }
}
