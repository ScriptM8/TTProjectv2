<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function update(Request $request)
    {
        $id = $request->id;
        $cat_list = session()->get('category_list');
        for ($i=0; $i < count($cat_list); $i++) { 
            if ($cat_list[$i]['id'] == $id){
                if ($cat_list[$i]['checked'] == false) {
                    $cat_list[$i]['checked'] = true;
                }else{
                    $cat_list[$i]['checked'] = false;
                }
            }
        }
        session()->put('category_list', $cat_list);
        
        return response()->json(200);
    }
}
