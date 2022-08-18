<?php

namespace Carparkdashboard\Lot\Models;


use Illuminate\Database\Eloquent\Model;

class LotCamera extends Model
{
    public $timestamps = false;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'lot_camera';
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
        'camera_id',
        'lot_id',
    ];



    /*protected static function boot()
    {
        parent::boot();

        self::deleting(function (Category $category) {
            $category->posts()->detach();
        });
    }*/
}
