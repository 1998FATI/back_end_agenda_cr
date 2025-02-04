@extends('layouts.app')

@section('content')
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session('success') }}</strong> 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show " role="alert">
        <strong> {{ session('error') }} </strong> 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="container">
    <!-- Formulaire de recherche -->
    <form action="{{ route('reunions.list') }}" method="GET" class="mb-3">
        <div class="row g-2">
            <!-- Recherche par Objet -->
            <div class="col-md-3">
                <input type="text" name="objet" class="form-control" placeholder="كلمة المفتاح  " value="{{ request('objet') }}">
            </div>

            <!-- Sélection Date -->
            <div class="col-md-3">
                <input type="date" name="date_reunion" class="form-control" value="{{ request('date_reunion') }}">
            </div>

            <!-- Sélection de l’organe -->
            <div class="col-md-3">
                <select name="organ_id" class="form-select">
                    <option value="">اختر لجنة</option>
                    @foreach ($organs as $organ)
                        <option value="{{ $organ->id }}" {{ request('organ_id') == $organ->id ? 'selected' : '' }}>
                            {{ $organ->libelle }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Bouton de recherche -->
            <div class="col-md-3">
                <button type="submit" class="btn btn-warning">🔍</button>
                <a href="{{ route('reunions.list') }}" class="btn btn-secondary">♻ </a>
            </div>
        </div>
    </form>
    <h3 class="mb-4 text-secondary">قائمة الاجتماعات</h3>
    <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addReunionModal">
    <i class="fas fa-plus"></i>    إضافة اجتماع جديد
    </button>   
    <br>
    <table class="table table-striped table-hover">
        <thead class="bg-primary text-white">
            <tr>
                <th>#</th>
                <th>اسم اللجنة</th>
                <th> الموضوع</th>
                <th>التاريخ</th>
                <th>القاعة</th>
                <th>الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($reunions as $reunion)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $reunion->organ->libelle }}</td>
                    <td>{{ $reunion->objet }}</td>
                    <td>{{ $reunion->date_reunion }}</td>
                    <td>{{ $reunion->salle }}</td>
                    <td>
                       <!-- Bouton Modifier -->
                       <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $reunion->id }}">
                       <i class="fas fa-edit "></i>  تعديل
                        </button>

                        <!-- Bouton Supprimer -->
                        <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $reunion->id }}">
                               <i class="fas fa-trash "></i>   حذف
                        </button>
                        <!-- Bouton Voir Détails -->
<button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#detailsModal{{ $reunion->id }}">
    <i class="fas fa-eye"></i> تفاصيل
</button>

                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Aucune réunion trouvée.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    
<!-- Pagination en dehors de la table -->
<div class="d-flex justify-content-center mt-3">
        {{ $reunions->links('pagination::bootstrap-5') }}
    </div>

    <!-- Modal pour ajouter une réunion -->
   @include('reunions.ajouterReunion')
    <!-- Modal pour modifier une réunion -->
   @include('reunions.modifierReunion')
    <!-- Modal pour supprimer une réunion -->
   @include('reunions.deleteReunion')
   @include('reunions.details')
</div>
@endsection
