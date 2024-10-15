<?php

namespace App\Http\Controllers;

use App\Models\RentalBike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class RentalController extends Controller {
    public function index() {
        $rentalBikes = RentalBike::all();
        return view('rental', compact('rentalBikes'));
    }

    public function addRental(Request $request) {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'alt' => 'required|string',
            'description' => 'required|string',
        ], [
            'image.required' => 'Veuillez ajouter une image.',
            'image.image' => 'L\'extesion de l\'image doit etre jpeg, png, jpg ou svg.',
            'image.max' => 'La taille de l\'image ne doit pas depasser 2Mo.',


            'alt.string' => 'Le texte alternatif doit etre une chaîne de caractères.',
            'alt.required' => 'Veuillez entrer un texte alternatif.',
            'description.required' => 'Veuillez entrer une description.',
            'description.string' => 'La description doit etre une chaîne de caractères.',
        ]);

        $rentalBike = new RentalBike();

        if ($request->hasFile('image')) {
            $imageName = time() . '_rentalBike.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $rentalBike->image = 'images/' . $imageName;
        }

        $rentalBike->alt = $request->alt;
        $rentalBike->description = $request->description;

        $rentalBike->save();
        return redirect()->back()->with('success', 'Rental deleted successfully.');
    }

    public function updateRental(Request $request) {
        // Valider les données entrantes
        $request->validate([
            'id' => 'required|exists:rental_bikes,id',  // Assurez-vous que l'ID existe dans la table
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',  // Rendre l'image facultative
            'alt' => 'nullable|string',
            'description' => 'nullable|string',  // Valider que la description est bien une chaîne
        ], [
            'image.required' => 'Veuillez ajouter une image.',
            'image.image' => 'L\'extesion de l\'image doit etre jpeg, png, jpg ou svg.',
            'image.max' => 'La taille de l\'image ne doit pas depasser 2Mo.',

            'description.string' => 'La description doit etre une chaîne de caractères.',
            'alt.string' => 'Le texte alternatif doit etre une chaîne de caractères.',
        ]);

        // Récupérer le vélo en fonction de l'ID fourni
        $rentalBike = RentalBike::find($request->input('id'));

        // Si une image est envoyée, surpimer l'ancienne image
        if ($request->image != null) {
            File::delete(public_path($rentalBike->image));
        }



        // Si le vélo n'est pas trouvé
        if (!$rentalBike) {
            return redirect()->back()->with('error', 'Vélo non trouvé.');
        }

        // Si une image est envoyée, gérer le téléchargement et le stockage de l'image
        if ($request->hasFile('image')) {
            $imageName = time() . '_rentalBike.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $rentalBike->image = 'images/' . $imageName;
        }

        if ($request->input('alt')) {
            $rentalBike->alt = $request->input('alt');
        }

        // Mettre à jour la description
        if ($request->input('description')) {
            $rentalBike->description = $request->input('description');
        }
        // Sauvegarder les modifications dans la base de données
        $rentalBike->save();

        // Rediriger avec un message de succès
        return redirect()->back()->with('success', 'Rental updated successfully.');
    }


    public function deleteRental($id) {
        $rentalBike = RentalBike::find($id);
        $rentalBike->delete();
        return redirect()->back()->with('success', 'Rental deleted successfully.');
    }

    public function getRentalApi() {
        $rentalBikes = RentalBike::all();
        return response()->json($rentalBikes);
    }
}
