<div id="transaction-attachment">
    {{--    {{dd(\Illuminate\Support\Facades\Session::getOldInput(),old('documents'))}}--}}
    @forelse(old('documents',\App\Supports\FormSupport::getFormData('documents')??[]) as $index => $document)
        <div id="transaction-attachment-item">
            <x-wrapper.form isRow>
                <x-wrapper.column>
                    <x-form.input name="documents[{{$index}}][name]" label="Nama Dokumen" isGroup/>
                </x-wrapper.column>

                <x-wrapper.column>
                    <x-form.file id="file" name="documents[{{$index}}][file]" label="Dokumen Legalisir"
                                 placeholder="Pilih Dokumen"
                                 isGroup
                                 noResize isMultiple/>
                </x-wrapper.column>
                <x-wrapper.column>
                    <x-form.input type="number" name="documents[{{$index}}][qty]" label="Jumlah Salinan" isGroup/>
                </x-wrapper.column>
                <div class="col-1">
                    <x-wrapper.form-group label="&nbsp;" isGroup>
                        <div class="d-block py-1">
                            <x-form.button id="transaction-attachment-remove" :isSubmit="false" circle outline
                                           type="{{\App\View\Components\Form\Button::TYPE_DANGER}}"
                                           size="{{\App\View\Components\Form\Button::SIZE_SMALL}}">
                                <i class="fa fa-times" aria-hidden="true"></i>
                            </x-form.button>
                        </div>
                    </x-wrapper.form-group>
                </div>
            </x-wrapper.form>
        </div>
    @empty
        <div id="transaction-attachment-item">
            <x-wrapper.form isRow>
                <x-wrapper.column>
                    <x-form.input name="documents[0][name]" label="Nama Dokumen" isGroup/>
                </x-wrapper.column>
                <x-wrapper.column>
                    <x-form.input type="number" name="documents[0][qty]" label="Jumlah Salinan" isGroup/>
                </x-wrapper.column>
                <x-wrapper.column>
                    <x-form.file id="file" name="documents[0][file]" label="Dokumen Legalisir"
                                 placeholder="Pilih Dokumen"
                                 isGroup
                                 noResize isMultiple/>
                </x-wrapper.column>
                <div class="col-1">
                    <x-wrapper.form-group label="&nbsp;" isGroup>
                        <div class="d-block py-1">
                            <x-form.button id="transaction-attachment-remove" :isSubmit="false" circle outline
                                           type="{{\App\View\Components\Form\Button::TYPE_DANGER}}"
                                           size="{{\App\View\Components\Form\Button::SIZE_SMALL}}">
                                <i class="fa fa-times" aria-hidden="true"></i>
                            </x-form.button>
                        </div>
                    </x-wrapper.form-group>
                </div>
            </x-wrapper.form>
        </div>
    @endforelse

</div>
<x-wrapper.form isRow>
    <x-wrapper.column>
        <x-form.button :isSubmit="false" type="{{\App\View\Components\Form\Button::TYPE_SUCCESS}}" outline
                       id="transaction-attachment-add">
            Tambah
        </x-form.button>
    </x-wrapper.column>
</x-wrapper.form>

@push("stack-script")
    <script>
        $(document).ready(function () {
            const maxElement = <?=$maxElement?>;

            function detachEvent() {
                const items = $("#transaction-attachment #transaction-attachment-item")
                items.each(function (index, item) {
                    $(this).unbind("click")
                    $(this).find("#transaction-attachment-remove").unbind("click")
                })
            }

            function attachFirst() {
                const items = $("#transaction-attachment #transaction-attachment-item")
                const addButton = $("#transaction-attachment-add")
                const item = items[0]
                addButton.on("click", function () {
                    const regex = /documents\[\d\]/g;
                    const countEl = $("#transaction-attachment #transaction-attachment-item").length;

                    const itemCloned = $(item).clone(true, true)
                    itemCloned.html(function (index,html) {
                        return html.replace(regex, `documents[${countEl}]`)
                    })
                    itemCloned.appendTo("#transaction-attachment")
                })
                attachEvent()
            }

            function attachEvent() {
                const items = $("#transaction-attachment #transaction-attachment-item")
                items.each(function (index, item) {
                    if (items.length <= 1) {
                        $(item).find("#transaction-attachment-remove").addClass("d-none")
                    } else {
                        $(item).find("#transaction-attachment-remove").removeClass("d-none")
                    }

                    if (items.length >= maxElement) {
                        $("#transaction-attachment-add").addClass("d-none")
                    } else {
                        $("#transaction-attachment-add").removeClass("d-none")
                    }

                    $(item).on("click", "#transaction-attachment-remove", function (e) {
                        if (items.length > 1) {
                            $(item).remove()
                        }
                    })
                })
            }

            attachFirst()

            $("#transaction-attachment").on("DOMSubtreeModified", function () {
                detachEvent()
                attachEvent()
            })
        });
    </script>
@endpush
