<?php

namespace App\Providers;

use Intervention\Image\Image;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\ServiceProvider;

class UploadedFileServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        UploadedFile::macro('resize', function (int $width, int $height) {
            Image::make($this)->resize($width, $height)->limitColors(255)->save();
            return $this->recreate();
        });

        UploadedFile::macro('width', function (int $width) {
            Image::make($this)->resize($width, null, function ($constraint) {
                $constraint->aspectRatio();
            })->limitColors(255)->save();
            return $this->recreate();
        });

        UploadedFile::macro('height', function (int $height) {
            Image::make($this)->resize(null, $height, function ($constraint) {
                $constraint->aspectRatio();
            })->limitColors(255)->save();
            return $this->recreate();
        });

        UploadedFile::macro(
            'recreate',
            function () {
                return new UploadedFile(
                $this->getPathname(),
                $this->getClientOriginalName(),
                $this->getClientMimeType()
            );
            }
        );
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
