<?php

declare(strict_types=1);

namespace Fcpl\Psalm\Pimple\Container\Plugin\Checker\Type;

use Fcpl\Psalm\Pimple\Container\Plugin\Checker\ValidatorInterface;

final class MethodNameValidator implements ValidatorInterface
{
    /** @var string $methodName */
    private $methodName;

    public function __construct(string $methodName)
    {
        $this->methodName = $methodName;
    }

    public function isValid(): bool
    {
        return $this->methodName === 'offsetget';
    }
}
