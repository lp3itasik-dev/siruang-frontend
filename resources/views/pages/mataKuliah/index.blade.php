<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Mata Kuliah') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-center">
                <div class="w-full md:w-5/12 p-3">
                    <div class="bg-white w-full dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <div
                                class="lg:p-2 p-2 lg:pl-4 text-sm lg:text-lg text-center lg:text-left bg-amber-100 lg:bg-amber-50 rounded-xl font-bold">
                                FORM INPUT MATA KULIAH
                            </div>
                            <form action="{{ route('mataKuliah.store') }}" method="post">
                                @csrf
                                <div class="p-4 rounded-xl">
                                    <div class="mb-5">
                                        <label for="mata_kuliah"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mata
                                            Kuliah</label>
                                        <input type="text" name="mata_kuliah"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Masukan mata kuliah disini ..." required />
                                    </div>
                                    <div class="mb-5">
                                        <label for="sks"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">SKS</label>
                                        <select class="js-example-placeholder-single js-states form-control w-full m-6"
                                            name="sks" data-placeholder="Pilih SKS">
                                            <option value="">Pilih...</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                        </select>
                                    </div>
                                    <button type="submit"
                                        class="text-blue-500 w-10 bg-blue-50 hover:bg-blue-100 border-2 border-blue-100 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-xl text-md sm:w-auto px-3 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"><i
                                            class="fi fi-ss-floppy-disk-pen"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-9/12 p-3">
                    <div class="bg-white w-full dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <div
                                class="lg:p-2 p-2 lg:pl-4 text-sm lg:text-lg text-center lg:text-left bg-amber-100 lg:bg-amber-50 rounded-xl font-bold">
                                DATA MATA KULIAH
                            </div>
                            <div class="flex justify-center">
                                <div class="p-12" style="width:100%;  overflow-x:auto;">
                                    <table class="table table-bordered" id="tahun-akademik-datatable">
                                        <thead>
                                            <tr>
                                                <th class="w-7">No.</th>
                                                <th>Mata Kuliah</th>
                                                <th>SKS</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $no = 1;
                                            @endphp
                                            @foreach ($data as $d)
                                                <tr>
                                                    <td>{{ $no++ }}.</td>
                                                    <td>{{ $d->mata_kuliah }}</td>
                                                    <td>{{ $d->sks }}</td>
                                                    <td>
                                                        <button type="button" data-id="{{ $d->id }}"
                                                            data-modal-target="sourceModal"
                                                            data-mata_kuliah="{{ $d->mata_kuliah }}"
                                                            data-sks="{{ $d->sks }}"
                                                            onclick="editSourceModal(this)"
                                                            class="bg-amber-50 hover:bg-amber-100 text-amber-950 px-3 py-1 rounded-xl h-10 w-10 text-xs border-2 border-amber-100">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        @if (in_array($d->id, $jadwalUserIds))
                                                        @else
                                                            <button
                                                                onclick="return dataDelete('{{ $d->id }}','{{ $d->mata_kuliah }}')"
                                                                class="bg-red-50 hover:bg-red-100 px-3 py-1 text-amber-950 rounded-xl h-10 w-10 text-xs border-2 border-red-100"><i
                                                                    class="fas fa-trash"></i></button>
                                                        @endif
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
        </div>
    </div>
    <div class="fixed inset-0 flex items-center justify-center z-50 hidden" id="sourceModal">
        <div class="fixed inset-0 bg-black opacity-50"></div>
        <div class="fixed inset-0 flex items-center justify-center">
            <div class="w-full md:w-1/4 relative bg-white rounded-lg shadow mx-5">
                <div class="flex items-start justify-between p-4 border-b rounded-t">
                    <h3 class="text-xl font-semibold text-gray-900" id="title_source">
                        Tambah Sumber Database
                    </h3>
                    <button type="button" onclick="sourceModalClose(this)" data-modal-target="sourceModal"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center"
                        data-modal-hide="defaultModal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <form method="POST" id="formSourceModal">
                    @csrf
                    <div class="flex flex-col  p-4 space-y-6">
                        <div class="">
                            <label for="text" class="block mb-2 text-sm font-medium text-gray-900">Mata
                                Kuliah</label>
                            <input type="text" id="mata_kuliah" name="mata_kuliah"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Masukan Mata Kuliah disini...">
                        </div>
                        <div class="mb-5">
                            <label for="text" class="block mb-2 text-sm font-medium text-gray-900">SKS</label>
                            <select class="js-example-placeholder-single js-states form-control w-full m-6"
                                name="skss" data-placeholder="Pilih SKS">
                                <option value="">Pilih...</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex items-center p-4 space-x-2 border-t border-gray-200 rounded-b">
                        <button type="submit" id="formSourceButton"
                            class="bg-emerald-50 m-2 w-40 h-10 rounded-xl hover:bg-emerald-100 border-2 border-emerald-100">Simpan</button>
                        <button type="button" data-modal-target="sourceModal" onclick="sourceModalClose(this)"
                            class="bg-red-50 m-2 w-40 h-10 rounded-xl hover:shadow-lg hover:bg-red-100 border-2 border-red-100">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#tahun-akademik-datatable').DataTable(); // Inisialisasi sederhana
        });
    </script>
    <script>
        const editSourceModal = (button) => {
            const formModal = document.getElementById('formSourceModal');
            const modalTarget = button.dataset.modalTarget;
            const id = button.dataset.id;
            const mata_kuliah = button.dataset.mata_kuliah;
            const sks = button.dataset.sks;
            let url = "{{ route('mataKuliah.update', ':id') }}".replace(':id', id);
            console.log(url);
            let status = document.getElementById(modalTarget);
            document.getElementById('title_source').innerText = `${mata_kuliah}`;
            document.getElementById('mata_kuliah').value = mata_kuliah;
            let event = new Event('change');
            document.querySelector('[name="skss"]').value = sks;
            document.querySelector('[name="skss"]').dispatchEvent(event);
            document.getElementById('formSourceButton').innerText = 'Simpan';
            document.getElementById('formSourceModal').setAttribute('action', url);
            let csrfToken = document.createElement('input');
            csrfToken.setAttribute('type', 'hidden');
            csrfToken.setAttribute('value', '{{ csrf_token() }}');
            formModal.appendChild(csrfToken);

            let methodInput = document.createElement('input');
            methodInput.setAttribute('type', 'hidden');
            methodInput.setAttribute('name', '_method');
            methodInput.setAttribute('value', 'PATCH');
            formModal.appendChild(methodInput);

            status.classList.toggle('hidden');
        }

        const sourceModalClose = (button) => {
            const modalTarget = button.dataset.modalTarget;
            let status = document.getElementById(modalTarget);
            status.classList.toggle('hidden');
        }

        const dataDelete = async (id, hari) => {
            let tanya = confirm(`Apakah anda yakin untuk menghapus mata kuliah ${hari} ?`);
            if (tanya) {
                await axios.post(`/mataKuliah/${id}`, {
                        '_method': 'DELETE',
                        '_token': $('meta[name="csrf-token"]').attr('content')
                    })
                    .then(function(response) {
                        Swal.fire({
                            title: "Data Berhasil dihapus",
                            text: "Klik OK untuk memuat ulang halaman",
                            icon: "error",
                            confirmButtonText: "OK"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    })
                    .catch(function(error) {
                        // Handle error
                        alert('Error deleting record');
                        console.log(error);
                    });
            }
        }
    </script>
</x-app-layout>
