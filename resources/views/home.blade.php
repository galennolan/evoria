@extends('layouts.layouts')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a>Dashboard</a></li>
        <li class="breadcrumb-item active">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            Selamat Datang {{ Auth::user()->name }} {{ Auth::user()->tim }}
        </li>
    </ol>

    <div class="card mb-2">
        <div class="card-header bg-primary text-white">{{ __('Dashboard') }}</div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            {{ __('Kamu Berhasil Login ya, :name sebagai :role', ['name' => Auth::user()->name,'role'=> Auth::user()->getRoleNames()->first()]) }}
        </div>
    </div>
</div>

<script>
function toggleInputField() {
  const dropdown = document.getElementById("dropdown");
  const otherInput = document.getElementById("otherInput");
  
  if (dropdown.value === "other") {
    dropdown.style.display = "none";
    otherInput.style.display = "block";
    otherInput.value = ""; // clear previous input value
  } else {
    dropdown.style.display = "block";
    otherInput.style.display = "none";
  }
}

</script>
@endsection
