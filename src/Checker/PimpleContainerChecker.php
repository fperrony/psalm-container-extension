<?php

declare(strict_types=1);

namespace Fcpl\Psalm\Pimple\Container\Plugin\Checker;

use Fcpl\Psalm\Pimple\Container\Plugin\Checker\Candidate\ArrayOfTLiteralClassString;
use Fcpl\Psalm\Pimple\Container\Plugin\Checker\Candidate\ArrayOfTLiteralString;
use Fcpl\Psalm\Pimple\Container\Plugin\Checker\Candidate\ArrayOfTNamedObject;
use Fcpl\Psalm\Pimple\Container\Plugin\Checker\Candidate\ArrayOfTTemplateParamClass;
use Psalm\Plugin\EventHandler\AfterMethodCallAnalysisInterface;
use Psalm\Plugin\EventHandler\Event\AfterMethodCallAnalysisEvent;
use Psalm\Type\Union;

final class PimpleContainerChecker implements AfterMethodCallAnalysisInterface
{
    public static function afterMethodCallAnalysis(AfterMethodCallAnalysisEvent $event): void
    {
        $codebase = $event->getCodebase();
        $type = (new Type($event, $codebase))->getType();
        if ($type === null) {
            return;
        }
        $atomicTypes = $type->getAtomicTypes();
        $returnTypeCandidates = array_merge(
            (new ArrayOfTLiteralClassString($atomicTypes))->getArray(),
            (new ArrayOfTLiteralString($atomicTypes, $codebase))->getArray(),
            (new ArrayOfTTemplateParamClass($atomicTypes))->getArray(),
            (new ArrayOfTNamedObject($atomicTypes))->getArray(),
        );
        if ($returnTypeCandidates !== []) {
            $event->setReturnTypeCandidate(new Union($returnTypeCandidates));
        }
    }
}
