<?php

declare(strict_types=1);

namespace Fcpl\Psalm\Pimple\Container\Plugin\Tests\Checker\Type;

use Fcpl\Psalm\Pimple\Container\Plugin\Checker\Type\ReturnTypeCandidateValidator;
use PHPUnit\Framework\TestCase;
use Psalm\Plugin\EventHandler\Event\AfterMethodCallAnalysisEvent;
use Psalm\Type\Union;

class ReturnTypeCandidateValidatorTest extends TestCase
{
    public function testIsValid(): void
    {
        $event = $this->createMock(AfterMethodCallAnalysisEvent::class);
        $union = $this->createMock(Union::class);
        $event->method('getReturnTypeCandidate')->willReturn($union);
        $this->assertTrue((new ReturnTypeCandidateValidator($event))->isValid());
    }

    public function testIsNotValid(): void
    {
        $event = $this->createMock(AfterMethodCallAnalysisEvent::class);
        $event->method('getReturnTypeCandidate')->willReturn(null);
        $this->assertFalse((new ReturnTypeCandidateValidator($event))->isValid());
    }
}
