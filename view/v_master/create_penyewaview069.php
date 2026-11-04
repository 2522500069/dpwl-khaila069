<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1 class="m-0">Entri Data Penyewa</h1></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('?url=c_master/Penyewa_C069/index') ?>">Master Penyewa</a></li>
                        <li class="breadcrumb-item active">Tambah 069</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-users"></i> Form Entri Data Penyewa</h3>
                </div>
                <form action="<?= base_url('?url=c_master/Penyewa_C069/simpan') ?>" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" name="user_plg069" class="form-control" placeholder="Masukkan username" required>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="text" name="sandi069" class="form-control" placeholder="Masukkan password" required>
                                </div>
                                <div class="form-group">
                                    <label>NIK</label>
                                    <input type="text" name="nik069" class="form-control" placeholder="Masukkan NIK 16 digit" maxlength="16" minlength="16" pattern="[0-9]{16}" inputmode="numeric" title="NIK harus terdiri dari 16 angka" required>
                                </div>
                                <div class="form-group">
                                    <label>Nama Lengkap</label>
                                    <input type="text" name="nm_lngkp069" class="form-control" placeholder="Masukkan nama lengkap" required>
                                </div>
                                <div class="form-group">
                                    <label>No. HP</label>
                                    <input type="tel" name="no_hp069" class="form-control" placeholder="Masukkan no HP" required>
                                </div>
                                <div class="form-group">
                                    <label>Foto KTP</label>
                                    <input type="file" name="ft_ktp069" class="form-control" accept="image/jpeg,image/png,image/jpg" required>
                                    <small class="text-muted">Format JPG / JPEG / PNG</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Alamat Lengkap</label>
                                    <textarea name="almt_lngkp069" class="form-control" rows="4" placeholder="Masukkan alamat lengkap" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Foto SIM A</label>
                                    <input type="file" name="ft_sim_a069" class="form-control" accept="image/jpeg,image/png,image/jpg" required>
                                    <small class="text-muted">Format JPG / JPEG / PNG</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                        <a href="<?= base_url('?url=c_master/Penyewa_C069/index') ?>" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>