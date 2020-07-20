@if(session('success'))
<script>
  $(document).ready(function() {
      iziToast.success({
        title: 'Success!',
        message: '{{ session('success') }}',
        position: 'topRight'
      });
  });
</script> 
@elseif(session('error'))
<script>
  $(document).ready(function() {
      iziToast.error({
        title: 'Fail!',
        message: '{{ session('error') }}',
        position: 'topRight'
      });
  });
</script>
@endif