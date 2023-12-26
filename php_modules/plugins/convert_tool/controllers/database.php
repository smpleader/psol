<?php
/**
 * SPT software - homeController
 *
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic controller
 *
 */

namespace App\plugins\convert_tool\controllers;

use SPT\Response;
use SPT\Web\ControllerMVVM;

class database extends ControllerMVVM
{
    public function convert_data_notes()
    {
        $this->ConvertToolModel->convertDataNotes();
        return;
    }
}