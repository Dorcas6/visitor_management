@extends('base', [
    'title' => 'Ajouter un visiteur',
    'pageTitle' => 'Ajouter un visiteur',
])

@section('content')
    <div class="card">
        <div class="card-header text-end">
            <h5 class="card-title">Ajouter un visiteur</h5>
        </div>
        <div class="card-body">
            @include('visitors._form', [
                "method" => "POST",
                "action" => route('visitors.store'),
            ])
        </div>
    </div>
@endsection
