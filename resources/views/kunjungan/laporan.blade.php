@extends('layouts.app')
@section('content')
    <x-breadcrumb :title="'Laporan'" :subtitle="'Laporan Kunjungan Perpustakaan'">
    </x-breadcrumb>
    <div class="card card-body">
        <div class="row">
            <div class="col-5">
                <label>TANGGAL AWAL</label>
                <div class="input-group date" id="tanggalAwal" data-target-input="nearest">

                    <input type="date" id="tglAwal" class="form-control " value="{{ $now }}" />
                </div>
            </div>
            <div class="col-5">
                <label>TANGGAL AKHIR</label>
                <div class="input-group date" id="tanggalAwal" data-target-input="nearest">
                    <input type="date" id="tglAkhir" class="form-control " value="{{ $now }}" />
                </div>
            </div>
            <div class="col-2">
                <label for="btn-proses"></label>
                <button class="btn btn-success w-100" id="btn-proses" onclick="prosesData()">Proses</button>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table" id="tableLaporan">
                <thead class="header-item">
                    <tr>
                        <th style="width: 10%">NO</th>
                        <th>nik</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Jumlah Kunjungan</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    @endsection
    @section('js')
        <script>
            var tabel;

            $(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                tabel = $("#tableLaporan").dataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('kehadiran.laporan.post') }}",
                        type: "POST",
                        data: function(d) {
                            d.start = $("#tglAwal").val();
                            d.end = $("#tglAkhir").val();
                        }
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'member.nik',
                            name: 'nim'
                        },
                        {
                            data: 'member.nama',
                            name: 'nama'
                        },
                        {
                            data: 'member.kelas',
                            name: 'kelas'
                        },
                        {
                            data: 'total',
                            name: 'total'
                        },
                    ]

                });
            });

            function prosesData() {
                tabel.api().ajax.reload();
            }
        </script>
    @endsection
