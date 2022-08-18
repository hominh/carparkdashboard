<?php

namespace Carparkdashboard\Camera\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Validator;
use Carparkdashboard\Camera\DataTables\CameraDataTable;
use Carparkdashboard\Camera\Repositories\Camera\CameraRepositoryInterface;
use Carparkdashboard\Camera\Models\Camera;


class CameraController extends Controller
{
    protected $camera;
	public function __construct(CameraRepositoryInterface $camera)
    {
        //$this->middleware('auth');
        $this->camera = $camera;
    }

	/**
	* @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	*/
	public function index(CameraDataTable $dataTable)
	{
		return $dataTable->render('carparkdashboard-camera::camera.index');
	}
	public function create() {
    	return view('carparkdashboard-camera::camera.create');
    }

    public function store(Request $request)
    {
        /*$permission = $this->authorize('create',Category::class);*/
        $validatedData = $request->validate([
            'name' => 'required|unique:cameras',
        ]);

        /*$author_id = Auth::user()->id;
        $request->request->add(['author_id' => $author_id]);*/
        $attributes = $request->all();
        $camera_id = $this->camera->create($attributes)->id;
        if($camera_id > 0)
            $notification = array(
                'message' => 'Create camera success',
                'alert-type' => 'success'
            );
        else
            $notification = array(
                'message' => 'Create camera unsuccess',
                'alert-type' => 'warning'
            );
        return redirect()->route('camera')->with($notification);
    }
    public function createSlug(Request $request)
    {
        $slug = createSlug($request->key);
        return response()->json($slug,200);
    }

    public function edit($id)
    {
        $camera = $this->camera->findById($id);
        //$permission = $this->authorize('view', $category);
        if($camera == null)
            return view('carparkdashboard-camera::error.404');
        else
            return view('carparkdashboard-camera::camera.edit',compact('camera'));
    }

    public function update(Request $request, $id)
    {
        $camera = $this->camera->findById($id);
        //$permission = $this->authorize('update',$category);
        $validatedData = $request->validate([
            'name' => 'required',
        ]);

        $data = $request->all();
        $camera = $this->camera->update($id,$data);
        $notification = array(
            'message' => 'Update camera success',
            'alert-type' => 'success'
        );
        return redirect()->route('camera')->with($notification);
    }

    public function destroy($id)
    {
        $camera = $this->camera->findById($id);
        //$permission = $this->authorize('delete', $category);
        $result = $this->camera->delete($id);
        if($result == "true")
            $notification = array(
                'message' => 'Delete camera success',
                'alert-type' => 'success'
            );
        else
            $notification = array(
                'message' => 'Delete camera unsuccess',
                'alert-type' => 'warning'
            );
        return redirect()->route('camera')->with($notification);
    }

    public function destroyMultiRecords(Request $request)
    {
        //$permission = $this->authorize('multiDelete',Category::class);
        $ids = $request->ids;
        $result = $this->camera->deleteMultiRecords($ids);
        //$resultDeletePostCategories = $this->postCategories->multiDeleteByCategoryId($ids);

        if($result == "true")
            return response()->json(['status'=>'success','message'=>"Camera deleted successfully."]);
        else
            return response()->json(['status'=>'error','message'=>"Camera deleted unsuccessfully."]);
    }


}