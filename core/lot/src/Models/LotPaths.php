<?php

namespace Carparkdashboard\Lot\Models;


use Illuminate\Database\Eloquent\Model;

class LotPaths extends Model
{
    public $timestamps = false;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'lot_paths';
    protected $dates = [
        'updated_at',
    ];

    /**
     * @var string
     */
    protected $primaryKey = 'id';



    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'kiosk_id',
        'lot_id',
        'x1_path',
        'y1_path',
        'x2_path',
        'y2_path'
    ];



    /*protected static function boot()
    {
        parent::boot();

        self::deleting(function (Category $category) {
            $category->posts()->detach();
        });
    }*/
}
