<?php

namespace Carparkdashboard\Kiosk\Repositories\Kiosk;

use Carparkdashboard\Kiosk\Models\Kiosk;

class KioskRepository implements KioskRepositoryInterface
{

    const LIMIT = 10;
    public function getAll()
    {
    	return Kiosk::all();
    }

    public function findById($id)
    {
    	return Kiosk::with('basement')->find($id);
    }

    public function create($attributes)
    {
         return Kiosk::create($attributes);
    }
    public function update($id, array $attributes)
    {
        $result = Kiosk::find($id);
        if($result)
        {
            $result->update($attributes);
            return $result;
        }
        return fasle;
    }

    public function delete($id)
    {
        $result = Kiosk::find($id);
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
}

?>
