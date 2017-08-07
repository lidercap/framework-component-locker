<?php

namespace Lidercap\Component\Locker\Behavior;

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
     * @codeCoverageIgnore
     *
     * @param string $pidFile
     */
    public function setPidFile($pidFile)
    {
        $this->pidFile = $pidFile;
    }

    /**
     * @codeCoverageIgnore
     *
     * @return string
     */
    public function getPidFile()
    {
        return $pidFile;
    }

    /**
     * @codeCoverageIgnore
     *
     * @param int $pidNumber
     */
    public function setPidNumber($pidNumber)
    {
        $this->pidNumber = $pidNumber;
    }

    /**
     * @codeCoverageIgnore
     *
     * @return int
     */
    public function getPidNumber()
    {
        return $this->pidNumber;
    }

    /**
     * Valida os dados informados.
     *
     * @throws \InvalidArgumentException
     * @throws \RunTimeException
     */
    protected function isPidFileValid()
    {
        if (!strlen($this->pidFile)) {
            $message = '"pidFile" não informado';
            throw new \InvalidArgumentException($message, -1);
        }

        if (!strlen($this->pidNumber)) {
            $message = '"pidNumber" não informado';
            throw new \InvalidArgumentException($message, -2);
        }

        $path = dirname($this->pidFile);

        if (!is_writable($path)) {
            $message = sprintf('Diretório sem permissão de escrita: %s', $path);
            throw new \RunTimeException($message, -3);
        }
    }
}
