<?php
namespace App\psol\report_calendar\registers;
 
use SPT\Application\IApp;  

class Dispatcher
{
    public static function dispatch(IApp $app)
    {
        $cName = $app->get('controller');
        $fName = $app->get('function');

        $controller = 'App\psol\report_calendar\controllers\\'. $cName;
        if(!class_exists($controller))
        {
            $app->raiseError('Invalid controller '. $cName);
        }

        $controller = new $controller($app->getContainer());
        $controller->{$fName}();

        $app->set('theme', $app->cf('adminTheme'));

        $fName = 'to'. ucfirst($app->get('format', 'html'));

        $app->finalize(
            $controller->{$fName}()
        );
    }
}