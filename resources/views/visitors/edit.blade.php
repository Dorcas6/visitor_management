@extends('base', [
    'title' => 'Modifier un visiteur',
    'pageTitle' => 'Modifier un visiteur',
])

@section('content')
    <div class="card">
        <div class="card-header text-end">
            <h5 class="card-title">Modifier un visiteur</h5>
        </div>
        <div class="card-body">
            @include('visitors._form', [
                "method" => "PUT",
                "action" => route('visitors.update', $visitor),
            ])
        </div>
    </div>
@endsection
