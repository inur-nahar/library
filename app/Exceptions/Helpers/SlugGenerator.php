<?php
namespace App\Exceptions\Helpers;

use App\Models\Category;

trait SlugGenerator{
    public function slug_generator(string $string,$model){
        $slug = str()->slug($string);
        $count = $model::where('slug','LIKE','%' . $slug . '%')->count();
        if($count > 0){
            $count += 1;
            $slug = $slug . '-'  . $count;

        }else{
          $slug = $slug;

        }
        return $slug;
    }
}






?>
