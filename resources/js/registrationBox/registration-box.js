$(document).ready(function() {
    let token = $("input[name='_token']").val();
    let regBoxId = $('#registrationBoxId').val();
    $('.form-range').on("change", function () {
        $.ajax({
            url: "/rssi_store/" + regBoxId,
            data: {
                _token: token,
                rssiNumber: $('.form-range').val(),
            },
            type: "POST",
            dataType: 'json',
            success: function (data) {},
            error: function (data) {}
        });
    });

    $(document).on('click','.filter-clean-form', function(e) {
        $(this).closest('form').find("input[type=text]").val("");
        window.location.href = '?';
    });
});
