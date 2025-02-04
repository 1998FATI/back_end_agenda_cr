@foreach ($reunions as $reunion)
    <div class="modal fade" id="detailsModal{{ $reunion->id }}" tabindex="-1" aria-labelledby="detailsModalLabel{{ $reunion->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body p-4">
                    <!-- En-tête avec la date et bordure rouge -->
                    <div class="d-flex align-items-center mb-3" style="border-left: 5px solid #b71c1c; background-color: #f8f9fa;">
                        <div class="px-3 py-2 bg-danger text-white fw-bold" style="border-radius: 0 5px 5px 0;">
                            {{ \Carbon\Carbon::parse($reunion->date_reunion)->format('d/m/Y') }}
                    
                        </div>  
                           
                    </div> 
                    <!-- Sujet -->
                    <h5 class="fw-bold text-secondary">**{{ $reunion->objet }}** - {{$reunion->organ->libelle}}</h5>
                    <!-- Heure et salle -->
                    <p class="text-danger fw-bold fs-5">{{ \Carbon\Carbon::parse($reunion->heure)->format('H:i') }}</p>
                    <p class="fw-bold"> القاعة رقم {{ $reunion->salle }}</p>

                    <!-- Description -->
                    <p class="text-dark">
                        {{ $reunion->details }}
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                </div>
            </div>
        </div>
    </div>
@endforeach
