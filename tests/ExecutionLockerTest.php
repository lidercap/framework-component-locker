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
        array_map('unlink', glob('/tmp/*.pid'));
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

        $object = $this->locker->lock();
        $this->assertInstanceOf(LockerInterface::class, $object);
    }

    public function testLockSuccess()
    {
        $pidNumber = rand(1, 100);
        $lockFile  = '/tmp/test.lock';
        $pidFile   = '/tmp/test.pid';

        $this->locker->setLockFile($lockFile);
        $this->locker->setPidFile($pidFile);
        $this->locker->setPidNumber($pidNumber);

        $object = $this->locker->lock();
        $this->assertInstanceOf(LockerInterface::class, $object);

        $this->assertFileExists($lockFile);
        $this->assertEquals(null, file_get_contents($lockFile));
        $this->assertEquals($pidNumber, file_get_contents($pidFile));
    }

    public function testUnlockAlreadyUnlocked()
    {
        $object = $this->locker->unLock();
        $this->assertInstanceOf(LockerInterface::class, $object);
    }

    public function testUnlockSuccess()
    {
        $pidNumber = rand(1, 100);
        $lockFile  = '/tmp/test.lock';
        $pidFile   = '/tmp/test.pid';

        $this->locker->setLockFile($lockFile);
        $this->locker->setPidFile($pidFile);
        $this->locker->setPidNumber($pidNumber);

        $this->locker->lock();
        $this->assertTrue($this->locker->isLocked());

        $object = $this->locker->unLock();
        $this->assertInstanceOf(LockerInterface::class, $object);

        $this->assertFalse($this->locker->isLocked());
        $this->assertFileNotExists($lockFile);
        $this->assertFileNotExists($pidFile);
    }
}
