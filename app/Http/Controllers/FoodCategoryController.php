<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\FoodCategory;

class FoodCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {        
        // get categories
        $foodCategories = FoodCategory::where('user_id', Auth::id())
            ->orderBy('name')
            ->get(); 

        return view('app.food-category.index', compact('foodCategories'));
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
        $request->validate([
            'name' => 'required|min:3|max:25|unique:food_categories,name,NULL,id,user_id,' . Auth::id(),
            'description' => 'max:2000',
        ]);

        $category = new FoodCategory();
        $category->name = $request->input('name');
        $category->description = $request->input('description');
        $category->user_id = Auth::id();
        $category->save();

        return redirect()->route('food-category.index');
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

        $request->validate([
            'name' => 'required|min:3|max:25|unique:food_categories,name,' . $foodCategory->id . ',id,user_id,' . Auth::id(),
            'description' => 'max:2000',
        ]);

        $foodCategory->name = $request->input('name');
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
}
