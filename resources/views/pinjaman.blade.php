<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Peminjaman LAB') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="p-6 text-gray-900">
                    <div class="mb-4">
                        <h4 class="font-bold text-2xl">Jadwal Peminjaman Lab</h4>
                        @if (Auth::user()->role_id == 4)
                            <p class="text-gray-600">Kamu mendapat hak akses "Hanya Lihat".</p>
                        @else
                            <p class="text-gray-600">Hanya Kepala LAB yang dapat Mengelola Dashboard ini.</p>
                        @endif
                    </div>
                    <div class="grid sm:grid-cols-1 md:grid-cols-3 grid-cols-1 gap-4 justify-items-start">
                        {{-- 1 --}}
                        <div class="bg-[#fcebfe] w-full rounded p-4 flex items-center">
                            <div class="mr-2">
                                <i class='bx bx-time bx-lg text-[#ca5ad7]'></i>
                            </div>
                            <div>
                                <span class="text-lg font-bold text-[#923c9c]">Total jadwal</span>
                                <p class="text-lg">{{ $totalJadwal->count() }}</p>
                            </div>
                        </div>
                        {{-- 2 --}}
                        <div class="bg-[#f0ffec] w-full rounded p-4 flex items-center">
                            <div class="mr-2">
                                <i class='bx bx-user bx-lg text-[#6ecc53]'></i>
                            </div>
                            <div>
                                <span class="text-lg font-bold text-[#4f8b3f]">Jadwal Hari ini</span>
                                <p class="text-lg"> {{ $jadwals->count() }} </p>
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
            <div class="bg-white overflow-hidden  sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex items-center justify-between  mb-3">
                        {{-- Form peminjaman --}}
                        @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 3)
                            <a href="{{ route('forms.view') }}"
                                class="text-white flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5  me-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                                style="display: inline-block; white-space:nowrap">
                                <i class='bx bx-plus'></i> Jadwal
                            </a>
                        @endif
                        <div class="flex items-center">
                            {{-- Filter --}}
                            <button data-modal-target="fillter" data-modal-toggle="fillter"
                                class="mr-3  block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                type="button">
                                <i class='bx bx-filter-alt'></i>
                            </button>
                            <div id="fillter" tabindex="-1" aria-hidden="true"
                                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <form action="{{ route('peminjaman.view') }}" method="GET">
                                    @csrf
                                    <div class="relative p-4 w-full max-w-lg max-h-full">
                                        <!-- Modal content -->
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <!-- Modal header -->
                                            <div
                                                class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                    Pilih status
                                                </h3>
                                                <button type="button"
                                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                    data-modal-hide="fillter">
                                                    <svg class="w-3 h-3" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                            </div>
                                            <!-- Modal body -->
                                            <div class="p-4 md:p-5 space-y-4">
                                                <div class="flex items-center">
                                                    <input id="default-radio-2" type="radio" name="filter"
                                                        value="Menunggu"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                    <label for="default-radio-2"
                                                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Menunggu</label>
                                                </div>
                                                <div class="flex items-center">
                                                    <input id="default-radio-2" type="radio" name="filter"
                                                        value="Berjalan"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                    <label for="default-radio-2"
                                                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Berjalan</label>
                                                </div>
                                                <div class="flex items-center">
                                                    <input id="default-radio-2" type="radio" name="filter"
                                                        value="Selesai"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                    <label for="default-radio-2"
                                                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Selesai</label>
                                                </div>
                                                <div class="flex items-center">
                                                    <input id="default-radio-2" type="radio" name="filter"
                                                        value="Diganti"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                    <label for="default-radio-2"
                                                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Diganti</label>
                                                </div>
                                                <div class="flex items-center">
                                                    <input id="default-radio-2" type="radio" name="filter"
                                                        value="Dijadwalkan"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                    <label for="default-radio-2"
                                                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Dijadwalkan</label>
                                                </div>
                                                <div class="flex items-center">
                                                    <input id="default-radio-2" type="radio" name="filter"
                                                        value="Diganti / dibatalkan"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                    <label for="default-radio-2"
                                                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Diganti
                                                        / dibatalkan</label>
                                                </div>
                                            </div>
                                            <!-- Modal footer -->
                                            <div
                                                class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                <button data-modal-hide="fillter" type="submit"
                                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Terapkan</button>
                                                <button data-modal-hide="fillter" type="button"
                                                    class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Batal</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            {{-- Search input --}}
                            <form class="flex items-center" action="{{ route('peminjaman.view') }}" method="GET">
                                <label for="simple-search" class="sr-only">Search</label>
                                <div class="relative w-full">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                                            <path stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2"
                                                d="M3 5v10M3 5a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm0 10a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm12 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0V6a3 3 0 0 0-3-3H9m1.5-2-2 2 2 2" />
                                        </svg>
                                    </div>
                                    <input type="text" id="simple-search"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Cari berdasarkan tanggal ... " name="keyword">
                                </div>
                                <button type="submit"
                                    class="p-2.5 ms-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                    </svg>
                                    <span class="sr-only">Search</span>
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="relative overflow-x-auto  sm:rounded-lg">
                        {{-- Notifikasi --}}
                        <x-alert />

                        {{-- table daftar kelas --}}
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 ">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        No
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        LAB
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Guru PJ
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Kelas
                                    </th>
                                    <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                        Mata Pelajaran
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Tanggal
                                    </th>
                                    <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                        Jam Mulai
                                    </th>
                                    <th scope="col" class="px-6 py-3 whitespace-nowrap">
                                        Jam Selesai
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <form action="{{ route('peminjaman.view') }}" method="GET">
                                            <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown"
                                                class="text-sm flex items-center" type="button">Status <svg
                                                    class="w-2.5 h-2.5 ms-3" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 10 6">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                                                </svg>
                                            </button>

                                            <!-- Dropdown menu -->
                                            <div id="dropdown"
                                                class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                                                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                                    aria-labelledby="dropdownDefaultButton">
                                                    <li>
                                                        <button type="submit" name="filter" value="Selesai"
                                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Selesai</button>
                                                    </li>
                                                    <li>
                                                        <button type="submit" name="filter" value="Dijadwalkan"
                                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Dijadwalkan</button>
                                                    </li>
                                                    <li>
                                                        <button type="submit" name="filter" value="Ditolak"
                                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Ditolak</button>
                                                    </li>
                                                    <li>
                                                        <button type="submit" name="filter"
                                                            value="Diganti / dijadwalkan"
                                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Diganti
                                                            / dibatalkan</button>
                                                    </li>
                                                    <li>
                                                        <button type="submit" name="filter" value="Berjalan"
                                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                            Berjalan</button>
                                                    </li>
                                                    <li>
                                                        <button type="submit" name="filter" value="Menunggu"
                                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                            Menunggu</button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </form>
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($jadwal->count() < 1)
                                    <tr
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 h-screen">
                                        <td class="w-4 p-4 text-center" colspan="10">
                                            <p class="text-lg font-semibold text-gray-600 mb-2">Tidak Ada Data</p>
                                            <p class="text-sm text-gray-400">Maaf, tidak ada data yang ditemukan.</p>
                                        </td>
                                    </tr>
                                @elseif ($jadwal)
                                    @foreach ($jadwal as $index => $pjm)
                                        <tr
                                            class="bg-white  dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                            <th scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ $index + 1 }}
                                            </th>
                                            <th scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ $pjm->lab->nama_lab }}
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ $pjm->user->name ?? '-' }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $pjm->kelas->nama_kelas ?? '-' }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $pjm->mata_pelajaran }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $pjm->tanggal }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ date('H:i', strtotime($pjm->waktu_mulai)) }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ date('H:i', strtotime($pjm->waktu_selesai)) }}
                                            </td>
                                            <td class="px-6 py-4">
                                                @if ($pjm->status == 'Selesai')
                                                    <span
                                                        class="inline-flex items-center bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">
                                                        <span class="w-2 h-2 me-1 bg-green-500 rounded-full"></span>
                                                        {{ $pjm->status }}
                                                    </span>
                                                @elseif($pjm->status == 'Diganti / dibatalkan')
                                                    <span
                                                        class="inline-flex items-center bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">
                                                        <span class="w-2 h-2 me-1 bg-red-500 rounded-full"></span>
                                                        {{ $pjm->status }}
                                                    </span>
                                                @elseif ($pjm->status == 'Berjalan')
                                                    <span
                                                        class="inline-flex items-center bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-yellow-900 dark:text-yellow-300">
                                                        <span class="w-2 h-2 me-1 bg-yellow-500 rounded-full"></span>
                                                        {{ $pjm->status }}
                                                    </span>
                                                @elseif ($pjm->status == 'Dijadwalkan')
                                                    <span
                                                        class="inline-flex items-center bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300">
                                                        <span class="w-2 h-2 me-1 bg-blue-500 rounded-full"></span>
                                                        {{ $pjm->status }}
                                                    </span>
                                                @elseif ($pjm->status == 'Menunggu')
                                                    <span
                                                        class="inline-flex items-center bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-gray-900 dark:text-gray-300">
                                                        <span class="w-2 h-2 me-1 bg-gray-500 rounded-full"></span>
                                                        {{ $pjm->status }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="flex items-center px-6 py-4">
                                                @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 3)
                                                    {{-- Button edit --}}
                                                    <a href="{{ route('edit.view', $pjm->id) }}"
                                                        class="font-medium flex items-center no-underline text-blue-600 dark:text-blue-500 ">
                                                        <i class='bx bx-edit bx-sm'></i>
                                                    </a>
                                                @else
                                                    <i class='bx bx-edit bx-sm'></i>
                                                @endif

                                                @if (Auth::user()->role_id == 4)
                                                    <i class='bx bx-trash-alt bx-sm'></i>
                                                @else
                                                    {{-- Button hapus --}}
                                                    <button
                                                        class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3 @if ($pjm->status == 'Berjalan' || $pjm->status == 'Selesai') cursor-not-allowed @endif
                                                    "
                                                        data-modal-target="hapus-{{ $pjm->id }}"
                                                        data-modal-toggle="hapus-{{ $pjm->id }}"
                                                        @if ($pjm->status == 'Berjalan' || $pjm->status == 'Selesai') disabled @endif>
                                                        <i class='bx bx-trash-alt bx-sm'></i>
                                                    </button>
                                                @endif

                                                {{-- Modal hapus --}}
                                                <div id="hapus-{{ $pjm->id }}" tabindex="-1"
                                                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                    <form action="{{ route('peminjaman.delete', $pjm->id) }}"
                                                        method="POST"
                                                        class="relative p-4 w-full max-w-md max-h-full">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div
                                                            class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                            <button type="button"
                                                                class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                                data-modal-hide="hapus-{{ $pjm->id }}">
                                                                <svg class="w-3 h-3" aria-hidden="true"
                                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 14 14">
                                                                    <path stroke="currentColor" stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                                </svg>
                                                                <span class="sr-only">Close modal</span>
                                                            </button>
                                                            <div class="p-4 md:p-5 text-center">
                                                                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200"
                                                                    aria-hidden="true"
                                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 20 20">
                                                                    <path stroke="currentColor" stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                                </svg>
                                                                <h3
                                                                    class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                                                                    kamu yakin ingin hapus jadwal ini? </h3>
                                                                <button type="submit"
                                                                    class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">
                                                                    Ya, hapus
                                                                </button>
                                                                <button data-modal-hide="hapus-{{ $pjm->id }}"
                                                                    type="button"
                                                                    class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No,
                                                                    batal</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="p-6 my-4">
                    {{ $jadwal->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
