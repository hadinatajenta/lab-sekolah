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
                    <h4 class="text-2xl font-bold dark:text-white text-center">Edit Jadwal</h4>
                    <x-alert />
                    {{-- Form pengajuan --}}
                    <form class="max-w-sm mx-auto mt-5" action="{{ route('peminjaman.update', $peminjaman->id) }}"
                        method="POST">
                        @csrf
                        @method('PUT')
                        {{-- pilih lab --}}
                        <div class="mb-5">
                            <label for="lab_id"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih LAB</label>
                            <select id="lab_id" name="lab_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @foreach ($lab as $labs)
                                    <option value="{{ $labs->id }}"
                                        @if ($labs->status == 'Tidak tersedia') disabled @endif
                                        {{ $peminjaman->lab_id == $labs->id ? 'selected' : '' }}>{{ $labs->nama_lab }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        {{-- pilih guru pj --}}
                        <div class="mb-5">
                            <label for="user_id"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Guru
                                PJ</label>
                            <select id="user_id" name="user_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @foreach ($user as $usr)
                                    @if ($usr->role_id == 2)
                                        <option value="{{ $usr->id }}"
                                            @if ($peminjaman->user_id == $usr->id) selected @endif>
                                            {{ $usr->name ?? '-' }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        {{-- pilih kelas yang menggunakan --}}
                        <div class="mb-5">
                            <label for="kelas_id"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Kelas
                            </label>
                            <select id="kelas_id" name="kelas_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @foreach ($kelas as $kls)
                                    <option value="{{ $kls->id }}" {{ $peminjaman->kelas_id ? 'selected' : '' }}>
                                        {{ $kls->nama_kelas }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- pilih mapel yang mengisi lab --}}
                        <div class="mb-5">
                            <label for="mata_pelajaran"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Masukkan
                                Mapel</label>
                            <input type="text" name="mata_pelajaran" id="mata_pelajaran"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Masukkan Mapel" required value="{{ $peminjaman->mata_pelajaran }}">
                        </div>
                        {{-- Masukkan tanggal --}}
                        <div class="mb-5">
                            <label for="tanggal" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Tanggal</label>

                            <div class="relative max-w-sm">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                    </svg>
                                </div>
                                <input datepicker datepicker-format="yyyy/mm/dd" type="text" name="tanggal"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Select date" value="{{ $peminjaman->tanggal }}">
                            </div>
                        </div>
                        {{-- masukkan jam mulai --}}
                        <div class="mb-5">
                            <label for="waktu_mulai"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jam Mulai</label>
                            <input type="time" id="waktu_mulai" name="waktu_mulai"
                                value="{{ $peminjaman->waktu_mulai }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required>
                        </div>
                        {{-- jam selesai --}}
                        <div class="mb-5">
                            <label for="waktu_selesai"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jam Selesai</label>
                            <input type="time" id="waktu_selesai" name="waktu_selesai"
                                value="{{ $peminjaman->waktu_selesai }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required>
                        </div>
                        <div class="mb-5">
                            <label for="status"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ubah status
                            </label>
                            <select id="status" name="status"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="Selesai" {{ $peminjaman->status ? 'selected' : '' }}> Selesai </option>
                                <option value="Diganti / dibatalkan" {{ $peminjaman->status ? 'selected' : '' }}>
                                    Diganti / dibatalkan </option>
                                <option value="Dijadwalkan" {{ $peminjaman->status ? 'selected' : '' }}> Dijadwalkan
                                </option>
                                <option value="Berjalan" {{ $peminjaman->status ? 'selected' : '' }}> Berjalan
                                </option>
                            </select>
                        </div>

                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                    </form>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
