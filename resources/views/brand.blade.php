@extends('app')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/listItem.css') }}">
@endpush

@section('title', 'Éditer les marques')

@section('content')

    <h2>Marques</h2>

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


            <h3>Ajouter une marque</h3>

            <form method="POST" action="{{ route('brand.addBrand') }}" enctype="multipart/form-data">

                @csrf

                <div>
                    <label for="name">Nom de la marque</label>
                    <input type="text" name="name">
                </div>

                <div>
                    <label for="link">Lien du site web de la marque</label>
                    <input type="text" name="link">

                </div>

                <div>
                    <label for="description">Description</label>
                    <textarea name="description"></textarea>
                </div>

                <div>
                    <label for="backgroundImg">Image de fond</label>
                    <input type="file" name="backgroundImg">
                    <label for="backgroundAlt">Texte alternatif</label>
                    <input type="text" name="altBgImg">
                </div>

                <div>
                    <label for="logoImg">Logo</label>
                    <input type="file" name="logoImg">
                    <label for="logoAlt">Texte alternatif</label>
                    <input type="text" name="altLogoImg">
                </div>

                <div>
                    <label for="actionImg">Image d'action</label>
                    <input type="file" name="actionImg">
                    <label for="actionAlt">Texte alternatif</label>
                    <input type="text" name="altActionImg">
                </div>

                <button type="submit">Ajouter</button>
            </form>
        </div>

        <div class="update">

            <h3>Modifier une marque</h3>

            <form action="{{ route('brand.updateBrand') }}" method="POST" enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <label for="id">Id</label>
                <input type="number" name="id">

                <div>
                    <label for="name">Nom de la marque</label>
                    <input type="text" name="name">
                </div>

                <div>
                    <label for="link">Lien du site web de la marque</label>
                    <input type="text" name="link">
                </div>

                <div>
                    <label for="description">Description</label>
                    <textarea name="description" id="description" cols="30" rows="10"></textarea>
                </div>


                <div>
                    <label for="backgroundImg">Image de fond</label>
                    <input type="file" name="backgroundImg">
                    <label for="backgroundAlt">Texte alternatif</label>
                    <input type="text" name="altBgImg">
                </div>


                <div>
                    <label for="logoImg">Logo</label>
                    <input type="file" name="logoImg">
                    <label for="logoAlt">Texte alternatif</label>
                    <input type="text" name="altLogoImg">
                </div>

                <div>
                    <label for="actionImg">Image d'action</label>
                    <input type="file" name="actionImg">
                    <label for="actionAlt">Texte alternatif</label>
                    <input type="text" name="altActionImg">
                </div>

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
        @foreach ($brands as $brand)
            <li class="brand item">

                <p>Id : {{ $brand->id }}</p>
                <p>Nom de la marque : {{ $brand->name }}</p>
                <p>Lien : {{ $brand->link }}</p>
                <p>Description : {{ $brand->description }}</p>
                <div class="imgs">
                    <p>Image de fond :</p>
                    <p>{{ $brand->altBgImg }}</p>
                    <img src="../{{ $brand->backgroundImg }}" alt="backgroundImg">

                    <p>Logo :</p>
                    <p>{{ $brand->altLogoImg }}</p>
                    <img src="../{{ $brand->logoImg }}" alt="logoImg">

                    <p>Image d'action :</p>
                    <p>{{ $brand->altActionImg }}</p>
                    <img src="../{{ $brand->actionImg }}" alt="actionImg">
                </div>

                <p>Derniére modification : {{ $brand->updated_at }}</p>

                <form action="{{ route('brand.deleteBrand', $brand->id) }}" method="POST">

                    @csrf
                    @method('DELETE')
                    <button type="submit">Supprimer</button>
                </form>
            </li>
        @endforeach
    </ul>

@endsection
