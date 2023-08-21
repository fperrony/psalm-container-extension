<?php

declare(strict_types=1);

namespace Fcpl\Psalm\Pimple\Container\Plugin\Checker\Candidate;

use Fcpl\Psalm\Pimple\Container\Plugin\Checker\AbstractArrayOf;
use Psalm\Type\Atomic;
use Psalm\Type\Atomic\TLiteralClassString;
use Psalm\Type\Atomic\TNamedObject;

final class ArrayOfTLiteralClassString extends AbstractArrayOf
{
    protected function process(Atomic $atomicType, string $key): void
    {
        if ($atomicType instanceof TLiteralClassString) {
            $this->addCandidate(new TNamedObject($atomicType->value), $key);
        }
    }
}
