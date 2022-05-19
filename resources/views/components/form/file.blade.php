<x-wrapper.form-group label="{{$label}}" name="{{$name}}" error="{{$error}}" helper="{{$helper}}" :isGroup="$isGroup">
    <div class="custom-file">
        <input name="{{$name}}" type="file" class="custom-file-input" id="{{$id}}"
               aria-describedby="{{$name}}" {{$isMultiple ? "multiple" : null}}>
        <label class="custom-file-label" for="{{$name}}">{{$placeholder ?? $label ?? "Choose file"}}</label>
    </div>
    <div id="{{$id}}-preview" class="custom-file-preview">

    </div>
</x-wrapper.form-group>
@push("stack-script")
    <script>
        $(document).ready(function () {
            const inputId = "<?=$id?>"
            $(`#${inputId}`).on("change", function (e) {
                const files = Array.from(e.currentTarget.files)
                const file = files.shift()
                const fileSize = helper.file.getSize(file)
                $(e.currentTarget).parent().find("label").text(`${file.name} (${fileSize})`)
            })
        })
    </script>
@endpush
