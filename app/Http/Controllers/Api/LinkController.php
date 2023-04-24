<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Link;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    public function index()
    {
        $data = Link::where('users_id', getUser()->id)->get();
        return response(['links' => $data, 'message' => 'Retrieved successfully'], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'url' => 'required|string',
        ]);

        $link = Link::create([
            'title' => $request->name,
            'url' => $request->url,
            'users_id' => getUser()->id,
        ]);

        if ($link) {
            return response(['data' => $link, 'message' => 'Created successfully'], 201);
        } else {
            return response(['data' => null, 'message' => 'Failed to create'], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // get put data
        Link::where('id', $id)->update($request->except('_method'));
        return response(['message' => 'Updated successfully'], 200);
    }

    public function destroy(string $id)
    {
        $req = Link::find($id)->delete();
        if ($req) {
            return response(['message' => 'Deleted successfully'], 200);
        } else {
            return response(['message' => 'Failed to delete'], 400);
        }
    }
}
