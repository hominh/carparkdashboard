<?php

namespace Carparkdashboard\Sensor\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Validator;
use Carparkdashboard\Sensor\DataTables\SensorDataTable;
use Carparkdashboard\Sensor\Repositories\Sensor\SensorRepositoryInterface;
use Carparkdashboard\Sensor\Models\Sensor;


class SensorController extends Controller
{
    protected $sensor;
	public function __construct(SensorRepositoryInterface $sensor)
    {
        //$this->middleware('auth');
        $this->sensor = $sensor;
    }

	/**
	* @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	*/
	public function index(SensorDataTable $dataTable)
	{
		return $dataTable->render('carparkdashboard-sensor::sensor.index');
	}
	public function create() {
    	return view('carparkdashboard-sensor::sensor.create');
    }

    public function store(Request $request)
    {
        /*$permission = $this->authorize('create',Category::class);*/
        $validatedData = $request->validate([
            'name' => 'required|unique:sensors',
        ]);

        /*$author_id = Auth::user()->id;
        $request->request->add(['author_id' => $author_id]);*/
        $attributes = $request->all();
        $sensor_id = $this->sensor->create($attributes)->id;
        if($sensor_id > 0)
            $notification = array(
                'message' => 'Create sensor success',
                'alert-type' => 'success'
            );
        else
            $notification = array(
                'message' => 'Create sensor unsuccess',
                'alert-type' => 'warning'
            );
        return redirect()->route('sensor')->with($notification);
    }
    public function createSlug(Request $request)
    {
        $slug = createSlug($request->key);
        return response()->json($slug,200);
    }

    public function edit($id)
    {
        $sensor = $this->sensor->findById($id);
        //$permission = $this->authorize('view', $category);
        if($sensor == null)
            return view('carparkdashboard-sensor::error.404');
        else
            return view('carparkdashboard-sensor::sensor.edit',compact('sensor'));
    }

    public function update(Request $request, $id)
    {
        $sensor = $this->sensor->findById($id);
        //$permission = $this->authorize('update',$category);
        $validatedData = $request->validate([
            'name' => 'required',
        ]);

        $data = $request->all();
        $sensor = $this->sensor->update($id,$data);
        $notification = array(
            'message' => 'Update sensor success',
            'alert-type' => 'success'
        );
        return redirect()->route('sensor')->with($notification);
    }

    public function destroy($id)
    {
        $sensor = $this->sensor->findById($id);
        //$permission = $this->authorize('delete', $category);
        $result = $this->sensor->delete($id);
        if($result == "true")
            $notification = array(
                'message' => 'Delete sensor success',
                'alert-type' => 'success'
            );
        else
            $notification = array(
                'message' => 'Delete sensor unsuccess',
                'alert-type' => 'warning'
            );
        return redirect()->route('sensor')->with($notification);
    }

    public function destroyMultiRecords(Request $request)
    {
        //$permission = $this->authorize('multiDelete',Category::class);
        $ids = $request->ids;
        $result = $this->sensor->deleteMultiRecords($ids);

        if($result == "true")
            return response()->json(['status'=>'success','message'=>"Sensor deleted successfully."]);
        else
            return response()->json(['status'=>'error','message'=>"Samera deleted unsuccessfully."]);
    }


}