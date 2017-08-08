<?php

namespace Lidercap\Component\Locker;

/**
 * @codeCoverageIgnore
 */
trait LockerAware
{
    /**
     * @var LockerInterface
     */
    protected $locker;

    /**
     * @param LockerInterface $locker
     */
    public function setLocker(LockerInterface $locker)
    {
        $this->locker = $locker;
    }
}
