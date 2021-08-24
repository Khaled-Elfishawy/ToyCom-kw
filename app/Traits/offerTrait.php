<?php

namespace App\Traits;

Trait OfferTrait{


    function saveImage($photo , $folder){

        $file_extension = $photo->getClientOriginalExtension();
        $file_name = time().'.'.$file_extension;
        $photo ->move(public_path($folder) , $file_name);

        return  $file_name ;
     }
}
