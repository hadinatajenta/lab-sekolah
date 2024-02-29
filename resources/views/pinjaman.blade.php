<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Peminjaman LAB') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden  sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="flex items-center justify-between  mb-3">
                        {{-- Form peminjaman --}}
                        <a href="{{ route('forms.view') }}"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5  me-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                            style="display: inline-block; white-space:nowrap">Tambah Jadwal</a>
                        {{-- Search input --}}
                        <form class="flex items-center" action="{{route('peminjaman.view')}}" method="GET">
                            <label for="simple-search" class="sr-only">Search</label>
                            <div class="relative w-full">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M3 5v10M3 5a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm0 10a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm12 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0V6a3 3 0 0 0-3-3H9m1.5-2-2 2 2 2" />
                                    </svg>
                                </div>
                                <input type="text" id="simple-search"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Cari jadwal ... " name="keyword">
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

                    <div class="relative overflow-x-auto  sm:rounded-lg">
                        {{-- Notifikasi --}}
                        <x-alert />

                        {{-- table daftar kelas --}}
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="p-4">
                                        <div class="flex items-center">
                                            <input id="checkbox-all-search" type="checkbox"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <label for="checkbox-all-search" class="sr-only">checkbox</label>
                                        </div>
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
                                    <th scope="col" class="px-6 py-3">
                                        Mata Pelajaran
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Tanggal
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Jam Mulai
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Jam Selesai
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jadwal as $pjm)
                                    <tr
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="w-4 p-4">
                                            <div class="flex items-center">
                                                <input id="checkbox-table-search-1" type="checkbox"
                                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                                            </div>
                                        </td>
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $pjm->lab->nama_lab }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ $pjm->user->name }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $pjm->kelas->nama_kelas }}
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
                                            @endif
                                        </td>
                                        <td class="flex items-center px-6 py-4">
                                            {{-- Button edit --}}
                                            @if ($pjm->status == 'Berjalan' || $pjm->status == 'Selesai')
                                                <span
                                                    class="font-medium text-gray-400 dark:text-gray-500 cursor-not-allowed"
                                                    title="Tidak bisa diedit">Edit</span>
                                            @else
                                                <a href="{{ route('edit.view', $pjm->id) }}"
                                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                            @endif

                                            {{-- Button hapus --}}
                                            <button href="#"
                                                class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3 @if ($pjm->status == 'Berjalan' || $pjm->status == 'Selesai') cursor-not-allowed @endif "
                                                data-modal-target="hapus-{{ $pjm->id }}"
                                                data-modal-toggle="hapus-{{ $pjm->id }}"
                                                @if ($pjm->status == 'Berjalan' || $pjm->status == 'Selesai') disabled @endif>hapus</button>
                                            {{-- Modal hapus --}}
                                            <div id="hapus-{{ $pjm->id }}" tabindex="-1"
                                                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                <form action="{{ route('peminjaman.delete', $pjm->id) }}"
                                                    method="POST" class="relative p-4 w-full max-w-md max-h-full">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
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
                                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                                fill="none" viewBox="0 0 20 20">
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
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
