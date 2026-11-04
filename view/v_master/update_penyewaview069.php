<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1 class="m-0">Entri Data Penyewa</h1></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('?url=c_master/Penyewa_C069/index') ?>">Master Penyewa</a></li>
                        <li class="breadcrumb-item active">Update 069</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-users"></i> Form Entri Data Penyewa - <?= htmlspecialchars($penyewa['nik069'] ?? '', ENT_QUOTES, 'UTF-8') ?> / <?= htmlspecialchars($penyewa['nm_lngkp069'] ?? '', ENT_QUOTES, 'UTF-8') ?></h3>
                </div>
                <form action="<?= base_url('?url=c_master/Penyewa_C069/UpdatePenyewa') ?>" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <!-- BARIS 1 : Username | Password -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Username (User Pelanggan)</label>
                                    <input type="text" name="user_plg069" class="form-control" value="<?= htmlspecialchars($penyewa['user_plg069'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
                                    <input type="hidden" name="user_lama069" value="<?= htmlspecialchars($penyewa['user_plg069'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kata Sandi (Password)</label>
                                    <input type="text" name="sandi069" class="form-control" value="<?= htmlspecialchars($penyewa['sandi069'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
                                </div>
                            </div>
                        </div>
                        <!-- BARIS 2 : NIK | Nama | No HP -->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>NIK</label>
                                    <input type="text" name="nik069" class="form-control" value="<?= htmlspecialchars($penyewa['nik069'] ?? '', ENT_QUOTES, 'UTF-8') ?>" maxlength="16" minlength="16" pattern="[0-9]{16}" inputmode="numeric" placeholder="Masukkan NIK 16 digit" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nama Lengkap</label>
                                    <input type="text" name="nm_lngkp069" class="form-control" value="<?= htmlspecialchars($penyewa['nm_lngkp069'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>No. Handphone</label>
                                    <input type="tel" name="no_hp069" class="form-control" value="<?= htmlspecialchars($penyewa['no_hp069'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
                                </div>
                            </div>
                        </div>
                        <!-- BARIS 3 : Alamat -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Alamat Lengkap</label>
                                    <textarea name="almt_lngkp069" class="form-control" rows="3" required><?= htmlspecialchars($penyewa['almt_lngkp069'] ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>
                                </div>
                            </div>
                        </div>
                        <!-- BARIS 4 : Foto KTP | Foto SIM A -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Foto KTP</label><br>
                                    <?php if(!empty($penyewa['ft_ktp069'])): ?>
                                    <img src="<?= base_url('assets/foto_penyewa/' . rawurlencode($penyewa['ft_ktp069'])) ?>" width="120" style="border-radius:5px; margin-bottom:5px;"><br>
                                    <?php endif; ?>
                                    <input type="file" name="ft_ktp069" class="form-control" accept="image/*">
                                    <small>Kosongkan jika tidak mengganti foto KTP.</small>
                                    <input type="hidden" name="ft_ktp_asli069" value="<?= htmlspecialchars($penyewa['ft_ktp069'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Foto SIM A</label><br>
                                    <?php if(!empty($penyewa['ft_sim_a069'])): ?>
                                    <img src="<?= base_url('assets/foto_penyewa/' . rawurlencode($penyewa['ft_sim_a069'])) ?>" width="120" style="border-radius:5px; margin-bottom:5px;"><br>
                                    <?php endif; ?>
                                    <input type="file" name="ft_sim_a069" class="form-control" accept="image/*">
                                    <small>Kosongkan jika tidak mengganti foto SIM A.</small>
                                    <input type="hidden" name="ft_sim_a_asli069" value="<?= htmlspecialchars($penyewa['ft_sim_a_asli069'] ?? $penyewa['ft_sim_a069'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                        <a href="<?= base_url('?url=c_master/Penyewa_C069/index') ?>" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>