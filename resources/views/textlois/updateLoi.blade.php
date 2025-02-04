@foreach ($textLois as $texte)
    <div class="modal fade" id="editModal{{ $texte->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $texte->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">           
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <h5 class="modal-title" id="editModalLabel{{ $texte->id }}" style="color:blue;">تعديل</h5>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('lois.update', $texte->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3"> 
                            <label for="titre{{ $texte->id }}" class="form-label">العنوان</label>
                            <input type="text" id="titre{{ $texte->id }}" name="titre" class="form-control" value="{{ $texte->titre }}" required>
                        </div>

                        <div class="mb-3"> 
                            <label for="pdf{{ $texte->id }}" class="form-label">الملف</label>
                            <input type="file" id="pdf{{ $texte->id }}" name="pdf" class="form-control">
                            
                            @if ($texte->pdf)
                                <p>
                                    <a href="{{ asset('storage/' . $texte->pdf) }}" target="_blank">عرض الملف الحالي</a>
                                </p>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary">حفظ</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
