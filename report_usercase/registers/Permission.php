<?php

namespace App\plugins\report_usercase\registers;

use SPT\Application\IApp;

class Permission
{
    public static function registerAccess()
    {
        return [
            'usercase_manager', 'usercase_read',
        ];
    }
}
