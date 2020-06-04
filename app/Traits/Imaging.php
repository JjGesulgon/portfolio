<?php

/*
|--------------------------------------------------------------------------
| Auto Upload, Delete and Resizing of Images
|--------------------------------------------------------------------------
|
|
*/

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

trait Imaging
{
    /**
     * Get storage path for images, photos or pictures.
     *
     * @return string
     */
    public static function storagePath()
    {
        return 'images';
    }

    /**
     * Get compression rate.
     *
     * @return int
     */
    public static function compressionRate()
    {
        return 70;
    }

    /**
     * Check whether to auto resize the image, photo or picture.
     *
     * @return true
     */
    public static function auteResize()
    {
        return true;
    }

    /**
     * Default resolution.
     *
     * @return string
     */
    public static function defaultResolution()
    {
        return '766';
    }

    /**
     * portrait resolution.
     *
     * @return string
     */
    public static function portraitResolution()
    {
        return '1366';
    }

    /**
     * default 16:9 ratio resolutions.
     *
     * @return array
     */
    public static function resolutions()
    {
        return [
            '766' => [
                'width'  => 1366,
                'height' => 766
            ],
            '900' => [
                'width'  => 1600,
                'height' => 900
            ],
            '1080' => [
                'width'  => 1920,
                'height' => 1080
            ],
            '1440' => [
                'width'  => 2560,
                'height' => 1440
            ],
            '2160' => [
                'width'  => 3840,
                'height' => 2160
            ],
            '1366' => [
                'width'  => 766,
                'height' => 1366
            ],
        ];
    }

    /**
     * If directory doesn't exist create directory.
     *
     * @return void
     */
    public static function createDirectory()
    {
        Storage::makeDirectory('public/' . self::storagePath(), 0775, true);
    }

    /**
     * Check if file exists.
     *
     * @param  string $imageName Image file name.
     * @return boolean
     */
    public static function checkIfImageExist($imageName)
    {
        $storagePath = self::storagePath();
        return Storage::exists('public/' . $storagePath . '/' . $imageName);
    }

    /**
     * Create sizes and store image, photo or picture automatically.
     *
     * @param  Illuminate\Database\Eloquent\Model $model
     * @param  array $sizes
     * @return void
     */
     public static function storeImage($model, $sizes = null)
    {
        if (request()->hasFile('image') || request()->hasFile('picture') || request()->hasFile('photo')) {
            self::createDirectory();

            $storagePath       = self::storagePath();
            $resolutions       = self::resolutions();
            $defaultResolution = self::defaultResolution();
            $compressionRate   = self::compressionRate();

            $image        = $model->image;
            $imageName    = uniqid() . '.jpg';
            $model->image = $imageName;

            if ($sizes != null && is_array($sizes)) {
                foreach ($sizes as $size) {
                    foreach ($resolutions as $key => $value) {
                        if ($defaultResolution != $size && $key == $size) {
                            Image::make($image)->resize($value['width'], $value['height'])
                            ->encode('jpg', $compressionRate)
                            ->save(
                                storage_path('app/public/' . $storagePath . '/' . $value['width'] . '-' . $value['height'] . '-' . $imageName),
                                $compressionRate
                            );
                        }
                    }
                }
            }

            $image = Image::make($image);
            if(!isset($model->is_compress) && !$model->is_compress){
                $image = $image->resize(
                    $resolutions[$defaultResolution]['width'],
                    $resolutions[$defaultResolution]['height']
                );
            }
            $image = $image->encode('jpg', $compressionRate)->save(
                storage_path('app/public/' . $storagePath . '/' . $imageName),
                $compressionRate
            );
        }
    }

    /**
     * Create sizes and store image, photo or picture automatically.
     *
     * @param  Illuminate\Database\Eloquent\Model $model
     * @param  array $sizes
     * @return void
     */
    public static function storeImageWithoutCompression($model, $sizes = null)
    {
        if (request()->hasFile('image') || request()->hasFile('picture') || request()->hasFile('photo')) {
            self::createDirectory();

            $storagePath       = self::storagePath();
            $resolutions       = self::resolutions();
            $defaultResolution = self::portraitResolution();
            $compressionRate   = self::compressionRate();

            $image        = $model->image;
            $imageName    = uniqid() . '.jpg';
            $model->image = $imageName;

            if ($sizes != null && is_array($sizes)) {
                foreach ($sizes as $size) {
                    foreach ($resolutions as $key => $value) {
                        if ($defaultResolution != $size && $key == $size) {
                            Image::make($image)->resize($value['width'], $value['height'])
                            ->encode('jpg', $compressionRate)
                            ->save(
                                storage_path('app/public/' . $storagePath . '/' . $value['width'] . '-' . $value['height'] . '-' . $imageName),
                                $compressionRate
                            );
                        }
                    }
                }
            }

            $image = Image::make($image);
            // if(!isset($model->is_compress) && !$model->is_compress){
            //     $image = $image->resize(
            //         $resolutions[$defaultResolution]['width'],
            //         $resolutions[$defaultResolution]['height']
            //         // $resolutions[$defaultResolution]['width'],
            //         // $resolutions[$defaultResolution]['height']
            //     );
            // }
            $image = $image;
            $image = $image->encode('jpg', $compressionRate)->save(
                storage_path('app/public/' . $storagePath . '/' . $imageName),
                $compressionRate
            );
        }
    }

    /**
     * Create sizes and store image, photo or picture automatically.
     *
     * @param  Illuminate\Database\Eloquent\Model $model
     * @param  array $sizes
     * @return void
     */
    public static function storeLocationImage($model, $sizes = null)
    {
        if (request()->hasFile('image') || request()->hasFile('picture') || request()->hasFile('photo')) {
            self::createDirectory();

            $storagePath       = self::storagePath();
            $resolutions       = self::resolutions();
            $defaultResolution = self::defaultResolution();
            $compressionRate   = self::compressionRate();

            $image        = $model->location;
            $imageName    = uniqid() . '.jpg';
            $model->location = $imageName;

            if ($sizes != null && is_array($sizes)) {
                foreach ($sizes as $size) {
                    foreach ($resolutions as $key => $value) {
                        if ($defaultResolution != $size && $key == $size) {
                            Image::make($image)->resize($value['width'], $value['height'])
                            ->encode('jpg', $compressionRate)
                            ->save(
                                storage_path('app/public/' . $storagePath . '/' . $value['width'] . '-' . $value['height'] . '-' . $imageName),
                                $compressionRate
                            );
                        }
                    }
                }
            }

            $image = Image::make($image);
            if(!isset($model->is_compress) && !$model->is_compress){
                $image = $image->resize(
                    $resolutions[$defaultResolution]['width'],
                    $resolutions[$defaultResolution]['height']
                );
            }
            $image = $image->encode('jpg', $compressionRate)->save(
                storage_path('app/public/' . $storagePath . '/' . $imageName),
                $compressionRate
            );
        }
    }

    /**
     * Create sizes and store image, photo or picture automatically.
     *
     * @param  Illuminate\Database\Eloquent\Model $model
     * @param  array $sizes
     * @return void
     */
    public static function storeImagePng($model, $sizes = null)
    {
        if (request()->hasFile('image') || request()->hasFile('picture') || request()->hasFile('photo')) {
            self::createDirectory();

            $storagePath       = self::storagePath();
            $resolutions       = self::resolutions();
            $defaultResolution = self::defaultResolution();
            $compressionRate   = self::compressionRate();

            $image        = $model->image;
            $imageName    = uniqid() . '.png';
            $model->image = $imageName;

            if ($sizes != null && is_array($sizes)) {
                foreach ($sizes as $size) {
                    foreach ($resolutions as $key => $value) {
                        if ($defaultResolution != $size && $key == $size) {
                            Image::make($image)->resize($value['width'], $value['height'])
                            ->encode('png', $compressionRate)
                            ->save(
                                storage_path('app/public/' . $storagePath . '/' . $value['width'] . '-' . $value['height'] . '-' . $imageName),
                                $compressionRate
                            );
                        }
                    }
                }
            }

            $image = Image::make($image);
            if(!isset($model->is_compress) && !$model->is_compress){
                $image = $image->resize(
                    $resolutions[$defaultResolution]['width'],
                    $resolutions[$defaultResolution]['height']
                );
            }
            $image = $image->encode('png', $compressionRate)->save(
                storage_path('app/public/' . $storagePath . '/' . $imageName),
                $compressionRate
            );
        }
    }

    /**
     * Delete image including sizes.
     *
     * @param  Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public static function deleteImage($model)
    {
        if ($model->image != null || $model->picture != null || $model->photo != null) {
            $storagePath = self::storagePath();
            $resolutions = self::resolutions();

            foreach ($resolutions as $key => $value) {
                $image = $value['width'] . '-' . $value['height'] . '-' . $model->image;
                if (self::checkIfImageExist($image)) {
                    Storage::delete('public/' . $storagePath . '/' . $image);
                }
            }

            if (self::checkIfImageExist($image)) {
                Storage::delete('public/' . $storagePath . '/' . $model->image);
            }
        }
    }

    /**
     * Update image including sizes.
     *
     * @param  Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public static function updateImage($model)
    {
        if ($model->image != null || $model->picture != null || $model->photo != null) {
            self::deleteImage($model->findorFail($model->id));
            self::storeImage($model);
        }
    }

    /**
     * Update image including sizes.
     *
     * @param  Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public static function updateLocationImage($model)
    {
        if ($model->location != null || $model->picture != null || $model->photo != null) {
            self::deleteImage($model->findorFail($model->id));
            self::storeLocationImage($model);
        }
    }

    /**
     * Update image including sizes.
     *
     * @param  Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public static function updateImageWithoutCompression($model)
    {
        if ($model->location != null || $model->picture != null || $model->photo != null) {
            self::deleteImage($model->findorFail($model->id));
            self::storeImageWithoutCompression($model);
        }
    }

    /**
     * Update image including sizes.
     *
     * @param  Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public static function updateImagePng($model)
    {
        if ($model->image != null || $model->picture != null || $model->photo != null) {
            self::deleteImage($model->findorFail($model->id));
            self::storeImagePng($model);
        }
    }
}
