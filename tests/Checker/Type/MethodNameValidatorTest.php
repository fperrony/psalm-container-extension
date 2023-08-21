<?php

declare(strict_types=1);

namespace Fcpl\Psalm\Pimple\Container\Plugin\Tests\Checker\Type;

use Fcpl\Psalm\Pimple\Container\Plugin\Checker\Type\MethodNameValidator;
use PHPUnit\Framework\TestCase;

class MethodNameValidatorTest extends TestCase
{
    public function testIsValid(): void
    {
        $this->assertTrue((new MethodNameValidator('offsetget'))->isValid());
    }

    public function testIsNotValid(): void
    {
        $this->assertFalse((new MethodNameValidator('offsetSet'))->isValid());
        $this->assertFalse((new MethodNameValidator('offsetGet'))->isValid());
        $this->assertFalse((new MethodNameValidator('offsetUnset'))->isValid());
        $this->assertFalse((new MethodNameValidator('offsetExists'))->isValid());
    }
}
