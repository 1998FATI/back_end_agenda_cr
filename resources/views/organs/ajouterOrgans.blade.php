<div class="modal fade" id="addOrganModal" tabindex="-1" aria-labelledby="addOrganModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                
                <h5 class="modal-title" id="addOrganModalLabel" style="color:green;">إضافة هيئة</h5>
            </div>
            <div class="modal-body">
                <form id="addOrganForm" method="POST" action="{{ route('organs.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="libelle" class="form-label">التسمية</label>
                        <input type="text" id="libelle" name="libelle" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-warning">إضافة</button>
                </form>
            </div>
        </div>
    </div>
</div>