@extends('base', [
    'title' => 'Informations d\'un agent de sécurité',
    'pageTitle' => 'Informations d\'un agent de sécurité',
])

@section('content')
<div class="bg-gray-50 shadow rounded-lg border border-gray-200">
  <div class="border-b border-gray-200 px-4 py-3 flex justify-between items-center">
    <h5 class="text-lg font-semibold text-gray-800">Détails d'un agent de sécurité</h5>
  </div>

  <div class="p-4">
    <form action="#">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nom complet</label>
          <input type="text" id="name" value="{{ $user->name }}" class="w-full rounded-md border border-gray-300 bg-white text-gray-800 shadow-sm focus:border-blue-500 focus:ring-blue-500" readonly>
        </div>
        
        <div>
          <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
          <input type="email" id="email" value="{{ $user->email }}" class="w-full rounded-md border border-gray-300 bg-white text-gray-800 shadow-sm focus:border-blue-500 focus:ring-blue-500" readonly>
        </div>
      </div>
    </form>
  </div>
</div>


@endsection
