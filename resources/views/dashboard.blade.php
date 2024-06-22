@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-lg my-5">
                <div class="card-header text-white" style="background-color: #e71717;">
                    <h2 class="my-2 text-center">Dashboard</h2>
                </div>

                <div class="card-body" style="background: linear-gradient(180deg, rgba(21, 92, 168, 0.1) 0%, rgba(0,123,255,0.05) 100%);">
                    <div class="text-center mt-4">
                        <h1 class="display-4">Selamat Datang di Employee Web, {{ Auth::user()->name }}</h1>
                        <p class="lead">Employee Web adalah platform untuk manajemen data pegawai. Anda dapat membuat, mengedit, dan menghapus data pegawai dengan mudah.</p>
                    </div>

                    <div class="row mt-5">
                        <div class="col-md-6 offset-md-3">
                            <div class="text-center">
                                <i class="fas fa-users fa-7x mb-3" style="color: #ff0044;"></i>
                                <h2 class="mb-4">Jumlah Pegawai Terbaru:</h2>
                                <h1 class="display-1" id="employeeCount" style="color: #000000; transition: all 0.3s ease-in-out;">Loading...</h1>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        fetchEmployeeCount();

        function fetchEmployeeCount() {
            axios.get('{{ route("employees.count") }}')
                .then(function(response) {
                    const employeeCountElem = document.getElementById('employeeCount');
                    employeeCountElem.textContent = response.data.employeeCount;
                    employeeCountElem.style.color = '#4e73df';
                })
                .catch(function(error) {
                    console.error(error);
                    const employeeCountElem = document.getElementById('employeeCount');
                    employeeCountElem.textContent = 'Gagal mengambil data';
                    employeeCountElem.style.color = '#e74a3b';
                });
        }
    });
</script>
@endpush
@endsection
