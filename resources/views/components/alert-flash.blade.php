@push('js')
    @if (session('alert'))
        <script>
            iziToast.success({ title: '{{ session("alert")["title"] }}', message: '{{ session("alert")["text"] }}', });
        </script>
    @endif

    {{-- @if ($errors->any())
        @php $i=0; @endphp
        @foreach ($errors->all() as $error)
            @php if ($i == 1) { break; } else { $i++; } @endphp
            <script>iziToast.error({ title: 'Error', message: '{{ $error }}', });</script>
        @endforeach
    @endif --}}

    @if ($errors->any())
        <script>iziToast.error({ title: 'Error', message: 'Data tidak lengkap atau tidak sesuai format.', });</script>
        @php $i=0; @endphp
        @foreach ($errors->all() as $error)
            @php if ($i == 1) { break; } else { $i++; } @endphp
            <script>iziToast.error({ title: 'Error', message: '{{ $error }}', });</script>
        @endforeach
    @endif
@endpush