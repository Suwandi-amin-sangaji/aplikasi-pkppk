@extends('layouts.template_admin')

@section('content')
    <div class="row justify-content-center">
        {{-- <div class="text-rigth" id="clock" class="clock"></div> --}}
        <div class="col-md-12">

            <div class="row">
                <div class="col-lg-4 col-md-12 col-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <i class='bx bx-check-square'></i>
                                </div>
                            </div>
                            <span class="fw-semibold d-block mb-1">Kendaraan Diperiksa</span>
                            <h3 class="card-title mb-2">{{ $jmlPemeriksaanKendaraan }}</h3>

                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-12 col-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <i class='bx bx-check-square'></i>
                                </div>
                            </div>
                            <span class="fw-semibold d-block mb-1">Peralatan Diperiksa</span>
                            <h3 class="card-title mb-2">{{ $jmlPemeriksaanPeralatan }}</h3>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <i class='menu-icon  tf-icons bx bxs-car'></i>
                                </div>
                            </div>
                            <span class="fw-semibold d-block mb-1">Jumlah Kendaraan</span>
                            <h3 class="card-title mb-2">{{ $jmlKendaraan }}</h3>

                        </div>
                    </div>
                </div>
            </div>
        </div>




    </div>
    </div>

    <script>
        function updateTime() {
            const options = {
                timeZone: 'Asia/Jayapura',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            };
            const formatter = new Intl.DateTimeFormat('en-US', options);
            const date = new Date();
            document.getElementById('clock').textContent = formatter.format(date);
        }

        setInterval(updateTime, 1000);
        updateTime(); // Initial call to set the time immediately
    </script>
@endsection
