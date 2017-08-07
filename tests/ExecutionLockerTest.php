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
        $this->tearDown();
        $this->locker = new ExecutionLocker;
    }

    public function tearDown()
    {
        array_map('unlink', glob('/tmp/*.lock'));
    }

    public function testInterface()
    {
        $this->assertInstanceOf(LockerInterface::class, $this->locker);
    }

    public function testFistExecutionIsNotLocked1()
    {
        $this->assertFalse($this->locker->isLocked());
    }

    public function testFistExecutionIsNotLocked2()
    {
        $this->locker->setLockFile('/tmp/test.lock');
        $this->assertFalse($this->locker->isLocked());
    }

    public function testIsLocked()
    {
        touch('/tmp/test.lock');

        $this->locker->setLockFile('/tmp/test.lock');
        $this->locker->setPidFile('/tmp/test.lock');
        $this->locker->setPidNumber(rand(1, 100));

        $this->assertTrue($this->locker->isLocked());
    }

    public function testIsUnLocked()
    {
        touch('/tmp/test.lock');

        $this->locker->setLockFile('/tmp/test.lock');
        $this->locker->setPidFile('/tmp/test.lock');
        $this->locker->setPidNumber(rand(1, 100));

        $this->assertTrue($this->locker->isLocked());

        unlink('/tmp/test.lock');
        $this->assertFalse($this->locker->isLocked());
    }

    public function testLockAlreadyLocked()
    {
        touch('/tmp/test.lock');

        $this->locker->setLockFile('/tmp/test.lock');
        $this->locker->setPidFile('/tmp/test.lock');
        $this->locker->setPidNumber(rand(1, 100));

        $this->locker->lock();
    }
}
