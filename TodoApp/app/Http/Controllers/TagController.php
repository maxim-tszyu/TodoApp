<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TagController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $tags = Tag::where('user_id', Auth::id())->get();
        return view('tags.index', compact('tags'));
    }

    public function create()
    {
        $this->authorize('create', Tag::class);
        return view('tags.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Tag::class);

        Tag::create([
            'user_id' => Auth::user()->id,
            'name' => $request->get('title')
        ]);
        return redirect(route('tags.index'));
    }

    public function show(Tag $tag)
    {
        $this->authorize('view', $tag);
        return view('tags.show', compact('tag'));
    }

    public function edit(Tag $tag)
    {
        $this->authorize('update', $tag);
        return view('tags.edit', compact('tag'));
    }

    public function update(Request $request, Tag $tag)
    {
        $this->authorize('update', $tag);
        $tag->update($request->only(['name']));
        return redirect(route('tags.index'));
    }

    public function destroy(Tag $tag)
    {
        $this->authorize('delete', $tag);
        $tag->delete();
        return redirect(route('tags.index'));
    }
}
