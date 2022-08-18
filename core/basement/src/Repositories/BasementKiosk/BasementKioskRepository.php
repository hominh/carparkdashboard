<?php

namespace Carparkdashboard\Basement\Repositories\BasementKiosk;

use Carparkdashboard\Basement\Models\BasementKiosk;

class BasementKioskRepository implements BasementKioskRepositoryInterface
{

    public function getAll()
    {
        return BasementKiosk::all();
    }

    public function findById($id)
    {
        return BasementKiosk::find($id);
    }

    public function create($attributes)
    {
         return BasementKiosk::create($attributes);
    }

    public function update($kiosk_id,$basement_id)
    {
        BasementKiosk::where('kiosk_id',$kiosk_id)->update(['basement_id' => $basement_id]);
    }
}

?>
