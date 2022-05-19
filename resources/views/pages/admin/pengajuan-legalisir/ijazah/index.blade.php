@extends("layouts.user.template")
@section("main")
    <x-wrapper.table :columns="$tables['transactionTable']" name="transactionTable">
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
    <x-wrapper.modal name="documentsModal">
        <x-slot name="body">
            @php
                $options = [
                      'order' => [],
                      'bSort' => false,
                      'targets' => "no-sort",
                      'searching' => false,
                      'paging'=> false,
                      'info' => false
                  ];
            @endphp
            <x-wrapper.table :options="$options" :columns="$tables['documentsTable']" name="documentsTable"
                             :isServerSide="false">
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
                    </div>
                </x-slot>
            </x-wrapper.table>
        </x-slot>
    </x-wrapper.modal>
@endsection

@push("stack-script")
    <script>
        $(document).ready(function () {
            const name = "transactionTable"
            const dataTable = table.dataTable.readExistingDataTable(name)
            const documentsDataTable = table.dataTable.readExistingDataTable("documentsTable")
            table.dataTable.action(documentsDataTable, 'click', '#download', function (document) {
                window.open(helper.url.routeUri('admin.attachment', {attachment: document?.attachment_id}))
            })
            table.dataTable.action(dataTable, 'click', '#download', function (data) {
                const documents = data?.documents
                documentsDataTable.clear().draw()
                documents.map((document) => {
                    documentsDataTable.row.add(document).draw()
                })
                $("#documentsModal").modal("show");

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
