@extends('app')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/listItem.css') }}">
@endpush

@section('title', 'Éditer les news')

@section('content')
    <h2>News</h2>

    <div class="info">
        @if ($errors->any())
            <div class="error">
                Erreur :
            </div>
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="sucess">
                Succès :
            </div>
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    </div>

    <div class="head">

        <div class="add">
            <h3>Ajouter une News</h3>

            <form method="POST" action="{{ route('news.addNews') }}" enctype="multipart/form-data">
                @csrf
                <label for="description">Description</label>
                <textarea name="description" id="description" cols="30" rows="10"></textarea>

                <label for="image">Image</label>
                <input type="file" name="image">

                <label for="alt">Texte alternatif</label>
                <input type="text" name="alt">

                <button type="submit">Ajouter</button>
            </form>
        </div>

        <div class="update">

            <h3>Modifier une news</h3>

            <form action="{{ route('news.updateNews') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <label for="id">Id </label>
                <input type="number" name="id" value="{{ old('id') }}">

                <label for="description">Description</label>
                <textarea name="description" id="description" cols="30" rows="10"></textarea>

                <label for="image">Image </label>
                <input type="file" name="image">


                <label for="alt">Texte alternatif</label>
                <input type="text" name="alt" value="{{ old('alt') }}">

                <button type="submit">Mettre a jour</button>
            </form>
        </div>
    </div>

    <div class="back">
        <button onclick="history.back()">Retour</button>
    </div>

    <div class="dashboard">
        <button onclick="location.href='/dashboard'">Dashboard</button>
    </div>

    <ul class="allList">

        @foreach ($news as $new)
            <li class="new item">

                <p>Id : {{ $new->id }}</p>

                <div class="img">

                    <p>Image :</p>
                    <img src="../{{ $new->image }}" alt="bikeImg">
                </div>

                <p>Texte altrernatif : {{ $new->alt }}</p>
                <p>Description : {{ $new->description }}</p>
                <p>Derniére modification : {{ $new->updated_at }}</p>

                <form action="{{ route('news.deleteNews', $new->id) }}" method="POST">

                    @csrf
                    @method('DELETE')
                    <button type="submit">Supprimer</button>
                </form>
            </li>
        @endforeach
    </ul>


@endSection
