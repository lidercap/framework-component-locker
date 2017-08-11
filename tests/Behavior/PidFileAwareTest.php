<?php

namespace Lidercap\Tests\Component\Locker\Behavior;

use Lidercap\Component\Locker\Behavior\PidFileAware;

class PidFileAwareTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var string
     */
    protected $pidFile;

    /**
     * @var PidFileAware
     */
    protected $trait;

    public function setUp()
    {
        $this->pidFile = '/tmp/pidfile-' . md5(microtime(true));
        $this->trait   = $this->getMockForTrait(PidFileAware::class);
    }

    public function tearDown()
    {
        @unlink($this->pidFile);
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessagePID file não encontrado: /non/existent/file.pid
     * @expectedExceptionCode -1
     */
    public function testGetPidNumberException()
    {
        $this->trait->setPidFile('/non/existent/file.pid');
        $this->trait->getPidNumber();
    }

    public function testGetPidNumberSuccess()
    {
        $pid = rand(100, 200);
        file_put_contents($this->pidFile, (int)$pid);
        $this->trait->setPidFile($this->pidFile);

        $this->assertEquals($pid, $this->trait->getPidNumber());
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
