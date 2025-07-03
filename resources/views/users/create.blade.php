@extends('base', [
    'title' => 'Ajouter un agent de sécurité',
    'pageTitle' => 'Ajouter un agent de sécurité',
])

@section('content')
    <div class="card">
        <div class="card-header text-end">
            <h5 class="card-title">Ajouter un agent de sécurité</h5>
        </div>
        <div class="space-y-6">
            @include('users._form', [
                "method" => "POST",
                "action" => route('users.store'),
            ])
        </div>
    </div>
@endsection
