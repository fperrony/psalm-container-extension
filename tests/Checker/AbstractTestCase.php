<?php

declare(strict_types=1);

namespace Fcpl\Psalm\Pimple\Container\Plugin\Tests\Checker;

use Fcpl\Psalm\Pimple\Container\Plugin\Checker\PimpleContainerChecker;
use PhpParser\Node\Expr\MethodCall;
use PHPUnit\Framework\TestCase;
use Psalm\Type\Union;

abstract class AbstractTestCase extends TestCase
{
    /** @var MethodCall $expr */
    protected $expr;
    /** @var Union $union */
    protected $union;

    public function setUp(): void
    {
        parent::setUp();
        $this->union = $this->createMock(Union::class);
        $this->expr = $this->createMock(MethodCall::class);
    }
}
