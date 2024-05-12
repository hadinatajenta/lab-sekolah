<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- first section --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="p-6 text-gray-900">
                    <div class="mb-4">
                        <h4 class="font-bold text-2xl">Dashboard</h4>
                        <p class="text-gray-600">Hanya Kepala LAB yang dapat Mengelola Dashboard ini.</p>
                    </div>
                    <div class="grid sm:grid-cols-1 md:grid-cols-3 grid-cols-1 gap-4 justify-items-start">
                        {{-- 1 --}}
                        <div class="bg-[#fcebfe] w-full rounded p-4 flex items-center">
                            <div class="mr-2">
                                <i class='bx bx-buildings bx-lg text-[#ca5ad7]'></i>
                            </div>
                            <div>
                                <span class="text-lg font-bold text-[#923c9c]">Jumlah Lab</span>
                                <p class="text-lg">{{ $lab }}</p>
                            </div>
                        </div>
                        {{-- 2 --}}
                        <div class="bg-[#f0ffec] w-full rounded p-4 flex items-center">
                            <div class="mr-2">
                                <i class='bx bx-user bx-lg text-[#6ecc53]'></i>
                            </div>
                            <div>
                                <span class="text-lg font-bold text-[#4f8b3f]">Jumlah Guru</span>
                                <p class="text-lg"> {{ $guru }} </p>
                            </div>
                        </div>
                        {{-- 3 --}}
                        <div class="bg-[#ffebf0] w-full rounded p-4  flex items-center">
                            <div class="mr-2">
                                <i class='bx bx-user bx-lg text-[#f199af]'></i>
                            </div>
                            <div>
                                <span class="text-lg font-bold text-[#ae596e]">Jumlah Siswa</span>
                                <p class="text-lg">10</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- first row --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 h-full">
                        {{-- Kiri / Jadwal hari ini --}}
                        <div>
                            <h2 class="text-lg font-semibold text-gray-800">Ringkasan Jadwal Lab Hari Ini</h2>
                            <p class="text-gray-600">Lihat semua jadwal di halaman Peminjaman </p>
                            <div class="mt-4">
                                <ul class="divide-y divide-gray-200">
                                    @if ($jadwals->isEmpty())
                                        <li class="py-2 flex justify-between items-center">
                                            <span class="text-sm font-medium text-gray-600">
                                                Tidak ada Jadwal hari ini
                                            </span>
                                        </li>
                                    @else
                                        @foreach ($jadwals as $jdwl)
                                            <li class="py-2 flex justify-between items-center">
                                                <span class="text-sm font-medium text-gray-600">
                                                    {{ $jdwl->lab->nama_lab }}
                                                    :
                                                    {{ date('H:i', strtotime($jdwl->waktu_mulai)) }}-{{ date('H:i', strtotime($jdwl->waktu_selesai)) }}
                                                </span>
                                                <span
                                                    class="text-xs font-semibold bg-blue-100 text-blue-800 py-1 px-3 rounded-full">Kelas
                                                    {{ $jdwl->kelas->nama_kelas }}
                                                </span>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>

                            <div class="text-center my-4 sm:my-0 self-end">
                                <a href="{{ route('peminjaman.view') }}"
                                    class="text-white  bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Lihat
                                    semua</a>
                            </div>
                        </div>

                        {{-- Kanan / Kalendar --}}
                        <div>
                            <div class="flex items-center justify-between mb-4">
                                <h2 class="text-xl font-semibold text-gray-700">Jadwal Lab Bulan {{ $bulan }}
                                    Tahun
                                    {{ $tahun }}
                                </h2>
                            </div>
                            <div class="grid grid-cols-7 gap-4 text-center">
                                @php
                                    $date = now()->setYear($tahun)->setMonth($bulan)->startOfMonth();
                                    $endOfMonth = $date->copy()->endOfMonth();
                                    $dayOfWeek = $date->dayOfWeek; // Hari pertama bulan (0 = Minggu, 6 = Sabtu)
                                    $daysInMonth = $date->daysInMonth;
                                @endphp

                                @for ($i = 0; $i < $dayOfWeek; $i++)
                                    <div></div> {{-- Mengosongkan hari sebelum bulan dimulai --}}
                                @endfor

                                @while ($date <= $endOfMonth)
                                    @php
                                        $day = $date->day;
                                    @endphp

                                    @if (isset($events[$day]))
                                        {{-- Tanggal dengan event --}}
                                        <div class="py-2 bg-blue-100 rounded-lg text-blue-800">
                                            {{ $day }}
                                        </div>
                                    @else
                                        {{-- Tanggal tanpa event --}}
                                        <div class="py-2 bg-gray-200 rounded-lg">
                                            {{ $day }}
                                        </div>
                                    @endif

                                    @php $date->addDay(); @endphp
                                @endwhile
                            </div>

                            <div class="flex my-4">
                                <ul class="max-w-md space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400">
                                    <li>
                                        <span class="text-blue-500">Tanggal biru</span> menandakan adanya Jadwal lab
                                        pada hari tersebut.
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
