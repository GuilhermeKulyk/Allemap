<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\FoodCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class FoodCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {        
        // get categories
        $results = FoodCategory::where('user_id', Auth::id())
            ->orderBy('category_name')
            ->get(); 
        
        return view('app.food-category.index', compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('app.food-category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        /*
        $request->validate([
            'name' => 'required|min:3|max:25',
            'description' => 'max:2000',
        ]);
            */
        
        $category = new FoodCategory();
        $category->category_name = $request->input('category_name');
        $category->description = $request->input('description');
        $category->user_id = Auth::id();
        $category->save();
        return redirect()->route('food-category.index')->with('success','All done.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FoodCategory $foodCategory)
    {
        if ($foodCategory->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized');
        }

        return view('app.food-category.edit', compact('foodCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FoodCategory $foodCategory)
    {
        if ($foodCategory->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized');
        }

        /*
        $request->validate([
            'name' => 'required|min:3|max:25',
            'description' => 'max:2000',
        ]);
        */

        $foodCategory->category_name = $request->input('category_name');
        $foodCategory->description = $request->input('description');
        $foodCategory->save();

        return redirect()->route('food-category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FoodCategory $foodCategory)
    {
        if ($foodCategory->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized');
        }

        $foodCategory->delete();
        return redirect()->route('food-category.index');
    }

            /**
     * Remove the specified resource from storage
     * @param  \App\FoodCategory $foodCategory
     * @param string $search
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request, FoodCategory $foodCategory)
    {   
        $search = $request->get('search');
        $results = $foodCategory->where('category_name', 'LIKE', '%' . $search . '%')->get();

        if (isset($results)) 
        {
            return view('app.food-category.index',  compact('results'));
        } 
        else
        {
            return view('app.food-category.index');
        } 
    }
}
