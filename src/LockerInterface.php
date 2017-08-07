<?php

declare(strict_types=1);

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
    public function isLocked() : bool;

    /**
     * Cria um lock.
     *
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     *
     * @return $this
     */
    public function lock() : LockerInterface;

    /**
     * Remove um lock.
     *
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     *
     * @return $this
     */
    public function unLock() : LockerInterface;
}
