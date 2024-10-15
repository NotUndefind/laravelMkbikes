<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactMailController extends Controller {
    public function sendEmail(Request $request) {

        // Validation des données
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required'
        ], [
            'name.required' => 'Le nom est obligatoire.',
            'email.required' => 'L\'adresse email est obligatoire.',
            'email.email' => 'Veuillez fournir une adresse email valide.',
            'subject.required' => 'Le sujet est obligatoire.',
            'message.required' => 'Le message est obligatoire.',
        ]);

        try {
            // Préparation des données pour la vue
            $data = [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'subject' => $validated['subject'],
                'user_message' => $validated['message']
            ];

            // Envoi de l'email
            Mail::send('emails.contact', $data, function ($message) use ($data) {
                $message->from($data['email'], $data['name']);
                $message->to('hello@example.com', 'Support Client')->subject($data['subject']);
            });

            // Réponse JSON en cas de succès
            return response()->json(['message' => 'Email envoyé avec succès.'], 200);
        } catch (\Exception $e) {
            // Réponse JSON en cas d'erreur
            return response()->json(['error' => 'Une erreur s\'est produite lors de l\'envoi de l\'email.'], 500);
        }
    }
}
