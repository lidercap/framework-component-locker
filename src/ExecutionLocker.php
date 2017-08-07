<?php

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
    public function isLocked()
    {

    }

    /**
     * Cria um lock.
     *
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     *
     * @return $this
     */
    public function lock()
    {

    }

    /**
     * Remove um lock
     *
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     *
     * @return $this
     */
    public function unLock()
    {

    }
}