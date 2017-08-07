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

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage "lockFile" não informado
     * @expectedExceptionCode -1
     */
    public function testIsLockFileValidException1()
    {
        $method = new \ReflectionMethod($this->trait, 'isLockFileValid');
        $method->setAccessible(true);

        $method->invoke($this->trait);
    }

    /**
     * @expectedException \RunTimeException
     * @expectedExceptionMessage Diretório sem permissão de escrita: /root
     * @expectedExceptionCode -2
     */
    public function testIsLockFileValidException2()
    {
        $this->trait->setLockFile('/root/file.lock');

        $method = new \ReflectionMethod($this->trait, 'isLockFileValid');
        $method->setAccessible(true);

        $method->invoke($this->trait);
    }

    public function testIsLockFileValidSuccess()
    {
        $this->trait->setLockFile('/tmp/file.lock');

        $method = new \ReflectionMethod($this->trait, 'isLockFileValid');
        $method->setAccessible(true);

        $method->invoke($this->trait);
    }
}
