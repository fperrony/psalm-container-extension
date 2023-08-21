<?php

declare(strict_types=1);

namespace Fcpl\Psalm\Pimple\Container\Plugin\Tests\Checker;

use Psalm\Codebase;
use Psalm\Type\Atomic\TClassString;
use Psalm\Type\Atomic\TLiteralClassString;
use Psalm\Type\Atomic\TLiteralString;
use Psalm\Type\Atomic\TNamedObject;
use Psalm\Type\Atomic\TTemplateParamClass;
use Psalm\Type\Union;

trait SuccessTrait
{
    protected function getUnionWithTClassString(): Union
    {
        $union = $this->createMock(Union::class);
        $tLiteralClassString = $this->createMock(TLiteralClassString::class);
        $tLiteralClassString->value = 'Foo';
        $tLiteralString = $this->createMock(TLiteralString::class);
        $tLiteralString->value = 'OtherFoo';
        $tTemplateParamClass = $this->createMock(TTemplateParamClass::class);
        $tTemplateParamClass->param_name = 'Test';
        $tTemplateParamClass->as_type = new TNamedObject('Foo');
        $tTemplateParamClass->defining_class = 'Foo';
        $tClassString = $this->createMock(TClassString::class);
        $tClassString->as_type = new TNamedObject('Foo');
        $tClassStringNull = $this->createMock(TClassString::class);
        $tClassStringNull->as_type = null;
        $union->expects($this->exactly(1))->method('getAtomicTypes')->willReturn(
            [
                get_class($tLiteralClassString) => $tLiteralClassString,
                get_class($tLiteralString) => $tLiteralString,
                get_class($tTemplateParamClass) => $tTemplateParamClass,
                get_class($tClassString) => $tClassString,
                '(null)' . get_class($tClassStringNull) => $tClassStringNull,
            ]
        );
        return $union;
    }

    protected function getCodebaseWithClassImplements(): Codebase
    {
        $codebase = $this->createMock(Codebase::class);
        $codebase->expects($this->exactly(1))->method('classOrInterfaceExists')
            ->willReturnCallback(
                static function (string $className): bool {
                    return $className === 'OtherFoo';
                }
            );
        return $codebase;
    }
}
