<?php

declare(strict_types=1);

namespace Fcpl\Psalm\Pimple\Container\Plugin\Checker\Type;

use Fcpl\Psalm\Pimple\Container\Plugin\Checker\ValidatorInterface;
use PhpParser\Node\Expr;
use PhpParser\Node\Expr\MethodCall;

final class MethodCallValidator implements ValidatorInterface
{
    /** @var Expr $expr */
    private $expr;

    public function __construct(Expr $expr)
    {
        $this->expr = $expr;
    }

    public function isValid(): bool
    {
        return $this->expr instanceof MethodCall;
    }
}
