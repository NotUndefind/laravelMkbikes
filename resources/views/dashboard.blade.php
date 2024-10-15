@extends('app')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush

@section('title', 'Dashboard')

@section('content')
    <h1>Dashboard</h1>

    <button onclick="window.location='{{ route('newsletter.index') }}'">Newsletter</button>
    <div class="dashboard">


        <div class="brands section">

            <h2>Marques</h2>


            <button onclick="window.location='{{ route('brand.index') }}'">Ajouter/Modifier/Supprimer</button>


            <div class="onlineBrands ">
                <ul class="allList">
                    @foreach ($brands as $brand)
                        <li class="brand item">

                            <p>Id : {{ $brand->id }}</p>
                            <p>Titre : {{ $brand->name }}</p>
                            <p>Lien : {{ $brand->link }}</p>
                            <p>Description : {{ $brand->description }}</p>
                            <div class="imgs">
                                <p>Image de fond :</p>
                                <img src="../{{ $brand->backgroundImg }}" alt="backgroundImg">

                                <p>Logo :</p>
                                <img src="../{{ $brand->logoImg }}" alt="logoImg">

                                <p>Image d'action :</p>
                                <img src="../{{ $brand->actionImg }}" alt="actionImg">
                            </div>

                            <p>Derniére modification : {{ $brand->updated_at }}</p>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>


        <div class="repair section">

            <h2>Reparations</h2>


            <button onclick="window.location='{{ route('repair.index') }}'">Ajouter/Modifier/Supprimer</button>

            <div class="onlineRepairs"></div>
            <ul class="allList">
                @foreach ($repairBikes as $repairBike)
                    <li class="repair item">
                        <p>Id : {{ $repairBike->id }}</p>

                        <div class="img">
                            <p>Image :</p>
                            <img src="../{{ $repairBike->image }}" alt="bikeImg">
                        </div>

                        <p>Description : {{ $repairBike->description }}</p>
                        <p>Derniére modification : {{ $repairBike->updated_at }}</p>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="transform section">

            <h2>Transformations</h2>


            <button onclick="window.location='{{ route('transform.index') }}'">Ajouter/Modifier/Supprimer</button>

            <div class="onlineTransforms">

                <ul class="allList">
                    @foreach ($transformBikes as $transformBike)
                        <li class="transform item">
                            <p>Id : {{ $transformBike->id }}</p>

                            <div class="img">

                                <p>Image :</p>
                                <img src="../{{ $transformBike->image }}" alt="bikeImg">
                            </div>

                            <p>Description : {{ $transformBike->description }}</p>
                            <p>Derniére modification : {{ $transformBike->updated_at }}</p>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="rental section">

            <h2>Location</h2>


            <button onclick="window.location='{{ route('rental.index') }}'">Ajouter/Modifier/Supprimer</button>

            <div class="onlineRental"></div>
            <ul class="allList">
                @foreach ($rentalBikes as $rentalBike)
                    <li class="rental item">
                        <p>Id : {{ $rentalBike->id }}</p>

                        <div class="img">

                            <p>Image :</p>
                            <img src="../{{ $rentalBike->image }}" alt="bikeImg">
                        </div>

                        <p>Description : {{ $rentalBike->description }}</p>
                        <p>Derniére modification : {{ $rentalBike->updated_at }}</p>
                    </li>
                @endforeach
            </ul>
        </div>


        <div class="usedBike section">

            <h2>Vélo d'occasion</h2>


            <button onclick="window.location='{{ route('bikesUsed.index') }}'">Ajouter/Modifier/Supprimer</button>

            <div class="onlineRental"></div>
            <ul class="allList">
                @foreach ($bikesUseds as $bikeUsed)
                    <li class="rental item">
                        <p>Id : {{ $bikeUsed->id }}</p>

                        <div class="img">

                            <p>Image :</p>
                            <img src="../{{ $bikeUsed->image }}" alt="bikeImg">
                        </div>

                        <p>Texte altrernatif : {{ $bikeUsed->alt }}</p>
                        <p>Description : {{ $bikeUsed->description }}</p>
                        <p>Derniére modification : {{ $bikeUsed->updated_at }}</p>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="News section">

            <h2>News</h2>


            <button onclick="window.location='{{ route('news.index') }}'">Ajouter/Modifier/Supprimer</button>

            <div class="onlineRental"></div>
            <ul class="allList">
                @foreach ($news as $new)
                    <li class="rental item">
                        <p>Id : {{ $new->id }}</p>

                        <div class="img">

                            <p>Image :</p>
                            <img src="../{{ $new->image }}" alt="bikeImg">
                            <p>Texte altrernatif : {{ $new->alt }}</p>
                        </div>

                        <p>Description : {{ $new->description }}</p>
                        <p>Derniére modification : {{ $new->updated_at }}</p>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


    </div>
@endsection
