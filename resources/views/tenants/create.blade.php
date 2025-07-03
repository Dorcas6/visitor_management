@extends('base', [
    'title' => 'Ajouter un locataire',
    'pageTitle' => 'Ajouter un locataire',
])

@section('content')
    <div class="card">
        <div class="card-header text-end">
            <h5 class="card-title">Ajouter un locataire</h5>
        </div>
        <div class="space-y-6">
            @include('tenants._form', [
                "method" => "POST",
                "action" => route('tenants.store'),
            ])
        </div>
    </div>
@endsection
