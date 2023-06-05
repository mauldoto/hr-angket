<?php $post_url = ''; ?>

<div class="form-content">
    <div class="row">
        <div class="col-sm-12" id="msg-info">
            <?php
            Flasher::msgInfo();
            ?>
        </div>

        <form action="<?= BASEURL; ?>/asset/create" method="post">
            <section class="title-section">
                <div class="col-xs-12 col-sm-12 text-center mb-10">
                    <h3><strong>ANGKET KARYAWAN</strong></h3>
                    <strong>Silakan isi NIK, kemudian isilah angket berikut</strong>
                </div>
            </section>

            <section class="data-karyawan">
                <div class="col-xs-12 col-sm-12">
                    <h5><strong>DATA KARYAWAN</strong></h5>
                    <hr />
                    <div>
                        <label for="form-field-mask-1">
                            NIK
                        </label>

                        <div class="form-group">
                            <input type="text" name="empName" id="empName" value="" class="form-control" required="true" placeholder="Contoh: H102023">
                        </div>
                    </div>
                </div>
            </section>

            <section class="isi-angket">
                <div class="col-xs-12 col-sm-12">
                    <h5><strong>ISI ANGKET</strong></h5>
                    <hr />
                </div>
            </section>

            <section>
                <?php foreach ($data['angket'] as $angket) : ?>
                    <div class="col-xs-12 col-sm-12 mb-10">
                        <div>
                            <div class="col-xs-1 angket"><?= $angket['NO'] ?>.</div>
                            <div class="col-xs-11 mb-5"><?= $angket['PERTANYAAN'] ?></div>
                        </div>

                        <div>
                            <div class="col-xs-1 angket"></div>
                            <div class="col-xs-10">
                                <label class="radio">
                                    <input type="radio" name="angket_<?= $angket['NO'] ?>" id="inlineRadio1" value="<?= $angket['P1'] ?>"> <?= $angket['P1'] ?>
                                </label>
                                <label class="radio">
                                    <input type="radio" name="angket_<?= $angket['NO'] ?>" id="inlineRadio2" value="<?= $angket['P2'] ?>"> <?= $angket['P2'] ?>
                                </label>
                                <label class="radio">
                                    <input type="radio" name="angket_<?= $angket['NO'] ?>" id="inlineRadio3" value="<?= $angket['P3'] ?>"> <?= $angket['P3'] ?>
                                </label>
                                <label class="radio">
                                    <input type="radio" name="angket_<?= $angket['NO'] ?>" id="inlineRadio3" value="<?= $angket['P4'] ?>"> <?= $angket['P4'] ?>
                                </label>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </section>

            <div>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
    </div>
    </form>

</div>
</div>
</div>

<script>
    document.getElementById("empId").focus();
</script>