<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\ImageManager;
// use Intervention\Image\Drivers\Imagick\Driver;
use Intervention\Image\Drivers\Gd\Driver;
use App\Rules\V3ReCaptcha;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:3000',
            'g-recaptcha-response' => ['required', new V3ReCaptcha]
        ]);

        $image = $request->file('gambar');

        $imageName = time() . '.' . $image->getClientOriginalExtension();

        // $image->move('uploads', $imageName);

        // create new manager instance with desired driver and default configuration
        $imgManager = new ImageManager(new Driver());

        // create new image instance
        // $thumbImage = $imgManager->read('uploads/' . $imageName);
        $thumbImage = $imgManager->read($image);

        // resize to 300 x 200 pixel
        // $thumbImage->resize(150, 150);
        $thumbImage->scaleDown(width: 200);
        $thumbImage->save(public_path('uploads/thumbnails/' . $imageName));

        // dd($imageName, $request->gambar);

        return redirect()->back()->with('success', 'Data has been successfully saved');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
