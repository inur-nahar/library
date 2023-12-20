<?php

namespace App\Http\Controllers;

use App\Exceptions\Helpers\SlugGenerator;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use SlugGenerator;

public function index(){
    $categories = Category::paginate(25);
    return view('backend.category.list', compact('categories'));
}



public function store(Request $request){


    $request->validate([
        'name'=> 'required|string|max:255'
        ]);



    $category = new Category();
    $category->name =$request->name;
    $category->slug = $this->slug_generator($request->name, Category::class);
    $category->save();
    toast('Your Category has been created!','success');

return back();
}

public function edit($id){
    $categories = Category::paginate(25);
    $editdata = Category::findOrFail($id, ['id','name']);

    return view('backend.category.list', compact('categories','editdata'));
}

public function update(Request $request, $id){
    $request->validate([
        'name'=> 'required|string|max:255'
        ]);
        $category_slug = str($request->name)->slug();
        $slug_count = Category::where('slug','LIKE','%'.$category_slug.'%')->count();
       if($slug_count>0){
        $category_slug .= '-'. $slug_count+1;

       }

    $category = Category::find($id);
    $category->name =$request->name;
    $category->slug = $category_slug;
    $category->save();
    toast('Your Category Updated Successfully!','success');
return back();
}
public function delete($id){
    $category_count = Category::count();
if($category_count > 1) {
    $category = Category::find($id);
    $category->delete();
    return back();

}
return back();


}
// public function change_status(Request $request){
//     $post = Category::find($request->category_id);
//     if($category->status){
//        $category->status = false;

//     }else{
//         $category->status = true;

//     }
//     $category->save();
//  }

public function change_status(Request $request){
    $category = Category::find($request-> category_id);
    if($category->status){
        $category->status = false;
    }else{
        $category->status = true;
    }
 $category->save();

}
}
