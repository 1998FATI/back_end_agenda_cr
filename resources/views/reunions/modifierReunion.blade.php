@foreach ($reunions as $reunion)
    <div class="modal fade" id="editModal{{ $reunion->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $reunion->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                <h5 class="modal-title" id="editModalLabel{{ $reunion->id }}" style="color:blue;">تعديل الاجتماع</h5>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('reunions.update', $reunion->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="objet{{ $reunion->id }}" class="form-label">الموضوع</label>
                            <input type="text" id="objet{{ $reunion->id }}" name="objet" class="form-control" value="{{ $reunion->objet }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="details{{ $reunion->id }}" class="form-label">التفاصيل</label>
                            <textarea id="details{{ $reunion->id }}" name="details" class="form-control" rows="4" required>{{ $reunion->details }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="organ_id{{ $reunion->id }}" class="form-label">نوع الهيئة</label>
                            <select id="organ_id{{ $reunion->id }}" name="id_organs" class="form-select" required>
                                @foreach ($organs as $organ)
                                    <option value="{{ $organ->id }}" @if($organ->id == $reunion->id_organs) selected @endif>{{ $organ->libelle }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="date{{ $reunion->id }}" class="form-label">التاريخ</label>
                            <input type="date" id="date{{ $reunion->id }}" name="date_reunion" class="form-control" value="{{ $reunion->date_reunion }}" required>
                        </div>
                        <div class="mb-3">
                    <label for="heure{{ $reunion->id }}" class="form-label">الساعة</label>
                    <input type="time" name="heure" id="heure{{ $reunion->id }}" class="form-control" value="{{ $reunion->heure }}">
                    </div>
                        <div class="mb-3">
                            <label for="salle{{ $reunion->id }}" class="form-label">القاعة</label>
                            <input type="number" id="salle{{ $reunion->id }}" name="salle" class="form-control" value="{{ $reunion->salle }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">حفظ</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
