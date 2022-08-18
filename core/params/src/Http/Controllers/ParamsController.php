<?php

namespace Carparkdashboard\Params\Http\Controllers;

use App\Http\Controllers\Controller;
use Carparkdashboard\Params\Repositories\Params\ParamsRepositoryInterface;
use Illuminate\Http\Request;
use Validator;

class ParamsController extends Controller
{
	protected $params;

	public function __construct(ParamsRepositoryInterface $params)
	{
		$this->params = $params;
	}

	public function index()
	{
		$params =  $this->params->getAll();
		return view('carparkdashboard-params::params.index',compact('params'));
	}

	public function getDataByParamname()
	{
		$result = $this->params->findByName('STATUS_DEVICE');
		if(count($result) > 0)
			return $result[0]["value"];
		else
			return -1;
	}

	public function updateparams(Request $request)
	{
		/*$validatedData = $request->validate([
            'name' => 'required',
            'value' => 'required',
        ]);*/
        $result = 1;
        $arr_result = array();
        $data = $request->all();
        for($i = 0; $i < count($data["arrParamname"]); $i++)
        {
        	$isUpdateSuccess = $this->params->update($data["arrParamname"][$i],$data["arrParamvalue"][$i]);
        	array_push($arr_result,$isUpdateSuccess);
        }
        for($i = 0; $i < count($arr_result); $i++)
        {
        	if($arr_result[$i] != 1)
        		$result = 0;
        }
        echo json_encode($result);
        //dd($data["arrParamname"][0]);
	}
}