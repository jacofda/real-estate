@if(session('message'))
<script>
    Swal.fire(
        '',
        '{{session('message')}}',
        'success'
    )
</script>
@endif
@if(session('closing-message'))
<script>
    Swal.fire({
      position: 'top-end',
      icon: 'success',
      title: '{{session('closing-message')}}',
      showConfirmButton: false,
      timer: 1500
    })
</script>
@endif


@if(session('error'))
<script>
    Swal.fire({
      icon: 'error',
      title: '{{session('error')}}',
    })
</script>
@endif
