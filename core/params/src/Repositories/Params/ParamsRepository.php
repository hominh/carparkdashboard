<?php

namespace Carparkdashboard\Params\Repositories\Params;

use Carparkdashboard\Params\Models\Params;
use DB;

class ParamsRepository implements ParamsRepositoryInterface
{

    const LIMIT = 10;
    public function getAll()
    {
    	return Params::all();
    }

    public function findByName($name)
    {
    	return Params::where('name','=',$name)->get();
    }

    public function update($param_name,$value)
    {
    	$result = DB::table('params')
            ->where('name', $param_name)->update(['value' => $value]);
        return $result;
    }
}

?>
