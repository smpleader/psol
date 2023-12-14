<?php
namespace App\plugins\report\registers;

use SPT\Application\IApp;
use SPT\Response;
use App\plugins\report\libraries\ReportDispatch;

class Dispatcher
{
    public static function dispatch(IApp $app)
    {
        // Check Permission
        $app->plgLoad('permission', 'CheckSession');
        
        $reportDispatcher = new ReportDispatch($app->getContainer());
        $reportDispatcher->execute();
    }
}