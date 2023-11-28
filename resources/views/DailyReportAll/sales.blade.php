@extends('layouts.layout')
@section('content')
@include('sweetalert::alert')


<div class="d-sm-flex align-items-center justify-content-between mb-4">
 <h1 class="h3 mb-0 text-gray-800">Diplomat Mild Customer Data Form</h1>
 </div>

<hr>
<div class="jumbotron">
<div class="d-sm-flex align-items-center justify-content-between mb-4">
<div class="card-body">
        <form method="POST" action="{{ route('sales.store') }}">
        @csrf

        <div class="form-group">
                <label class="font-weight-bold" for="area">1. Area</label>
                <select class="form-control"  id="area" name="area" required>
                    <option value="">Please select</option>
                    <option value="Semarang01">Semarang01</option>
                    <option value="Semarang02" >Semarang02</option>
                    <option value="Solo">Solo</option>
                </select>
              
            </div>

            <div class="form-group">
                <label class="font-weight-bold" for="rayon">2. Rayon</label>
                <select class="form-control" id="rayon" name="rayon"  required>
                    <option value="">Please select</option>
                    <option value="Semarang01" >Solo</option>
                    <option value="Semarang02" >Semarang</option>
                    <option value="Solo">Purwodadi</option>
                </select>
            </div> 

            <div class="form-group">
                <label class="font-weight-bold" for="kab">3. Kabupaten / Kecamatan</label>
                <input type="text" name="kab" id="kab" class="form-control" value="{{ old('kab') }}" required>
               
            </div>            
            <div class="form-group">
                <label class="font-weight-bold" for="venue">4. Venue</label>
                <select class="form-control" id="venue" name="venue">
                    <option value="">Silahkan Pilih</option>
                    <option value="C&B" >C&B</option>
                    <option value="KANTOR" @if(old('venue') == 'KANTOR') selected @endif>KANTOR</option>
                    <option value="PA" @if(old('venue') == 'PA') selected @endif>PA</option>
                    <option value="PT" @if(old('venue') == 'PT') selected @endif>PT</option>
                    <option value="R&C" @if(old('venue') == 'R&C') selected @endif>R&C</option>
                    <option value="SC" @if(old('venue') == 'SC') selected @endif>SC</option>
                    <option value="PUSAT PEMBELANJAAN" @if(old('venue') == 'PUSAT PEMBELANJAAN') selected @endif>PUSAT PEMBELANJAAN</option>
                    <option value="WARTEN" @if(old('venue') == 'WARTEN') selected @endif>WARTEN</option>
                </select>
            </div>

            <div class="form-group">
                <label class="font-weight-bold" for="exampleFormControlInput1">5. Nama</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Silahkan diisi">
          
            </div>

            

            <div class="form-group">
                <label class="font-weight-bold" for="exampleFormControlInput1">6. No Telp/Email/IG/FB</label>
                <input type="text" name="telp" id="telp" class="form-control" placeholder="Silahkan diisi">
            </div>

            <div class="form-group">
                <label class="font-weight-bold" for="jenis_kelamin">7. Jenis Kelamin</label>
                <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                    <option value="">Silahkan Pilih</option>
                    <option value="L">L</option>
                    <option value="P">P</option>
                </select>
                @error('jenis_kelamin')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            
            <div class="form-group">
                <label class="font-weight-bold" for="exampleFormControlInput1">8. Umur</label>
                <select class="form-control @error('umur') is-invalid @enderror" id="umur" name="umur">
                    <option value="">Please select</option>
                    <option value="18-25thn">18-25thn</option>
                    <option value="26-30thn">26-30thn</option>
                    <option value="31-40thn">31-40thn</option>
                    <option value="41-50thn">41-50thn</option>
                    <option value=">50">>50</option>
                </select>
                @error('umur')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="font-weight-bold" for="exampleFormControlSelect1">9. Pekerjaan</label><br>
                <select class="form-control @error('pekerjaan') is-invalid @enderror" id="pekerjaan" name="pekerjaan">
                    <option value="">Silahkan Pilih</option>
                    <option value="Karyawan">Karyawan</option>
                    <option value="Mahasiswa">Mahasiswa</option>
                    <option value="PNS">PNS</option>
                    <option value="Wiraswasta">Wiraswasta</option>
                    <option value="Others">Others</option>
                </select>
                @error('pekerjaan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror 
            </div>

            <div class="form-group">
                <label class="font-weight-bold" for="merk_rokok">10. Rokok yang dikonsumsi selama ini</label>
                <div id="rokok-container">
                    <select class="form-control @error('rokok') is-invalid @enderror" id="rokok" name="rokok">              
                        <option value="">Please select</option>
                        <option value="Diplomat Mild">Diplomat Mild</option>
                        <option value="Diplomat Mild Menthol">Diplomat Mild Menthol</option>
                        <option value="Pro Mild">Pro Mild</option>
                        <option value="Class Mild">Class Mild</option>
                        <option value="A Mild">A Mild</option>
                        <option value="other">other</option>
                    </select>
                    @error('rokok')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror 
                    <input type="text" class="form-control @error('rokok-input') is-invalid @enderror" id="rokok-input" name="rokok-input" style="display: none;">
                    @error('rokok-input')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror 
                </div>
            </div>


            <div class="form-group">
                <label class="font-weight-bold" for="jml_beli">11. Jumlah Beli Rokok Pack</label>
                <select class="form-control @error('jmlbeli') is-invalid @enderror" id="jml_beli" name="jml_beli">       
                    <option value="">Please select</option>
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                </select>
                @error('jmlbeli')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror 
            </div>

            <div class="form-group">
                <label class="font-weight-bold" for="pernahrasa">12. Apakah ingin membeli Diplomat Mild ?</label>
                <select class="form-control" id="pernahrasa" name="pernahrasa">       
                    <option value="">Please select</option>
                    <option value="1">Ya</option>
                    <option value="0">Tidak</option>
                </select>
            </div>

            <label class="font-weight-bold">13. Wismilak Diplomat</label>

            <div class="form-group ml-5">
                <label class="font-weight-bold" for="rasadip">Rasa</label>
                <select class="form-control @error('rasadip') is-invalid @enderror" id="rasadip" name="rasadip">       
                    <option value="">Please select</option>
                    <option value="0">Biasa</option>
                    <option value="1">Enak</option>
                    <option value="0">Tidak Enak</option>
                </select>
                @error('rasadip')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror 
            </div>

            <div class="form-group ml-5">
                <label for="hargadip">Harga</label>
                <select class="form-control bg-light @error('hargadip') is-invalid @enderror" id="hargadip" name="hargadip">           
                    <option value="">Please select</option>
                    <option value="1">Terjangkau</option>
                    <option value="0">Mahal</option>
                </select>
                @error('hargadip')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror 
            </div>


            <div class="form-group">
                <label class="font-weight-bold" for="akanbeli">14. Apakah akan membeli Wismilak Diploma Lagi</label>
                <select class="form-control @error('akanbeli') is-invalid @enderror" id="akanbeli" name="akanbeli">       
                    <option value="" selected>Please select</option>
                    <option value="1">Ya</option>
                    <option value="0">Tidak</option>
                </select>
                @error('akanbeli')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror 
            </div>

            <div class="form-group">
                <label class="font-weight-bold" for="alasan">15. Alasan</label>
                <select class="form-control @error('alasan') is-invalid @enderror" id="alasan" name="alasan">       
                    <option value="" >Please select</option>
                    <option value="Rasa Enak">Rasa Enak</option>
                    <option value="Rasa Tidak Enak">Rasa Tidak Enak</option>
                    <option value="Harga Terjangkau">Harga Terjangkau</option>
                    <option value="Harga Mahal">Harga Mahal</option>
                    <option value="Kemasan Menarik">Kemasan Menarik</option>
                    <option value="Kemasan Tidak Menarik">Kemasan Tidak Menarik</option>
                </select>
                @error('alasan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror 
            </div>

            <div class="form-group">
                <label class="font-weight-bold" for="tempatbeli">16. Tempat biasa membeli rokok</label>
                <input type="text" class="form-control @error('tempatbeli') is-invalid @enderror" id="tempatbeli" placeholder="Tempat" name="tempatbeli">       
                @error('tempatbeli')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror 
            </div>
        <div class="modal-footer">

            <input type="submit" class="btn btn-danger btn-send" value="Simpan">
        </div>
    </form>

</div>
</div>
</div>



 

 
 <script>
  const rokokContainer = document.getElementById("rokok-container");
const rokokSelect = document.getElementById("rokok");
const rokokInput = document.getElementById("rokok-input");

rokokSelect.addEventListener("change", function() {
    if (rokokSelect.value === "other") {
        rokokSelect.style.display = "none";
        rokokInput.style.display = "block";
        rokokInput.value = "";
        rokokInput.setAttribute("name", "rokok"); // set the name attribute dynamically
    } else {
        rokokInput.style.display = "none";
        rokokSelect.style.display = "block";
        rokokInput.removeAttribute("name"); // remove the name attribute when hidden
    }
});


</script>

<script>
    const select = document.getElementById("contact-method");
const input = document.getElementById("contact-value");

select.addEventListener("change", function() {
  const selectedValue = select.value;
  if (selectedValue === "IG") {
    input.setAttribute("id", "IG");
  } else if (selectedValue === "email") {
    input.setAttribute("id", "email");
  } else {
    input.removeAttribute("id");
  }
});

</script>

<div class="form-group">
  <label class="font-weight-bold" for="pernahrasa">12. Apakah sudah pernah merasakan Diplomat Mild</label>
  <select class="form-control" id="pernahrasa" name="pernahrasa" onchange="showDiplomatMild(this.value)">
    <option value="">Please select</option>
    <option value="1">Ya</option>
    <option value="0">Tidak</option>
  </select>
</div>

<script>
function showDiplomatMild(selectedValue) {
  var selectElement = document.getElementById("pernahrasa");
  var diplomatMildOption = document.createElement("option");
  diplomatMildOption.value = "diplomat-mild";
  diplomatMildOption.text = "Diplomat Mild";

  var diplomatMildMentholOption = document.createElement("option");
  diplomatMildMentholOption.value = "diplomat-mild-menthol";
  diplomatMildMentholOption.text = "Diplomat Mild Menthol";

  if (selectedValue === "1") {
    selectElement.appendChild(diplomatMildOption);
    selectElement.appendChild(diplomatMildMentholOption);
  } else {
    selectElement.removeChild(diplomatMildOption);
    selectElement.removeChild(diplomatMildMentholOption);
  }
}
</script>

@endsection
