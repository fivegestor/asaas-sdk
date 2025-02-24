<?php

namespace FiveGestor\Test\Unit;

use FiveGestor\Asaas\Facade\Asaas;
use FiveGestor\Test\TestCase;

class NotificationTest extends TestCase
{
     public function testUpdateNotification()
    {
        $values = [];

        $result = Asaas::notification()->update('1', $values);

        $this->assertEquals($result->getStatusCode(), 200);
    }
}
