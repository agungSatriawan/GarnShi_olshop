<div>
    <div class="row">
        <div class="col-sm-12 text-center">
            <h2>Data Registrasi Pasien</h2>
        </div>
    </div>
    <div class="row mb-3 mt-3 justify-content-end">
        <div class="col-sm-3">
            <label for="">Mulai</label>
            <input type="date" class="form-control mulai rentang">
        </div>
        <div class="col-sm-3">
            <label for="">Sampai</label>
            <input type="date" class="form-control sampai rentang">
        </div>
    </div>
    <div class="row">

        <div class="col">
            <table class="table table-bordered tabledata tableUser">
                <thead>
                    <tr>
                        <th class="text-center align-middle">No</th>
                        <th class="text-center align-middle">Nama</th>
                        <th class="text-center align-middle">Email</th>
                        <th class="text-center align-middle">WhatsApp</th>
                        <th class="text-center align-middle">Status</th>
                    </tr>
                </thead>
                <tbody class="dataUserRegistered">
                    <?php $i = 1; ?>
                    <?php foreach ($detail_user as $du) : ?>
                        <tr>
                            <td class="text-center"><?= $i ?></td>
                            <td><?= $du['nama'] ?></td>
                            <td><?= $du['email'] ?></td>
                            <td><?= $du['whatsapp'] ?></td>
                            <td class="text-center <?= $du['active'] == 1 ? "text-success" : "text-danger" ?>">
                                <?= $du['active'] == 1 ? 'Aktif' : 'Tidak Aktif' ?>
                            </td>
                        </tr>
                        <?php $i++ ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>









</div>
</section>