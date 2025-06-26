@extends('base', [
    'title' => 'Détails du locataire',
    'pageTitle' => 'Détails du locataire',
])

@section('content')
    <div class="card">
        <div class="card-header text-end">
            <h5 class="card-title">Détails du locataire</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="input-block mb-3">
                        <label>Nom</label>
                        <p>{{ $tenant->name }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-block mb-3">
                        <label>Appartement</label>
                        <p>{{ $tenant->apartment }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-block mb-3">
                        <label>Nombre de visites</label>
                        <p>{{ $tenant->visits_count }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
