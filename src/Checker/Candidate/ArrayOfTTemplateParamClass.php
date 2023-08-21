<?php

declare(strict_types=1);

namespace Fcpl\Psalm\Pimple\Container\Plugin\Checker\Candidate;

use Fcpl\Psalm\Pimple\Container\Plugin\Checker\AbstractArrayOf;
use Psalm\Type\Atomic;
use Psalm\Type\Atomic\TNamedObject;
use Psalm\Type\Atomic\TTemplateParam;
use Psalm\Type\Atomic\TTemplateParamClass;
use Psalm\Type\Union;

final class ArrayOfTTemplateParamClass extends AbstractArrayOf
{
    protected function process(Atomic $atomicType, string $key): void
    {
        if ($atomicType instanceof TTemplateParamClass) {
            $this->addCandidate(
                new TTemplateParam(
                    $atomicType->param_name,
                    new Union([$atomicType->as_type ?? new TNamedObject($atomicType->as)]),
                    $atomicType->defining_class,
                ),
                $key
            );
        }
    }
}
