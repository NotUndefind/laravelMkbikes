<?php

namespace App\Http\Controllers;

use App\Models\BikesUsed;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class BikesUsedController extends Controller {
    public function index() {
        $bikesUseds = BikesUsed::all();
        return view('bike_used', compact('bikesUseds'));
    }

    public function addBikeUsed(Request $request) {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required|string',
            'alt' => 'required|string',
        ], [
            'image.required' => 'Veuillez ajouter une image.',
            'image.image' => 'L\'extesion de l\'image doit etre jpeg, png, jpg ou svg.',
            'image.max' => 'La taille de l\'image ne doit pas depasser 2Mo.',


            'description.required' => 'Veuillez ajouter une description.',
            'description.string' => 'La description doit etre une chaîne de caractères.',
            'alt.string' => 'Le texte alternatif doit etre une chaîne de caractères.',
            'alt.required' => 'Veuillez entrer un texte alternatif.',
        ]);

        $usedBike = new BikesUsed();

        if ($request->hasFile('image')) {
            $imageName = time() . '_bikeUsed.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $usedBike->image = 'images/' . $imageName;
        }

        $usedBike->description = $request->description;
        $usedBike->alt = $request->alt;

        $usedBike->save();
        return redirect()->back()->with('success', 'Used bike added successfully.');
    }

    public function updateBikeUsed(Request $request) {
        // Valider les données entrantes
        $request->validate([
            'id' => 'required|exists:bikes_useds,id',  // Assurez-vous que l'ID existe dans la table
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',  // Rendre l'image facultative
            'description' => 'nullable|string',  // Valider que la description est bien une chaîne
            'alt' => 'nullable|string',
        ], [
            'image.required' => 'Veuillez ajouter une image.',
            'image.image' => 'L\'extesion de l\'image doit etre jpeg, png, jpg ou svg.',
            'image.max' => 'La taille de l\'image ne doit pas depasser 2Mo.',


            'description.string' => 'La description doit etre une chaîne de caractères.',
            'alt.string' => 'Le texte alternatif doit etre une chaîne de caractères.',
        ]);

        // Récupérer le vélo en fonction de l'ID fourni
        $bikeUsed = BikesUsed::find($request->input('id'));

        // Si une image est envoyée, surpimer l'ancienne image
        if ($request->input('image')) {
            File::delete(public_path($bikeUsed->image));
        }

        // Si le vélo n'est pas trouvé
        if (!$bikeUsed) {
            return redirect()->back()->with('error', 'Vélo non trouvé.');
        }

        // Si une image est envoyée, gérer le téléchargement et le stockage de l'image
        if ($request->hasFile('image')) {
            $imageName = time() . '_bikeUsed.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $bikeUsed->image = 'images/' . $imageName;
        }

        // Mettre à jour la description
        if ($request->input('description')) {
            $bikeUsed->description = $request->input('description');
        }

        // Mettre à jour le texte alternatif
        if ($request->input('alt')) {
            $bikeUsed->alt = $request->input('alt');
        }

        // Sauvegarder les modifications dans la base de données
        $bikeUsed->save();

        // Rediriger avec un message de succès
        return redirect()->back()->with('success', 'Vélo d\'occasion updated successfully.');
    }


    public function deleteBikeUsed($id) {
        $bikeUsed =  BikesUsed::find($id);
        $bikeUsed->delete();
        return redirect()->back()->with('success', 'Rental deleted successfully.');
    }

    public function getBikesUsedApi() {
        $bikeUsed = BikesUsed::all();
        return response()->json($bikeUsed);
    }
}
