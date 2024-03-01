<script>
    $(document).on('click', '.btn-delete', function() {
        let dadoId = $(this).data('dado-id');
        let btn = $(this);
        let url = '{{ route('cargo.destroy', ':dadoId') }}';
        let data = {
            '_token': '{{ csrf_token() }}'
        };
        url = url.replace(":dadoId", dadoId);
        // confirmDelete();
        confirmDelete(url, data, "DELETE")

    })
</script>
<script>
    function confirmDelete(url, data, method) {
        Swal.fire({
            title: 'Tem certeza?',
            text: 'Você realmente deseja excluir este item?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, excluir!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: method,
                    url: url,
                    data: data,
                    success: function(response) {
                        Swal.fire(
                            'Excluído!',
                            response.message,
                            'success'
                        );
                        $('#table5').DataTable().ajax.reload();
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr)
                        toastr.warning(xhr.responseJSON);
                    }
                })
            }
            return;
        });
    }
</script>
