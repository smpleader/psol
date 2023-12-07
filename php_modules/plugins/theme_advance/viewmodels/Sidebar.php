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

class Sidebar extends ViewModel
{
    public static function register()
    {
        return [
            'widget'=>'sidebar'
        ];
    }

    public function sidebar()
    {
        $menu_tmp = [];
        $this->app->plgLoad('advance', 'registerSidebar', function($res) use (&$menu_tmp){
            if (is_array($res) && $res)
            {
                $order = 1;
                if (isset($res['order']))
                {
                    $order = $res['order'];
                    unset($res['order']);
                }

                foreach($res as $key => $item)
                {
                    $menu_tmp[$order] = array_merge($menu_tmp[$order] ?? [], $res[$key]);
                }
            }
        });
        
        ksort($menu_tmp);

        $sidebar = [];
        foreach($menu_tmp as $item)
        {
            $sidebar = array_merge($sidebar, $item);
        }

        return [
            'sidebar' => $sidebar,
        ];
    }
}
