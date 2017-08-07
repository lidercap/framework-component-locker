<?php

namespace Lidercap\Component\Locker\Behavior;

/**
 * @codeCoverageIgnore
 */
trait LockFileAware
{
    /**
     * @var string
     */
    protected $lockFile;

    /**
     * @param string $lockFile
     */
    public function setLockFile($lockFile)
    {
        $this->lockFile = $lockFile;
    }

    /**
     * @return string
     */
    public function getLockFile()
    {
        return $this->lockFile;
    }
}
