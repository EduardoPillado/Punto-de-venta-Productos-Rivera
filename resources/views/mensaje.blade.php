@if (Session::has('success'))
    <script>
        Swal.fire({
            icon: 'success',
            text: '{{ Session::get('success') }}',
            showConfirmButton: false,
            timer: 2000
        });
    </script>
@endif

@if (Session::has('error'))
    <script>
        Swal.fire({
            icon: 'error',
            text: '{{ Session::get('error') }}',
            showConfirmButton: false,
            timer: 2000
        });
    </script>
@endif

@if (Session::has('message'))
    <script>
        Swal.fire({
            icon: 'warning',
            text: '{{ Session::get('message') }}',
            showConfirmButton: false,
            timer: 2000
        });
    </script>
@endif