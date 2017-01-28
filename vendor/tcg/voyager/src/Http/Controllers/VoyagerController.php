<?php

namespace TCG\Voyager\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Constraint;
use Intervention\Image\Facades\Image;
use TCG\Voyager\Voyager;

class VoyagerController extends Controller
{
    public function index()
    {
        return view('voyager::index');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('voyager.logout');
    }

    public function upload(Request $request)
    {
        $fullFilename = null;
        $resizeWidth = 1800;
        $resizeHeight = null;
        $slug = $request->input('type_slug');
        $file = $request->file('image');
        $filename = Str::random(20);
        $path = str_finish(DIRECTORY_SEPARATOR."media".DIRECTORY_SEPARATOR.$slug.DIRECTORY_SEPARATOR.date('F').date('Y'), '/');
        $fullPath = $path.$filename.'.'.$file->getClientOriginalExtension();
        if (!is_dir(public_path().$path)) {
            mkdir(public_path().$path, 0755, true);
        }
        $ext = $file->guessClientExtension();

        if (in_array($ext, ['jpeg', 'jpg', 'png', 'gif'])) {
          $image = Image::make($file)->resize($resizeWidth, $resizeHeight,
              function (Constraint $constraint) {
                  $constraint->aspectRatio();
                  $constraint->upsize();
              })->encode($file->getClientOriginalExtension(), 75);
          $image->save(public_path().$fullPath, 100);

            // move uploaded file from temp to uploads directory
                $status = 'Зураг амжилттай хуулагдлаа!';
                $fullFilename = $fullPath;
        } else {
            $status = "Upload Fail: Зургийн төрөл 'jpeg', 'jpg', 'png', 'gif' байх боломжтой";
        }

        // echo out script that TinyMCE can handE:\react\niigem\niigem\vendor\tcg\voyager\src\Http\Controllers\VoyagerController.phple and update the image in the editor
        return "<script> parent.setImageValue('".$fullFilename."'); </script>";
    }

    public function profile()
    {
        return view('voyager::profile');
    }
}
