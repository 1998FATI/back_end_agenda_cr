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
        <strong>{{ session('error') }}</strong> 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="container">
<form action="{{ route('lois.list') }}" method="GET" class="mb-3">
        <div class="row g-2">
            <!-- Recherche par Objet -->
            <div class="col-md-3">
                <input type="text" name="titre" class="form-control" placeholder="كلمة المفتاح  " value="{{ request('titre') }}">
            </div>
             <!-- Bouton de recherche -->
             <div class="col-md-3">
                <button type="submit" class="btn btn-warning">🔍</button>
                <a href="{{ route('lois.list') }}" class="btn btn-secondary">♻ </a>
            </div>
        </div>
    </form>

<h3 class="mb-4 text-secondary">قائمة النصوص القانونية</h3>
    <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addLoiModal">
    <i class="fas fa-plus"></i>    إضافة نص قانوني جديد
    </button>   
    <br>
    <table class="table table-striped table-hover">
        <thead class="bg-primary text-white">
            <tr>
                <th>#</th>
                <th>العنوان </th>
                <th>الملف </th>
                <th>الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($textLois as $texte)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $texte->titre }}</td>
                    <td><a href="{{ asset('storage/' . $texte->pdf) }}" target="_blank">تحميل الملف</a>
                    </td>
                    
                    <td>
                       <!-- Bouton Modifier -->
                       <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $texte->id }}">
                       <i class="fas fa-edit "></i>  تعديل
                        </button>

                        <!-- Bouton Supprimer -->
                        <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $texte->id }}">
                               <i class="fas fa-trash "></i>   حذف
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">القائمة فارغة.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

 <!-- Modal pour ajouter une réunion -->
 @include('textlois.addLoi')
    <!-- Modal pour modifier une réunion -->
   @include('textlois.updateLoi')
    <!-- Modal pour supprimer une réunion -->
   @include('textlois.deleteLoi')
    </div>
@endsection