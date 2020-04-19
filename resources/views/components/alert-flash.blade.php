@push('js')
    @if (session('alert'))
        <script>
            iziToast.success({ title: '{{ session("alert")["title"] }}', message: '{{ session("alert")["text"] }}', });
        </script>
    @endif

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <script>iziToast.error({ title: 'Error', message: '{{ $error }}', });</script>
        @endforeach
    @endif
@endpush