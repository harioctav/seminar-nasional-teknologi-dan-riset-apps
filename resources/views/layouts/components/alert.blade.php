<script>
  @if($message = session('error'))
    Swal.fire({
      icon: 'error',
      title: '{{ $message }}',
      confirmButtonText: 'Mengerti',
      confirmButtonColor: '#E74C3C',
    })
  @endif
</script>