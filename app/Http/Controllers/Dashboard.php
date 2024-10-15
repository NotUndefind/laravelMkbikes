<?php

namespace App\Http\Controllers;

use App\Models\BikesUsed;
use App\Models\Brand;
use App\Models\News;
use App\Models\RentalBike;
use App\Models\RepairBike;
use App\Models\TransformBike;

use Illuminate\Http\Request;

class Dashboard extends Controller {
    public function index() {
        $rentalBikes = RentalBike::all();

        $transformBikes = TransformBike::all();

        $repairBikes = RepairBike::all();

        $brands = Brand::all();

        $bikesUseds = BikesUsed::all();

        $news = News::all();

        return view('dashboard', compact('brands', 'repairBikes', 'transformBikes', 'rentalBikes', 'bikesUseds', 'news'));
    }



    public function rental(Request $request) {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required',
        ]);

        $rentalBike = new RentalBike();

        if ($request->hasFile('image')) {
            $imageName = time() . '_rentalBike.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $rentalBike->image = 'images/' . $imageName;
        }

        $rentalBike->description = $request->description;

        $rentalBike->save();
        return back()->with('success', 'Rental created successfully.');
    }
}
