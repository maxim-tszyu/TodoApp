<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CategoryController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $categories = Category::where('user_id', Auth::id())->get();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Category::class);

        Category::create([
            'user_id' => Auth::user()->id,
            'name' => $request->get('title')
        ]);
        return redirect(route('categories.index'));
    }

    public function show(Category $cat)
    {
        $this->authorize('view', $cat);
        $tasks = $cat->tasks()->where('user_id', Auth::user()->id)->get();
        return view('categories.show', compact('tasks', 'cat'));
    }

    public function edit(Category $cat)
    {
        $this->authorize('update', $cat);
        return view('categories.edit', compact('cat'));
    }

    public function update(Request $request, Category $cat)
    {
        $this->authorize('update', $cat);
        $validated_data = $request->validate(['name' => 'required']);
        $cat->update($validated_data);
        return redirect(route('categories.index'));
    }

    public function destroy(Category $cat)
    {
        $this->authorize('delete', $cat);
        $cat->delete();
        return redirect(route('categories.index'));
    }
}
