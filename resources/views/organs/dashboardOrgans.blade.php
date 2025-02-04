@extends('layouts.app')

@section('content')
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong> {{ session('success') }}</strong> 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show " role="alert">
        <strong>{{ session('error') }}</strong> 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif


<div class="container">
<form action="{{ route('organs.list') }}" method="GET" class="mb-3">
        <div class="row g-2">
            <!-- Recherche par Objet -->
            <div class="col-md-3">
                <input type="text" name="libelle" class="form-control" placeholder="كلمة المفتاح  " value="{{ request('libelle') }}">
            </div>
             <!-- Bouton de recherche -->
             <div class="col-md-3">
                <button type="submit" class="btn btn-warning">🔍</button>
                <a href="{{ route('organs.list') }}" class="btn btn-secondary">♻ </a>
            </div>
        </div>
    </form>

    <h3 class="mb-4 text-secondary">قائمة اللجان</h3>
    <form action="{{route('organs.form')}}" method="post">
     <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addOrganModal">
     <i class="fas fa-plus"></i>  إضافة لجنة جديدة 
    </button>
    </form>
    <br>
    <table class="table table-striped table-hover">
        <thead class="bg-primary text-white">
            <tr>
                <th>#</th>
                <th>اللجنة</th>
                <th>الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($organs as $organ)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $organ->libelle }}</td>
                    <td>
                        <!-- Icône Modifier -->
                        <button type="button" title="Modifier" class="btn btn-sm btn-outline-primary"data-bs-toggle="modal" data-bs-target="#editModal{{ $organ->id }}">
                        <i class="fas fa-edit "></i>تعديل
                        </button>

                        <!-- Icône Supprimer -->
                        <button type="button" title="Supprimer" class="btn btn-sm btn-outline-danger"data-bs-toggle="modal" data-bs-target="#deleteModal{{ $organ->id }}">
                        <i class="fas fa-trash "></i>حذف
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Aucune Organ trouvé.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    @include('organs.ajouterOrgans')
    @include('organs.updateOrgan')
    @include('organs.deleteOrgan')
</div>
@endsection


