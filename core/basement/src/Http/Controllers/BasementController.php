<?php

namespace Carparkdashboard\Basement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Validator;
use Carparkdashboard\Basement\DataTables\BasementDataTable;
use Carparkdashboard\Basement\Repositories\Basement\BasementRepositoryInterface;
use Carparkdashboard\Basement\Models\Basement;


class BasementController extends Controller
{
    protected $basement;
	public function __construct(BasementRepositoryInterface $basement)
    {
        //$this->middleware('auth');
        $this->basement = $basement;
    }

	/**
	* @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	*/
	public function index(BasementDataTable $dataTable)
	{
		return $dataTable->render('carparkdashboard-basement::basement.index');
	}
	public function create() {
    	return view('carparkdashboard-basement::basement.create');
    }

    public function store(Request $request)
    {
        /*$permission = $this->authorize('create',Category::class);*/
        $validatedData = $request->validate([
            'name' => 'required|unique:basements',
            'image' => 'required'
        ]);

        /*$author_id = Auth::user()->id;
        $request->request->add(['author_id' => $author_id]);*/
        $attributes = $request->all();
        $basement_id = $this->basement->create($attributes)->id;
        if($basement_id > 0)
            $notification = array(
                'message' => 'Tạo bãi giữ xe thành công',
                'alert-type' => 'success'
            );
        else
            $notification = array(
                'message' => 'Tạo bãi giữ xe thất bại',
                'alert-type' => 'warning'
            );
        return redirect()->route('basement')->with($notification);
    }
    
    public function getDataById(Request $request)
    {
        $data = $request->all();
        $id = $data["basement"];
        $basement = $this->basement->findById($id)->toJson();
        return $basement;
    }

    public function edit($id)
    {
        $basement = $this->basement->findById($id);
        //$permission = $this->authorize('view', $category);
        if($basement == null)
            return view('carparkdashboard-basement::error.404');
        else
            return view('carparkdashboard-basement::basement.edit',compact('basement'));
    }

    public function update(Request $request, $id)
    {
        $basement = $this->basement->findById($id);
        //$permission = $this->authorize('update',$category);
        $validatedData = $request->validate([
            'name' => 'required',
        ]);

        $data = $request->all();
        $basement = $this->basement->update($id,$data);
        $notification = array(
            'message' => 'Cập nhật bãi giữ xe thành công',
            'alert-type' => 'success'
        );
        return redirect()->route('basement')->with($notification);
    }

    public function destroy($id)
    {
        $basement = $this->basement->findById($id);
        //$permission = $this->authorize('delete', $category);
        $result = $this->basement->delete($id);
        if($result == "true")
            $notification = array(
                'message' => 'Xóa bãi giữ xe thành công',
                'alert-type' => 'success'
            );
        else
            $notification = array(
                'message' => 'Xóa bãi giữ xe thất bại',
                'alert-type' => 'warning'
            );
        return redirect()->route('basement')->with($notification);
    }

    public function destroyMultiRecords(Request $request)
    {
        //$permission = $this->authorize('multiDelete',Category::class);
        $ids = $request->ids;
        $result = $this->basement->deleteMultiRecords($ids);

        if($result == "true")
            return response()->json(['status'=>'success','message'=>"Basement deleted successfully."]);
        else
            return response()->json(['status'=>'error','message'=>"Basement deleted unsuccessfully."]);
    }


}