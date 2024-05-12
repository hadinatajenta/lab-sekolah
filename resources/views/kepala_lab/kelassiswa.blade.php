<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Siswa Kelas   ') }} {{ $kelas->nama_kelas }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden  sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="relative overflow-x-auto  sm:rounded-lg">
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
                                        Kelas
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Jenis Kelamin
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Nomor Telp
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Alamat
                                    </th>

                                </tr>
                            </thead>
                            <tbody>
                                @if ($siswa->count() >= 1)
                                    @foreach ($siswa as $index => $ss)
                                        <tr
                                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                            <td class="px-6 py-4">
                                                {{ $index + 1 }}
                                            </td>
                                            <th scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ $ss->name }}
                                            </th>
                                            <th scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ $ss->kelas->nama_kelas }}
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ $ss->email }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $ss->kelas->nama_kelas }}
                                            </td>

                                            <td class="px-6 py-4">
                                                {{ $ss->jenis_kelamin ?? 'Belum diatur' }}
                                            </td>

                                            <td class="px-6 py-4">
                                                {{ $ss->nomor_telp ?? '-' }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $ss->alamat ?? 'Belum diatur' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <td colspan="6" class="px-6 py-4 text-center"> Tidak ada siswa ditemukan pada
                                        kelas ini </td>
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
