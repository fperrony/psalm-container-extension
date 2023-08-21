<?php

declare(strict_types=1);

namespace Fcpl\Psalm\Pimple\Container\Plugin\Checker;

use Fcpl\Psalm\Pimple\Container\Plugin\Checker\Type\ClassNameValidator;
use Fcpl\Psalm\Pimple\Container\Plugin\Checker\Type\MethodCallValidator;
use Fcpl\Psalm\Pimple\Container\Plugin\Checker\Type\MethodNameValidator;
use Fcpl\Psalm\Pimple\Container\Plugin\Checker\Type\ReturnTypeCandidateValidator;
use Iterator;
use PhpParser\Node\Arg;
use PhpParser\Node\Expr;
use Psalm\Codebase;
use Psalm\Plugin\EventHandler\Event\AfterMethodCallAnalysisEvent;
use Psalm\Type\Union;

final class Type
{
    /** @var AfterMethodCallAnalysisEvent $event */
    private $event;
    /** @var Expr $expr */
    private $expr;
    /** @var Codebase */
    private $codebase;
    /** @var string $className */
    private $className;
    /** @var string $methodName */
    private $methodName;
    /** @var Union|null $type */
    private $type = null;

    public function __construct(AfterMethodCallAnalysisEvent $event, Codebase $codebase)
    {
        $this->event = $event;
        $this->expr = $event->getExpr();
        $arg = $this->expr->args[0] ?? null;
        $this->codebase = $codebase;
        [$this->className, $this->methodName] = explode('::', $this->event->getDeclaringMethodId());

        /** @var ValidatorInterface $validator */
        foreach ($this->getValidators() as $validator) {
            if (! $validator->isValid()) {
                return;
            }
        }
        if ($arg instanceof Arg) {
            $this->type = $this->event->getStatementsSource()->getNodeTypeProvider()->getType($arg->value);
        }
    }

    public function getType(): ?Union
    {
        return $this->type;
    }

    private function getValidators(): Iterator
    {
        yield new MethodCallValidator($this->expr);
        yield new ReturnTypeCandidateValidator($this->event);
        yield new ClassNameValidator($this->codebase, $this->className);
        yield new MethodNameValidator($this->methodName);
    }
}
