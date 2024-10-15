<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class NewsController extends Controller {
    public function index() {
        $news = News::all();
        return view('news', compact('news'));
    }

    public function addNews(Request $request) {
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

        $new = new News();

        if ($request->hasFile('image')) {
            $imageName = time() . '_news.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $new->image = 'images/' . $imageName;
        }

        $new->description = $request->description;
        $new->alt = $request->alt;

        $new->save();
        return redirect()->back()->with('success', 'News added successfully.');
    }

    public function updateNews(Request $request) {
        // Valider les données entrantes
        $request->validate([
            'id' => 'required|exists:news,id',  // Assurez-vous que l'ID existe dans la table
            'image' => 'nullable|image:jpeg,png,jpg,svg|max:2048',
            'description' => 'nullable|string',
            'alt' => 'nullable|string',
        ], [
            'image.required' => 'Veuillez ajouter une image.',
            'image.image' => 'L\'extesion de l\'image doit etre jpeg, png, jpg ou svg.',
            'image.max' => 'La taille de l\'image ne doit pas depasser 2Mo.',

            'description.string' => 'La description doit etre une chaîne de caractères.',
            'alt.string' => 'Le texte alternatif doit etre une chaîne de caractères.',
        ]);

        // Récupérer le vélo en fonction de l'ID fourni
        $new = News::find($request->input('id'));

        // Si le vélo n'est pas trouvé
        if (!$new) {
            return redirect()->back()->with('error', 'Vélo non trouvé.');
        }

        // Si une image est envoyée, surpimer l'ancienne image
        if ($request->image !== null) {
            File::delete(public_path($new->image));
        }

        // Si une image est envoyée, gérer le téléchargement et le stockage de l'image
        if ($request->hasFile('image')) {
            $imageName = time() . '_new.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $new->image = 'images/' . $imageName;
        }

        // Mettre à jour la description
        if ($request->input('description')) {
            $new->description = $request->input('description');
        }

        // Mettre à jour l'alt
        if ($request->input('alt')) {
            $new->alt = $request->input('alt');
        }

        // Sauvegarder les modifications dans la base de données
        $new->save();

        // Rediriger avec un message de succès
        return redirect()->back()->with('success', 'Rental updated successfully.');
    }


    public function deleteNews($id) {
        $new = News::find($id);
        $new->delete();
        return redirect()->back()->with('success', 'Rental deleted successfully.');
    }

    public function getNewsApi() {
        $new = News::all();
        return response()->json($new);
    }
}
