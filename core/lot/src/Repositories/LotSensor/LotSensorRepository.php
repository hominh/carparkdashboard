<?php

namespace Carparkdashboard\Lot\Repositories\LotSensor;

use Carparkdashboard\Lot\Models\LotSensor;

class LotSensorRepository implements LotSensorRepositoryInterface
{

    public function getAll()
    {
        return LotSensor::all();
    }

    public function findById($id)
    {
        return LotSensor::find($id);
    }

    public function create($attributes)
    {
         return LotSensor::create($attributes);
    }

    public function update($lot_id,$sensor_id)
    {
        LotSensor::where('lot_id',$lot_id)->update(['sensor_id' => $sensor_id]);
    }

    public function deleteByLotId($lotId)
    {
        $lotSensor = LotSensor::where('lot_id',$lotId);
        if($lotSensor)
        {
            $lotSensor->delete();
            return true;
        }
        return false;
    }

    public function deleteBySensorId($sensorId)
    {
        $lotSensor = LotSensor::where('sensor_id',$sensorId);
        if($lotSensor)
        {
            $lotSensor->delete();
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
