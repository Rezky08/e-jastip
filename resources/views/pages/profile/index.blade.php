@extends("layouts.user.template")
@section("main")
    <form>
        @csrf
        <x-wrapper.form isRow>
            <x-wrapper.column>
                <x-form.input name="nim" label="NIM" isGroup/>
            </x-wrapper.column>
            <x-wrapper.column>
                <x-form.input name="nama" label="Nama" isGroup/>
            </x-wrapper.column>
        </x-wrapper.form>
        <x-wrapper.form isRow>
            <x-wrapper.column>
                <x-form.select-api name="faculty_id" label="Fakultas" isGroup url="/api/master/faculty"/>
            </x-wrapper.column>
            <x-wrapper.column>
                <x-form.select-api name="study_program_id" label="Jurusan" isGroup url="/api/master/study-program" chainSelector="select[name='faculty_id']" />
            </x-wrapper.column>
        </x-wrapper.form>
        <x-wrapper.form isRow>
            <x-wrapper.column>
                <x-form.input name="nomor_hp" label="Nomor HP" placeholder="Masukan Nomor Hp" isGroup />
            </x-wrapper.column>
            <x-wrapper.column>
            </x-wrapper.column>
        </x-wrapper.form>
        <x-form.button>
            Simpan
        </x-form.button>
    </form>
@endsection
@push("stack-script")
    <script>
        API.get(window.location.pathname).then((data)=>{
            console.log(data)
        })
    </script>
@endpush
