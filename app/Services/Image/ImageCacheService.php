<?php

namespace App\Services\Image;


use Illuminate\Support\Facades\Config;
use Intervention\Image\Facades\Image;

class ImageCacheService{
    public function cache($imagePath,$size='')
    {
        $imageSizes=Config::get('image.cache-image-sizes');
        if (!isset($imageSizes[$size])){
            $size=Config::get('image.default-current-cache-image');
        }
        $width=$imageSizes[$size]['width'];
        $height=$imageSizes[$size]['height'];

        if (file_exists($imagePath)){
            $img=Image::cache(function ($image)use ($imagePath,$width,$height){
                return $image->make($imagePath)->fit($width,$height);
            },Config::get('image.image-cache-life-time'),true);
            return$img->response();
        }else{
            $img=Image::canvas($width,$height,'#cdcdcd')->text('image not found - 404',$width/2,$height/2,function ($font){
                $font->color('#333333');
                $font->align('center');
                $font->valign('center');
                $font->file(public_path('admin-assets/fonts/IRANSans/IRANSansWeb.woff'));
                $font->size(24);
            });

            return $img->response();
        }

    }
}
