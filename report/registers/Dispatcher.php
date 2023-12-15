<?php
namespace App\plugins\psol\report\registers;

use SPT\Application\IApp;
use SPT\Response;
use App\plugins\psol\report\libraries\ReportDispatch;

class Dispatcher
{
    public static function dispatch(IApp $app)
    {
        $reportDispatcher = new ReportDispatch($app->getContainer());
        $reportDispatcher->execute();
    }
}