<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NewsletterController extends Controller {
    public function index() {
        return view('sendNewsletter');
    }
    // Gérer l'abonnement à la newsletter
    public function subscribe(Request $request) {
        $request->validate([
            'email' => 'required|email|unique:subscribers,email',
        ], [
            'email.required' => 'L\'email est obligatoire.',
            'email.email' => 'L\'email doit être valide.',
            'email.unique' => 'Cet email est déjà abonné.',
        ]);

        // Ajouter l'abonné
        Subscriber::create([
            'email' => $request->email,
            'subscribed_at' => now(),
        ]);

        // Réponse JSON en cas de succès
        return response()->json(['message' => 'Email abonné avec succès.'], 200);
    }

    // Envoyer la newsletter
    public function sendNewsletter(Request $request) {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        // Créer la newsletter
        $newsletter = Newsletter::create([
            'title' => $request->title,
            'content' => $request->content,
            'sent_at' => now(),
        ]);

        // Récupérer les abonnés actifs
        $subscribers = Subscriber::where('is_subscribed', true)->get();

        foreach ($subscribers as $subscriber) {
            // Envoyer l'email
            Mail::send('emails.costumerNewsletter', ['content' =>  $newsletter->content, 'title' => $newsletter->title, 'ctaUrl' => url('http://localhost:5173'), 'unsubscribeUrl' => route('newsletter.unsubscribe', ['email' => $subscriber->email])], function ($message) use ($subscriber, $newsletter) {
                $message->to($subscriber->email)
                    ->subject($newsletter->title);
            });

            // Enregistrer l'envoi dans la table pivot
            $newsletter->subscribers()->attach($subscriber->id, ['sent_at' => now()]);
        }

        return back()->with('success', 'La newsletter a été envoyée avec succès.');
    }

    // Supprimer l'abonnement à la newsletter
    public function unsubscribe($email) {
        Subscriber::where('email', $email)->update(['is_subscribed' => false, 'unsubscribed_at' => now()]);

        return redirect('http://localhost:5173/unsubscribe');
    }
}
