@extends('base', [
    'title' => 'Ajouter un locataire',
    'pageTitle' => 'Ajouter un locataire',
])

@section('content')
        <div class="card">
        <div class="card-header text-end">
            <h5 class="card-title">Ajouter un locataire</h5>
        </div>
        <div class="card-body">

        <div class="space-y-6">
            @include('tenants._form', [
                'action' => route('tenants.store'),
                'method' => 'POST',
                'tenant' => new App\Models\Tenant
            ])
        </div>

        </div>
@endsection
