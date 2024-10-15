@extends('app')

@section('content')
    <h1>Connexion</h1>

    <form method="POST" action="">
        @csrf

        <div>

            <label for="email" class="sr-only">Email</label>

            <input id="email" type="email" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>

            <div class="error">

                @error('email')
                {{ $message }}
                @enderror
            </div>

            <label for="password" class="sr-only">Mot de passe</label>

            <input id="password" type="password" name="password">


            <div class="error">

                @error('password')
                {{ $message }}
                @enderror
            </div>
                
            <button type="submit">Se connecter</button>
        </div>
            @endsection

