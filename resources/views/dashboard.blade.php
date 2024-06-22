@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background-color: #ff0044; color: #000000;">Dashboard</div>

                <div class="card-body" style="background: linear-gradient(180deg, rgba(21, 92, 168, 0.1) 0%, rgba(0,123,255,0.05) 100%);">
                    <div class="text-center mt-4">
                        <h1>Selamat Datang di Employee Web, {{ Auth::user()->name }}</h1>
                        <p class="lead">Employee Web adalah platform untuk manajemen data pegawai. Anda dapat membuat, mengedit, dan menghapus data pegawai dengan mudah.</p>
                    </div>

                    <div class="row mt-5">
                        <div class="col-md-6 offset-md-3">
                            <div class="text-center">
                                <i class="fas fa-users fa-7x text-info mb-3"></i>
                                <h2 class="mb-4">Jumlah Pegawai Terbaru:</h2>
                                <h1 class="display-1" id="employeeCount">Loading...</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        fetchEmployeeCount();

        function fetchEmployeeCount() {
            axios.get('{{ route("employees.count") }}')
                .then(function(response) {
                    document.getElementById('employeeCount').textContent = response.data.employeeCount;
                })
                .catch(function(error) {
                    console.error(error);
                    document.getElementById('employeeCount').textContent = 'Gagal mengambil data';
                });
        }
    });
</script>
@endpush
@endsection
