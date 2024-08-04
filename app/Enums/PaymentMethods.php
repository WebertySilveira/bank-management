<?php

namespace App\Enums;

enum PaymentMethods: string
{
    case P = "P";
    case C = "C";
    case D = "D";

    public static function all(): array
    {
        $data = [];
        foreach (self::cases() as $status) {
            $data[] = $status->value;
        }

        return $data;
    }
}
