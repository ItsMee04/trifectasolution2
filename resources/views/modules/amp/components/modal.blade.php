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
            <form id="formTambahPerjalanan" action="/perjalanan/storePerjalanan" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <div class="form-group local-forms mb-3">
                                    <label>Tanggal <span class="login-danger">*</span></label>
                                    <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <div class="form-group local-forms mb-3">
                                    <label> Material <span class="login-danger">*</span></label>
                                    <select class="form-control" id="selectMaterial" name="role_id">
                                        <option>Memuat data...</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <div class="form-group local-forms mb-3">
                                    <label>Kode <span class="login-danger">*</span></label>
                                    <input type="text" class="form-control" id="kode" name="kode"
                                        placeholder="Masukan Kode" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <div class="form-group local-forms mb-3">
                                    <label> No Polisi <span class="login-danger">*</span></label>
                                    <select class="form-control" id="selectKendaraan" name="kendaraan_id">
                                        <option>Memuat data...</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <div class="form-group local-forms mb-3">
                                    <label>Driver <span class="login-danger">*</span></label>
                                    <select class="form-control" id="selectDriver" name="driver_id">
                                        <option>Memuat data...</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <div class="form-group local-forms mb-3">
                                    <label> Suplier <span class="login-danger">*</span></label>
                                    <select class="form-control" id="selectSuplier" name="suplier_id">
                                        <option>Memuat data...</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <div class="form-group local-forms mb-3">
                                    <label>Volume <span class="login-danger">*</span></label>
                                    <input type="text" class="form-control" id="volume" name="volume"
                                        placeholder="Masukan Volume" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <div class="form-group local-forms mb-3">
                                    <label>Berat Total <span class="login-danger">*</span></label>
                                    <input type="text" class="form-control" id="berat_total" name="berat_total"
                                        placeholder="Masukan Berat Total" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <div class="form-group local-forms mb-3">
                                    <label>Berat Kendaraan <span class="login-danger">*</span></label>
                                    <input type="text" class="form-control" id="berat_kendaraan"
                                        name="berat_kendaraan" placeholder="Masukan Berat Kendaraan" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <div class="form-group local-forms mb-3">
                                    <label>Berat Muatan <span class="login-danger">*</span></label>
                                    <input type="text" class="form-control" id="berat_muatan" name="berat_muatan"
                                        placeholder="Masukan Berat Muatan" required>
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
            <form id="formEditPerjalanan" action="/perjalanan/updatePerjalanan" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <div class="form-group local-forms mb-3">
                                    <label>Tanggal <span class="login-danger">*</span></label>
                                    <input type="date" class="form-control" id="editTanggal" name="editTanggal"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <div class="form-group local-forms mb-3">
                                    <label> Material <span class="login-danger">*</span></label>
                                    <select class="form-control" id="editselectMaterial" name="editrole_id">
                                        <option>Memuat data...</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <div class="form-group local-forms mb-3">
                                    <label>Kode <span class="login-danger">*</span></label>
                                    <input type="text" class="form-control" id="editKode" name="editKode"
                                        placeholder="Masukan Kode" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <div class="form-group local-forms mb-3">
                                    <label> No Polisi <span class="login-danger">*</span></label>
                                    <select class="form-control" id="editselectKendaraan" name="editkendaraan_id">
                                        <option>Memuat data...</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <div class="form-group local-forms mb-3">
                                    <label>Driver <span class="login-danger">*</span></label>
                                    <select class="form-control" id="editselectDriver" name="editdriver_id">
                                        <option>Memuat data...</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <div class="form-group local-forms mb-3">
                                    <label> Suplier <span class="login-danger">*</span></label>
                                    <select class="form-control" id="editselectSuplier" name="editsuplier_id">
                                        <option>Memuat data...</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <div class="form-group local-forms mb-3">
                                    <label>Volume <span class="login-danger">*</span></label>
                                    <input type="text" class="form-control" id="editVolume" name="editVolume"
                                        placeholder="Masukan Volume" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <div class="form-group local-forms mb-3">
                                    <label>Berat Total <span class="login-danger">*</span></label>
                                    <input type="text" class="form-control" id="editBeratTotal" name="editBeratTotal"
                                        placeholder="Masukan Berat Total" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <div class="form-group local-forms mb-3">
                                    <label>Berat Kendaraan <span class="login-danger">*</span></label>
                                    <input type="text" class="form-control" id="editBeratKendaraan"
                                        name="editBeratKendaraan" placeholder="Masukan Berat Kendaraan" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <div class="form-group local-forms mb-3">
                                    <label>Berat Muatan <span class="login-danger">*</span></label>
                                    <input type="text" class="form-control" id="editBeratMuatan" name="editBeratMuatan"
                                        placeholder="Masukan Berat Muatan" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="btnUpdatePerjalanan" class="btn btn-primary">Simpan Perjalanan</button>
                </div>
            </form>
        </div>
    </div>
</div>
