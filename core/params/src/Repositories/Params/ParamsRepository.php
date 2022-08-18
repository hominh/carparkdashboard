<?php

namespace Carparkdashboard\Params\Repositories\Params;

use Carparkdashboard\Params\Models\Params;

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
}

?>
