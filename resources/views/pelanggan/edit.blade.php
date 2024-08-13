<form action="/pelanggan/update" method="POST" id="frmPelangganEdit">
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                  <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-barcode" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7v-1a2 2 0 0 1 2 -2h2" /><path d="M4 17v1a2 2 0 0 0 2 2h2" /><path d="M16 4h2a2 2 0 0 1 2 2v1" /><path d="M16 20h2a2 2 0 0 0 2 -2v-1" /><path d="M5 11h1v2h-1z" /><path d="M10 11l0 2" /><path d="M14 11h1v2h-1z" /><path d="M19 11l0 2" /></svg>
                </span>
                <input type="text" id="kode_pelanggan" value="{{ $pelanggan->kode_pelanggan }}" readonly class="form-control" name="kode_pelanggan" placeholder="Kode Pelanggan">
              </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                  <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg>
                </span>
                <input type="text" id="nama_pelanggan" value="{{ $pelanggan->nama_pelanggan }}" class="form-control" name="nama_pelanggan" placeholder="Nama Pelanggan">
              </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                  <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-map-pin" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 11a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" /><path d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z" /></svg>
                </span>
                <input type="text" id="lokasi_pelanggan" value="{{ $pelanggan->lokasi_pelanggan }}" class="form-control" name="lokasi_pelanggan" placeholder="Lokasi Pelanggan">
              </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                  <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-radar" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M21 12h-8a1 1 0 1 0 -1 1v8a9 9 0 0 0 9 -9" /><path d="M16 9a5 5 0 1 0 -7 7" /><path d="M20.486 9a9 9 0 1 0 -11.482 11.495" /></svg>
                </span>
                <input type="text" id="radius_pelanggan" value="{{ $pelanggan->radius_pelanggan }}" class="form-control" name="radius_pelanggan" placeholder="Radius Pelanggan">
              </div>
        </div>
    </div>
   
    <div class="row mt-2">
        <div class="col-12">
            <div class="form-group">
                <button class="btn btn-primary w-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-send" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 14l11 -11" /><path d="M21 3l-6.5 18a.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a.55 .55 0 0 1 0 -1l18 -6.5" /></svg>
                    Simpan
                </button>
            </div>
        </div>
    </div>
</form>
<script>
    $(function() {
        $("#frmPelangganEdit").submit(function(){
            var kode_pelanggan = $("#frmPelangganEdit").find("#kode_pelanggan").val();
            var nama_pelanggan = $("#frmPelangganEdit").find("#nama_pelanggan").val();
            var lokasi_pelanggan = $("#frmPelangganEdit").find("#lokasi_pelanggan").val();
            var radius_pelanggan = $("#frmPelangganEdit").find("#radius_pelanggan").val();

            if(kode_pelanggan==""){
                // alert('NIK harus diisi');
                Swal.fire({
                title: 'Warning!',
                text: 'Kode Pelanggan harus diisi',
                icon: 'warning',
                confirmButtonText: 'OK'
                }).then((result)=>{
                    $("#kode_pelanggan").focus();

                });
                return false;
            }else if(nama_pelanggan==""){
                // alert('NIK harus diisi');
                Swal.fire({
                title: 'Warning!',
                text: 'Nama pelanggan harus diisi',
                icon: 'warning',
                confirmButtonText: 'OK'
                }).then((result)=>{
                    $("#nama_pelanggan").focus();

                });
                return false;
              }else if(lokasi_pelanggan==""){
                // alert('NIK harus diisi');
                Swal.fire({
                title: 'Warning!',
                text: 'Lokasi pelanggan harus diisi',
                icon: 'warning',
                confirmButtonText: 'OK'
                }).then((result)=>{
                    $("#lokasi_pelanggan").focus();

                });
                return false;
              }else if(radius_pelanggan==""){
                // alert('NIK harus diisi');
                Swal.fire({
                title: 'Warning!',
                text: 'Radius pelanggan harus diisi',
                icon: 'warning',
                confirmButtonText: 'OK'
                }).then((result)=>{
                    $("#radius_pelanggan").focus();

                });
                return false;
              }
        });
    });
</script>