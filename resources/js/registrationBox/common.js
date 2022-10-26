import $ from 'jquery';

$(document).ready(function() {
    let token = $("input[name='_token']").val();
    let regBoxId = $('#registrationBoxId').val();
    $('.form-range').click(function () {
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
});
