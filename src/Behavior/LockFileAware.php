<?php

namespace Lidercap\Component\Locker\Behavior;

trait LockFileAware
{
    /**
     * @var string
     */
    protected $lockFile;

    /**
     * @codeCoverageIgnore
     *
     * @param string $lockFile
     */
    public function setLockFile($lockFile)
    {
        $this->lockFile = $lockFile;
    }

    /**
     * @codeCoverageIgnore
     *
     * @return string
     */
    public function getLockFile()
    {
        return $this->lockFile;
    }

    /**
     * Valida os dados informados.
     *
     * @throws \InvalidArgumentException
     */
    protected function isLockFileValid()
    {
        if (!strlen($this->lockPath)) {
            $message = '"lockFile" não informado';
            throw new \InvalidArgumentException($message, -1);
        }
    }
}
