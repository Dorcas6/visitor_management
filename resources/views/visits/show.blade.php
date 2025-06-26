@extends('base', [
    'title' => 'Détails de la visite',
    'pageTitle' => 'Détails de la visite',
])

@section('content')
    <div class="card">
        <div class="card-header text-end">
            <h5 class="card-title">Détails de la visite</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="input-block mb-3">
                        <label>Visiteur</label>
                        <p>{{ $visit->visitor->last_name }} {{ $visit->visitor->first_name }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-block mb-3">
                        <label>Locataire</label>
                        <p>{{ $visit->tenant->name }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-block mb-3">
                        <label>Heure d'arrivée</label>
                        <p>{{ $visit->arrival_time->translatedFormat('d/m/Y H:i') }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-block mb-3">
                        <label>Heure de départ</label>
                        <p>{{ $visit->departure_time ? $visit->departure_time->translatedFormat('d/m/Y H:i') : 'Non enregistrée' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
