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

    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->has('id')) {
            $link = Link::find($request->id);
            if ($link->image) {
                $img = explode('/', $link->image);
                $image_path = public_path('images/link/' . end($img));
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/link'), $imageName);

            Link::where('id', $request->id)->update([
                'image' => $imageName
            ]);

            return response(['message' => 'Updated successfully', 'image' => url('images/link/' . $imageName)], 200);
        }

        return response(['message' => 'Failed to update'], 400);
    }

    public function removeImage($id)
    {
        $link = Link::find($id);
        if ($link->image) {
            $img = explode('/', $link->image);
            $image_path = public_path('images/link/' . end($img));
            if (file_exists($image_path)) {
                unlink($image_path);
            }
        }

        Link::where('id', $id)->update([
            'image' => null
        ]);

        return response(['message' => 'Updated successfully'], 200);
    }
}
