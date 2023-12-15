<?php
namespace App\plugins\psol\report_calendar\registers;

use SPT\Application\IApp;
use SPT\Support\Loader;

class Report
{
    public static function registerType( IApp $app )
    {
        return [
            'calendar' => [
                'title' => 'Calendar',
                'namespace' => 'App\plugins\psol\report_calendar\\',
                'remove_object' => 'CalendarModel',
            ],
        ];
    }
}