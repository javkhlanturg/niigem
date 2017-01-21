<?php

namespace TCG\Voyager\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use TCG\Voyager\Voyager;
use Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class VoyagerMediaController extends Controller
{
    /** @var string */
    private $filesystem;

    /** @var string */
    private $directory = DIRECTORY_SEPARATOR.'media';

    public function index()
    {
        Voyager::can('browse_media');

        return view('voyager::media.index');
    }

    public function files(Request $request)
    {
        $dir = $request->input('folder');

        return response()->json([
            'name'          => 'files',
            'type'          => 'folder',
            'path'          => $dir,
            'items'         => $this->getFiles($dir),
            'last_modified' => 'asdf',
        ]);
    }

    private function getFiles($dir)
    {
        $fullPath = str_finish(public_path().$this->directory.$dir, DIRECTORY_SEPARATOR);
        $files = [];
        $_files = array_diff(scandir($fullPath), array('.', '..'));
        if(sizeof($_files) > 0){
          foreach ($_files as $file) {
            if(file_exists($fullPath.$file) and mime_content_type($fullPath.$file) !== 'directory'){
              $files[] = [
                  'name'          => strpos($file, '/') > 1 ? str_replace('/', '', strrchr($file, '/')) : $file,
                  'type'          => mime_content_type($fullPath.$file),
                  'path'          => str_finish($this->directory.$dir, DIRECTORY_SEPARATOR).$file,
                  'size'          => filesize($fullPath.$file),
                  'last_modified' => date("Y.m.d H:i:s.",filemtime($fullPath.$file)),
              ];
            }
          }

          foreach ($_files as $folder) {
            if(file_exists($fullPath.$file) and mime_content_type($fullPath.$folder) === 'directory'){
              $files[] = [
                  'name'          => strpos($folder, '/') > 1 ? str_replace('/', '', strrchr($folder, '/')) : $folder,
                  'type'          => 'folder',
                  'items'         => '',
                  'last_modified' => date("Y.m.d H:i:s.",filemtime($fullPath.$folder)),
              ];
            }
          }
        }

        return $files;
    }

    // New Folder with 5.3

    public function new_folder(Request $request)
    {
        $new_folder = str_finish(public_path().$this->directory, DIRECTORY_SEPARATOR).$request->new_folder ;
        $success = false;
        $error = '';

        if (!is_dir( $new_folder) ) {
            mkdir( $new_folder, 0755, true);
            $success = true;
        }else{
            $error = 'Хавтас үүссэн байна.';
        }

        return compact('success', 'error');
    }

    // Delete File or Folder with 5.3

    public function delete_file_folder(Request $request)
    {

        $folderLocation = $request->folder_location;
        $fileFolder = $request->file_folder;
        $type = $request->type;
        $success = true;
        $error = '';

        if (is_array($folderLocation)) {
            $folderLocation = rtrim(implode('/', $folderLocation), '/');
        }
        $location = str_finish($this->directory .DIRECTORY_SEPARATOR. $folderLocation, DIRECTORY_SEPARATOR);
        $fileFolder = public_path().$location.$fileFolder;
        if ($type == 'folder') {
            if(!is_dir( $fileFolder )){
              $error = $request->file_folder.' нэртэй хавтас үүсээгүй байна';
              $success = false;
            }else{
                $this->rrmdir($fileFolder);
            }
        } elseif (!unlink($fileFolder)) {
            $error = 'Sorry something seems to have gone wrong deleting this file, please check your permissions';
            $success = false;
        }

        return compact('success', 'error');
    }

    public function rrmdir($dir) {
       if (is_dir($dir)) {
         $objects = scandir($dir);
         foreach ($objects as $object) {
           if ($object !== "." && $object !== "..") {
              if (is_dir($dir."/".$object)){
                $this->rrmdir($dir."/".$object);
              }else{unlink($dir."/".$object);}
           }
         }
         reset($objects);
         rmdir($dir);
       }
     }

    // GET ALL DIRECTORIES Working with Laravel 5.3

    public function get_all_dirs(Request $request)
    {
        $folderLocation = $request->folder_location;

        if (is_array($folderLocation)) {
            $folderLocation = rtrim(implode('/', $folderLocation), '/');
        }

        $location = "{$this->directory}/{$folderLocation}";

        return response()->json(
            str_replace($location, '', Storage::directories($location))
        );
    }

    // NEEDS TESTING

    public function move_file(Request $request)
    {
        $source = $request->source;
        $destination = $request->destination;
        $folderLocation = $request->folder_location;
        $success = false;
        $error = '';

        if (is_array($folderLocation)) {
            $folderLocation = rtrim(implode('/', $folderLocation), '/');
        }

        $location = "{$this->directory}/{$folderLocation}";
        $source = "{$location}/{$source}";
        $destination = strpos($destination, '/../') !== false
            ? $this->directory.'/'.dirname($folderLocation).'/'.str_replace('/../', '', $destination)
            : "{$location}/{$destination}";

        if (!file_exists($destination)) {
            if (Storage::move($source, $destination)) {
                $success = true;
            } else {
                $error = 'Sorry there seems to be a problem moving that file/folder, please make sure you have the correct permissions.';
            }
        } else {
            $error = 'Sorry there is already a file/folder with that existing name in that folder.';
        }

        return compact('success', 'error');
    }

    // RENAME FILE WORKING with 5.3

    public function rename_file(Request $request)
    {
        $folderLocation = $request->folder_location;
        $filename = $request->filename;
        $newFilename = $request->new_filename;
        $success = false;
        $error = false;

        if (is_array($folderLocation)) {
            $folderLocation = rtrim(implode('/', $folderLocation), '/');
        }

        $location = "{$this->directory}/{$folderLocation}";

        if (!Storage::exists("{$location}/{$newFilename}")) {
            if (Storage::move("{$location}/{$filename}", "{$location}/{$newFilename}")) {
                $success = true;
            } else {
                $error = 'Sorry there seems to be a problem moving that file/folder, please make sure you have the correct permissions.';
            }
        } else {
            $error = 'File or Folder may already exist with that name. Please choose another name or delete the other file.';
        }

        return compact('success', 'error');
    }

    // Upload Working with 5.3

    public function upload(Request $request)
    {
        try {
            $mimes = 'mimes:JPG,PNG,GIF,JPEG,png,gif,jpeg,jpg|max:80000';
            $file = $request->file('file');
            $rules = ['file' => $mimes];
            $validator = Validator::make( $request->all(), $rules );
            $path = "";
            if ($validator->passes()) {
              $path = $this->uploadImage($file,  $request->upload_path);
            }else{
              $avarta =$request->file;
              $file_name = $avarta->getClientOriginalName();
              $avarta->move(public_path() .$this->directory.$request->upload_path, $file_name);
            }
            $success = true;
            $message = 'Файл хадгалагдлаа!';
        } catch ( Exception $e ) {
            $success = false;
            $message = $e->getMessage();
        }

        $path = preg_replace('/^public\//', '', $path);

        return response()->json( compact('success', 'message', 'path') );
    }

    public function uploadImage($file, $path)
    {
          $filename = Str::random(20).'.'.$file->getClientOriginalExtension();
          $watermark = public_path()."/assets/images/watermark.png";
          $fullPath = str_finish($path, "/").$filename;
          $resize_width = 800;
          $resize_height = null;
          $uploadSuccess = Image::make($file);
          $bigImage = $uploadSuccess->resize($resize_width, $resize_height, function ($constraint) {
              $constraint->aspectRatio();
          })->encode($file->getClientOriginalExtension(), 75);
          $bigImage->insert($watermark, 'bottom-right', null, null, 220, 80);
          $bigImage->save( str_finish( public_path().$this->directory.$path, '/').$filename, 100 );

          //-------------- thumb image -------------
          $thumb_image = $uploadSuccess->resize(200, null, function ($constraint) {
              $constraint->aspectRatio();
          })->encode($file->getClientOriginalExtension(), 75);
          //$image->save($destinationPath . $fileUniqueName, 100);
          //          Storage::put($path."/"."thumb-".$filename.'.'.$file->getClientOriginalExtension(), (string) $t_image, 'public');
          $thumb_image->save( str_finish( public_path() .$this->directory.$path, '/')."thumb-".$filename, 100 );
          //----------------------------------------
          return $fullPath;
      }
}
