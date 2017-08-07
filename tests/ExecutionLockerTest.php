<?php

namespace Lidercap\Tests\Component\Locker;

use Lidercap\Component\Locker\ExecutionLocker;
use Lidercap\Component\Locker\LockerInterface;

class ExecutionLockerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ExecutionLocker
     */
    protected $locker;

    public function setUp()
    {
        $this->locker = new ExecutionLocker;
    }

    public function testInterface()
    {
        $this->assertInstanceOf(LockerInterface::class, $this->locker);
    }
}
