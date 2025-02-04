<div class="modal fade" id="addReunionModal" tabindex="-1" aria-labelledby="addReunionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                <h5 class="modal-title" id="addReunionModalLabel" style="color:green;">إضافة اجتماع</h5>
            </div>
            <div class="modal-body">
                <form id="addReunionForm" method="POST" action="{{ route('reunions.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="objet" class="form-label">الموضوع</label>
                        <input type="text" id="objet" name="objet" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="details" class="form-label">التفاصيل</label>
                        <textarea id="details" name="details" class="form-control" rows="4" required></textarea>                    </div>
                    <div class="mb-3">
                        <label for="organ_id" class="form-label">نوع الهيئة</label>
                        <select id="organ_id" name="id_organs" class="form-select" required>
                            @foreach ($organs as $organ)
                                <option value="{{ $organ->id }}">{{ $organ->libelle }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">التاريخ</label>
                        <input type="date" id="date" name="date_reunion" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                    <label for="heure" class="form-label">الساعة</label>
                    <input type="time" name="heure" id="heure" class="form-control" value="{{ old('heure', $reunion->heure ?? '') }}">
                    </div>

                    <div class="mb-3">
                        <label for="salle" class="form-label">القاعة</label>
                        <input type="number" id="salle" name="salle" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-success">إضافة</button>
                </form>
            </div>
        </div>
    </div>
</div>
