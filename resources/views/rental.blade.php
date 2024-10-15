@extends('app')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/listItem.css') }}">
@endpush

@section('title', 'Éditer les locations')

@section('content')
    <h2>Locations</h2>

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

            <h3>Ajouter une Location</h3>

            <form method="POST" action="{{ route('rental.addRental') }}" enctype="multipart/form-data">

                @csrf
                @method('POST')

                <label for="description">Description</label>
                <textarea name="description" id="description" cols="30" rows="10"></textarea>

                <label for="image">Image</label>
                <input type="file" name="image">
                <label for="alt">Texte alternatif :</label>
                <input type="text" name="alt" id="altImg">

                <button type="submit">Ajouter</button>
            </form>
        </div>

        <div class="update">

            <h3>Modifier une Location</h3>

            <form action="{{ route('rental.updateRental') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')


                <label for="id">Id</label>
                <input type="number" name="id" value="{{ old('id') }}">


                <label for="description">Description</label>
                <textarea name="description" id="description" cols="30" rows="10"></textarea>


                <label for="image">Image</label>
                <input type="file" name="image">
                <label for="alt">Texte alternatif :</label>
                <input type="text" name="alt" id="altImg">

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

        @foreach ($rentalBikes as $rentalBike)
            <li class="rental item">
                <p>Id : {{ $rentalBike->id }}</p>

                <div class="img">

                    <p>Image :</p>
                    <img src="../{{ $rentalBike->image }}" alt="bikeImg">
                    <p>Texte alternatif : {{ $rentalBike->alt }}</p>
                </div>

                <p>Description : {{ $rentalBike->description }}</p>
                <p>Derniére modification : {{ $rentalBike->updated_at }}</p>



                <form action="{{ route('rental.deleteRental', $rentalBike->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Supprimer</button>
                </form>

            </li>
        @endforeach
    </ul>
@endSection
