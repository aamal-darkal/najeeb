<?php
namespace App\Traits ;

trait ImageTrait {

    public function uploadImage($file,$path)
    {
        $filename = date('YmdHi') . $file->getClientOriginalName();
        $file->move(public_path($path), $filename);

        return $filename;
    }
}
