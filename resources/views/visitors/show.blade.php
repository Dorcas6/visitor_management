@extends('base', [
    'title' => 'Détails du visiteur',
    'pageTitle' => 'Détails du visiteur',
])

@section('content')
    <div class="card">
        <div class="card-header text-end">
            <h5 class="card-title">Détails du visiteur</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="input-block mb-3">
                        <label>Nom</label>
                        <p>{{ $visitor->last_name }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-block mb-3">
                        <label>Prénom</label>
                        <p>{{ $visitor->first_name }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-block mb-3">
                        <label>Téléphone</label>
                        <p>{{ $visitor->phone_number }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-block mb-3">
                        <label>CNI</label>
                        <p>{{ $visitor->icn }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
