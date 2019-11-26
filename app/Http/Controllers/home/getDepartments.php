
<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class getDepartments extends Controller
{
public function getDepartments(&$collection, $parentId = '0', &$item = null, $name = 'children')
    {
        $tree = [];
        foreach ($collection as $key => $value) {
            if ($value['parent_id'] == $parentId) {
                self::shiftCollection($collection, $value, $key);
                if ($item) $item[$name][] = $value;
                else $tree[] = $value;
            }
        };
     
        return $tree;
    }
}