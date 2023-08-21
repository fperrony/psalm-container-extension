<?php

declare(strict_types=1);

namespace Fcpl\Psalm\Pimple\Container\Plugin\Checker;

use Psalm\Type\Atomic;

abstract class AbstractArrayOf
{
    /** @var array<int, Atomic> */
    private $candidates = [];

    /** @var array<string, Atomic> $atomicTypes */
    private $atomicTypes;

    /**
     * @param array<string, Atomic> $atomicTypes
     */
    public function __construct(array &$atomicTypes)
    {
        $this->atomicTypes = &$atomicTypes;
    }

    /**
     * @return array<int, Atomic>
     */
    public function getArray(): array
    {
        $atomicTypes = $this->atomicTypes;
        foreach ($atomicTypes as $key => $atomicType) {
            $this->process($atomicType, $key);
        }
        return $this->candidates;
    }

    protected function addCandidate(Atomic $atomicType, string $key): void
    {
        $this->candidates[] = $atomicType;
        $this->removeAtomicType($key);
    }

    abstract protected function process(Atomic $atomicType, string $key): void;

    private function removeAtomicType(string $key): void
    {
        unset($this->atomicTypes[$key]);
    }
}
