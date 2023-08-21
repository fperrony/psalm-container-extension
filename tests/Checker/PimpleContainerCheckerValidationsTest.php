<?php

declare(strict_types=1);

namespace Fcpl\Psalm\Pimple\Container\Plugin\Tests\Checker;

use Fcpl\Psalm\Pimple\Container\Plugin\Checker\PimpleContainerChecker;
use PhpParser\Node\Arg;
use PhpParser\Node\Expr;
use PhpParser\Node\Stmt\ClassLike;
use PhpParser\NodeAbstract;
use PHPStan\Node\ClassMethodsNode;
use Pimple\Container;
use Psalm\NodeTypeProvider;
use Psalm\Plugin\EventHandler\Event\AfterMethodCallAnalysisEvent;
use Psalm\StatementsSource;
use Psr\Container\ContainerInterface;

class PimpleContainerCheckerValidationsTest extends AbstractTestCase
{
    public function testGetReturnTypeCandidateNull(): void
    {
        $afterEvent = $this->createMock(AfterMethodCallAnalysisEvent::class);
        $afterEvent->expects($this->once())->method('getExpr')->willReturn($this->expr);
        $afterEvent->expects($this->once())->method('getReturnTypeCandidate')->willReturn(null);
        $afterEvent->expects($this->once())->method('getDeclaringMethodId')
            ->willReturn(Container::class . '::' . 'invalidMethodName');
        PimpleContainerChecker::afterMethodCallAnalysis($afterEvent);
    }

    public function testInvalidMethodName(): void
    {
        $afterEvent = $this->createMock(AfterMethodCallAnalysisEvent::class);
        $afterEvent->expects($this->once())->method('getExpr')->willReturn($this->expr);
        $afterEvent->expects($this->once())->method('getReturnTypeCandidate')->willReturn($this->union);
        $afterEvent->expects($this->once())->method('getDeclaringMethodId')
            ->willReturn(Container::class . '::' . 'invalidMethodName');
        PimpleContainerChecker::afterMethodCallAnalysis($afterEvent);
    }

    public function testInvalidClassName(): void
    {
        $afterEvent = $this->createMock(AfterMethodCallAnalysisEvent::class);
        $afterEvent->expects($this->once())->method('getExpr')->willReturn($this->expr);
        $afterEvent->expects($this->once())->method('getReturnTypeCandidate')->willReturn($this->union);
        $afterEvent->expects($this->once())->method('getDeclaringMethodId')
            ->willReturn(\Pimple\Psr11\Container::class . '::' . 'offsetGet');
        PimpleContainerChecker::afterMethodCallAnalysis($afterEvent);
    }

    public function testArgNull(): void
    {
        $afterEvent = $this->createMock(AfterMethodCallAnalysisEvent::class);
        $afterEvent->expects($this->once())->method('getExpr')->willReturn($this->expr);
        $afterEvent->expects($this->once())->method('getReturnTypeCandidate')->willReturn($this->union);
        $afterEvent->expects($this->once())->method('getDeclaringMethodId')
            ->willReturn(Container::class . '::' . 'offsetGet');
        PimpleContainerChecker::afterMethodCallAnalysis($afterEvent);
    }

    public function testInvalidClassImplements(): void
    {
        $afterEvent = $this->createMock(AfterMethodCallAnalysisEvent::class);
        $afterEvent->expects($this->once())->method('getExpr')->willReturn($this->expr);
        $afterEvent->expects($this->once())->method('getReturnTypeCandidate')->willReturn($this->union);
        $afterEvent->expects($this->once())->method('getDeclaringMethodId')
            ->willReturn(ContainerInterface::class . '::' . 'offsetget');
        PimpleContainerChecker::afterMethodCallAnalysis($afterEvent);
    }

    public function testTypeNull(): void
    {
        $arg = $this->createMock(Arg::class);
        $node = new Expr\ArrayItem($this->createMock(Expr::class), $this->createMock(Expr::class));
        $arg->value = $node;
        $this->expr->args = [$arg];
        $afterEvent = $this->createMock(AfterMethodCallAnalysisEvent::class);
        $afterEvent->expects($this->once())->method('getExpr')->willReturn($this->expr);
        $afterEvent->expects($this->once())->method('getReturnTypeCandidate')->willReturn($this->union);
        $afterEvent->expects($this->once())->method('getDeclaringMethodId')
            ->willReturn(Container::class . '::' . 'offsetget');
        PimpleContainerChecker::afterMethodCallAnalysis($afterEvent);
    }
}
