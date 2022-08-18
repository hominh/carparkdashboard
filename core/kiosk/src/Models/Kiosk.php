<?php

namespace Carparkdashboard\Kiosk\Models;
use Carparkdashboard\Basement\Models\Basement;

use Illuminate\Database\Eloquent\Model;


class Kiosk extends Model
{

    public $timestamps = false;
    const LIMIT = 10;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'kiosks';

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
        'x1',
        'y1',
        'x2',
        'y2'
    ];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    /*public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_categories');
    }*/
    public function basement()
    {
        return $this->belongsToMany(Basement::class,'basement_kiosk');
    }
}