<?php

declare(strict_types=1);

namespace Fcpl\Psalm\Pimple\Container\Plugin\Tests\Checker;

use Fcpl\Psalm\Pimple\Container\Plugin\Checker\PimpleContainerChecker;
use PhpParser\Node\Arg;
use PhpParser\Node\Expr;
use Pimple\Container;
use Psalm\Codebase;
use Psalm\NodeTypeProvider;
use Psalm\Plugin\EventHandler\Event\AfterMethodCallAnalysisEvent;
use Psalm\StatementsSource;
use Psalm\Type\Union;

class PimpleContainerCheckerSuccessTest extends AbstractTestCase
{
    use SuccessTrait;

    /**
     * @dataProvider dataProvider
     */
    public function testAfterMethodCallAnalysis(string $method, Union $union, Codebase $codebase): void
    {
        $arg = $this->createMock(Arg::class);
        $arg->value = $node = new Expr\ArrayItem($this->createMock(Expr::class), $this->createMock(Expr::class));
        $this->expr->args = [$arg];
        $afterEvent = $this->createMock(AfterMethodCallAnalysisEvent::class);
        $afterEvent->expects($this->once())->method('getExpr')->willReturn($this->expr);
        $afterEvent->expects($this->once())->method('getReturnTypeCandidate')->willReturn($union);
        $afterEvent->expects($this->once())->method('getDeclaringMethodId')
            ->willReturn(Container::class . '::' . $method);
        $afterEvent->expects($this->once())->method('getCodebase')->willReturn($codebase);
        $statementsSource = $this->createMock(StatementsSource::class);
        $nodeTypeProvider = $this->createMock(NodeTypeProvider::class);
        $nodeTypeProvider->expects($this->once())->method('getType')->with($node)->willReturn($union);
        $statementsSource->expects($this->once())->method('getNodeTypeProvider')->willReturn($nodeTypeProvider);
        $afterEvent->expects($this->once())->method('getStatementsSource')->willReturn($statementsSource);
        PimpleContainerChecker::afterMethodCallAnalysis($afterEvent);
    }

    /**
     * @return array<string, array{method: string, union: Union, codebase: Codebase}>
     */
    public function dataProvider(): array
    {
        return [
            'offsetGet' => [
                'method' => 'offsetget',
                'union' => $this->getUnionWithTClassString(),
                'codebase' => $this->getCodebaseWithClassImplements(),
            ],
        ];
    }
}
