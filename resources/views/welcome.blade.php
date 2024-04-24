<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title> {{ __('Penjadwalan LAB') }} </title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />

</head>

<body class="antialiased">
    {{-- Navbar --}}
    <nav class="bg-white border-gray-200 dark:bg-gray-900">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
                {{-- Icon --}}
                <img src="/img/tut.png" class="h-8" alt="Flowbite Logo" />
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">SMPN28</span>
            </a>
            {{-- Hamburger menu --}}
            <button data-collapse-toggle="navbar-default" type="button"
                class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                aria-controls="navbar-default" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
            <div class="hidden w-full md:block md:w-auto " id="navbar-default">
                <ul
                    class="font-medium flex items-center flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                    <li>
                        <a href="{{ route('welcome') }}"
                            class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white md:dark:text-blue-500"
                            aria-current="page">Home</a>
                    </li>
                    <li>
                        <a href="#about"
                            class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent"
                            aria-current="page">About</a>
                    </li>
                    <li>
                        <a href="#jadwal"
                            class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Jadwal</a>
                    </li>
                    <li>
                        @if (Auth::check())
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Logout</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Login</a>
                        @endif

                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="bg-white dark:bg-gray-900">
        <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 h-screen">
            <div class="mr-auto place-self-center lg:col-span-7">
                <h1
                    class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl dark:text-white">
                    Sistem <span style="color: #0b76e5;">Penjadwalan</span> <span style="color: #ffb24c">LAB</span> SMPN
                    28</h1>
                <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">
                    Dapatkan Informasi Jadwal LAB melalui Sistem Informasi Penjadwalan LAB SMPN 28 Bandar Lampung.</p>
                <a href="#"
                    class="inline-flex items-center justify-center px-5 py-3 mr-3 text-base font-medium text-center text-white  rounded-lg bg-blue-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:focus:ring-primary-900">
                    Lihat Jadwal
                    <svg class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </a>

            </div>
            <div class=" lg:mt-0 lg:col-span-5 lg:flex">
                <img src="/img/jadwal.svg" alt="mockup">
            </div>
        </div>
    </section>
    <section style="background: #f4f5fa" class="py-12 px-6 " id="about">
        <div class="grid max-w-screen-xl mx-auto lg:gap-8 xl:gap-0 px-8 lg:py-16 lg:grid-cols-12 bg-white"
            style="border-radius: 40px">
            <div class=" lg:mt-0 lg:col-span-5 lg:flex">
                <img src="/img/human.svg" alt="mockup">
            </div>
            <div class="mr-auto place-self-center lg:col-span-7">
                <h1
                    class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-4xl dark:text-white">
                    Sistem Penjadwalan Lab</h1>
                <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">
                    Temukan jadwal Pemakaian Lab pada website ini, dapatkan informasi mengenai jadwal pemakaian lab dan
                    ajukan peminjaman lab segera!.</p>
                <a href="#"
                    class="inline-flex items-center justify-center px-5 py-3 mr-3 text-base font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:focus:ring-primary-900">
                    Ajukan jadwal
                    <svg class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </a>
                <a href="#jadwal"
                    class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-gray-900 border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                    Temukan jadwal
                </a>
            </div>
        </div>
    </section>
    <section id="jadwal" class="py-12 px-6" style="background: #f4f5fa">
        <div class="grid max-w-screen-xl mx-auto bg-white rounded-xl p-8 lg:gap-8 xl:gap-0 lg:grid-cols-12 lg:py-16">
            <div class="lg:col-span-5 flex justify-center">
                <img src="/img/jadwal2.svg" alt="Classroom" class="max-w-full h-auto">
            </div>
            <div class="lg:col-span-7 place-self-center">
                <h1 class="text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl mb-4">
                    Jadwal LAB Hari ini
                </h1>
                <p class="text-gray-500 text-lg lg:text-xl mb-6">
                    Lihat dan pantau jadwal lab terkini. Pastikan Anda selalu terinformasi tentang perubahan waktu
                    atau ruangan lab.
                </p>
                <div class="flex flex-col space-y-4">
                    <!-- Jadwal -->
                    @foreach ($jadwals as $jdwl)
                        <div class="flex justify-between items-center p-4 bg-gray-100 rounded-lg">
                            <span class="font-medium text-gray-800">
                                {{ $jdwl->kelas->nama_kelas ?? '-' }} |
                                {{ $jdwl->mata_pelajaran ?? 'Tidak ada' }} -
                                {{ $jdwl->lab->nama_lab ?? 'Tidak ada' }}
                            </span>
                            <span class="text-gray-600">
                                {{ date('H:i', strtotime($jdwl->waktu_mulai)) ?? '00:00' }} -
                                {{ date('H:i', strtotime($jdwl->waktu_selesai)) ?? '00:00' }}
                            </span>
                        </div>
                    @endforeach
                    <!-- Tambah jadwal lebih banyak sesuai kebutuhan -->
                    {{-- <a href="#"
                        class="px-5 py-3 bg-blue-700 text-white rounded-lg text-center font-medium hover:bg-blue-800">
                        Lihat Semua Jadwal
                    </a> --}}
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>

</html>
