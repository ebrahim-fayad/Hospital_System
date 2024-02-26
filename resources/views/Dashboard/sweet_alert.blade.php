@error($error_name)
    <script>
        window.onload = function() {

            Swal.fire({
                icon: "error",
                title: "{{ $error_name }}",
                text: "{{ $message }}",
                footer: '<a href="#">Why do I have this issue?</a>'
            });
        };
    </script>
@enderror
