@extends('base', [
    'title' => 'Ajouter un locataire',
    'pageTitle' => 'Ajouter un locataire',
])

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-bold mb-6">Ajouter un locataire</h2>
        </div>

        <div class="space-y-6">
            @include('tenants._form', [
                'action' => route('tenants.store'),
                'method' => 'POST',
                'tenant' => new App\Models\Tenant
            ])
        </div>

    </div>
@endsection
