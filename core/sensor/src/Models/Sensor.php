<?php

namespace Carparkdashboard\Sensor\Models;


use Illuminate\Database\Eloquent\Model;


class Sensor extends Model
{

    public $timestamps = false;
    const LIMIT = 10;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sensors';

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
        'slug'
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
}