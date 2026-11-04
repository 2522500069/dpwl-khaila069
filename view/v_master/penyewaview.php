<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1 class="m-0">Data Penyewa 069</h1></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                        <li class="breadcrumb-item active">Penyewa 069</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <a href="<?= base_url('?url=c_master/Penyewa_C069/tambah') ?>" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah Penyewa</a>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>NIK</th>
                                <th>Nama Lengkap</th>
                                <th>No HP</th>
                                <th>Alamat</th>
                                <th>Foto KTP</th>
                                <th>Foto SIM A</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($penyewa)) { foreach($penyewa as $row){ ?>
                            <tr>
                                <td><?= $row['user_plg069'] ?></td>
                                <td><?= $row['nik069'] ?></td>
                                <td><?= $row['nm_lngkp069'] ?></td>
                                <td><?= $row['no_hp069'] ?></td>
                                <td><?= $row['almt_lngkp069'] ?></td>
                                <td>
                                    <?php if(!empty($row['ft_ktp'])){ ?>
                                    <img src="<?= base_url('assets/foto_penyewa/'.$row['ft_ktp']) ?>" width="80" style="border-radius:5px">
                                    <?php } else { echo '<span class="text-danger">No Foto</span>'; } ?>
                                </td>
                                <td>
                                    <?php if(!empty($row['ft_sim_a'])){ ?>
                                    <img src="<?= base_url('assets/foto_penyewa/'.$row['ft_sim_a']) ?>" width="80" style="border-radius:5px">
                                    <?php } else { echo '<span class="text-danger">No Foto</span>'; } ?>
                                </td>
                                <td>
                                    <a href="<?= base_url('?url=c_master/Penyewa_C069/edit/'.$row['user_plg069']) ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="<?= base_url('?url=c_master/Penyewa_C069/hapus/'.$row['user_plg069']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus?')">Hapus</a>
                                </td>
                            </tr>
                            <?php } } else { ?>
                            <tr><td colspan="8" class="text-center">Data kosong</td></tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>