<div class="table-responsive">
    <table id="{{$name}}" class="table table-striped table-bordered" style="width:100%">
        <thead class="bg-primary text-white">
        <tr>
            @forelse($columns as $columnName => $keyValue)
                <th>{{$columnName}}</th>
            @empty
            @endforelse
        </tr>
        </thead>
        <tfoot>
        <tr>
            @forelse($columns as $columnName => $keyValue)
                <th>{{$columnName}}</th>
            @empty
            @endforelse
        </tr>
        </tfoot>
    </table>
</div>
@push("stack-script")
    <script>
        $(document).ready(function () {
            const action = `<?=$action?>`;
            const tableName = "<?=$name?>"
            const url = "<?=$url?>"
            const isLocalhost = <?=json_encode($isLocalhost)?>;
            const columns = <?=json_encode($columns)?>;
            const requestUrl = isLocalhost ? `${window.location.origin}${url}` : url;
            const mappedColumns = Object.entries(columns)?.map(([columnName, keyValue]) => ({data: keyValue}))
            $(`#${tableName}`).DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: requestUrl,
                    contentType: "application/json",
                    accept: "application/json",
                },
                "columns": mappedColumns,
                columnDefs: [
                    {
                        targets: -1,
                        render: function (data, type, row, meta) {
                            return action
                        }
                    }
                ]
            });
        });
    </script>
@endpush
