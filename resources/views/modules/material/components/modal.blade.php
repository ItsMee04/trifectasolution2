<div class="modal fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalTambahLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <b>
                    <h5 class="modal-title text-primary" id="modalTambahLabel"></h5>
                </b>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formTambahMaterial" action="/material/storeMaterial" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-4">
                                <div class="form-group local-forms mb-3">
                                    <label>Kode Material <span class="login-danger">*</span></label>
                                    <input type="text" class="form-control" id="kode" name="kode"
                                        placeholder="Masukan Kode Material" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-4">
                                <div class="form-group local-forms mb-3">
                                    <label>Nama <span class="login-danger">*</span></label>
                                    <input type="text" class="form-control" id="nama" name="nama"
                                        placeholder="Masukan Nama Material" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-4">
                                <div class="form-group local-forms mb-3">
                                    <label>Satuan <span class="login-danger">*</span></label>
                                    <input type="text" class="form-control" id="satuan" name="satuan"
                                        placeholder="Masukan Satuan Material" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-4">
                                <div class="form-group local-forms mb-3">
                                    <label>Rumus <span class="login-danger">*</span></label>
                                    <textarea name="rumus" class="form-control" id="rumus"  placeholder="Masukan Rumus Material"
                                        required cols="4" rows="10"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="btnSimpanMaterial" class="btn btn-primary">Simpan Material</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <b>
                    <h5 class="modal-title text-primary" id="modalEditLabel"></h5>
                </b>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formEditMaterial" action="/material/updateMaterial" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-4">
                                <div class="form-group local-forms mb-3">
                                    <label>Kode Material <span class="login-danger">*</span></label>
                                    <input type="text" class="form-control" id="editkode" name="editkode"
                                        placeholder="Masukan Kode Material" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-4">
                                <div class="form-group local-forms mb-3">
                                    <label>Nama <span class="login-danger">*</span></label>
                                    <input type="text" class="form-control" id="editnama" name="editnama"
                                        placeholder="Masukan Nama Material" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-4">
                                <div class="form-group local-forms mb-3">
                                    <label>Satuan <span class="login-danger">*</span></label>
                                    <input type="text" class="form-control" id="editsatuan" name="editsatuan"
                                        placeholder="Masukan Satuan Material" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-4">
                                <div class="form-group local-forms mb-3">
                                    <label>Rumus <span class="login-danger">*</span></label>
                                    <textarea name="editrumus" class="form-control" id="editrumus"  placeholder="Masukan Rumus Material"
                                        required cols="4" rows="10"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="btnUpdateMaterial" class="btn btn-primary">Simpan Material</button>
                </div>
            </form>
        </div>
    </div>
</div>
