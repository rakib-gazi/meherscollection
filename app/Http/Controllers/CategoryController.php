<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class CategoryController extends Controller
{
    //categroy
    function getCategory(Request $request)
    {
        $categories = Category::oldest()->get();
        return Inertia::render('Category',['categories'=>$categories]);
    }
    function addCategory(Request $request)
    {
        $data = $request->validate([
            'category' => 'required|string|min:3|max:60|unique:categories,category',
        ]);
        DB::beginTransaction();
        try {
            Category::create($data);
            DB::commit();

            return redirect()->back();
        } catch (Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    function updateCategory(Request $request, $id)
    {

        $data = $request->validate([
            'category' => 'required|string|min:3|max:60|unique:categories,category,' . $id,
        ]);

        DB::beginTransaction();
        try {
            Category::where('id', $id)->update($data);
            DB::commit();
            return redirect()->back();
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors($e->getMessage());
        }

    }
    function deleteCategory(Request $request)
    {
        $id = $request->id;
        try{
            $deleted =  Category::where('id', $id)->delete();
            $error = "";
            if(!$deleted){
                $error = "Category not found or could not be deleted";
            }
            $data = ['message' => 'Category Deleted Successfully', 'status' => true, 'error' => $error];
            return redirect()->route('super-admin/category')->with($data );
        }
        catch(Exception $e){
            return Redirect::back()->withErrors($e->getMessage());
        }
    }

    //sub category

    function getSubCategory(Request $request)
    {
        $subCategories = SubCategory::oldest()->get();
        return Inertia::render('SubCategory',['subCategories'=>$subCategories]);
    }
    function addSubCategory(Request $request)
    {
        $data = $request->validate([
            'sub_category' => 'required|string|min:3|max:60|unique:sub_categories,sub_category',
        ]);
        DB::beginTransaction();
        try {
            SubCategory::create($data);
            DB::commit();

            return redirect()->back();
        } catch (Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    function updateSubCategory(Request $request, $id)
    {

        $data = $request->validate([
            'sub_category' => 'required|string|min:3|max:60|unique:sub_categories,sub_category,' . $id,
        ]);

        DB::beginTransaction();
        try {
            SubCategory::where('id', $id)->update($data);
            DB::commit();
            return redirect()->back();
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors($e->getMessage());
        }

    }
    function deleteSubCategory(Request $request)
    {
        $id = $request->id;
        try{
            $deleted =  SubCategory::where('id', $id)->delete();
            $error = "";
            if(!$deleted){
                $error = "Sub Category not found or could not be deleted";
            }
            $data = ['message' => 'Sub Category Deleted Successfully', 'status' => true, 'error' => $error];
            return redirect()->route('super-admin/sub-category')->with($data );
        }
        catch(Exception $e){
            return Redirect::back()->withErrors($e->getMessage());
        }
    }
}
