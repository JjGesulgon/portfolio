<?php

namespace App;

use App\Traits\Filtering;
use App\Traits\Imaging;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectImages extends Model
{
    use SoftDeletes, Filtering, Imaging;

     /**
     * Project Images table.
     *
     * @var string
     */
    protected $table = 'project_images';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'project_id', 'image', 'caption'
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

    /**
     * The projects images belongs to a project.
     *
     * @return object
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}

