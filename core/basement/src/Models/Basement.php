<?php

namespace Carparkdashboard\Basement\Models;


use Illuminate\Database\Eloquent\Model;
use Carparkdashboard\Kiosk\Models\Kiosk;
use Carparkdashboard\Lot\Models\Lot;


class Basement extends Model
{

    public $timestamps = false;
    const LIMIT = 10;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'basements';

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
        'name',
        'image'
    ];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    /*public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_categories');
    }*/

    public function kiosk()
    {
        return $this->belongsToMany(Kiosk::class,'basement_kiosk');
    }
    public function lot()
    {
        return $this->belongsToMany(Lot::class,'lot_basement');
    }
}