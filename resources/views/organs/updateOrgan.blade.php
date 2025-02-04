@foreach ($organs as $organ)
    <div class="modal fade" id="editModal{{ $organ->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $organ->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                <h5 class="modal-title" id="editModalLabel{{ $organ->id }}" style="color:blue;">تعديل الهيئة</h5>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('organs.update', $organ->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3"> 
                            <label for="libelle{{ $organ->id }}" class="form-label"> <strong>التسمية</strong></label>
                            <input type="text" id="libelle{{ $organ->id }}" name="libelle" class="form-control" value="{{ $organ->libelle }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">حفظ</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
