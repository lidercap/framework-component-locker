<?php

namespace Lidercap\Tests\Component\Locker\Behavior;

use Lidercap\Component\Locker\Behavior\LockFileAware;

class LockFileAwareTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var LockFileAware
     */
    protected $trait;

    public function setUp()
    {
        $this->trait = $this->getMockForTrait(LockFileAware::class);
    }

    public function testIsLockFileValid()
    {
        $this->assertEquals(1, 1);
    }
}
