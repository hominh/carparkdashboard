<?php

namespace Carparkdashboard\Kiosk\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Validator;
use Carparkdashboard\Kiosk\DataTables\KioskDataTable;
use Carparkdashboard\Basement\Repositories\Basement\BasementRepositoryInterface;
use Carparkdashboard\Kiosk\Repositories\Kiosk\KioskRepositoryInterface;
use Carparkdashboard\Basement\Repositories\BasementKiosk\BasementKioskRepositoryInterface;
use Carparkdashboard\Kiosk\Models\Kiosk;


class KioskController extends Controller
{
    protected $kiosk;
    protected $basement;
    protected $basementkiosk;
	public function __construct(KioskRepositoryInterface $kiosk, BasementRepositoryInterface $basement, BasementKioskRepositoryInterface $basementkiosk)
    {
        //$this->middleware('auth');
        $this->kiosk = $kiosk;
        $this->basement = $basement;
        $this->basementkiosk = $basementkiosk;
    }

	/**
	* @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	*/
	public function index(KioskDataTable $dataTable)
	{
		return $dataTable->render('carparkdashboard-kiosk::kiosk.index');
	}
	public function create() {
        $basements = $this->basement->getAll();
    	return view('carparkdashboard-kiosk::kiosk.create',compact('basements'));
    }

    public function store(Request $request)
    {
        /*$permission = $this->authorize('create',Category::class);*/
        $validatedData = $request->validate([
            'name' => 'required|unique:kiosks',
        ]);

        /*$author_id = Auth::user()->id;
        $request->request->add(['author_id' => $author_id]);*/
        $attributes = $request->all();
        $kiosk_id = $this->kiosk->create($attributes)->id;
        if($kiosk_id > 0)
        {
            $basement_id = $attributes['basement'];
            if($basement_id > 0)
            {
                $attributes_basment_kiosk['basement_id'] = $basement_id;
                $attributes_basment_kiosk['kiosk_id'] = $kiosk_id;
                $basement_kiosk_id = $this->basementkiosk->create($attributes_basment_kiosk);
            }
        }
        if($kiosk_id > 0)
            $notification = array(
                'message' => 'Create kiosk success',
                'alert-type' => 'success'
            );
        else
            $notification = array(
                'message' => 'Create kiosk unsuccess',
                'alert-type' => 'warning'
            );
        return redirect()->route('kiosk')->with($notification);
    }

    public function edit($id)
    {
        $kiosk = $this->kiosk->findById($id);
        $basements = $this->basement->getAll();
        //$permission = $this->authorize('view', $category);
        if($kiosk == null)
            return view('carparkdashboard-kiosk::error.404');
        else
            return view('carparkdashboard-kiosk::kiosk.edit',compact('kiosk','basements'));
    }

    public function update(Request $request, $id)
    {
        $kiosk = $this->kiosk->findById($id);
        //$permission = $this->authorize('update',$category);
        $validatedData = $request->validate([
            'name' => 'required',
        ]);

        $data = $request->all();
        $basement_id = $data['basement'];
        $kiosk = $this->kiosk->update($id,$data);
        $basementkiosk_update = $this->basementkiosk->update($id,$basement_id);
        $notification = array(
            'message' => 'Update kiosk success',
            'alert-type' => 'success'
        );
        return redirect()->route('kiosk')->with($notification);
    }

    public function destroy($id)
    {
        $kiosk = $this->kiosk->findById($id);
        //$permission = $this->authorize('delete', $category);
        $result = $this->kiosk->delete($id);
        if($result == "true")
            $notification = array(
                'message' => 'Delete kiosk success',
                'alert-type' => 'success'
            );
        else
            $notification = array(
                'message' => 'Delete kiosk unsuccess',
                'alert-type' => 'warning'
            );
        return redirect()->route('kiosk')->with($notification);
    }

    public function destroyMultiRecords(Request $request)
    {
        //$permission = $this->authorize('multiDelete',Category::class);
        $ids = $request->ids;
        $result = $this->kiosk->deleteMultiRecords($ids);

        if($result == "true")
            return response()->json(['status'=>'success','message'=>"Kiosk deleted successfully."]);
        else
            return response()->json(['status'=>'error','message'=>"Kiosk deleted unsuccessfully."]);
    }

    public function settings()
    {
        $basements = $this->basement->getAll();
        return view('carparkdashboard-kiosk::kiosk.settings',compact('basements'));
    }

    public function updateSettings(Request $request,$id)
    {
        $kiosk = $this->kiosk->findById($id);
        $validatedData = $request->validate([
            'x1' => 'required|integer',
            'y1' => 'required|integer',
            'x2' => 'required|integer',
            'y2' => 'required|integer'
        ]);
        $data = $request->all();
        $kiosk_update = $this->kiosk->update($id,$data);
        return $kiosk_update->id;
    }

}