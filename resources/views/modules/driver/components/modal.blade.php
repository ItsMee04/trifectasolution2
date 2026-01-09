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
            <form id="formTambahDriver" action="/driver/storeDriver" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-4">
                                <div class="form-group local-forms mb-3">
                                    <label>Kode Driver <span class="login-danger">*</span></label>
                                    <input type="text" class="form-control" id="kode" name="kode"
                                        placeholder="Masukan Kode Driver" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-4">
                                <div class="form-group local-forms mb-3">
                                    <label>Nama <span class="login-danger">*</span></label>
                                    <input type="text" class="form-control" id="nama" name="nama"
                                        placeholder="Masukan Nama Driver" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-4">
                                <div class="form-group local-forms mb-3">
                                    <label>Kontak <span class="login-danger">*</span></label>
                                    <input type="text" class="form-control" id="kontak" name="kontak"
                                        placeholder="Masukan Kontak Driver" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-4">
                                <div class="form-group local-forms mb-3">
                                    <label>Alamat <span class="login-danger">*</span></label>
                                    <textarea name="alamat" class="form-control" id="alamat"  placeholder="Masukan Alamat Driver"
                                        required cols="4" rows="10"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="btnSimpanDriver" class="btn btn-primary">Simpan Driver</button>
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
            <form id="formEditDriver" action="/driver/updateDriver" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-4">
                                <div class="form-group local-forms mb-3">
                                    <label>Kode Driver <span class="login-danger">*</span></label>
                                    <input type="text" class="form-control" id="editkode" name="editkode"
                                        placeholder="Masukan Kode Driver" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-4">
                                <div class="form-group local-forms mb-3">
                                    <label>Nama <span class="login-danger">*</span></label>
                                    <input type="text" class="form-control" id="editnama" name="editnama"
                                        placeholder="Masukan Nama Driver" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-4">
                                <div class="form-group local-forms mb-3">
                                    <label>Kontak <span class="login-danger">*</span></label>
                                    <input type="text" class="form-control" id="editkontak" name="editkontak"
                                        placeholder="Masukan Kontak Driver" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-4">
                                <div class="form-group local-forms mb-3">
                                    <label>Alamat <span class="login-danger">*</span></label>
                                    <textarea name="editalamat" class="form-control" id="editalamat"  placeholder="Masukan Alamat Driver"
                                        required cols="4" rows="10"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="btnUpdateDriver" class="btn btn-primary">Simpan Driver</button>
                </div>
            </form>
        </div>
    </div>
</div>
