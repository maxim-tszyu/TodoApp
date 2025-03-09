<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Category::create([
            'user_id' => Auth::user()->id,
            'name' => $request->get('title')
        ]);
        return redirect(route('categories.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $cat)
    {
        $tasks = $cat->tasks()->where('user_id', Auth::user()->id)->get();
        return view('categories.show', compact('tasks','cat'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $cat)
    {
        return view('categories.edit', compact('cat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $cat)
    {
        $validated_data = $request->validate(['name' => 'required']);
        $cat->update($validated_data);
        return redirect(route('categories.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $cat)
    {
        //
    }
}
