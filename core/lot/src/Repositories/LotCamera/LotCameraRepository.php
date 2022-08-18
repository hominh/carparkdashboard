<?php

namespace Carparkdashboard\Lot\Repositories\LotCamera;

use Carparkdashboard\Lot\Models\LotCamera;

class LotCameraRepository implements LotCameraRepositoryInterface
{

    public function getAll()
    {
        return LotCamera::all();
    }

    public function findById($id)
    {
        return LotCamera::find($id);
    }

    public function create($attributes)
    {
         return LotCamera::create($attributes);
    }

    public function update($lot_id,$camera_id)
    {
        LotCamera::where('lot_id',$lot_id)->update(['camera_id' => $camera_id]);
    }

    public function deleteByLotId($lotId)
    {
        $lotCamera = LotCamera::where('lot_id',$lotId);
        if($lotCamera)
        {
            $lotCamera->delete();
            return true;
        }
        return false;
    }

    public function deleteByCameraId($cameraId)
    {
        $lotCamera = LotCamera::where('camera_id',$cameraId);
        if($lotCamera)
        {
            $lotCamera->delete();
            return true;
        }
        return false;
    }

    public function multiDeleteByLotId($lotId)
    {

        $arr_id = explode(",",$lotId);
        for($i = 0; $i < count($arr_id); $i++)
        {
            $result = $this->deleteByLotId($arr_id[$i]);
        }
        return $result;
    }

}

?>
