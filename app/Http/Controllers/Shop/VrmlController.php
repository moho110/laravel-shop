<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\ArticleCats;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class VrmlController extends Controller{

    public function index()
    {
        $articlecats = DB::table('article_cats')
                        ->select('id','catName');
        

         return view("articles/vrml")
         ->with("articlecats",$articlecats);
    }

    public function test() 
    {
        $hello   = "测试方法";
        $welcome = "欢迎您到虚拟现实工作室";
        
        return view("articles/test")
        ->with("hello",$hello)
        ->with("welcome",$welcome);
    }
}

?>