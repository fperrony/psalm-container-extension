<?php

declare(strict_types=1);

namespace Fcpl\Psalm\Pimple\Container\Plugin\Checker;

interface ValidatorInterface
{
    public function isValid(): bool;
}
