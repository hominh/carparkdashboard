<?php

namespace Carparkdashboard\Lot\Repositories\LotBasement;

use Carparkdashboard\Basement\Models\Basement;
use Carparkdashboard\Lot\Models\LotBasement;

class LotBasementRepository implements LotBasementRepositoryInterface
{

    public function getAll()
    {
        return LotBasement::all();
    }

    public function findById($id)
    {
        return LotBasement::find($id);
    }

    public function create($attributes)
    {
         return LotBasement::create($attributes);
    }

    public function update($lot_id,$basement_id)
    {
        LotBasement::where('lot_id',$lot_id)->update(['basement_id' => $basement_id]);
    }

    public function checkExist($lot_id)
    {
        $lot_basement = LotBasement::where('lot_id',$lot_id)->get();
        return count($lot_basement);
    }

}

?>
