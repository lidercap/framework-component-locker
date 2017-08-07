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
     * @throws \RunTimeException
     */
    protected function isLockFileValid()
    {
        if (!strlen($this->lockFile)) {
            $message = '"lockFile" não informado';
            throw new \InvalidArgumentException($message, -1);
        }

        $path = dirname($this->lockFile);

        if (!is_writable($path)) {
            $message = sprintf('Diretório sem permissão de escrita: %s', $path);
            throw new \RunTimeException($message, -2);
        }
    }
}
