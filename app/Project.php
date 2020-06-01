<?php

namespace App;

use App\Traits\Filtering;
use App\Traits\Imaging;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes, Filtering, Imaging;

     /**
     * Project table.
     *
     * @var string
     */
    protected $table = 'projects';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'name', 'description', 'role', 'live_link', 'github_link', 'image'
    ];

     /**
     * Run functions on boot.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->user_id = auth('api')->user()->id;
            static::storeImage($model);
        });

        static::updating(function ($model) {
            $model->user_id = auth('api')->user()->id;
            static::updateImage($model);
        });

        static::deleting(function ($model) {
            static::deleteImage($model);
        });
    }

     /**
     * The projects belongs to a user.
     *
     * @return object
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

