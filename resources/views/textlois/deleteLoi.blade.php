
@foreach ($textLois as $texte)
    <div class="modal fade" id="deleteModal{{ $texte->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $texte->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                    <h5 class="modal-title" id="deleteModalLabel{{ $texte->id }}" style="color:red;">تأكيد الحذف</h5>
                </div>
                <div class="modal-body">
                    هل أنت متأكد من أنك تريد حذف هذا العضو؟
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <form action="{{ route('lois.destroy', $texte->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">تأكيد</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
