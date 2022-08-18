<?php

namespace Carparkdashboard\Lot\Models;


use Illuminate\Database\Eloquent\Model;
use Carparkdashboard\Camera\Models\Camera;
use Carparkdashboard\Sensor\Models\Sensor;
use Carparkdashboard\Basement\Models\Basement;

class Lot extends Model
{

    public $timestamps = false;
    const LIMIT = 10;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'lots';

    /**
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The date fields for the model.clear
     *
     * @var array
     */
    protected $dates = [
        'updated_at',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'status',
        'x1',
        'y1',
        'x2',
        'y2',
        'plate',
        'x1_web',
        'y1_web',
        'x2_web',
        'y2_web',
        'x3_web',
        'y3_web',
        'x4_web',
        'y4_web',
        'x1_path',
        'y1_path',
        'x2_path',
        'y2_path',
        'id_forS',
        'overlap'
    ];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    /*public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_categories');
    }*/

    public function createdBy()
    {
        return $this->belongsTo('App\User','author_id','id');
    }
    public function camera()
    {
        return $this->belongsToMany(Camera::class, 'lot_camera');
    }
    public function sensor()
    {
        return $this->belongsToMany(Sensor::class, 'lot_sensor');
    }
    public function basement()
    {
        return $this->belongsToMany(Basement::class,'lot_basement');
    }

}