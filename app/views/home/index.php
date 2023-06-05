<?php $post_url = ''; ?>

<div class="form-content">
	<div class="row">
		<div class="col-sm-12" id="msg-info">
			<?php
			Flasher::msgInfo();
			?>
		</div>

		<form action="<?= BASEURL; ?>/home/inputmultiple" method="post">
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
							<input type="text" name="nik" id="empName" value="" class="form-control" required="true" placeholder="Contoh: H102023">
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
							<div class="col-xs-11 mb-5 pertanyaan"><?= $angket['PERTANYAAN'] ?></div>
						</div>

						<div>
							<div class="col-xs-11 col-xs-offset-1">
								<label class="radio">
									<input class="input-radio" type="radio" data-no="<?= $angket['NO'] ?>" data-sort="1" name="angket_<?= $angket['NO'] ?>" id="radio<?= $angket["NO"] ?>1" value="a" required>(A) <?= $angket['P1'] ?>
									<?php if ($angket['P1_REASON'] == 1) : ?>
										<textarea style="margin-top: 3px; display: none;" id="alasan<?= $angket["NO"] ?>-1" type="text" class="form-control input-<?= $angket['NO'] ?>" name="alasan_angket_<?= $angket['NO'] ?>a" rows="3" cols="20"></textarea>
									<?php endif; ?>
								</label>
								<label class="radio">
									<input class="input-radio" type="radio" data-no="<?= $angket['NO'] ?>" data-sort="2" name="angket_<?= $angket['NO'] ?>" id="radio<?= $angket["NO"] ?>2" value="b" required>(B) <?= $angket['P2'] ?>
									<?php if ($angket['P2_REASON'] == 1) : ?>
										<textarea style="margin-top: 3px; display: none;" id="alasan<?= $angket["NO"] ?>-2" type="text" class="form-control input-<?= $angket['NO'] ?>" name="alasan_angket_<?= $angket['NO'] ?>b" rows="3" cols="20"></textarea>
									<?php endif; ?>
								</label>
								<?php if ($angket['P3']) : ?>
									<label class="radio">
										<input class="input-radio" type="radio" data-no="<?= $angket['NO'] ?>" data-sort="3" name="angket_<?= $angket['NO'] ?>" id="radio<?= $angket["NO"] ?>3" value="c" required>(C) <?= $angket['P3'] ?>
										<?php if ($angket['P3_REASON'] == 1) : ?>
											<textarea style="margin-top: 3px; display: none;" id="alasan<?= $angket["NO"] ?>-3" type="text" class="form-control input-<?= $angket['NO'] ?>" name="alasan_angket_<?= $angket['NO'] ?>c" rows="3" cols="20"></textarea>
										<?php endif; ?>
									</label>
								<?php endif; ?>
								<?php if ($angket['P4']) : ?>
									<label class="radio">
										<input class="input-radio" type="radio" data-no="<?= $angket['NO'] ?>" data-sort="4" name="angket_<?= $angket['NO'] ?>" id="radio<?= $angket["NO"] ?>3" value="d" required>(D) <?= $angket['P4'] ?>
										<?php if ($angket['P4_REASON'] == 1) : ?>
											<textarea style="margin-top: 3px; display: none;" id="alasan<?= $angket["NO"] ?>-4" type="text" class="form-control input-<?= $angket['NO'] ?>" name="alasan_angket_<?= $angket['NO'] ?>d" rows="3" cols="20"></textarea>
										<?php endif; ?>
									</label>
								<?php endif; ?>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</section>

			<div class="col-xs-12">
				<button type="submit" class="col-xs-12 btn btn-primary">Save</button>
			</div>
	</div>
	</form>

</div>
</div>
</div>

<script>
	document.getElementById("empId").focus();
</script>