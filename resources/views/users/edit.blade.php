@extends('base', [
    'title' => 'Éditer un agent de sécurité',
    'pageTitle' => 'Éditer un agent de sécurité',
])

@section('content')
    <div class="card">
        <div class="card-header text-end">
            <h5 class="card-title">Éditer un agent de sécurité</h5>
        </div>
        <div class="card-body">
            @include('users._form', [
                "method" => "PUT",
                "action" => route('users.update', $user->id),
            ])
        </div>
    </div>
@endsection
