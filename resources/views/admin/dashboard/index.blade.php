@extends('admin.dashboard.layouts.app')

@section('container')
    <!-- row 1 -->
    <div class="flex flex-wrap -mx-3">
        <!-- card1 -->
        <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
            <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="flex-auto p-4">
                    <div class="flex flex-row -mx-3">
                        <div class="flex-none w-2/3 max-w-full px-3">
                            <div>
                                <p class="mb-0 font-semibold leading-normal text-sm">Kriteria</p>
                                <h5 class="mb-0 font-bold">
                                    {{ $jml_kriteria }}
                                </h5>
                            </div>
                        </div>
                        <div class="px-3 text-right basis-1/3">
                            <div class="flex justify-center items-center w-12 h-12 rounded-lg bg-gradient-to-tl from-backgroundSecondary to-greenSecondary">
                                <i class="ri-table-fill text-2xl text-greenPrimary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- card2 -->
        <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
            <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="flex-auto p-4">
                    <div class="flex flex-row -mx-3">
                        <div class="flex-none w-2/3 max-w-full px-3">
                            <div>
                                <p class="mb-0 font-semibold leading-normal text-sm">Sub Kriteria</p>
                                <h5 class="mb-0 font-bold">
                                    {{ $subKriteria }}
                                </h5>
                            </div>
                        </div>
                        <div class="px-3 text-right basis-1/3">
                            <div class="flex justify-center items-center w-12 h-12 rounded-lg bg-gradient-to-tl from-backgroundSecondary to-greenSecondary">
                                <i class="ri-collage-fill text-2xl text-greenPrimary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- card3 -->
        <div class="w-full max-w-full px-3 sm:w-1/2 sm:flex-none xl:w-1/4">
            <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="flex-auto p-4">
                    <div class="flex flex-row -mx-3">
                        <div class="flex-none w-2/3 max-w-full px-3">
                            <div>
                                <p class="mb-0 font-semibold leading-normal text-sm">Alternatif</p>
                                <h5 class="mb-0 font-bold">
                                    {{ $alternatif }}
                                </h5>
                            </div>
                        </div>
                        <div class="px-3 text-right basis-1/3">
                            <div class="flex justify-center items-center w-12 h-12 rounded-lg bg-gradient-to-tl from-backgroundSecondary to-greenSecondary">
                                <i class="ri-braces-fill text-2xl text-greenPrimary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- cards row 2 -->
    <div class="flex flex-wrap mt-6 -mx-3">
        <div class="w-full px-3 mb-6 lg:mb-0 lg:w-1/2 lg:flex-none">
            <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="flex-auto p-4">
                    <div class="flex flex-wrap -mx-3">
                        <div class="max-w-full px-3 lg:w-1/2 lg:flex-none">
                            <div class="flex flex-col h-full">
                                <p class="pt-2 mb-1 font-semibold">Sistem Pendukung Keputusan</p>
                                <h5 class="font-bold">TOPSIS</h5>
                                <p class="mb-12 text-justify">Topsis adalah metode pengambilan keputusan multi kriteria dengan dasar alternatif yang dipilih memiliki jarak terdekat dengan solusi ideal positif dan memiliki jarak terjauh dari solusi ideal negatif.</p>
                            </div>
                        </div>
                        <div class="max-w-full px-3 mt-12 ml-auto text-center lg:mt-0 lg:w-5/12 lg:flex-none">
                            <div class="h-full bg-gradient-to-tl from-backgroundSecondary to-greenSecondary rounded-xl">
                                <img src="{{ asset('img/shapes/waves-white.svg') }}" class="absolute top-0 hidden w-1/2 h-full lg:block" alt="waves" />
                                <div class="relative flex items-center justify-center h-full">
                                    <img class="relative z-20 w-full pt-6" src="{{ asset('img/logoo.png') }}" alt="logo" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full px-3 mb-6 lg:mb-0 lg:w-1/2 lg:flex-none">
            <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="flex-auto p-4">
                    <div class="flex flex-wrap -mx-3">
                        <div class="max-w-full px-3 lg:w-1/2 lg:flex-none">
                            <div class="flex flex-col h-full">
                                <p class="pt-2 mb-1 font-semibold">Cara Melakukan Perhitungan</p>
                                <h5 class="font-bold">TOPSIS</h5>
                                <p class="mb-12 text-justify">
                                    1. Menentukan Alternatif coffeeshop pada menu Isi Alternatif. <br>
                                    2. Memasukkan Alternatif pada menu Alternatif. <br>
                                    3. Melakukan penilaian terhadap Alternatif yang dipilih. <br>
                                    4. Melakukan Perhitungan. <br>
                                    5. Menghitung nilai normalisasi.<br>
                                    6. Menghitung matriks normalisasi terbobot.<br>
                                    7. Menentukan solusi ideal positif dan negatif.<br>
                                    8. Menghitung jarak ke solusi ideal. <br>
                                    9. Menghitung nilai preferensi untuk setiap alternatif. <br>
                                    10. Hasil perankingan terbaik berada pada menu Perankingan <br>
                                </p>
                            </div>
                        </div>
                        <div class="max-w-full px-3 mt-12 ml-auto text-center lg:mt-0 lg:w-5/12 lg:flex-none">
                            <div class="h-full bg-gradient-to-tl from-backgroundSecondary to-greenSecondary rounded-xl">
                                <img src="{{ asset('img/shapes/waves-white.svg') }}" class="absolute top-0 hidden w-1/2 h-full lg:block" alt="waves" />
                                <div class="relative flex items-center justify-center h-full">
                                    <img class="relative z-20 w-full pt-6" src="{{ asset('img/logoo.png') }}" alt="logo" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection

@section('js')
    <script>
        var ctx = document.getElementById("chart-bars").getContext("2d");

        new Chart(ctx, {
        type: "bar",
        data: {
            labels: [{{ $kriteriaID }}],
            datasets: [
            {
                label: "Bobot",
                tension: 0.4,
                borderWidth: 0,
                borderRadius: 4,
                borderSkipped: false,
                backgroundColor: "#fff",
                data: [{{ $kriteriaBobot }}],
                maxBarThickness: 6,
            },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
            legend: {
                display: false,
            },
            },
            interaction: {
            intersect: false,
            mode: "index",
            },
            scales: {
            y: {
                grid: {
                drawBorder: false,
                display: false,
                drawOnChartArea: false,
                drawTicks: false,
                },
                ticks: {
                suggestedMin: 0,
                suggestedMax: 600,
                beginAtZero: true,
                padding: 15,
                font: {
                    size: 14,
                    family: "Open Sans",
                    style: "normal",
                    lineHeight: 2,
                },
                color: "#fff",
                },
            },
            x: {
                grid: {
                drawBorder: false,
                display: false,
                drawOnChartArea: false,
                drawTicks: false,
                },
                ticks: {
                display: false,
                },
            },
            },
        },
        });

    </script>


@endsection
