<?php

namespace App\Jobs;

use App\Services\Image\ImageService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class uploadImageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    public $image;
    public $width;
    public $height;

    /**
     * Create a new job instance.
     */
    public function __construct($image,$width,$height)
    {
        $this->image=$image;
        $this->width=$width;
        $this->height=$height;
    }

    /**
     * Execute the job.
     */
    public function handle():void
    {
        if (!empty($this->image)) {
            $imageService = new ImageService();
            $imageService->setExclusiveDirectory('products');
            $result = $imageService->fitAndSave($this->image, $this->width, $this->height);
        }
    }
}
