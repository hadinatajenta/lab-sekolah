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
                    <h4 class="text-2xl fp.ont-bold dark:text-white text-center">Form pengajuan</h4>
                    <p class="text-gray-400 text-center">Baca aturan untuk peminjaman lab
                        <a href="#" data-modal-target="disini" data-modal-toggle="disini"
                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Disini</a>
                    </p>
                    <div id="disini" tabindex="-1" aria-hidden="true"
                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-2xl max-h-full">
                            <!-- Modal content -->
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <!-- Modal header -->
                                <div
                                    class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                        Aturan form peminjaman LAB
                                    </h3>
                                    <button type="button"
                                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                        data-modal-hide="disini">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <!-- Modal body -->
                                <div class="p-4 md:p-5 space-y-4">

                                    <h2 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Aturan :</h2>
                                    <ul
                                        class="max-w-md space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400">
                                        <li>
                                            Pengguna hanya dapat meminjam lab dengan status <span
                                                class="inline-flex items-center bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">
                                                <span class="w-2 h-2 me-1 bg-green-500 rounded-full"></span>
                                                Tersedia
                                            </span>.
                                        </li>
                                        <li>
                                            Yang dapat menjadi Guru PJ adalah user dengan Role sebagai Guru, Laboran
                                            tidak dapat menjadi Guru PJ.
                                        </li>
                                        <li>
                                            Tidak dapat memilih tanggal yang sudah lewat.
                                        </li>
                                        <li>
                                            Tidak dapat menambahkan jadwal yang sama dengan
                                        </li>
                                    </ul>


                                </div>
                                <!-- Modal footer -->
                                <div
                                    class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                    <button data-modal-hide="disini" type="button"
                                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Oke,
                                        paham.
                                    </button>
                                    <button data-modal-hide="disini" type="button"
                                        class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <x-alert />
                    {{-- Form pengajuan --}}
                    <form class="max-w-sm mx-auto mt-5" action="{{ route('peminjaman.create') }}" method="POST">
                        @csrf
                        {{-- pilih lab --}}
                        <div class="mb-5">
                            <label for="lab_id"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih LAB</label>
                            <select id="lab_id" name="lab_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @foreach ($lab as $labs)
                                    <option value="{{ $labs->id }}"
                                        @if ($labs->status == 'Tidak tersedia') disabled @endif>{{ $labs->nama_lab }}</option>
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
                                    @if ($usr->role_id == 3)
                                        <option value="{{ $usr->id }}">{{ $usr->name }}</option>
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
                                    <option value="{{ $kls->id }}">{{ $kls->nama_kelas }}</option>
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
                                placeholder="Masukkan Mapel" required>
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
                                    placeholder="Select date">
                            </div>
                        </div>
                        {{-- masukkan jam mulai --}}
                        <div class="mb-5">
                            <label for="waktu_mulai"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jam Mulai</label>
                            <input type="time" id="waktu_mulai" name="waktu_mulai"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required>
                        </div>
                        {{-- jam selesai --}}
                        <div class="mb-5">
                            <label for="waktu_selesai"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jam
                                Selesai</label>
                            <input type="time" id="waktu_selesai" name="waktu_selesai"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required>
                        </div>

                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
