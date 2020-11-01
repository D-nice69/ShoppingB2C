function actionDelete(event) {
    event.preventDefault();
    let urlRequest = $(this).data('url');
    let that = $(this);
    Swal.fire({
        title: 'Bạn có muốn xóa không ?',
        text: "Bạn sẽ không thể hoàn lại nếu nhấn nút Có",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#000000',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Không',
        confirmButtonText: 'Có'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: 'GET',
                url: urlRequest,
                success: function (data) {
                    console.log(data);
                    if (data.code == 200) {
                        that.parent().parent().remove();
                    }
                },
                error: function () {
                    
                }
            });
            Swal.fire(
                'Đã xóa!',
                'Đã xóa thành công.',
                'success'
            )
        }
    })
}
$(function () {
    $(document).on('click', '.action_delete', actionDelete);
});
