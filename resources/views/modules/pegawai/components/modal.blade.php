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
            <form id="formTambahPegawai" action="/pegawai/storePegawai" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-4">
                                <div class="form-group local-forms mb-3">
                                    <label>Nama <span class="login-danger">*</span></label>
                                    <input type="text" class="form-control" id="nama" name="nama"
                                        placeholder="Masukan Nama Pegawai" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-4">
                                <div class="form-group local-forms mb-3">
                                    <label>Kontak <span class="login-danger">*</span></label>
                                    <input type="text" class="form-control" id="kontak" name="kontak"
                                        placeholder="Masukan Kontak Pegawai" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-4">
                                <div class="form-group local-forms mb-3">
                                    <label>Alamat <span class="login-danger">*</span></label>
                                    <textarea name="alamat" class="form-control" id="alamat"  placeholder="Masukan Alamat Pegawai"
                                        required cols="4" rows="10"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-4">
                                <div class="form-group local-forms mb-3">
                                    <label>Image</label>
                                    <input type="file" class="form-control" aria-label="file example" id="image"
                                        name="image">
                                    <div class="invalid-feedback">File harus JPG/PNG</div>
                                </div>
                            </div>

                            <div id="previewContainer" class="mt-2" style="display: none;">
                                <label class="d-block mb-2">Preview:</label>
                                <img id="imgPreview" src="#" alt="Preview" class="img-thumbnail"
                                    style="max-height: 150px;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="btnSimpanPegawai" class="btn btn-primary">Simpan Pegawai</button>
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
            <form id="formEditPegawai" action="/pegawai/updatePegawai" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-4">
                                <div class="form-group local-forms mb-3">
                                    <label>Nama <span class="login-danger">*</span></label>
                                    <input type="text" class="form-control" id="namaPegawai" name="namaPegawai"
                                        placeholder="Masukan Nama Pegawai" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-4">
                                <div class="form-group local-forms mb-3">
                                    <label>Kontak <span class="login-danger">*</span></label>
                                    <input type="text" class="form-control" id="kontakPegawai" name="kontakPegawai"
                                        placeholder="Masukan Kontak Pegawai" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-4">
                                <div class="form-group local-forms mb-3">
                                    <label>Alamat <span class="login-danger">*</span></label>
                                    <textarea class="form-control" id="alamatPegawai" name="alamatPegawai" placeholder="Masukan Alamat Pegawai"
                                        required cols="4" rows="10"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-4">
                                <div class="form-group local-forms mb-3">
                                    <label>Image</label>
                                    <input type="file" class="form-control" aria-label="file example"
                                        id="imagePegawai" name="imagePegawai">
                                    <div class="invalid-feedback">File harus JPG/PNG</div>
                                </div>
                            </div>

                            <div id="previewContainerEdit" class="mt-2" style="display: none;">
                                <label class="d-block mb-2">Preview:</label>
                                <img id="imgPreviewPegawai" src="#" alt="Preview" class="img-thumbnail"
                                    style="max-height: 150px;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="btnUpdatePegawai" class="btn btn-primary">Simpan Pegawai</button>
                </div>
            </form>
        </div>
    </div>
</div>
