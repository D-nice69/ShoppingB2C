function actionUpdate(event) {
    event.preventDefault();
    let urlRequest = $(this).data('url');
    let that = $(this);
    Swal.fire({
        title: 'Bạn có muốn cập nhật đơn hàng ?',
        text: "Bạn sẽ không thể hoàn trả lại nếu ấn nút Có!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Có',
        cancelButtonText: 'Không'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: 'GET',
                url: urlRequest,
                success: function (data) {
                    console.log(data);
                    if (data.code == 200) {
                        if (data.url == 0) {
                            Swal.fire(
                                'Không thể cập nhật đơn hàng!',
                                data.message,
                                'error'
                            )
                            window.setTimeout(function () {
                                location.reload();
                            }, 3000);
                        } else {
                            Swal.fire(
                                'Cập nhật thành công!',
                                'Cập nhật đơn hàng thành công!',
                                'susscess'
                            )
                            window.setTimeout(function () {
                                location.replace("/admin/orders");
                            }, 1500);
                        }
                    }
                },
                error: function () {

                }
            });
        }    
    });
}
$(function () {
    $(document).on('click', '#update_order', actionUpdate);
});
