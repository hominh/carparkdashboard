<?php

namespace Carparkdashboard\Lot\Repositories\LotPaths;

use Carparkdashboard\Lot\Models\LotPaths;
use DB;

class LotPathsRepository implements LotPathsRepositoryInterface
{

    
    public function findByKios($lot_id)
    {
        return LotPaths::find($id);
    }
    public function findByLot($lot_id)
    {
        return LotPaths::find($id);
    }

    public function create($attributes)
    {
         return LotPaths::create($attributes);
    }

    public function reset($kiosk_id,$lot_id)
    {
        LotPaths::where('kiosk_id',$kiosk_id)->where('kiosk_id',$kiosk_id)->update(['x1_path' => '0','y1_path' => '0', 'x2_path' => '0','y2_path' => '0']);
    }

    public function update($kiosk_id,$lot_id,$x1_path,$y1_path,$x2_path,$y2_path)
    {
        $resetPath  = DB::update('update lot_paths set x1_path = ?, y1_path = ?, x2_path = ?, y2_path = ? where kiosk_id = ? AND lot_id = ?',["","","","",$kiosk_id,$lot_id]);
        $result = DB::update('update lot_paths set x1_path = ?, y1_path =  ?, x2_path = ?, y2_path = ? where kiosk_id = ? AND lot_id = ?',[$x1_path,$y1_path,$x2_path,$y2_path,$kiosk_id,$lot_id]);
        return $result;
    }

    public function checkExist($kiosk_id,$lot_id)
    {
        $lot_path = LotPaths::where('lot_id',$lot_id)->where('kiosk_id',$kiosk_id)->get();
        return count($lot_path);
    }
}

?>
