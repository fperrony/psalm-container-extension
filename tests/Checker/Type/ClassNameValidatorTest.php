<?php

declare(strict_types=1);

namespace Fcpl\Psalm\Pimple\Container\Plugin\Tests\Checker\Type;

use Fcpl\Psalm\Pimple\Container\Plugin\Checker\Type\ClassNameValidator;
use PHPUnit\Framework\TestCase;
use Pimple\Container;
use Psalm\Codebase;
use Psr\Container\ContainerInterface;

class ClassNameValidatorTest extends TestCase
{
    public function testIsValidImplementsArrayAccess(): void
    {
        $codebase = $this->createMock(Codebase::class);
        $codebase->expects($this->once())->method('classImplements')->willReturn(true);
        $classNameValidator = new ClassNameValidator($codebase, '');
        $this->assertTrue($classNameValidator->isValid());
    }

    public function testIsValidIsContainer(): void
    {
        $codebase = $this->createMock(Codebase::class);
        $classNameValidator = new ClassNameValidator($codebase, Container::class);
        $this->assertTrue($classNameValidator->isValid());
    }

    public function testIsNotValid(): void
    {
        $codebase = $this->createMock(Codebase::class);
        $codebase->expects($this->once())->method('classImplements')->willReturn(false);
        $classNameValidator = new ClassNameValidator($codebase, '');
        $this->assertFalse($classNameValidator->isValid());
    }

    public function testIsNotValidIsNotContainer(): void
    {
        $codebase = $this->createMock(Codebase::class);
        $classNameValidator = new ClassNameValidator($codebase, ContainerInterface::class);
        $this->assertFalse($classNameValidator->isValid());
    }
}
