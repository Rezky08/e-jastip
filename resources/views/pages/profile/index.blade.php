@extends("layouts.user.template")
@section("main")
    <form method="POST">
        @csrf
        <x-wrapper.form isRow>
            <x-wrapper.column>
                <x-form.input name="student_id" label="NIM" isGroup/>
            </x-wrapper.column>
            <x-wrapper.column>
                <x-form.input name="name" label="Nama" isGroup/>
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
                <x-form.input name="phone" label="Nomor HP" placeholder="Masukan Nomor Hp" isGroup />
            </x-wrapper.column>
            <x-wrapper.column>
            </x-wrapper.column>
        </x-wrapper.form>
        <x-form.button isSubmit>
            Simpan
        </x-form.button>
    </form>
@endsection
