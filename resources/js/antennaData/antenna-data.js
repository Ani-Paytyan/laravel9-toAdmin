$(document).ready(function() {
    let token = $("input[name='_token']").val();

    $('.items').on('change', function(e) {
        $('#uniqueItems').empty();
        let itemId = $('.items').val();
        $.ajax({
            url: "/watcher/item_unique",
            data: {
                itemId: itemId,
            },
            type: "GET",
            dataType: 'json',
            success: function (data) {
                $.each(data.uniqueItems, function(key, value) {
                    var $option = $("<option/>", {
                        value: key,
                        text: value
                    });
                    $('#uniqueItems').append($option);
                });
            },
            error: function (data) {}
        });
    });

    $('.addAntennaData').on('click', function(e) {
        let mac = $('.macUniqueItem').data('mac');
        let uniqueItemId = $("#uniqueItems").val();
        $.ajax({
            url: "/watcher/item_unique/" + uniqueItemId,
            data: {
                _token: token,
                mac: mac
            },
            type: "POST",
            dataType: 'json',
            success: function () {
                window.location.reload()
            },
            error: function (data) {}
        });
    });
});

