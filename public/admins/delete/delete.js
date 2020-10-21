function actionDelete(event) {
    event.preventDefault();
    let urlRequest = $(this).data('url');
    let that = $(this);
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#000000',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type:'GET',
                url: urlRequest,
                success: function (data) {
                    console.log(data);
                    if(data.code == 200){
                        that.parent().parent().remove();
                    }
                },
                error: function () {

                }
            });
            Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
              )
        }
    })
}
$(function () {
    $(document).on('click', '.action_delete', actionDelete);
});
