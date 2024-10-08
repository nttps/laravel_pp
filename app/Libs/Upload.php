<?php

namespace NttpDev\Libs;


use Intervention\Image\Facades\Image;
use File;

class Upload
{
    public function uploadFiles($name, $setname = null, $path = null, $is_thumbnail = false, $category = false)
    {

        $filename = '';
        $path = $this->setPath($path, $is_thumbnail);

        if (request()->hasFile($name)) {
            $imga = request()->file($name);
            $filename = isset($setname) ? $setname . '.' . $imga->getClientOriginalExtension() : str_slug(pathinfo($imga->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $imga->getClientOriginalExtension();

            //$imga->save(public_path('storage/'.$path) , $filename);
            if (!file_exists(public_path('storage/' . $path . '/'))) {
                File::makeDirectory(public_path('storage/' . $path . '/'), $mode = 0777, true, true);
            }
            $thumbnailImage = Image::make($imga);
            $thumbnailImage->backup();

            if ($category != true) {
                $thumbnailImage->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
            }

            $thumbnailImage->save(public_path('storage/' . $path . '/') . $filename);
            $thumbnailImage->resizeCanvas(1200, 1200, 'center', true, 'ffffff');
            //$thumbnailImage->resizeCanvas(1280, 630, 'center', true, 'ffffff');
            if (!file_exists(public_path('storage/' . $path . '/thumbnail_facebook/'))) {
                File::makeDirectory(public_path('storage/' . $path . '/thumbnail_facebook/'), $mode = 0777, true, true);
            }
            $thumbnailImage->save(public_path('storage/' . $path . '/thumbnail_facebook/') . $filename);
            $thumbnailImage->reset();
            if ($is_thumbnail) {
                $thumbnailImage->resize(250, 230);
                //$thumbnailImage->resizeCanvas(300, 300, 'center', false, 'ffffff');
                if (!file_exists(public_path('storage/' . $path . '/thumbnail/'))) {
                    File::makeDirectory(public_path('storage/' . $path . '/thumbnail/'), $mode = 0777, true, true);
                }
                $thumbnailImage->save(public_path('storage/' . $path . '/thumbnail/') . $filename);
            }
            $filename = $path . '/' . $filename;
        }
        return $filename;
    }
    private function setPath($path = null, $is_thumbnail)
    {

        $year   = date('Y');
        $month  = date('m');
        $date   = date('d');

        return $path . '/' . $year . '/' . $month . '/' . $date;
    }
}
