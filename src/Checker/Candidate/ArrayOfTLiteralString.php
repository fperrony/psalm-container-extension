<?php

declare(strict_types=1);

namespace Fcpl\Psalm\Pimple\Container\Plugin\Checker\Candidate;

use Fcpl\Psalm\Pimple\Container\Plugin\Checker\AbstractArrayOf;
use Psalm\Codebase;
use Psalm\Type\Atomic;
use Psalm\Type\Atomic\TLiteralString;
use Psalm\Type\Atomic\TNamedObject;

final class ArrayOfTLiteralString extends AbstractArrayOf
{
    /** @var Codebase $codebase */
    private $codebase;

    /**
     * @param array<string, Atomic> $atomicTypes
     */
    public function __construct(array &$atomicTypes, Codebase $codebase)
    {
        $this->codebase = $codebase;
        parent::__construct($atomicTypes);
    }

    protected function process(Atomic $atomicType, string $key): void
    {
        if ($atomicType instanceof TLiteralString && $this->codebase->classOrInterfaceExists($atomicType->value)) {
            $this->addCandidate(new TNamedObject($atomicType->value), $key);
        }
    }
}
