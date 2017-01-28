<?php

namespace TCG\Voyager\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Constraint;
use Intervention\Image\Facades\Image;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getSlug(Request $request)
    {
        if (isset($this->slug)) {
            $slug = $this->slug;
        } else {
            $slug = explode('.', $request->route()->getName())[1];
        }

        return $slug;
    }

    public function insertUpdateData($request, $slug, $rows, $data)
    {
        $rules = [];
        $messages = [];

        foreach ($rows as $row) {
            $options = json_decode($row->details);
            if (isset($options->validation)) {
                if (isset($options->validation->rule)) {
                    $rules[$row->field] = $options->validation->rule;
                }
                if (isset($options->validation->messages)) {
                    foreach ($options->validation->messages as $key => $msg) {
                        $messages[$row->field.'.'.$key] = $msg;
                    }
                }
            }

            $content = $this->getContentBasedOnType($request, $slug, $row);
            if ($content === null) {
                if (isset($data->{$row->field})) {
                    $content = $data->{$row->field};
                }
                if ($row->field == 'password') {
                    $content = $data->{$row->field};
                }
            }
            if ($row->type == 'select_multiple') {
                // do nothing
            } else {
                $data->{$row->field} = $content;
            }
        }

        $this->validate($request, $rules, $messages);

        $data->save();

        if ($row->type == 'select_multiple') {
            $data->{$row->field}()->sync($content);
        }

        return $data;
    }

    public function getContentBasedOnType(Request $request, $slug, $row)
    {
        $content = null;
        switch ($row->type) {
            /********** PASSWORD TYPE **********/
            case 'password':
                $pass_field = $request->input($row->field);

                if (isset($pass_field) && !empty($pass_field)) {
                    return bcrypt($request->input($row->field));
                }
                break;

            /********** CHECKBOX TYPE **********/
            case 'checkbox':
                $checkBoxRow = $request->input($row->field);

                if (isset($checkBoxRow)) {
                    return 1;
                }

                $content = 0;
                break;
            case 'select_dropdown':
                    $checkBoxRow = $request->input($row->field);
                    $content = $checkBoxRow;
                    break;

            /********** FILE TYPE **********/
            case 'file':
                if ($file = $request->file($row->field)) {
                    $filename = Str::random(20);
                    $path = $slug.'/'.date('F').date('Y').'/';
                    $fullPath = $path.$filename.'.'.$file->getClientOriginalExtension();

                    Storage::put(config('voyager.storage.subfolder').$fullPath, (string) $file, 'public');

                    return $fullPath;
                }
            // no break

            /********** SELECT MULTIPLE TYPE **********/
            case 'select_multiple':
                $content = $request->input($row->field);
                if ($content === null) {
                    $content = [];
                }

                return $content;

            /********** IMAGE TYPE **********/
            case 'image':
                if ($request->hasFile($row->field)) {
                    $file = $request->file($row->field);
                    $filename = Str::random(20);

                    $path = str_finish(DIRECTORY_SEPARATOR."media".DIRECTORY_SEPARATOR.$slug.DIRECTORY_SEPARATOR.date('F').date('Y'), '/');
                    $fullPath = $path.$filename.'.'.$file->getClientOriginalExtension();

                    if (!is_dir(public_path().$path)) {
                        mkdir(public_path().$path, 0755, true);
                    }

                    $options = json_decode($row->details);
                    if (isset($options->resize) && isset($options->resize->width) && isset($options->resize->height)) {
                        $resize_width = $options->resize->width;
                        $resize_height = $options->resize->height;
                    } else {
                        $resize_width = Image::make($file)->width();
                        $resize_height = null;
                    }
                    $image = Image::make($file)->resize($resize_width, $resize_height,
                        function (Constraint $constraint) {
                            $constraint->aspectRatio();
                            $constraint->upsize();
                        })->encode($file->getClientOriginalExtension(), 75);
                    $image->save(public_path().$fullPath, 100);
                    //Storage::put(config('voyager.storage.subfolder').$fullPath, (string) $image, 'public');

                    if (isset($options->thumbnails)) {
                        foreach ($options->thumbnails as $thumbnails) {
                          $image = null;
                            if (isset($thumbnails->name) && isset($thumbnails->scale)) {
                                $scale = intval($thumbnails->scale) / 100;
                                $thumb_resize_width = $resize_width;
                                $thumb_resize_height = $resize_height;
                                if ($thumb_resize_width != 'null') {
                                    $thumb_resize_width = $thumb_resize_width * $scale;
                                }
                                if ($thumb_resize_height != 'null') {
                                    $thumb_resize_height = $thumb_resize_height * $scale;
                                }
                                $image = Image::make($file)->resize($thumb_resize_width, $thumb_resize_height,
                                    function (Constraint $constraint) {
                                        $constraint->aspectRatio();
                                        $constraint->upsize();
                                    })->encode($file->getClientOriginalExtension(), 75);
                            } elseif (isset($options->thumbnails) && isset($thumbnails->crop->width) && isset($thumbnails->crop->height)) {
                                $crop_width = $thumbnails->crop->width;
                                $crop_height = $thumbnails->crop->height;
                                $image = Image::make($file)->fit($crop_width,
                                    $crop_height)->encode($file->getClientOriginalExtension(), 75);
                            }
                            $image->save(public_path().$path.$filename.'-'.$thumbnails->name.'.'.$file->getClientOriginalExtension(), 100);
                        }
                    }

                    return $fullPath;
                }
                break;

            /********** ALL OTHER TEXT TYPE **********/
            default:
                return $request->input($row->field);
            // no break
        }

        return $content;
    }

    public function uploadPhoto(Request $request)
    {
        $base_folder = 'uploaded';
        $destination_folder = 'zar';
        $thumb_folder = 'thumb';

        $mimes = 'mimes:JPG,PNG,GIF,JPEG,png,gif,jpeg,jpg|max:80000';
        $watermark = 'images/watermark.png';
        $file = Request::file('file');
        $rules = ['file' => $mimes];
        $validator = Validator::make(Request::all(), $rules);

        if ($validator->passes()) {
            $destinationPath = public_path() . DIRECTORY_SEPARATOR . $base_folder . DIRECTORY_SEPARATOR . $destination_folder . DIRECTORY_SEPARATOR;
            $thumbPath = $destinationPath . $thumb_folder . DIRECTORY_SEPARATOR;
            if (!is_dir($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            if (!is_dir($thumbPath)) {
                mkdir($thumbPath, 0755, true);
            }

            $destinationUrl = "/" . $base_folder . "/" . $destination_folder . '/';
            $thumbUrl = $destinationUrl . $thumb_folder . '/';

            $fileOrigName = $file->getClientOriginalName();
            $fileUniqueName = date("YmdHis") . "_" . str_random(25) . '.' . $file->getClientOriginalExtension();
            while (File::exists($destinationPath . $fileUniqueName)) {
                $fileUniqueName = uniqid() . "_" . $fileUniqueName;
            }

            $uploadSuccess = Image::make($file->getRealPath());
            $bigImage = $uploadSuccess->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $bigImage->insert($watermark, 'bottom-right', null, null, 220, 80);
            $bigImage->save($destinationPath . $fileUniqueName, 100);
            $thumb_image = $uploadSuccess->resize(250, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $thumb_image->save($thumbPath . $fileUniqueName);
            $result = [
                'destinationUrl' => $destinationUrl,
                'thumbUrl' => $thumbUrl,
                'origName' => $fileOrigName,
                'uniqueName' => $fileUniqueName
            ];

            if ($uploadSuccess) {
                return Response::json(['status' => true, 'data' => $result], 200);
            } else {
                return Response::json(['status' => false, 'flash' => 'Үйлдэл амжилтгүй боллоо'], 400);
            }
        } else {
            return Response::json(['status' => false, 'flash' => 'Үйлдэл амжилтгүй боллоо. Файлын төрөл, хэмжээг шалгана уу!!'], 400);
        }
    }

    public function generate_views(Request $request)
    {
        //$dataType = DataType::where('slug', '=', $slug)->first();
    }

    public function deleteFileIfExists($path)
    {
        if (Storage::exists($path)) {
            Storage::delete($path);
        }
    }
}
