<?php

namespace Carparkdashboard\Camera\Repositories\Camera;

use Carparkdashboard\Camera\Models\Camera;

class CameraRepository implements CameraRepositoryInterface
{

    const LIMIT = 10;
    public function getAll()
    {
    	return Camera::all();
    }

    public function findById($id)
    {
    	return Camera::find($id);
    }

    public function create($attributes)
    {
         return Camera::create($attributes);
    }
    public function update($id, array $attributes)
    {
        $result = Camera::find($id);
        if($result)
        {
            $result->update($attributes);
            return $result;
        }
        return fasle;
    }

    public function delete($id)
    {
        $result = Camera::find($id);
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

    public function getCameraByName($name)
    {
        return Camera::where('name',$name)->get();
    }
}

?>
