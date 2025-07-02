@extends('base', [
    'title' => 'Enregistrer une visite',
    'pageTitle' => 'Enregistrer une visite',
])

@section('content')
<div class="card">
        <div class="card-header text-end">
            <h5 class="card-title">Enregistrer une visite</h5>
        </div>
        <div class="card-body">
            @include('visits._form', [
                "method" => "POST",
                "action" => route('visits.store'),
            ])
            
        </div>
    </div>
@endsection
