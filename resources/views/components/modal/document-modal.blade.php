<x-wrapper.modal :name="$name">
    @php
        $options = [
              "initComplete"=> $name.'DataTableCallback',
              'order' => [],
              'bSort' => false,
              'targets' => "no-sort",
              'searching' => false,
              'paging'=> false,
              'info' => false
          ];
    @endphp
    <x-wrapper.table :options="$options" :columns="$table" :name="$name"
                     :isServerSide="$isServerSide">
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
    {{$slot}}
</x-wrapper.modal>


@push("stack-script")
    <script>
        function <?=$name?>DataTableCallback() {
            const documentsDataTableName = "<?=$name?>";
            const documentsDataTable = table.dataTable.readExistingDataTable(documentsDataTableName)
            const attachmentUri = "<?=$attachmentUri?>"
            table.dataTable.action(documentsDataTable, 'click', '#download', function (document) {
                window.open(helper.url.routeUri(attachmentUri, {attachment: document?.attachment_id}))
            })
        }
    </script>
@endpush
