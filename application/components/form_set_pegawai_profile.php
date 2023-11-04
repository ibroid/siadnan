<div class="shipping-info">
  <form class="row g-3 needs-validation custom-input" novalidate="">
    <div class="col-xxl-12 col-sm-6">
      <label for="selectSatker">Satker Anda</label>
      <select class="form-select" required id="selectSatker" aria-label=".form-select-sm example">
        <option selected disabled>Pilih Satu </option>
        <?php foreach (SatkerEntity::all() as $satker) { ?>
          <option value="<?= $satker->id ?>"><?= $satker->nama_satker ?> </option>
        <?php } ?>
      </select>
    </div>

    <div class="col-xxl-12 col-sm-6">
      <label for="inputNamaPegawai">Ketik dan Pilih Nama Pegawai</label>
      <div id="prefetch">
        <input id="inputNamaPegawai" class="typeahead form-control" type="text" placeholder="Ketik Nama Anda" required>
        <small class="text-danger">*Jika nama anda tidak muncul. Hubungi Admin PTA</small>
      </div>
    </div>
    <div class="col-12 text-end">
      <!-- <button class="btn btn-primary">Previous</button> -->
      <button type="button" disabled="true" id="btnSavePegawaiId" class="btn btn-primary">Save</button>
    </div>
  </form>
</div>

<script>
  window.onload = () => {
    selectSatker = $("#selectSatker")
    inputNamaPegawai = $("#prefetch .typeahead")

    inputNamaPegawai.attr('disabled', true)

    selectSatker.on('change', (e) => {
      if (selectSatker.val() == null) {
        inputNamaPegawai.attr('disabled', true)
      } else {
        inputNamaPegawai.attr('disabled', false)
      }

      initTypeahead(selectSatker.val())
    })

    function initTypeahead(id) {
      var pegawai = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace("value"),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
          url: `<?= base_url('pegawai/type_suggest') ?>?query=%QUERY&satker_id=${id}`,
          wildcard: "%QUERY",
        },
      });

      inputNamaPegawai.typeahead(null, {
        name: 'pegawai',
        source: pegawai,
        display: 'nama_lengkap'
      });
    }

    var bodySelectPegawai = new FormData()
    bodySelectPegawai.append('id', '<?= R_Input::gett('set_pegawai_profile') ?>')
    inputNamaPegawai.on("typeahead:select", (e, selection) => {
      bodySelectPegawai.append('pegawai_id', selection.id);
      if (selection.id != null) {
        $("#btnSavePegawaiId").attr('disabled', false)
      }
    })

    $("#btnSavePegawaiId").on('click', (e) => {
      $("#btnSavePegawaiId").attr('disabled', true)
      $("#btnSavePegawaiId").text('Mohon Tunggu')

      $.ajax({
        url: "<?= base_url('/settings/set_pegawai') ?>",
        method: "POST",
        data: bodySelectPegawai,
        processData: false,
        contentType: false,
        success(data) {
          console.log(data)
        },
        error() {
          alert(error.messsage)
        },
        complete() {
          $("#btnSavePegawaiId").attr('disabled', false)
          $("#btnSavePegawaiId").text('Save')
          location.href = "<?= base_url('/settings') ?>"
        }
      })
    })
  }
</script>