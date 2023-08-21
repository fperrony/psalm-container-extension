<?php

declare(strict_types=1);

use NunoMaduro\PhpInsights\Domain\Insights\CyclomaticComplexityIsHigh;
use PHP_CodeSniffer\Standards\Generic\Sniffs\Files\LineLengthSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\Formatting\SpaceAfterNotSniff;
use SlevomatCodingStandard\Sniffs\Classes\SuperfluousAbstractClassNamingSniff;
use SlevomatCodingStandard\Sniffs\Classes\SuperfluousExceptionNamingSniff;
use SlevomatCodingStandard\Sniffs\Classes\SuperfluousInterfaceNamingSniff;
use SlevomatCodingStandard\Sniffs\Classes\SuperfluousTraitNamingSniff;
use SlevomatCodingStandard\Sniffs\Commenting\DocCommentSpacingSniff;

return [
    'preset' => 'default',
    'exclude' => [
        'docker',
        'var',
        'vendor',
    ],
    'add' => [],
    'remove' => [
        SuperfluousInterfaceNamingSniff::class,
        SuperfluousAbstractClassNamingSniff::class,
        SuperfluousTraitNamingSniff::class,
        SuperfluousExceptionNamingSniff::class,
    ],
    'config' => [
        LineLengthSniff::class => [
            'lineLimit' => 120,
            'absoluteLineLimit' => 140,
        ],
        SpaceAfterNotSniff::class => [
            'spacing' => 1,
        ],
        DocCommentSpacingSniff::class => [
            'linesCountBetweenDifferentAnnotationsTypes' => 0,
        ],
        CyclomaticComplexityIsHigh::class => [
            'maxComplexity' => 5,
        ],
    ],
    'requirements' => [
        'min-quality' => 100.0,
        'min-complexity' => 75.0,
        'min-architecture' => 100.0,
        'min-style' => 100.0,
    ],
];
