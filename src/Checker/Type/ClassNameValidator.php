<?php

declare(strict_types=1);

namespace Fcpl\Psalm\Pimple\Container\Plugin\Checker\Type;

use ArrayAccess;
use Fcpl\Psalm\Pimple\Container\Plugin\Checker\ValidatorInterface;
use Pimple\Container;
use Psalm\Codebase;

final class ClassNameValidator implements ValidatorInterface
{
    /** @var Codebase $codebase */
    private $codebase;
    /** @var string $className */
    private $className;

    public function __construct(Codebase $codebase, string $className)
    {
        $this->codebase = $codebase;
        $this->className = $className;
    }

    public function isValid(): bool
    {
        return $this->className === Container::class ||
            $this->codebase->classImplements($this->className, ArrayAccess::class);
    }
}
