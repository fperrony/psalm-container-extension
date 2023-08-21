<?php

declare(strict_types=1);

namespace Fcpl\Psalm\Pimple\Container\Plugin\Tests\Checker\Type;

use Fcpl\Psalm\Pimple\Container\Plugin\Checker\Type\MethodCallValidator;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Expr\StaticCall;
use PHPUnit\Framework\TestCase;

class MethodCallValidatorTest extends TestCase
{
    public function testIsValid(): void
    {
        $expr = $this->createMock(MethodCall::class);
        $validator = new MethodCallValidator($expr);
        $this->assertTrue($validator->isValid());
    }

    public function testIsNotValid(): void
    {
        $expr = $this->createMock(StaticCall::class);
        $validator = new MethodCallValidator($expr);
        $this->assertFalse($validator->isValid());
    }
}
