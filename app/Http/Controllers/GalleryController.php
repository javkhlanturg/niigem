<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function galleryAction(Request $request){
      switch ($request->input('action')) {
        case 'upload': return $this->upload($request);
        default:
          # code...
          break;
      }
    }

    public function upload($request){

    }
}
