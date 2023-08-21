<?php

declare(strict_types=1);

namespace Fcpl\Psalm\Pimple\Container\Plugin;

use Fcpl\Psalm\Pimple\Container\Plugin\Checker\PimpleContainerChecker;
use Psalm\Plugin\PluginEntryPointInterface;
use Psalm\Plugin\RegistrationInterface;
use SimpleXMLElement;

final class Plugin implements PluginEntryPointInterface
{
    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     * @phpcsSuppress SlevomatCodingStandard.Functions.UnusedParameter
     */
    public function __invoke(RegistrationInterface $registration, ?SimpleXMLElement $config = null): void
    {
        class_exists(PimpleContainerChecker::class);
        $registration->registerHooksFromClass(PimpleContainerChecker::class);
    }
}
