@extends("layouts.user.template")
@section("main")
    @php
        $columns = [
        'Token' => 'token',
        'NIM' => 'user.student_id',
        'Nama' => 'user.name',
        'Fakultas' => 'faculty.name',
        'Program Studi' => 'study_program.name',
        'Aksi' => null,
    ];
    @endphp
    <x-wrapper.table :columns="$columns" name="data">
        <x-slot name="action">
            <div class="d-flex justify-content-around">
                <x-form.button id="download"
                               circle
                               type="{{\App\View\Components\Form\Button::TYPE_INFO}}"
                               size="{{\App\View\Components\Form\Button::SIZE_SMALL}}"
                               data-toggle="tooltip"
                               title="Unduh Dokumen"
                >
                    <i class="fa fa-download" aria-hidden="true"></i>
                </x-form.button>
                <x-form.button id="view"
                               circle
                               size="{{\App\View\Components\Form\Button::SIZE_SMALL}}"
                               title="Lihat Detail"
                               outline
                >
                    <i class="fa fa-eye" aria-hidden="true"></i>
                </x-form.button>
            </div>
        </x-slot>
    </x-wrapper.table>
@endsection

@push("stack-script")
    <script>
        $(document).ready(function () {
            const name = "data"
            const dataTable = table.dataTable.readExistingDataTable(name)
            table.dataTable.action(dataTable, 'click', '#download', function (data) {
                console.log("download", data)
            })
            table.dataTable.action(dataTable, 'click', '#view', function (data) {
                window.location.href = helper.url.routeUri('admin.pengajuan-legalisir.ijazah.detail', {transaction: data?.id})
            })
            table.dataTable.action(dataTable, 'click', '#cancel', function (data) {
                console.log("cancel", data)
            })
        });
    </script>
@endpush
