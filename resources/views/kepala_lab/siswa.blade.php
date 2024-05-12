<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Siswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="p-6 text-gray-900">
                    <div class="mb-4">
                        <h4 class="font-bold text-2xl">Siswa</h4>
                        <p class="text-gray-600">Hanya Kepala LAB yang dapat Mengelola Dashboard ini.</p>
                    </div>
                    <div class="grid sm:grid-cols-1 md:grid-cols-4 grid-cols-1 gap-4 justify-items-start">
                        {{-- 1 --}}
                        <div class="bg-[#fcebfe] w-full rounded p-4 flex items-center">
                            <div class="mr-2">
                                <i class='bx bx-buildings bx-lg text-[#ca5ad7]'></i>
                            </div>
                            <div>
                                <span class="text-lg font-bold text-[#923c9c]">Jumlah Siswa</span>
                                <p class="text-lg">{{ $siswa->count() }}</p>
                            </div>
                        </div>
                        {{-- 2 --}}
                        <div class="bg-[#f0ffec] w-full rounded p-4 flex items-center">
                            <div class="mr-2">
                                <i class='bx bx-user bx-lg text-[#6ecc53]'></i>
                            </div>
                            <div>
                                <span class="text-lg font-bold text-[#4f8b3f]">Kelas 7</span>
                                <p class="text-lg"> {{ $kelas7->jumlah_siswa ?? '0' }} </p>
                            </div>
                        </div>
                        {{-- 3 --}}
                        <div class="bg-[#ffebf0] w-full rounded p-4  flex items-center">
                            <div class="mr-2">
                                <i class='bx bx-user bx-lg text-[#f199af]'></i>
                            </div>
                            <div>
                                <span class="text-lg font-bold text-[#ae596e]">Kelas 8</span>
                                <p class="text-lg">{{ $kelass8->jumlah_siswa ?? '0' }}</p>
                            </div>
                        </div>
                        {{-- 4 --}}
                        <div class="bg-[#ffebf0] w-full rounded p-4  flex items-center">
                            <div class="mr-2">
                                <i class='bx bx-user bx-lg text-[#f199af]'></i>
                            </div>
                            <div>
                                <span class="text-lg font-bold text-[#ae596e]">Kelas 9</span>
                                <p class="text-lg">{{ $kelas9->jumlah_siswa ?? '0' }}</p>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
            <div class="bg-white overflow-hidden  sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="relative overflow-x-auto  sm:rounded-lg">
                        <!-- Modal toggle -->
                        <div class="flex items-center mb-3 justify-between">
                            @if (Auth::user()->role_id == 1)
                                <button data-modal-target="user-modal" data-modal-toggle="user-modal"
                                    class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                    type="button">
                                    Tambah Siswa
                                </button>
                            @endif

                            <!-- Tambah user modal -->
                            <div id="user-modal" tabindex="-1" aria-hidden="true"
                                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-md max-h-full">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <!-- Modal header -->
                                        <div
                                            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                Tambah data siswa
                                            </h3>
                                            <button type="button"
                                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                data-modal-toggle="user-modal">
                                                <svg class="w-3 h-3" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                </svg>
                                                <span class="sr-only">Tutup</span>
                                            </button>
                                        </div>
                                        <!-- Modal body -->
                                        <form class="p-4 md:p-5" action="{{ route('create.siswa') }}" method="post">
                                            @csrf
                                            <div class="grid gap-4 mb-4 grid-cols-2">
                                                <div class="col-span-2">
                                                    <label for="name"
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                                        pengguna</label>
                                                    <input type="text" name="name" id="name"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                        placeholder="Masukkan Nama pengguna" required="">
                                                </div>
                                                <div class="col-span-2">
                                                    <label for="email"
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email
                                                    </label>
                                                    <input type="email" name="email" id="email"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                        placeholder="johndoe@gmail.com" required>
                                                </div>
                                                <div class="col-span-2">
                                                    <label for="password"
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password
                                                    </label>
                                                    <input type="password" name="password" id="password"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                        placeholder="********" required>
                                                </div>
                                                <div class="col-span-2">
                                                    <label for="countries"
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                        Pilih Kelas</label>
                                                    <select id="countries" name="kelas_id"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                        <option selected disabled> Kelas</option>
                                                        @foreach ($kelas as $kls)
                                                            <option value="{{ $kls->id }}">
                                                                {{ $kls->nama_kelas ?? 'tidak ada' }} </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <button type="submit"
                                                class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                                Tambah siswa
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            {{-- search --}}
                            <form class="flex items-center" action="{{ route('siswa.view') }}" method="GET">
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
                                        placeholder="Cari Siswa ... " name="cari">
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

                        {{-- notifikasi --}}
                        <x-alert />

                        {{-- table daftar kelas --}}
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        No
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Nama Siswa
                                    </th>

                                    <th scope="col" class="px-6 py-3">
                                        Kelas
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Email
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Nomor Telp
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Alamat
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Jenis Kelamin
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $index => $kl)
                                    <tr
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $index + 1 }}
                                        </th>
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $kl->name ?? '?' }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ $kl->nama_kelas ?? 'Kelas tidak ditemukan' }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $kl->email }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $kl->nomor_telp ?? '-' }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $kl->alamat ?? 'Tidak ada' }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $kl->jenis_kelamin ?? 'Belum diatur' }}
                                        </td>

                                        <td class="flex items-center px-6 py-4">
                                            {{-- Button edit --}}
                                            @if (Auth::user()->role_id != 1)
                                                <i class='bx bx-edit bx-sm'></i>
                                            @else
                                                <button type="button"
                                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                                                    data-modal-toggle="update-user-{{ $kl->id }}"
                                                    data-modal-target="update-user-{{ $kl->id }}"
                                                    @if (Auth::user()->id == $kl->id) disabled @endif>
                                                    <i class='bx bx-edit bx-sm'></i>
                                                </button>
                                            @endif

                                            {{-- Modal edit --}}
                                            <div id="update-user-{{ $kl->id }}" tabindex="-1"
                                                aria-hidden="true"
                                                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                <div class="relative p-4 w-full max-w-md max-h-full">
                                                    <!-- Modal content -->
                                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                        <!-- Modal header -->
                                                        <div
                                                            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                            <h3
                                                                class="text-lg font-semibold text-gray-900 dark:text-white">
                                                                Edit user
                                                            </h3>
                                                            <button type="button"
                                                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                                data-modal-toggle="update-user-{{ $kl->id }}">
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
                                                        <form class="p-4 md:p-5"
                                                            action="{{ route('update.siswa', $kl->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="grid gap-4 mb-4 grid-cols-2">
                                                                <div class="col-span-2">
                                                                    <label for="name"
                                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                                                        siswa</label>
                                                                    <input type="text" name="name"
                                                                        id="name"
                                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                                        placeholder="Masukkan Nama pengguna"
                                                                        value="{{ $kl->name }}" required="">
                                                                </div>
                                                                <div class="col-span-2">
                                                                    <label for="email"
                                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email
                                                                    </label>
                                                                    <input type="email" name="email"
                                                                        id="email"
                                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                                        placeholder="johndoe@gmail.com"
                                                                        value="{{ $kl->email }}" required>
                                                                </div>

                                                                <div class="col-span-2">
                                                                    <label for="countries"
                                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                                        Pilih Kelas</label>
                                                                    <select id="countries" name="kelas_id" required
                                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                                        <option value="" disabled>Pilih kelas
                                                                        </option>
                                                                        @foreach ($kelas as $kls)
                                                                            <option
                                                                                @if ($kls->id == $kl->kelas_id) selected @endif
                                                                                value="{{ $kls->id }}">
                                                                                {{ $kls->nama_kelas }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <div class="col-span-2">
                                                                    <label for="countries"
                                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                                        Jenis Kelamin</label>
                                                                    <select id="jenis_kelamin" name="jenis_kelamin"
                                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                                        <option selected disabled> Pilih</option>
                                                                        <option value="Laki-laki"> Laki-laki</option>
                                                                        <option value="Perempuan"> Perempuan</option>

                                                                    </select>
                                                                </div>

                                                                <div class="col-span-2">
                                                                    <div class="relative max-w-sm">
                                                                        <div
                                                                            class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                                                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400"
                                                                                aria-hidden="true"
                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                                fill="currentColor"
                                                                                viewBox="0 0 20 20">
                                                                                <path
                                                                                    d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                                                            </svg>
                                                                        </div>
                                                                        <input datepicker type="text"
                                                                            id="datePicker"
                                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                                            placeholder="Select date">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <button type="submit"
                                                                class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                                <svg class="w-6 h-6 text-white dark:text-white"
                                                                    aria-hidden="true"
                                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24">
                                                                    <path stroke="currentColor"
                                                                        stroke-linecap="square"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="M7 19H5a1 1 0 0 1-1-1v-1a3 3 0 0 1 3-3h1m4-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm7.4 1.6a2 2 0 0 1 0 2.7l-6 6-3.4.7.7-3.4 6-6a2 2 0 0 1 2.7 0Z" />
                                                                </svg>
                                                                Edit Pengguna
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Button hapus --}}
                                            @if (Auth::user()->role_id != 1)
                                                <i class='bx bx-trash-alt bx-sm'></i>
                                            @else
                                                <button
                                                    class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3"
                                                    data-modal-target="hapus-{{ $kl->id }}"
                                                    data-modal-toggle="hapus-{{ $kl->id }}"
                                                    @if (Auth::user()->id == $kl->id) disabled @endif>
                                                    <i class='bx bx-trash-alt bx-sm'></i>
                                                </button>
                                            @endif
                                            {{-- Modal hapus --}}
                                            <div id="hapus-{{ $kl->id }}" tabindex="-1"
                                                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                <form action="{{ route('delete.siswa', $kl->id) }}" method="POST"
                                                    class="relative p-4 w-full max-w-md max-h-full">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                        <button type="button"
                                                            class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                            data-modal-hide="popup-modal">
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
                                                                kamu yakin ingin menghapus {{ $kl->name }} dari
                                                                sistem? Tindakan ini tidak
                                                                dapat dibatalkan.
                                                            </h3>
                                                            <button type="submit"
                                                                class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">
                                                                Ya, hapus
                                                            </button>
                                                            <button data-modal-hide="hapus-{{ $kl->id }}"
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
    </div>
</x-app-layout>
