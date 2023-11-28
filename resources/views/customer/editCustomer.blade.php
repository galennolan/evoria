@extends('layouts.layouts')

@section('content')
@include('sweetalert::alert')
<div class="container-fluid px-4">
<h1 class="mt-4">Customer Contact</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
        <li class="breadcrumb-item active">Selamat Datang {{ Auth::user()->name }} {{ Auth::user()->tim }} </li>
    </ol>
    
<form action="{{route('customer.update', [$customer->id])}}" method="POST">
    @csrf
    @method('PUT')
    <fieldset>
    <div class="card mb-2">
                <div class="card-header bg-primary text-white">
                    <i class="fas fa-table me-1"></i>
                    Ubah Customer Contact
                </div>
                <div class="card-body">
                <div class="row mb-3">
    <div class="col-md-3">
        <div class="form-floating mb-3">
            <select class="form-control" id="area" name="area">
                <option value="">Please select</option>
                <option value="Semarang" {{ $customer->area == 'Semarang' ? 'selected' : '' }}>Semarang</option>
                <option value="Yogyakarta" {{ $customer->area == 'Yogyakarta' ? 'selected' : '' }}>Yogyakarta</option>
                <option value="Solo" {{ $customer->area == 'Solo' ? 'selected' : '' }}>Solo</option>
            </select>
            <label class="font-weight-bold" for="area">1. Area</label>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-floating mb-3">
            <select class="form-control" id="rayon" name="rayon" required>
                <option value="">Please select</option>
                <option value="Klaten" {{ $customer->rayon == 'Klaten' ? 'selected' : '' }}>Klaten</option>
                <option value="Solo" {{ $customer->rayon == 'Solo' ? 'selected' : '' }}>Solo</option>
                <option value="Sragen" {{ $customer->rayon == 'Sragen' ? 'selected' : '' }}>Sragen</option>
                <option value="Boyolali" {{ $customer->rayon == 'Boyolali' ? 'selected' : '' }}>Boyolali</option>
                <option value="Wonogiri" {{ $customer->rayon == 'Wonogiri' ? 'selected' : '' }}>Wonogiri</option>
                <option value="Yogyakarta" {{ $customer->rayon == 'Yogyakarta' ? 'selected' : '' }}>Yogyakarta</option>
                <option value="Wonosari" {{ $customer->rayon == 'Wonosari' ? 'selected' : '' }}>Wonosari</option>
                <option value="Bantul" {{ $customer->rayon == 'Bantul' ? 'selected' : '' }}>Bantul</option>
                <option value="Purwodadi" {{ $customer->rayon == 'Purwodadi' ? 'selected' : '' }}>Purwodadi</option>
                <option value="Salatiga" {{ $customer->rayon == 'Salatiga' ? 'selected' : '' }}>Salatiga</option>
            </select>
            <label class="font-weight-bold" for="rayon">2. Rayon</label>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-floating mb-3">
            <input type="text" name="kab" id="kab" class="form-control" value="{{$customer->kab}}" required>
            <label class="font-weight-bold" for="kab">3. Kabupaten / Kecamatan</label>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-floating mb-3">
            <select class="form-control" id="venue" name="venue" required>
                <option value="">Silahkan Pilih</option>
                <option value="C&B">C&B</option>
                <option value="KANTOR" @if($customer->venue == 'KANTOR') selected @endif>KANTOR</option>
                <option value="PA" @if($customer->venue == 'PA') selected @endif>PA</option>
                <option value="PT" @if($customer->venue == 'PT') selected @endif>PT</option>
                <option value="R&C" @if($customer->venue == 'R&C') selected @endif>R&C</option>
                <option value="SC" @if($customer->venue == 'SC') selected @endif>SC</option>
                <option value="PUSAT PEMBELANJAAN" @if($customer->venue == 'PUSAT PEMBELANJAAN') selected @endif>PUSAT PEMBELANJAAN</option>
                <option value="WARTEN" @if($customer->venue == 'WARTEN') selected @endif>WARTEN</option>
            </select>
            <label class="font-weight-bold" for="venue">4. Venue</label>
        </div>
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-3">
        <div class="form-floating mb-3">
            <input id="name" type="text" name="name" class="form-control" value="{{$customer->name}}">
            <label class="font-weight-bold" for="name">5. Nama</label>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-floating mb-3">
            <input id="telp" type="text" name="telp" class="form-control" placeholder="Kosongin jika tidak ada" value="{{$customer->telp}}">
            <label class="font-weight-bold" for="telp">Telp</label>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-floating mb-3">
            <input id="IG" type="text" name="IG" class="form-control" placeholder="Kosongin jika tidak ada" value="{{$customer->IG}}">
            <label class="font-weight-bold" for="IG">IG</label>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-floating mb-3">
            <input id="email" type="text" name="email" class="form-control" placeholder="Kosongin jika tidak ada" value="{{$customer->email}}">
            <label class="font-weight-bold" for="email">Email</label>
        </div>
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-3">
        <div class="form-floating mb-3">
            <select class="form-control" name="jenis_kelamin" id="jenis_kelamin" required>
                <option value="">Silahkan Pilih</option>
                <option value="laki-laki" @if($customer->jenis_kelamin == 'laki-laki') selected @endif>L</option>
                <option value="perempuan" @if($customer->jenis_kelamin == 'perempuan') selected @endif>P</option>
            </select>
            <label class="font-weight-bold" for="jenis_kelamin">6. Jenis Kelamin</label>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-floating mb-3">
            <select class="form-control" id="umur" name="umur" required>
                <option value="" {{$customer->umur == "" ? "selected" : ""}}>Please select</option>
                <option value="18-25thn" {{$customer->umur == "18-25thn" ? "selected" : ""}}>18-25thn</option>
                <option value="26-30thn" {{$customer->umur == "26-30thn" ? "selected" : ""}}>26-30thn</option>
                <option value="31-40thn" {{$customer->umur == "31-40thn" ? "selected" : ""}}>31-40thn</option>
                <option value="41-50thn" {{$customer->umur == "41-50thn" ? "selected" : ""}}>41-50thn</option>
                <option value=">50" {{$customer->umur == ">50" ? "selected" : ""}}>&gt;50</option>
            </select>
            <label class="font-weight-bold" for="umur">7. Umur Range</label>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-floating mb-3">
            <input type="date" class="form-control" name="created_at" id="created_at" required value="{{ old('created_at', date('Y-m-d', strtotime($customer->created_at))) }}">
            <label class="font-weight-bold" for="created_at">Tanggal</label>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-floating mb-3">
            <select class="form-control" id="pekerjaan" name="pekerjaan" required>
                <option value="">Silahkan Pilih</option>
                <option value="Karyawan" @if($customer->pekerjaan == 'Karyawan') selected @endif>Karyawan</option>
                <option value="Mahasiswa" @if($customer->pekerjaan == 'Mahasiswa') selected @endif>Mahasiswa</option>
                <option value="PNS" @if($customer->pekerjaan == 'PNS') selected @endif>PNS</option>
                <option value="Wiraswasta" @if($customer->pekerjaan == 'Wiraswasta') selected @endif>Wiraswasta</option>
                <option value="Others" @if($customer->pekerjaan == 'Others') selected @endif>Others</option>
            </select>
            <label class="font-weight-bold" for="pekerjaan">8. Pekerjaan</label>
        </div>
    </div>
</div>


<div class="row mb-3">
    <div class="col-md-4">
    <div class="form-floating mb-3">

            <select class="form-control" id="rokok" name="rokok" required>
                <option value="">Please select</option>
                <option value="Diplomat Mild" @if(old('rokok', $customer->rokok) == 'Diplomat Mild') selected @endif>Diplomat Evo</option>
                <option value="Diplomat Mild Menthol" @if(old('rokok', $customer->rokok) == 'Diplomat Mild Menthol') selected @endif>Diplomat Mild Menthol</option>
                <option value="Pro Mild" @if(old('rokok', $customer->rokok) == 'Pro Mild') selected @endif>Pro Mild</option>
                <option value="Class Mild" @if(old('rokok', $customer->rokok) == 'Class Mild') selected @endif>Class Mild</option>
                <option value="A Mild" @if(old('rokok', $customer->rokok) == 'A Mild') selected @endif>A Mild</option>
                <option value="other">Other</option>
            </select>
            <label class="font-weight-bold" for="merk_rokok">9. Rokok yang dikonsumsi selama ini</label>
    </div> </div>

    <div class="col-md-4">
    <div class="form-floating mb-3">
        
        <select class="form-control" id="jml_beli" name="jml_beli" required>
            <option value="" {{$customer->jml_beli == "" ? "selected" : ""}}>Please select</option>
            <option value="0" {{$customer->jml_beli == '0' ? "selected" : ""}}>0</option>
            <option value="1" {{$customer->jml_beli == '1' ? "selected" : ""}}>1</option>
            <option value="2" {{$customer->jml_beli == '2' ? "selected" : ""}}>2</option>
        </select>
        <label class="font-weight-bold" for="jml_beli">10. Jumlah Beli Rokok Pack</label>
    </div> </div>

    <div class="col-md-4">
    <div class="form-floating mb-3">
       
        <select class="form-control" id="open" name="open" required>
            <option value="" {{$customer->open == "" ? "selected" : ""}}>Please select</option>
            <option value="0" {{$customer->open == '0' ? "selected" : ""}}>0</option>
            <option value="1" {{$customer->open == '1' ? "selected" : ""}}>1</option>
            <option value="2" {{$customer->open == '2' ? "selected" : ""}}>2</option>
        </select>
        <label class="font-weight-bold" for="open">11. Open Teartape</label>
    </div>
</div> </div>

        <div class="form-group">
        <div class="form-floating mb-3">
       
        <select class="form-control" id="pernahrasa" name="pernahrasa" onchange="showDiplomatMildOptions(this.value)" value="{{$customer->pernahrasa}}" required>       
            <option value="">Please select</option>
            <option value="1">Ya</option>
            <option value="0">Tidak</option>
        </select>
        <label class="font-weight-bold" for="pernahrasa">12. Beli Diplomat Evo?</label>
        </div>  </div>

        <div class="form-group">
                <div id="diplomatMildOptions" style="display:none;">
                <div class="form-floating mb-3">
                    <select class="form-control" id="pernahrasa" name="pernahrasa">
                        <option value="">Please select</option>
                        <option value="Diplomat Mild">Diplomat Evo</option>
                        <option value="Diplomat Mild Menthol">Diplomat Mild Menthol</option>
                    </select>
                    <label class="font-weight-bold" for="diplomatMildRasa">Pilih rasa Diplomat Evo</label>
                </div></div>
            </div>

            <div class="form-group ml-5">
            <div class="form-floating mb-3">
                
                <select class="form-control" name="rasadip" value="{{$customer->rasadip}}" required>       
                    <option value="">Please select</option>
                    <option value="Biasa" {{$customer->rasadip == 'Biasa' ? 'selected' : ''}}>Biasa</option>
                    <option value="Enak" {{$customer->rasadip == 'Enak' ? 'selected' : ''}}>Enak</option>
                    <option value="Tidak Enak" {{$customer->rasadip == 'Tidak Enak' ? 'selected' : ''}}>Tidak Enak</option>
                </select>
                <label class="font-weight-bold" for="rasadip">Rasa</label>
            </div> </div>

            <div class="form-group ml-5">
            <div class="form-floating mb-3">
                
                <select class="form-control bg-light" id="hargadip" name="hargadip" value="{{$customer->hargadip}}"  required>           
                    <option value="">Please select</option>
                    <option value="1" {{$customer->hargadip == 1 ? 'selected' : ''}}>Terjangkau</option>
                    <option value="0" {{$customer->hargadip == 0 ? 'selected' : ''}}>Mahal</option>
                </select>
                <label class="font-weight-bold" for="hargadip">Harga</label>
            </div> </div>

            <div class="form-group ml-5">
            <div class="form-floating mb-3">
                
                <select class="form-control bg-light" id="kemasan" name="kemasan" required>
                    <option value="" {{$customer->kemasan == "" ? "selected" : ""}}>Please select</option>
                    <option value="Menarik" {{$customer->kemasan == "Menarik" ? "selected" : ""}}>Menarik</option>
                    <option value="Tidak Menarik" {{$customer->kemasan == "Tidak Menarik" ? "selected" : ""}}>Tidak Menarik</option>
                </select>
                <label class="font-weight-bold" for="kemasan">Kemasan</label>
            </div> </div>


     

            <div class="row mb-3">
    <div class="col-md-4">
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="tempatbeli" placeholder="Tempat" name="tempatbeli" value="{{$customer->tempatbeli}}" required>
        <label class="font-weight-bold" for="tempatbeli">14. Tempat biasa membeli rokok</label>
    </div> </div>

    <div class="col-md-4">
    <div class="form-floating mb-3">
        <select class="form-control" id="akanbeli" name="akanbeli" required>
            <option value="" {{$customer->akanbeli == "" ? "selected" : ""}}>Please select</option>
            <option value="1" {{$customer->akanbeli == "1" ? "selected" : ""}}>Ya</option>
            <option value="0" {{$customer->akanbeli == "0" ? "selected" : ""}}>Tidak</option>
        </select>
        <label class="font-weight-bold" for="akanbeli">15. Akan Beli lagi Diplomat Mild?</label>
        </div>
    </div>

    <div class="col-md-4">
    <div class="form-floating mb-3">
        <select class="form-control" id="alasan" name="alasan" required>
            <option value="" {{$customer->alasan == "" ? "selected" : ""}}>Please select</option>
            <option value="Rasa Enak" {{$customer->alasan == "Rasa Enak" ? "selected" : ""}}>Rasa Enak</option>
            <option value="Rasa Tidak Enak" {{$customer->alasan == "Rasa Tidak Enak" ? "selected" : ""}}>Rasa Tidak Enak</option>
            <option value="Harga Terjangkau" {{$customer->alasan == "Harga Terjangkau" ? "selected" : ""}}>Harga Terjangkau</option>
            <option value="Harga Mahal" {{$customer->alasan == "Harga Mahal" ? "selected" : ""}}>Harga Mahal</option>
            <option value="Kemasan Menarik" {{$customer->alasan == "Kemasan Menarik" ? "selected" : ""}}>Kemasan Menarik</option>
            <option value="Kemasan Tidak Menarik" {{$customer->alasan == "Kemasan Tidak Menarik" ? "selected" : ""}}>Kemasan Tidak Menarik</option>
        </select>
        <label class="font-weight-bold" for="alasan">16. Alasan</label>
    </div>
    </div><div class="col-md-10">
                            <button type="submit" class="btn btn-primary btn-send">Update</button>
                            <a href="{{ route('customer') }}" class="btn btn-danger btn-send">Kembali</a>
                        </div>
</div>

    </fieldset>
    <div class="row mb-3">
                        
                    </div>
</div>
                </div>
            </div>
        </form>
    </div>

<script>
    
//diplomat Evo and diplomat mild 
    function showDiplomatMildOptions() {
        var pernahrasaSelect = document.getElementById("pernahrasa");
        var diplomatMildOptionsDiv = document.getElementById("diplomatMildOptions");
        if (pernahrasaSelect.value === "1") {
            diplomatMildOptionsDiv.style.display = "block";
        } else {
            diplomatMildOptionsDiv.style.display = "none";
        }
    }
</script>
@endsection
