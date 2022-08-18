<?php

namespace Carparkdashboard\Basement\Repositories\Basement;

use Carparkdashboard\Basement\Models\Basement;

class BasementRepository implements BasementRepositoryInterface
{

    const LIMIT = 10;
    public function getAll()
    {
    	return Basement::all();
    }

    public function findById($id)
    {
    	return Basement::with(['kiosk' => function ($query){
            $query->where('x1','<>','');
        }])->with('lot')->find($id);
    }

    public function create($attributes)
    {
         return Basement::create($attributes);
    }
    public function update($id, array $attributes)
    {
        $result = Basement::find($id);
        if($result)
        {
            $result->update($attributes);
            return $result;
        }
        return fasle;
    }

    public function delete($id)
    {
        $result = Basement::find($id);
        if($result)
        {
            $result->delete();
            return true;
        }
        return false;
    }

    public function deleteMultiRecords($ids)
    {
        $arr_id = explode(",",$ids);
        for($i = 0; $i < count($arr_id); $i++)
            $result = $this->delete($arr_id[$i]);
        return $result;
    }
}

?>
