<?php

namespace Carparkdashboard\Lot\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;
use Carparkdashboard\Camera\Repositories\Camera\CameraRepositoryInterface;
use Carparkdashboard\Sensor\Repositories\Sensor\SensorRepositoryInterface;
use Carparkdashboard\Lot\Repositories\Lot\LotRepositoryInterface;
use Carparkdashboard\Lot\Repositories\LotCamera\LotCameraRepositoryInterface;
use Carparkdashboard\Basement\Repositories\Basement\BasementRepositoryInterface;
use Carparkdashboard\Kiosk\Repositories\Kiosk\KioskRepositoryInterface;
use Carparkdashboard\Lot\DataTables\LotDataTable;
use App\Http\Controllers\Controller;
use Response;
use Illuminate\Support\Facades\Cache;
use DB;
use Carparkdashboard\Lot\Models\Lot;

class StatusController extends Controller
{
    protected $lots_old = 0;
	protected $camera;
	protected $lot;
	protected $lotcamera;
	protected $sensor;
    protected $basement;
	public function __construct(CameraRepositoryInterface $camera,LotRepositoryInterface $lot,LotCameraRepositoryInterface $lotcamera,SensorRepositoryInterface $sensor, BasementRepositoryInterface $basement, KioskRepositoryInterface $kiosk)
    {
        $this->camera = $camera;
        $this->lot = $lot;
        $this->lotcamera = $lotcamera;
        $this->sensor = $sensor;
        $this->basement = $basement;
        $this->kiosk = $kiosk;
    }

    public function index()
    {
    	/**$value = Cache::rememberForever('lots_cached', function () {
    		$data = $this->lot->getAll();
		    return $data;
		});*/
		//echo $value."<br />";
		//$data2 = Cache::get('lots_cached');
		//dd($data2);
        $basements = $this->basement->getAll();
    	$lots = $this->lot->getAll();
    	$sensors = $this->sensor->getAll();
    	return view('carparkdashboard-lot::status.index',compact('lots','sensors','basements'));
    }

    public function settings()
    {
        $basements = $this->basement->getAll();
    	$lots = $this->lot->getAll();
    	return view('carparkdashboard-lot::status.settings',compact('lots','basements'));
    }

    public function settingPath()
    {
        $basements = $this->basement->getAll();
    	$lots = $this->lot->getAll();
        $kiosks = $this->lot->getAll();
    	return view('carparkdashboard-lot::status.settings-path',compact('lots','basements','kiosks'));
    }
    
    public function initData($basement)
    {
        $lots = $this->lot->tracking($basement);
        $lots["countEnableLot"] = $this->lot->countLot($basement,0);
        return Response::json($lots);
    }

    public function getData($basement)
    {
        $result = array();
        $lots = $this->lot->tracking($basement);

        for($i = 0; $i < count($lots); $i++)
        {
            if($lots[$i]->is_change == 1)
            {
                $result[$i] = $lots[$i];
                $this->update_isChange($lots[$i]->id,2);
            }
        }
        $result["countEnableLot"] = $this->lot->countLot($basement, 0);
        return Response::json($result);
    }

    public function update_isChange($id,$is_change)
    {
        $result = DB::table('lots')
            ->where('id', $id)->update(['is_change' => $is_change]);
        return $result;
    }

    public function getLotByPlate(Request $request)
    {
    	$lot = $this->lot->getLotByPlate($request["plate"]);
        return Response::json($lot);
    }
}