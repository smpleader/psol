<?php

/**
 * SPT software - ViewModel
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: A simple View Model
 * 
 */

namespace App\plugins\theme_advance\viewmodels;

use SPT\Web\ViewModel;
use SPT\Web\Gui\Form;

class MenuPopup extends ViewModel
{
    public static function register()
    {
        return [
            'widget'=>'popupMenu'
        ];
    }

    public function popupMenu()
    {
        $menu_root=[];
        $this->app->plgLoad('advance', 'registerMenu', function($menu) use (&$menu_root)
        {
            if (is_array($menu) && $menu)
            {
                $index = $menu[0][0];
                if (!$menu_root || !isset($menu_root[$index]))
                {
                    $menu_root[$index] = [];
                }
                $menu_root[$index] = array_merge($menu_root[$index], $menu);
            }
        });

        ksort($menu_root);
        $menu = [];
        foreach($menu_root as $menu_items)
        {
            $menu = array_merge($menu, $menu_items);
        }

        return [
            'path_current' => $this->router->get('actualPath'),
            'logout_link' => $this->router->url('logout'),
            'link_admin' => $this->router->url(''),
            'menu' => $menu,
        ];
    }
}
