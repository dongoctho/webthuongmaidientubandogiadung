<?php

namespace App\Services;

class ImageService
{
    // xử lý hình ảnh
    public function image($image)
    {
        $file = $image;
        $ext = $image->extension();
        $file_name = time().'-'.'product.'.$ext;
        $file->move(public_path('uploads'), $file_name);

        return $file_name;
    }

}
