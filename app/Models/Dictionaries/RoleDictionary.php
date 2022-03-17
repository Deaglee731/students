<?php

namespace App\Models\Dictionaries;

use Dictionaries\Dictionary;

class RoleDictionary extends Dictionary
{
    const ROLE_ADMIN = 1;
    const ROLE_TEACHER = 2;
    const ROLE_STUDENT = 3;

    /**
     * @inheritDoc
     */
    public static function getDictionary(): array
    {
        return [
            self::ROLE_ADMIN => 'Администратор',
            self::ROLE_TEACHER => 'Учитель',
            self::ROLE_STUDENT => 'Студент',
        ];
    }
}
