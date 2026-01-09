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
            <form id="formTambahKendaraan" action="/kendaraan/storeKendaraan" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-4">
                                <div class="form-group local-forms mb-3">
                                    <label>Kode Kendaraan <span class="login-danger">*</span></label>
                                    <input type="text" class="form-control" id="kode" name="kode"
                                        placeholder="Masukan Kode Kendaraan" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-4">
                                <div class="form-group local-forms mb-3">
                                    <label>Nama Kendaraan<span class="login-danger">*</span></label>
                                    <input type="text" class="form-control" id="nama" name="nama"
                                        placeholder="Masukan Nama Kendaraan" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-4">
                                <div class="form-group local-forms mb-3">
                                    <label>Jenis Kendaraan <span class="login-danger">*</span></label>
                                    <input type="text" class="form-control" id="jenis" name="jenis"
                                        placeholder="Masukan Jenis Kendaraan" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-4">
                                <div class="form-group local-forms mb-3">
                                    <label>Nomor Kendaraan <span class="login-danger">*</span></label>
                                    <input type="text" class="form-control" id="nomor" name="nomor"
                                        placeholder="Masukan Nomor Kendaraan" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="btnSimpanKendaraan" class="btn btn-primary">Simpan Kendaraan</button>
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
            <form id="formEditKendaraan" action="/kendaraan/updateKendaraan" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-4">
                                <div class="form-group local-forms mb-3">
                                    <label>Kode Kendaraan <span class="login-danger">*</span></label>
                                    <input type="text" class="form-control" id="editkode" name="editkode"
                                        placeholder="Masukan Kode Kendaraan" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-4">
                                <div class="form-group local-forms mb-3">
                                    <label>Nama Kendaraan<span class="login-danger">*</span></label>
                                    <input type="text" class="form-control" id="editnama" name="editnama"
                                        placeholder="Masukan Nama Kendaraan" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-4">
                                <div class="form-group local-forms mb-3">
                                    <label>Jenis Kendaraan <span class="login-danger">*</span></label>
                                    <input type="text" class="form-control" id="editjenis" name="editjenis"
                                        placeholder="Masukan Jenis Kendaraan" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-4">
                                <div class="form-group local-forms mb-3">
                                    <label>Nomor Kendaraan <span class="login-danger">*</span></label>
                                    <input type="text" class="form-control" id="editnomor" name="editnomor"
                                        placeholder="Masukan Nomor Kendaraan" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="btnUpdateKendaraan" class="btn btn-primary">Simpan Kendaraan</button>
                </div>
            </form>
        </div>
    </div>
</div>
