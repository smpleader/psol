<?php
namespace App\plugins\theme_advance\registers;

use SPT\Application\IApp;
use SPT\Support\Loader;

class Advance
{
    public static function registerSidebar( IApp $app )
    {
        $menu = [
            [
                'title' => 'Menu', 
                'type' => 'popup',
                'target' => 'popupMenu',
                'widget' => 'theme_advance::popupMenu',
                'icon' => '',
            ],
        ];
        
        return [
            'order' => 10,
            'menu' => $menu,
        ];
    }
}