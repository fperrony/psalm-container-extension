<?php

declare(strict_types=1);

namespace Fcpl\Psalm\Pimple\Container\Plugin\Checker\Type;

use Fcpl\Psalm\Pimple\Container\Plugin\Checker\ValidatorInterface;
use Psalm\Plugin\EventHandler\Event\AfterMethodCallAnalysisEvent;

final class ReturnTypeCandidateValidator implements ValidatorInterface
{
    /** @var AfterMethodCallAnalysisEvent $event */
    private $event;

    public function __construct(AfterMethodCallAnalysisEvent $event)
    {
        $this->event = $event;
    }

    public function isValid(): bool
    {
        return $this->event->getReturnTypeCandidate() !== null;
    }
}
