@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-8 d-flex align-items-stretch">
            <div class="card w-100 bg-light-info overflow-hidden shadow-none">
                <div class="card-body position-relative">
                    <div class="row">
                        <div class="col-sm-7">
                            <div class="d-flex align-items-center mb-7">
                                <div class="rounded-circle me-6 overflow-hidden">
                                    <img src="{{ asset('templates/images/user-1.jpg') }}" alt="" width="40"
                                        height="40">
                                </div>
                                <div class="div">
                                    <h5 class="fw-semibold fs-5 mb-0">Welcome back {{ auth()->user()->name }}</h5>
                                    <p class="badge bg-success mt-2">{{ auth()->user()->email }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="welcome-bg-img mb-n7 text-end">
                                <img src="{{ asset('templates/images/welcome-bg.svg') }}" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 row">
            <div class="col-6">
                <div class="card">

                    <div class="card-body">
                        <div class="text-center">
                            <img src="{{ asset('templates/images/icon-user-male.svg') }}" width="50" height="50"
                                class="mb-3" alt="">
                            <p class="fw-semibold fs-3 text-primary mb-1">Member</p>
                            <h5 class="fw-semibold text-primary mb-0">{{ $countMember }}</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="{{ asset('templates/fonts/icon-tasks.svg') }}" width="50" height="50"
                                class="mb-3" alt="">
                            <p class="fw-semibold fs-3 text-primary mb-1">Buku</p>
                            <h5 class="fw-semibold text-primary mb-0">{{ $countBuku }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-5">
            <div class="card">
                <div class="card-header">
                    <h6>Peminjam Hari Ini</h6>
                </div>
                <div class="card-body">
                    <table class="table align-middle" id="buku_table">
                        <thead>
                            <tr class="text-muted fw-semibold">
                                <th scope="col">Nama</th>
                                <th scope="col">Kelas</th>
                                <th scope="col">Jam</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataPeminjam as $peminjam)
                                <tr>
                                    <td> <strong>{{ $peminjam->member->nama }}</strong></td>
                                    <td> <strong>{{ $peminjam->member->kelas }}</strong></td>
                                    <td> <strong>{{ date('H:i', strtotime($peminjam->created_at)) }}</strong></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-7 d-flex align-items-stretch">
            <div class="card w-100 bg-light-primary overflow-hidden">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h5 class="card-title fw-semibold">Sales Hourly</h5>
                            <div class="d-flex gap-2">
                                <span>
                                    <span class="round-8 bg-primary rounded-circle d-inline-block"></span>
                                </span>
                                <span>Your data updates every 3 hours</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-stretch ms-auto gap-2">
                            <a href="javascript:void(0)" class="btn btn-primary">
                                <i class="ti ti-download fs-6"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div id="activity-status"></div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('templates/js/apex.js') }}"></script>
    <script>
        $(() => {
            renderChart();
        })

        function renderChart() {
            var chart2 = {
                series: [{
                    name: "Jumlah Peminjaman",
                    data: [
                        @foreach ($dates as $date)
                            @if (isset($data[$date]))
                                {{ $data[$date]->count }}
                            @else
                                0
                            @endif ,
                        @endforeach
                    ],
                }, ],
                chart: {
                    height: 350,
                    type: "area",
                    fontFamily: '"DM Sans",sans-serif',
                    foreColor: "#adb0bb",
                    toolbar: {
                        show: false,
                    },
                    sparkline: {
                        enabled: true
                    },
                    dropShadow: {
                        enabled: true,
                        top: 3,
                        left: 0,
                        blur: 5,
                        color: "#000",
                        opacity: 0.2,
                    },
                },
                colors: ["#615dff"],
                dataLabels: {
                    enabled: false,
                },
                stroke: {
                    curve: "smooth",
                    colors: ["#615dff"],
                    width: 2,
                },
                fill: {
                    type: "gradient",
                },
                markers: {
                    show: false,
                },
                grid: {
                    show: false,
                },
                yaxis: {
                    show: false,
                },
                xaxis: {
                    type: "category",
                    categories: [
                        @foreach ($dates as $date)
                            "{{ $date }}",
                        @endforeach
                    ],

                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false,
                    },
                },
                legend: {
                    show: false,
                },
                tooltip: {
                    theme: "dark",
                },
            };

            var chart2 = new ApexCharts(
                document.querySelector("#activity-status"),
                chart2
            );
            chart2.render();
        }
    </script>
@endsection
