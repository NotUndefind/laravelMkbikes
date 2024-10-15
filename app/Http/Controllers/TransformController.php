<?php

namespace App\Http\Controllers;

use App\Models\TransformBike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class TransformController extends Controller {

    public function index() {
        $transformBikes = TransformBike::all();
        return view('transform', compact('transformBikes'));
    }

    public function addTransform(Request $request) {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'alt' => 'required|string',
            'description' => 'required|string',
        ], [
            'image.required' => 'Veuillez ajouter une image.',
            'image.image' => 'L\'extesion de l\'image doit etre jpeg, png, jpg ou svg.',
            'image.max' => 'La taille de l\'image ne doit pas depasser 2Mo.',

            'alt.required' => 'Veuillez entrer un texte alternatif.',
            'description.required' => 'Veuillez entrer une description.',
            'description.string' => 'La description doit etre une chaîne de caractères.',
            'alt.string' => 'Le texte alternatif doit etre une chaîne de caractères.',
        ]);

        $transformBike = new TransformBike();

        if ($request->hasFile('image')) {
            $imageName = time() . '_transformBike.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $transformBike->image = 'images/' . $imageName;
        }

        $transformBike->description = $request->description;
        $transformBike->alt = $request->alt;

        $transformBike->save();
        return redirect()->back()->with('success', 'Rental deleted successfully.');
    }

    public function updateTransform(Request $request) {
        // Valider les données entrantes
        $request->validate([
            'id' => 'required|exists:transform_bikes,id',  // Assurez-vous que l'ID existe dans la table
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
        $transformBike = TransformBike::find($request->input('id'));

        // Si le vélo n'est pas trouvé
        if (!$transformBike) {
            return redirect()->back()->with('error', 'Vélo non trouvé.');
        }

        // Si une image est envoyée, surpimer l'ancienne image
        if ($request->image != null) {
            File::delete(public_path($transformBike->image));
        }

        // Si une image est envoyée, gérer le téléchargement et le stockage de l'image
        if ($request->hasFile('image')) {
            $imageName = time() . '_transformBike.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $transformBike->image = 'images/' . $imageName;
        }

        if ($request->input('alt')) {
            $transformBike->alt = $request->input('alt');
        }

        // Mettre à jour la description
        if ($request->input('description')) {
            $transformBike->description = $request->input('description');
        }

        // Sauvegarder les modifications dans la base de données
        $transformBike->save();

        // Rediriger avec un message de succès
        return redirect()->back()->with('success', 'Transform updated successfully.');
    }

    public function deleteTransform($id) {
        $transformBike = TransformBike::find($id);
        $transformBike->delete();
        return redirect()->back()->with('success', 'Rental deleted successfully.');
    }

    public function getTransformApi() {
        $transformBikes = TransformBike::all();
        return response()->json($transformBikes);
    }
}
