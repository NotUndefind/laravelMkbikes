<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BrandsController extends Controller {
    public function index() {
        $brands = Brand::all();
        return view('brand', compact('brands'));
    }

    public function addBrand(Request $request) {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'link' => 'required|string',
            'altBgImg' => 'required|string',
            'altLogoImg' => 'required|string',
            'altActionImg' => 'required|string',

            'backgroundImg' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'logoImg' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'actionImg' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $brand = new Brand();
        //Attribution des textes
        $brand->name = $request->name;
        $brand->link = $request->link;
        $brand->description = $request->description;
        $brand->altBgImg = $request->altBgImg;
        $brand->altLogoImg = $request->altLogoImg;
        $brand->altActionImg = $request->altActionImg;

        // Attribution des images
        $brand->backgroundImg = $request->backgroundImg;
        $brand->logoImg = $request->logoImg;
        $brand->actionImg = $request->actionImg;

        // Gestion de l'image de fond
        if ($request->hasFile('backgroundImg')) {
            $backgroundImgName = time() . '_background.' . $request->backgroundImg->extension();
            $request->backgroundImg->move(public_path('images'), $backgroundImgName);
            $brand->backgroundImg = 'images/' . $backgroundImgName;
        }

        // Gestion du logo
        if ($request->hasFile('logoImg')) {
            $logoImgName = time() . '_logo.' . $request->logoImg->extension();
            $request->logoImg->move(public_path('images'), $logoImgName);
            $brand->logoImg = 'images/' . $logoImgName;
        }

        // Gestion de l'image d'action
        if ($request->hasFile('actionImg')) {
            $actionImgName = time() . '_action.' . $request->actionImg->extension();
            $request->actionImg->move(public_path('images'), $actionImgName);
            $brand->actionImg = 'images/' . $actionImgName;
        }

        $brand->save();
        return redirect()->back()->with('success', 'Rental deleted successfully.');
    }

    public function updateBrand(Request $request) {
        $request->validate([
            'id' => 'required|exists:brands,id',
            'description' => 'nullable|string',  // Valider que la description est bien une chaîne
            'name' => 'nullable|string', // Valider que le nom est bien une chaîne
            'link' => 'nullable|string', // Valider que le lien est bien une chaîne

            'backgroundImg' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',  // Rendre l'image facultative
            'logoImg' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',  // Rendre l'image facultative
            'actionImg' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',  // Rendre l'image facultative
        ]);

        // Récupérer le vélo en fonction de l'ID fourni
        $brand = Brand::find($request->input('id'));

        // Si une image est envoyée, surpimer l'ancienne image
        if ($request->backgroundImg !== null) {
            File::delete(public_path($brand->backgroundImg));
        }

        if ($request->logoImg !== null) {
            File::delete(public_path($brand->logoImg));
        }

        if ($request->actionImg !== null) {
            File::delete(public_path($brand->actionImg));
        }

        // Si le vélo n'est pas trouvé
        if (!$brand) {
            return redirect()->back()->with('error', 'Rental non trouvé.');
        }

        if ($request->hasFile('backgroundImg')) {
            $backgroundImgName = time() . '_background.' . $request->backgroundImg->extension();
            $request->backgroundImg->move(public_path('images'), $backgroundImgName);
            $brand->backgroundImg = 'images/' . $backgroundImgName;
        }

        if ($request->hasFile('logoImg')) {
            $logoImgName = time() . '_logo.' . $request->logoImg->extension();
            $request->logoImg->move(public_path('images'), $logoImgName);
            $brand->logoImg = 'images/' . $logoImgName;
        }

        if ($request->hasFile('actionImg')) {
            $actionImgName = time() . '_action.' . $request->actionImg->extension();
            $request->actionImg->move(public_path('images'), $actionImgName);
            $brand->actionImg = 'images/' . $actionImgName;
        }

        if ($request->description !== null) {
            $brand->description = $request->input('description');
        }

        if ($request->name !== null) {
            $brand->name = $request->input('name');
        }

        if ($request->link !== null) {
            $brand->link = $request->input('link');
        }

        if ($request->altBgImg !== null) {
            $brand->altBgImg = $request->altBgImg;
        }

        if ($request->altLogoImg !== null) {
            $brand->altLogoImg = $request->altLogoImg;
        }

        if ($request->altActionImg !== null) {
            $brand->altActionImg = $request->altActionImg;
        }

        $brand->save();
        return redirect()->back()->with('success', 'Brand updated successfully.');
    }

    public function deleteBrand($id) {
        $brand = Brand::find($id);
        $brand->delete();
        return redirect()->back()->with('success', 'Rental deleted successfully.');
    }

    public function getBrandsApi() {
        $brands = Brand::all();
        return response()->json($brands);
    }
}
