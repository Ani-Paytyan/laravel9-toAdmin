$(document).ready(function() {
    let token = $("input[name='_token']").val();

    $(document).on('click','.itemEdit', function(e) {
        $(this).parent().siblings('.mac').find("input.mac").removeAttr('disabled');
        $(this).parent().find("button.itemConnect").removeAttr('disabled');
        $(this).parent().siblings('.mac').find("input.mac").focus();
    });

    $(document).on('click','.itemConnect', function(e) {
        $('tr').removeClass('table-active');
        let uniqueItemId = $(e.target).data("id");
        $('.display_value').addClass('d-none');
        $('.display_value_error').addClass('d-none');
        let self = $(this);
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
                    self.parent().find("button.itemEdit").removeClass('d-none');
                    self.parent().siblings('.mac').find("input.mac").attr('disabled','disabled')
                    self.parent().find("button.itemConnect").attr('disabled','disabled');
                    self.closest('tr').addClass('table-active');
                },
                error: function (data) {
                    $('.display_value_error').removeClass('d-none');
                }
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
                self.parent().siblings('.mac').find("input.mac").removeAttr('disabled');
                self.parent().find("button.itemEdit").addClass('d-none');
                self.parent().find("button.itemConnect").attr('disabled','disabled');
                self.parent().find("button.itemDetach").addClass('disabled');
                self.parent().parent().find("div.onlineButton").css('background-color','red');
                self.parent().parent().find("div.onlineButton").html('Offline');
                self.parent().parent().find("div.insideButton").css('background-color','red');
                self.parent().parent().find("div.insideButton").html('Offline');
            },
            error: function (data) {}
        });
    });

    $(document).on('input','.mac', function(e) {
        if (e.target.value.length > 0) {
            $(this).parent().find("button.itemConnect").removeAttr('disabled');
            $(this).parent().find("button.itemDetach").removeAttr('disabled');
        }
        else {
            $(this).parent().find("button.itemConnect").attr('disabled', 'disabled');
            $(this).parent().find("button.itemDetach").attr('disabled', 'disabled');
        }
    });
});

