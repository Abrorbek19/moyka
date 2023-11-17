<?php

namespace App\Http\Controllers;

use App\Models\Carusel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;

class CaruselController extends VoyagerBaseController
{
    public function pageView(Request $request,$slug)
    {
        $carusel = Carusel::findBySlug($slug);

        if ($carusel == null){
            return view('template.index');
        }

        return view('template.index',compact('carusel',));
    }
}
