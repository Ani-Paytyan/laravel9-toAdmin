$(document).ready(function() {
    let token = $("input[name='_token']").val();

    $(document).on('click','.itemEdit', function(e) {
        $(this).parent().siblings('.mac').find("input.mac").removeClass('form-control-muted');
        $(this).parent().siblings('.mac').find("input.mac").focus();
    });

    $(document).on('click','.itemConnect', function(e) {
        let uniqueItemId = $(e.target).data("id");
        $('.display_value').addClass('d-none');
        let mac = $(this).parent().siblings('.mac').find("input.mac").val();
        if (mac) {
                $.ajax({
                url: "/updateByMac/" + uniqueItemId,
                data: {
                    _token: token,
                    mac: mac
                },
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    $('.display_value').removeClass('d-none');
                },
                error: function (data) {}
            });
        }
    });

    $(document).on('click','.itemDetach', function(e) {
        $('.display_value').addClass('d-none');
        let uniqueItemId = $(e.target).data("id");
        let self = $(this)
        $.ajax({
            url: "/detachedByMac/" + uniqueItemId,
            data: {
                _token: token,
            },
            type: "POST",
            dataType: 'json',
            success: function (data) {
                $('.display_value').removeClass('d-none');
                self.parent().siblings('.mac').find("input.mac").val('');
            },
            error: function (data) {}
        });
    });

    $(document).on('input','.mac', function(e) {
        if (e.target.value.length > 0) {
            $(this).parent().find("button.itemConnect").removeClass('disabled').removeClass('disabled');
        }else {
            $(this).parent().find("button.itemConnect").removeClass('disabled').addClass('disabled');
        }
    });
});

