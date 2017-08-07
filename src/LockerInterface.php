<?php

namespace Lidercap\Component\Locker;

/**
 * Interface para lockers de recursos.
 */
interface LockerInterface
{
    /**
     * @param string $lockPath
     */
    public function setLockFile(string $lockPath);

    /**
     * Verifica se há lock ativo.
     *
     * @return bool
     */
    public function isLocked();

    /**
     * Cria um lock.
     *
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     *
     * @return $this
     */
    public function lock();

    /**
     * Remove um lock
     *
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     *
     * @return $this
     */
    public function unLock();
}
