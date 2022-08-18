<?php

namespace Carparkdashboard\Sensor\Repositories\Sensor;

use Carparkdashboard\Sensor\Models\Sensor;

class SensorRepository implements SensorRepositoryInterface
{

    const LIMIT = 10;
    public function getAll()
    {
    	return Sensor::all();
    }

    public function getAllWithUser()
    {
        return Sensor::orderBy('id')->with('createdBy')->get();
    }

    public function getAllAtFrontEnd($type)
    {
        return Sensor::where('status','published')->where('type',$type)->with('children')->get();
    }

    public function paginateWithUser($limit)
    {
        return Sensor::with('createdBy')->paginate($limit);
    }

    public function findById($id)
    {
    	return Sensor::find($id);
    }

    public function getCategoryBySlug($slug)
    {
        $sensor = Sensor::where('slug',$slug)->with('createdBy')->get();
        return $sensor;
    }


    public function getSensorBySlug($slug)
    {
        $sensor = Sensor::where('slug',$slug)->with('createdBy')->get();
        return $sensor;
    }
    public function create($attributes)
    {
         return Sensor::create($attributes);
    }
    public function update($id, array $attributes)
    {
        $result = Sensor::find($id);
        if($result)
        {
            $result->update($attributes);
            return $result;
        }
        return fasle;
    }

    public function delete($id)
    {
        $result = Sensor::find($id);
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
        {
            $result = $this->delete($arr_id[$i]);
        }
        return $result;
    }

    public function getSensorByName($name)
    {
        return Sensor::where('name',$name)->get();
    }
}

?>
