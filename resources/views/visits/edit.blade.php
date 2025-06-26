@extends('base', [
    'title' => 'Modifier une visite',
    'pageTitle' => 'Modifier une visite',
])

@section('content')
    <div class="card">
        <div class="card-header text-end">
            <h5 class="card-title">Modifier une visite</h5>
        </div>
        <div class="card-body">
            @include('visits._form', [
                "method" => "PUT",
                "action" => route('visits.update', $visit)
            ])
        </div>
    </div>
@endsection
