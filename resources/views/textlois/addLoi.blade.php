<div class="modal fade" id="addLoiModal" tabindex="-1" aria-labelledby="addLoiModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <h5 class="modal-title" id="addLoiModalLabel" style="color:green;">إضافة نص قانوني </h5>
                </div>
                <div class="modal-body">
                    <form id="addLoiForm" method="POST" action="{{ route('lois.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="titre" class="form-label">العنوان</label>
                            <input type="text" id="titre" name="titre" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="pdf" class="form-label">الملف</label>
                            <input type="file" id="pdf" name="pdf" accept=".pdf" class="form-control" required>

                        </div>
                        <button type="submit" class="btn btn-warning">إضافة</button>
                    </form>
                </div>
            </div>
        </div>
    </div>