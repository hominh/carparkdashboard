<?php

namespace Carparkdashboard\Params\Http\Controllers;

use App\Http\Controllers\Controller;
use Carparkdashboard\Params\Repositories\Params\ParamsRepositoryInterface;

class ParamsController extends Controller
{
	protected $params;

	public function __construct(ParamsRepositoryInterface $params)
	{
		$this->params = $params;
	}

	public function getDataByParamname()
	{
		$result = $this->params->findByName('STATUS_DEVICE');
		if(count($result) > 0)
			return $result[0]["value"];
		else
			return -1;
	}
}