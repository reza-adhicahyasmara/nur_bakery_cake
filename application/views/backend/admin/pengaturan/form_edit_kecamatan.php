<input type="hidden" name="jenis" id="jenis" value="Edit">
<div class="form-group">
    <label for="ongkos_kecamatan">Ongkos (Rp.)</label>
    <input type="hidden" class="form-control" name="kode_kecamatan" id="kode_kecamatan" value="<?php echo $kode_kecamatan; ?>" placeholder="">
    <input type="text" class="form-control" name="ongkos_kecamatan" id="ongkos_kecamatan" value="<?php echo $ongkos_kecamatan; ?>"  onkeypress="return /[0-9]/i.test(event.key)" placeholder="Ongkos Kecamatan">
</div>