<?php

namespace App\Http\Controllers;

use App\Models\RepairBike;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class RepairController extends Controller {
    public function index() {
        $repairBikes = RepairBike::all();
        return view('repair', compact('repairBikes'));
    }

    public function addRepair(Request $request) {

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

        $repairBike = new RepairBike();

        if ($request->hasFile('image')) {
            $imageName = time() . '_repairBike.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $repairBike->image = 'images/' . $imageName;
        }

        $repairBike->description = $request->description;
        $repairBike->alt = $request->alt;

        $repairBike->save();
        return redirect()->back()->with('success', 'Rental deleted successfully.');
    }

    public function updateRepair(Request $request) {
        // Valider les données entrantes
        $request->validate([
            'id' => 'required|exists:repair_bikes,id',  // Assurez-vous que l'ID existe dans la table
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
        $repairBike = RepairBike::find($request->input('id'));

        // Si le vélo n'est pas trouvé
        if (!$repairBike) {
            return redirect()->back()->with('error', 'Vélo non trouvé.');
        }

        // Si une image est envoyée, surpimer l'ancienne image
        if ($request->image !== null) {
            File::delete(public_path($repairBike->image));
        }


        // Si une image est envoyée, gérer le téléchargement et le stockage de l'image
        if ($request->hasFile('image')) {
            $imageName = time() . '_repairBike.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $repairBike->image = 'images/' . $imageName;
        }

        // Mettre à jour la description
        if ($request->input('description')) {
            $repairBike->description = $request->input('description');
        }

        if ($request->input('alt')) {
            $repairBike->alt = $request->input('alt');
        }

        // Sauvegarder les modifications dans la base de données
        $repairBike->save();

        // Rediriger avec un message de succès
        return redirect()->back()->with('success', 'Repair updated successfully.');
    }

    public function deleteRepair($id) {
        $repairBike = RepairBike::find($id);
        $repairBike->delete();
        return redirect()->back()->with('success', 'Repair deleted successfully.');
    }

    public function getRepairApi() {
        $repairBikes = RepairBike::all();
        return response()->json($repairBikes);
    }
}
