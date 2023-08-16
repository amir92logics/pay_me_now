$(".action-button").on("click", function (e) {
    var basicBtnHtml = $(this).text();
    var url = $(this).data('url');
    var id = $(this).data('id');
    $.ajax({
        type: "GET",
        url: url,
        beforeSend: function () {
            $('.btn-'+id).attr('disabled', true);
            $('.btn-'+id).text('Wait...');
        },
        success: function (response) {
            $('.btn-'+id).removeAttr('disabled');
            $('.btn-'+id).text(basicBtnHtml);
            if (response.type) {
                $('.btn-'+id).removeClass('btn-danger');
                $('.btn-'+id).addClass('btn-success');
                $('.btn-'+id).text('Active');
            } else {
                $('.btn-'+id).text('Deactive');
                $('.btn-'+id).addClass('btn-danger');
                $('.btn-'+id).removeClass('btn-success');
            }
            toastr.success(response.message);
        },
        error: function (xhr, status, error) {
            $('.btn-'+id).removeAttr('disabled');
            $('.btn-'+id).text(basicBtnHtml);
            if (xhr.responseJSON.message) {
                toastr.error(xhr.responseJSON.message);
            }
        },
    });
});
