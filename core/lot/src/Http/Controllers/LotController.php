<?php

namespace Carparkdashboard\Lot\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;
use Carparkdashboard\Camera\Repositories\Camera\CameraRepositoryInterface;
use Carparkdashboard\Sensor\Repositories\Sensor\SensorRepositoryInterface;
use Carparkdashboard\Lot\Repositories\Lot\LotRepositoryInterface;
use Carparkdashboard\Basement\Repositories\Basement\BasementRepositoryInterface;
use Carparkdashboard\Lot\Repositories\LotCamera\LotCameraRepositoryInterface;
use Carparkdashboard\Lot\Repositories\LotSensor\LotSensorRepositoryInterface;
use Carparkdashboard\Lot\Repositories\LotBasement\LotBasementRepositoryInterface;
use Carparkdashboard\Lot\Repositories\LotPaths\LotPathsRepositoryInterface;
use Carparkdashboard\Lot\DataTables\LotDataTable;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Cache;
use Response;

class LotController extends Controller
{
	protected $camera;
	protected $lot;
	protected $lotcamera;
    protected $sensor;
    protected $lotsensor;
    protected $basement;
    protected $lotbasement;
    protected $lotpaths;
	public function __construct(CameraRepositoryInterface $camera,LotRepositoryInterface $lot,LotCameraRepositoryInterface $lotcamera,SensorRepositoryInterface $sensor,LotSensorRepositoryInterface $lotsensor, BasementRepositoryInterface $basement, LotBasementRepositoryInterface $lotbasement, LotPathsRepositoryInterface $lotpaths)
    {
        //$this->middleware('auth');
        $this->camera = $camera;
        $this->lot = $lot;
        $this->lotcamera = $lotcamera;
        $this->sensor = $sensor;
        $this->lotsensor = $lotsensor;
        $this->basement = $basement;
        $this->lotbasement = $lotbasement;
        $this->lotpaths = $lotpaths;
    }

	/**
	* @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	*/
	public function index(LotDataTable $dataTable)
	{
		return $dataTable->render('carparkdashboard-lot::lot.index');
	}

	public function create() {
		$cameras = $this->camera->getAll();
        $sensors = $this->sensor->getAll();
        $basements = $this->basement->getAll();
    	return view('carparkdashboard-lot::lot.create',compact('cameras','sensors','basements'));
    }
    public function store(Request $request)
    {
        /*$permission = $this->authorize('create',Category::class);*/
        $validatedData = $request->validate([
            'name' => 'required',
            'x1' => 'required|integer',
            'y1' => 'required|integer',
            'x2' => 'required|integer',
            'y2' => 'required|integer',
        ]);
       
        /*$author_id = Auth::user()->id;
        $request->request->add(['author_id' => $author_id]);*/
        $request->request->add(['status' => 2]);
        $attributes = $request->all();
        $lot_id = $this->lot->create($attributes)->id;
        if($lot_id > 0)
        {
        	$camera_id = $attributes['camera'];
        	if($camera_id > 0)
        	{
        		$attributes_lot_camera['lot_id'] = $lot_id;
        		$attributes_lot_camera['camera_id'] = $camera_id;
        		$lot_camera_id = $this->lotcamera->create($attributes_lot_camera);
        	}
            $sensor_id = $attributes['sensor'];
            if($sensor_id > 0)
            {
                $attributes_lot_sensor['lot_id'] = $lot_id;
                $attributes_lot_sensor['sensor_id'] = $sensor_id;
                $lot_sensor_id = $this->lotsensor->create($attributes_lot_sensor);
            }
        }
        if($lot_id > 0)
            $notification = array(
                'message' => 'Create lot success',
                'alert-type' => 'success'
            );
        else
            $notification = array(
                'message' => 'Create lot unsuccess',
                'alert-type' => 'warning'
            );
        return redirect()->route('lot')->with($notification);
    }
    public function edit($id)
    {
        $lot = $this->lot->findById($id);
        $cameras = $this->camera->getAll();
        $sensors = $this->sensor->getAll();
        $basements = $this->basement->getAll();
        //$permission = $this->authorize('view', $category);
        if($lot == null)
            return view('carparkdashboard-lot::error.404');
        else
            return view('carparkdashboard-lot::lot.edit',compact('lot','cameras','sensors','basements'));
    }

    public function update(Request $request, $id)
    {
        $lot = $this->lot->findById($id);
        //$permission = $this->authorize('update',$category);
        $validatedData = $request->validate([
            'name' => 'required',
            'x1' => 'required|integer',
            'y1' => 'required|integer',
            'x2' => 'required|integer',
            'y2' => 'required|integer'
        ]);

        $data = $request->all();
        $basement = $data['basement'];
        $attributes_lot_camera['lot_id'] = $id;
        $attributes_lot_camera['camera_id'] = $data['camera'];
        $attributes_lot_sensor['lot_id'] = $id;
        $attributes_lot_sensor['sensor_id'] = $data['sensor'];
        $attributes_lot_basement['basement_id'] = $basement;
        $attributes_lot_basement['lot_id'] = $id;
        $lot = $this->lot->update($id,$data);
        $lotcamera = $this->lotcamera->update($id,$data['camera']);
        $lotsensor = $this->lotsensor->update($id,$data['sensor']);

        $checkLotBasement = $this->lotbasement->checkExist($id);
        if($checkLotBasement == 0)
            $lotbasement = $this->lotbasement->create($attributes_lot_basement);
        if($checkLotBasement > 0)
            $lotbasement = $this->lotbasement->update($id,$basement);
            

        $notification = array(
            'message' => 'Update lot success',
            'alert-type' => 'success'
        );
        
        return redirect()->route('lot')->with($notification);
    }

    public function updateSettings(Request $request,$id)
    {
        $lot = $this->lot->findById($id);
        $validatedData = $request->validate([
            'x1_web' => 'required|integer',
            'y1_web' => 'required|integer',
            'x2_web' => 'required|integer',
            'y2_web' => 'required|integer',
            'x3_web' => 'required|integer',
            'y3_web' => 'required|integer',
            'x4_web' => 'required|integer',
            'y4_web' => 'required|integer'
        ]);
        $data = $request->all();
        $lot = $this->lot->update($id,$data);
        return $lot->id;
    }

    public function updateSettingPath(Request $request,$lot_id,$kiosk_id)
    {
        $validatedData = $request->validate([
            'x1_path' => 'required',
            'y1_path' => 'required',
        ]);

        $data = $request->all();

        $x1_path = $data["x1_path"]."-";
        $y1_path = $data["y1_path"]."-";
        $x2_path = $data["x2_path"]."-";
        $y2_path = $data["y2_path"]."-";
        $kiosk_id = $data["kiosk_id"];
        $lot_id = $data["lot_id"];
        $countLotPath = $this->lotpaths->checkExist($kiosk_id,$lot_id);
        if($countLotPath == 0)
        {
            $lotpath = $this->lotpaths->create($data);
            echo Response::json($lotpath->id);
        }
        if($countLotPath > 0)
        {
            $lotpath = $this->lotpaths->update($kiosk_id,$lot_id,$x1_path,$y1_path,$x2_path,$y2_path);
            echo Response::json($lotpath);
        }
    }

    public function getPathFromBasement($basement)
    {
        $path = $this->lot->getPathFromBasement($basement);
        echo json_encode($path);
    }

    public function findLotByCoordinate(Request $request)
    {
        $x = $request->x;
        $y = $request->y;
        $basement = $request->basement;

        $lot = $this->lot->findLotByCoordinate($basement,$x,$y);
        echo json_encode($lot);
    }

}