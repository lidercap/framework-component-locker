<?php

declare(strict_types=1);

namespace Lidercap\Component\Locker;

use Lidercap\Component\Locker\Behavior;

/**
 * Locker de execussões de processo.
 */
class ExecutionLocker implements LockerInterface
{
    use Behavior\LockFileAware;
    use Behavior\PidFileAware;

    /**
     * Verifica se há lock ativo.
     *
     * @return bool
     */
    public function isLocked() : bool
    {
        try {
            $this->isLockFileValid();
            $this->isPidFileValid();

            return file_exists($this->lockFile);
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Cria um lock.
     *
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     *
     * @return $this
     */
    public function lock() : LockerInterface
    {
        if ($this->isLocked()) {
            return $this;
        }

        touch($this->lockFile);
        file_put_contents($this->pidFile, $this->pidNumber);

        return $this;
    }

    /**
     * Remove um lock.
     *
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     *
     * @return $this
     */
    public function unLock() : LockerInterface
    {
    }
}
