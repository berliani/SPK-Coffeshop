@extends('admin.dashboard.layouts.app')

@section('container')
    <div class="flex flex-wrap -mx-3">
        <div class="flex-none w-full max-w-full px-3">
            <div class="relative flex flex-col min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="flex flex-row items-center justify-between p-6 pb-0 mb-4 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                    <h6>Tabel {{ $judul }}</h6>
                </div>
                <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
                    <table id="tabel_data" class="stripe hover" style="width:100%; padding-top: 1em; padding-bottom: 1em;">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Bobot</th>
                                <th>Tipe</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $item->kode }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->bobot }}</td>
                                    <td>{{ $item->tipe }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td style="text-align: center" class="font-bold" colspan="2">Total Bobot:</td>
                                <td class="font-bold" colspan="2">
                                    @if ($sumBobot < 1)
                                        {{ $sumBobot }}
                                    @else
                                        {{ $sumBobot }} <span class="text-error"> (max)</span>
                                    @endif
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        // Menginisialisasi DataTable
        $(document).ready(function() {
            $('#tabel_data').DataTable({
                responsive: true,
                order: [],
            })
            .columns.adjust()
            .responsive.recalc();
        });

        @if (session()->has('berhasil'))
            Swal.fire({
                title: 'Berhasil',
                text: '{{ session('berhasil') }}',
                icon: 'success',
                confirmButtonColor: '#ddbf86',
                confirmButtonText: 'OK',
            });
        @endif

        @if (session()->has('gagal'))
            Swal.fire({
                title: 'Gagal',
                text: '{{ session('gagal') }}',
                icon: 'error',
                confirmButtonColor: '#ddbf86',
                confirmButtonText: 'OK',
            });
        @endif

        @if ($errors->any())
            Swal.fire({
                title: 'Gagal',
                text: @foreach ($errors->all() as $error) '{{ $error }}' @endforeach,
                icon: 'error',
                confirmButtonColor: '#ddbf86',
                confirmButtonText: 'OK',
            })
        @endif
    </script>
@endsection
