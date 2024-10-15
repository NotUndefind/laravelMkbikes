@extends('app')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/sendNewsletter.css') }}">
@endpush

@section('title', 'Envoyer une newsletter')

@section('content')
    <div class="container">
        <h1>Envoyer une Newsletter</h1>

        @if (session('success'))
            <div class="alert success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('newsletter.send') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Titre</label>
                <input type="text" name="title" id="title" class="input-field" value="{{ old('title') }}" required>
            </div>

            <div class="form-group">
                <label for="content">Contenu</label>
                <textarea name="content" id="content" class="input-field" rows="8" required>{{ old('content') }}</textarea>
            </div>

            <button type="submit" class="submit-btn">Envoyer la Newsletter</button>
        </form>
    </div>
@endSection
