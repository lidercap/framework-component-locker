<?php

namespace Lidercap\Tests\Component\Locker\Behavior;

use Lidercap\Component\Locker\Behavior\PidFileAware;

class PidFileAwareTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var PidFileAware
     */
    protected $trait;

    public function setUp()
    {
        $this->trait = $this->getMockForTrait(PidFileAware::class);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage "pidFile" não informado
     * @expectedExceptionCode -1
     */
    public function testIsPidFileValidException1()
    {
        $method = new \ReflectionMethod($this->trait, 'isPidFileValid');
        $method->setAccessible(true);

        $method->invoke($this->trait);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage "pidNumber" não informado
     * @expectedExceptionCode -2
     */
    public function testIsPidFileValidException2()
    {
        $this->trait->setPidFile('/path/to/file.pid');

        $method = new \ReflectionMethod($this->trait, 'isPidFileValid');
        $method->setAccessible(true);

        $method->invoke($this->trait);
    }

    /**
     * @expectedException \RunTimeException
     * @expectedExceptionMessage Diretório sem permissão de escrita: /root
     * @expectedExceptionCode -3
     */
    public function testIsPidFileValidException3()
    {
        $this->trait->setPidFile('/root/file.pid');
        $this->trait->setPidNumber(123);

        $method = new \ReflectionMethod($this->trait, 'isPidFileValid');
        $method->setAccessible(true);

        $method->invoke($this->trait);
    }

    public function testIsPidFileValidSuccess()
    {
        $this->trait->setPidFile('/tmp/file.pid');
        $this->trait->setPidNumber(123);

        $method = new \ReflectionMethod($this->trait, 'isPidFileValid');
        $method->setAccessible(true);

        $method->invoke($this->trait);
    }
}
