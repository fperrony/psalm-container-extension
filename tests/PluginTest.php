<?php

declare(strict_types=1);

namespace Fcpl\Psalm\Pimple\Container\Plugin\Tests;

use Fcpl\Psalm\Pimple\Container\Plugin\Checker\PimpleContainerChecker;
use Fcpl\Psalm\Pimple\Container\Plugin\Plugin;
use PHPUnit\Framework\TestCase;
use Psalm\Plugin\RegistrationInterface;

class PluginTest extends TestCase
{
    public function testInvoke(): void
    {
        $plugin = new Plugin();
        $registration = $this->createMock(RegistrationInterface::class);
        $registration->expects($this->once())->method('registerHooksFromClass')->with(PimpleContainerChecker::class);
        $plugin($registration, null);
    }
}
