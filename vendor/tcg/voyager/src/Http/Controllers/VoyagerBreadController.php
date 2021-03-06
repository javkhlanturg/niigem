<?php

namespace TCG\Voyager\Http\Controllers;

use Illuminate\Http\Request;
use TCG\Voyager\Models\DataType;
use TCG\Voyager\Voyager;
use App\PostImage;
use App\PostCategories;
class VoyagerBreadController extends Controller
{
    //***************************************
    //               ____
    //              |  _ \
    //              | |_) |
    //              |  _ <
    //              | |_) |
    //              |____/
    //
    //      Browse our Data Type (B)READ
    //
    //****************************************

    public function index(Request $request)
    {
        // GET THE SLUG, ex. 'posts', 'pages', etc.
        $slug = $this->getSlug($request);

        // GET THE DataType based on the slug
        $dataType = DataType::where('slug', '=', $slug)->first();

        // Check permission
        Voyager::can('browse_'.$dataType->name);

        // Next Get the actual content from the MODEL that corresponds to the slug DataType
        $dataTypeContent = (strlen($dataType->model_name) != 0)
            ? call_user_func([$dataType->model_name, 'all'])
            : DB::table($dataType->name)->get(); // If Model doest exist, get data from table name

        $view = 'voyager::bread.browse';

        if (view()->exists("voyager::$slug.browse")) {
            $view = "voyager::$slug.browse";
        }

        return view($view, compact('dataType', 'dataTypeContent'));
    }

    //***************************************
    //                _____
    //               |  __ \
    //               | |__) |
    //               |  _  /
    //               | | \ \
    //               |_|  \_\
    //
    //  Read an item of our Data Type B(R)EAD
    //
    //****************************************

    public function show(Request $request, $id)
    {
        $slug = $this->getSlug($request);

        $dataType = DataType::where('slug', '=', $slug)->first();

        // Check permission
        Voyager::can('read_'.$dataType->name);

        $dataTypeContent = (strlen($dataType->model_name) != 0)
            ? call_user_func([$dataType->model_name, 'findOrFail'], $id)
            : DB::table($dataType->name)->where('id', $id)->first(); // If Model doest exist, get data from table name

        $view = 'voyager::bread.read';

        if (view()->exists("voyager::$slug.read")) {
            $view = "voyager::$slug.read";
        }

        return view($view, compact('dataType', 'dataTypeContent'));
    }

    //***************************************
    //                ______
    //               |  ____|
    //               | |__
    //               |  __|
    //               | |____
    //               |______|
    //
    //  Edit an item of our Data Type BR(E)AD
    //
    //****************************************

    public function edit(Request $request, $id)
    {
        $slug = $this->getSlug($request);

        $dataType = DataType::where('slug', '=', $slug)->first();

        // Check permission
        Voyager::can('edit_'.$dataType->name);

        $dataTypeContent = (strlen($dataType->model_name) != 0)
            ? call_user_func([$dataType->model_name, 'findOrFail'], $id)
            : DB::table($dataType->name)->where('id', $id)->first(); // If Model doest exist, get data from table name

        $view = 'voyager::bread.edit-add';

        if (view()->exists("voyager::$slug.edit-add")) {
            $view = "voyager::$slug.edit-add";
        }

        return view($view, compact('dataType', 'dataTypeContent'));
    }

    // POST BR(E)AD
    public function update(Request $request, $id)
    {
        $slug = $this->getSlug($request);

        $dataType = DataType::where('slug', '=', $slug)->first();

        // Check permission
        Voyager::can('edit_'.$dataType->name);

        $data = call_user_func([$dataType->model_name, 'findOrFail'], $id);
        $this->insertUpdateData($request, $slug, $dataType->editRows, $data);
        if($slug === 'posts'){
          PostImage::where('post_id', $data->id)->delete();
          $this->createSlider($request->input('sliders'), $data->id);

          PostCategories::where('post_id', $data->id)->delete();
          $this->addPostCategories($request->input('cats'), $data->id);
        }
        return redirect()
            ->route("voyager.{$dataType->slug}.index")
            ->with([
                'message'    => "Successfully Updated {$dataType->display_name_singular}",
                'alert-type' => 'success',
            ]);
    }

    //***************************************
    //
    //                   /\
    //                  /  \
    //                 / /\ \
    //                / ____ \
    //               /_/    \_\
    //
    //
    // Add a new item of our Data Type BRE(A)D
    //
    //****************************************

    public function create(Request $request)
    {
        $slug = $this->getSlug($request);

        $dataType = DataType::where('slug', '=', $slug)->first();

        // Check permission
        Voyager::can('add_'.$dataType->name);

        $view = 'voyager::bread.edit-add';

        if (view()->exists("voyager::$slug.edit-add")) {
            $view = "voyager::$slug.edit-add";
        }

        return view($view, compact('dataType'));
    }

    // POST BRE(A)D
    public function store(Request $request)
    {

        $slug = $this->getSlug($request);

        $dataType = DataType::where('slug', '=', $slug)->first();
        // Check permission
        Voyager::can('add_'.$dataType->name);

        if (function_exists('voyager_add_post')) {
            $url = $request->url();
            voyager_add_post($request);
        }

        $data = new $dataType->model_name();

        $this->insertUpdateData($request, $slug, $dataType->addRows, $data);
        if($slug === 'posts'){
              $this->createSlider($request->input('sliders'), $data->id);
              $this->addPostCategories($request->input('cats'), $data->id);
        }
        return redirect()
            ->route("voyager.{$dataType->slug}.index")
            ->with([
                'message'    => "Мэдээ нэмэгдлээ {$dataType->display_name_singular}",
                'alert-type' => 'success',
            ]);
    }

    public function addPostCategories($categories, $postid){
      if(sizeof($categories)>0){
        foreach($categories as $category){
            $post = new PostCategories();
            $post->post_id = $postid;
            $post->cat_id = $category;
            $post->save();
        }
      }
    }

    public function createSlider($sliders, $postid){
      if(sizeof($sliders)>0){
        foreach($sliders as $slider){
          $arr = explode(":::", $slider);
          $path = $arr[0];
          $public_path = $arr[1];
          $file_name = $arr[2];
          $pi = new PostImage();
          $pi->post_id = $postid;
          $pi->path = $path;
          $pi->public_path = $public_path;
          $pi->file_name = $file_name;
          $pi->save();
        }
      }

    }

    //***************************************
    //                _____
    //               |  __ \
    //               | |  | |
    //               | |  | |
    //               | |__| |
    //               |_____/
    //
    //         Delete an item BREA(D)
    //
    //****************************************

    public function destroy(Request $request, $id)
    {
        $slug = $this->getSlug($request);

        $dataType = DataType::where('slug', '=', $slug)->first();

        // Check permission
        Voyager::can('delete_'.$dataType->name);

        $data = call_user_func([$dataType->model_name, 'findOrFail'], $id);

        foreach ($dataType->deleteRows as $row) {
            if ($row->type == 'image') {
                $this->deleteFileIfExists('/uploads/'.$data->{$row->field});

                $options = json_decode($row->details);

                if (isset($options->thumbnails)) {
                    foreach ($options->thumbnails as $thumbnail) {
                        $ext = explode('.', $data->{$row->field});
                        $extension = '.'.$ext[count($ext) - 1];

                        $path = str_replace($extension, '', $data->{$row->field});

                        $thumb_name = $thumbnail->name;

                        $this->deleteFileIfExists('/uploads/'.$path.'-'.$thumb_name.$extension);
                    }
                }
            }
        }

        $data = $data->destroy($id)
            ? [
                'message'    => "Successfully Deleted {$dataType->display_name_singular}",
                'alert-type' => 'success',
            ]
            : [
                'message'    => "Sorry it appears there was a problem deleting this {$dataType->display_name_singular}",
                'alert-type' => 'error',
            ];

        return redirect()->route("voyager.{$dataType->slug}.index")->with($data);
    }
}
