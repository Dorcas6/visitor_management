@extends('base', [
    'title' => 'Modifier un locataire',
    'pageTitle' => 'Modifier un locataire',
])

@section('content')
    <div class="card">
        <div class="card-header text-end">
            <h5 class="card-title">Modifier un locataire</h5>
        </div>
        <div class="card-body">
            @include('tenants._form', [
                "method" => "PUT",
                "action" => route('tenants.update', $tenant),
            ])
        </div>
    </div>
@endsection
