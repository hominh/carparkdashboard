<?php

namespace Carparkdashboard\Basement\Models;


use Illuminate\Database\Eloquent\Model;

class BasementKiosk extends Model
{
    public $timestamps = false;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'basement_kiosk';
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
        'basement_id',
    ];
}
