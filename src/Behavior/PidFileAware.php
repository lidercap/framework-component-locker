<?php

namespace Lidercap\Component\Locker\Behavior;

/**
 * @codeCoverageIgnore
 */
trait PidFileAware
{
    /**
     * @var string
     */
    protected $pidFile;

    /**
     * @var int
     */
    protected $pidNumber;

    /**
     * @param string $pidFile
     */
    public function setPidFile($pidFile)
    {
        $this->pidFile = $pidFile;
    }

    /**
     * @return string
     */
    public function getPidFile()
    {
        return $pidFile;
    }

    /**
     * @param int $pidNumber
     */
    public function setPidNumber($pidNumber)
    {
        $this->pidNumber = $pidNumber;
    }

    /**
     * @return int
     */
    public function getPidNumber()
    {
        return $this->pidNumber;
    }
}
