<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Category;
use DB;


class CategoryController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function manageCategory()
    {

        $categories = Category::where('parent_id', '=', 0)->get();
        $allCategories = Category::pluck('title','id', 'parent_id')->all();
        return view('categoryTreeview',compact('categories','allCategories'));
        // $all = Category::all();
        // for ($i=0; $i < count($all); $i++) { 
        // 	//return Category::where('id', '=', $all[$i]->parent_id)->get();
        // 	echo $all[]->parent_id;
        // }
        
        //
        // $view = Category::all();
        // foreach ($view as $parents) {
        // 	$all = Category::where('id', '=', $parents->id)->get();
        // 	foreach ($all as $l) {
        // 		//echo $l->title;
        // 		if (count($l->childs)) {
        // 			echo $l->title;
        // 			echo $l->id;
        // 			 echo "['childs' => $l->childs]";
        // 		}
        // 	}
        // }
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function addCategory(Request $request)
    {
        $this->validate($request, [
        		'title' => 'required',
        	]);
        $save = new Category();
        $parent = Category::where('title', '=', $request->input('parent_id'))->first();
        $all = Category::all();

         $input = $request->all();
         	
         if (empty($input['parent_id'])) {
         	// Category::create($input);
         	$save->title=$request->input('title');
         	$save->parent_id=0;
         	$save->save();
         	return back()->with('success', 'New Category added successfully.');
         }
         else {
         	$save->title=$request->input('title');
         	$save->parent_id=$parent->id;
         	$save->save();
         	for ($i=0; $i <count($all) ; $i++) { 
         		Category::where('id', '=', $all[$i]->parent_id)->update(['total' => $all[$i]->total + 1]); 
         	}
         	return back()->with('success', 'New Category added successfully.');
        }
        // $input['parent_id'] = empty($input['parent_id']) ? 0 : $input[($parent[0]->id)];
        
        // Category::create($input);
        //return back()->with('success', 'New Category added successfully.');
    }
}
