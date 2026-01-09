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
            <form id="formEditUsers" action="/users/updateUsers" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-4">
                                <div class="form-group local-forms mb-3">
                                    <label>Pegawai <span class="login-danger">*</span></label>
                                    <input type="text" class="form-control" id="namaPegawai" name="namaPegawai"
                                        readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-4">
                                <div class="form-group local-forms mb-3">
                                    <label>Email <span class="login-danger">*</span></label>
                                    <input type="email" class="form-control" id="emailPegawai" name="emailPegawai"
                                        placeholder="Masukan Email Pegawai" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-4">
                                <div class="form-group local-forms mb-3">
                                    <label>Password <span class="login-danger">*</span></label>
                                    <input type="password" class="form-control" id="passwordPegawai"
                                        name="passwordPegawai" placeholder="Masukan Password Pegawai" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-4">
                                <div class="form-group local-forms mb-3">
                                    <label>Role <span class="login-danger">*</span></label>
                                    <select class="form-control" id="selectRole" name="role_id">
                                        <option>Memuat data...</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="btnUpdateUsers" class="btn btn-primary">Simpan Users</button>
                </div>
            </form>
        </div>
    </div>
</div>
