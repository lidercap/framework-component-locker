<?php

declare(strict_types=1);

namespace Lidercap\Component\Locker\Behavior;

trait PidFileAware
{
    /**
     * @var string
     */
    protected $pidFile = '';

    /**
     * @var int
     */
    protected $pidNumber = 0;

    /**
     * @codeCoverageIgnore
     *
     * @param string $pidFile
     *
     * @return $this
     */
    public function setPidFile(string $pidFile)
    {
        $this->pidFile = $pidFile;

        return $this;
    }

    /**
     * @codeCoverageIgnore
     *
     * @return string
     */
    public function getPidFile() : string
    {
        return $this->pidFile;
    }

    /**
     * @codeCoverageIgnore
     *
     * @param int $pidNumber
     *
     * @return $this
     */
    public function setPidNumber(int $pidNumber)
    {
        $this->pidNumber = $pidNumber;

        return $this;
    }

    /**
     * @throws \RunTimeException
     *
     * @return int
     */
    public function getPidNumber() : int
    {
        if (!file_exists($this->pidFile)) {
            $message = sprintf('PID file não encontrado: %s', $this->pidFile);
            throw new \RunTimeException($message, -1);
        }

        return (int)file_get_contents($this->pidFile);
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

        if ($this->pidNumber === 0) {
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
