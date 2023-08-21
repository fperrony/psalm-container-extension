<?php

declare(strict_types=1);

namespace Fcpl\Psalm\Pimple\Container\Plugin\Checker\Candidate;

use Fcpl\Psalm\Pimple\Container\Plugin\Checker\AbstractArrayOf;
use Psalm\Type\Atomic;
use Psalm\Type\Atomic\TNamedObject;
use Psalm\Type\Atomic\TTemplateParamClass;

final class ArrayOfTNamedObject extends AbstractArrayOf
{
    protected function process(Atomic $atomicType, string $key): void
    {
        if (
            ! $atomicType instanceof TTemplateParamClass
            && isset($atomicType->as_type)
            && $atomicType->as_type instanceof TNamedObject
        ) {
            $this->addCandidate($atomicType->as_type, $key);
        }
    }
}
