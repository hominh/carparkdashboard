<?php

namespace Carparkdashboard\Lot\Repositories\Lot;

use Carparkdashboard\Lot\Models\Lot;
use DB;

class LotRepository implements LotRepositoryInterface
{

    const LIMIT = 10;
    public function getAll()
    {
    	return Lot::orderBy('status')->with('camera')->with('sensor')->with('basement')->get();
    }

    public function countLot($basement,$status)
    {
        $query = "SELECT COUNT(*) FROM lots a LEFT JOIN  lot_basement b ON a.id = b.lot_id WHERE b.basement_id = ? AND a.status = ?";
        $result = DB::select($query,[$basement,$status]);
        return $result;
    }

    public function tracking($basement)
    {
        //return Lot::orderBy('status')->with(["basement" => function($q) use($basement){$q->where('basement_id','=',$basement);}])->with('camera')->with('sensor')->where('status','!=',2)->where('status','!=',3)->get();
        $query = "SELECT a.name,a.status,a.id,a.x1_web,a.y1_web,a.x2_web,a.y2_web,a.x3_web,a.y3_web,a.x4_web,a.y4_web, a.plate,a.is_change FROM lots a LEFT JOIN  lot_basement b ON a.id = b.lot_id WHERE b.basement_id = ? AND a.status != 20 AND a.status != 3";
        $lot = DB::select($query,[$basement]);
        return $lot;
    }

    public function getAllWithUser()
    {
        return Lot::orderBy('id')->with('createdBy')->get();
    }

    public function getAllAtFrontEnd($type)
    {
        return Lot::where('status','published')->where('type',$type)->with('children')->get();
    }

    public function paginateWithUser($limit)
    {
        return Lot::with('createdBy')->paginate($limit);
    }

    public function findById($id)
    {
    	return Lot::with('camera')->with('sensor')->with('basement')->find($id);
    }

    public function getCategoryBySlug($slug)
    {
        $lot = Lot::where('slug',$slug)->with('createdBy')->get();
        return $lot;
    }

    public function getLotByPlate($plate)
    {
        //$arr_str_plate = str_split($plate);
        //$plate = "%".$plate."%";
        $query = "SELECT a.id, a.x1_path,a.y1_path,a.x2_path,a.y2_path,b.plate,b.status,b.id as lot_id, a.kiosk_id as kiosk_id";
        $query.= " FROM lot_paths a LEFT JOIN lots b ON a.lot_id = b.id ";
        //$query.= " LEFT JOIN lot_basement c ON b.id = c.lot_id LEFT JOIN basements d ON c.basement_id = d.id ";
        $query.= " WHERE b.plate LIKE '%".$plate."%'";

        /*for($i = 0; $i < count($arr_str_plate); $i++)
        {
            if($i == 0) $query.= "  WHERE b.plate LIKE '%".$arr_str_plate[0]."%'";
            if($i > 0) $query.= "  AND b.plate LIKE '%".$arr_str_plate[$i]."%'";

        }*/
        //$lot = Lot::where('plate',$plate)->where('name','!=','test')->with('camera')->get();
        $lot = DB::select(DB::raw($query));
        for($i = 0; $i < count($lot); $i++)
        {
            $queryGetBasement = "SELECT a.* FROM basements a  JOIN lot_basement b ON a.id = b.basement_id WHERE b.lot_id = ?";
            $basements = DB::select($queryGetBasement,[$lot[$i]->lot_id]);
            $queryGetKiosk = "SELECT * FROM kiosks WHERE id = ?";
            $kiosks = DB::select($queryGetKiosk,[$lot[$i]->kiosk_id]);
            for($j = 0; $j < count($basements); $j++)
            {
                $lot[$i]->basement_id = $basements[$j]->id;
                $lot[$i]->basement_name = $basements[$j]->name;
                $lot[$i]->basement_image = $basements[$j]->image;
            }
            for($k = 0; $k < count($kiosks); $k++)
            {
                $lot[$i]->kiosk_name = $kiosks[$k]->name;
            }
        }
        return $lot;
    }

    public function getLotBySlug($slug)
    {
        $lot = Lot::where('slug',$slug)->with('createdBy')->get();
        return $lot;
    }
    public function create($attributes)
    {
         return Lot::create($attributes);
    }
    public function update($id, array $attributes)
    {
        $result = Lot::find($id);
        if($result)
        {
            $result->update($attributes);
            return $result;
        }
        return fasle;
    }

    public function updatePath($id, $x1_path,$y1_path)
    {
        $resetPath  = DB::update('update lots set x1_path = ?, y1_path = ? where id = ?',["","",$id]);
        //$clearValue = DB::update('update lots set x1_path = ?, y1_path = ? where id = ?',["","",$id]);
        $result = DB::update('update lots set x1_path = x1_path + ?, y1_path = y1_path + ? where id = ?',[$x1_path,$y1_path,$id]);
        return $result;
    }
    public function updatePath2($id, $x2_path,$y2_path)
    {
        $resetPath  = DB::update('update lots set x2_path = ?, y2_path = ? where id = ?',["","",$id]);
        //$clearValue = DB::update('update lots set x1_path = ?, y1_path = ? where id = ?',["","",$id]);
        $result = DB::update('update lots set x2_path = x2_path + ?, y2_path = y2_path + ? where id = ?',[$x2_path,$y2_path,$id]);
        return $result;
    }

    public function delete($id)
    {
        $result = Lot::find($id);
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

    public function getMaxId()
    {
        $result = Lot::where('id','>=', 0)->max('id');
        return $result;
    }

    public function getPathFromBasement($basement)
    {
        $query = "SELECT a.x1_path,a.y1_path,a.x2_path,a.y2_path,d.x1,d.y1,d.x2,d.y2";
        $query.= " FROM lot_paths a LEFT JOIN lots b ON a.lot_id = b.id ";
        $query.= " LEFT JOIN lot_basement C ON b.id = c.lot_id";
        $query.= " LEFT JOIN kiosks d ON a.kiosk_id = d.id";
        $query.= " WHERE c.basement_id = ?";
        $result = DB::select($query,[$basement]);
        return $result;
    }

    public function findLotByCoordinate($basement,$x,$y)
    {
        $arr_result = array();
        $query = "SELECT lots.name as lotname,x1_web,y1_web,x2_web,y2_web,x3_web,y3_web,x4_web,y4_web,lots.image,plate,lots.overlap_calc,lots.updated_at,status,basements.name as basment_name ";
        $query.= "FROM lots LEFT JOIN lot_basement ON lots.id = lot_basement.lot_id ";
        $query.= " LEFT JOIN basements ON lot_basement.basement_id = basements.id ";
        $query.= " WHERE basements.id = ".$basement."";
        $result = DB::select(DB::raw($query));
        for($i = 0; $i < count($result); $i++)
        {
            if($this->checkPointInsideRectangle($result[$i]->x1_web,$result[$i]->y1_web,$result[$i]->x3_web,$result[$i]->y3_web,$x,$y))
                array_push($arr_result,$result[$i]);
        }
       return $arr_result;
    }

    public function checkPointInsideRectangle($x1, $y1, $x2, $y2, $x, $y)
    {
        if ($x > $x1 and $x < $x2 and $y > $y1 and $y < $y2)
            return true;
        return false;
    }
}

?>
