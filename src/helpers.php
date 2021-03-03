<?php

declare(strict_types=1);

namespace DeSmart\Enum\Helpers;

function toConstName(string $value): string
{
    if (\ctype_upper($value)) {
        return $value;
    }

    if (\preg_match_all('/^([A-Z])+([A-Z_])*/u', $value)) {
        return $value;
    }

    $value = \preg_replace('/(.)(?=[A-Z])/u', '$1_', $value);

    return \mb_strtoupper($value, 'UTF-8');
}