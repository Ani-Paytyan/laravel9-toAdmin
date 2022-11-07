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

    window.setInterval(async function () {
        await updateTable();
    }, 3000);

    function updateTable() {
        var url = window.location.pathname;
        var registrationBoxId = url.substring(url.lastIndexOf('/') + 1);
        $.ajax({
            url: "/registrationBox/" + registrationBoxId,
            data: {},
            type: "GET",
            dataType: 'json',
            success: function (data) {
                $('.antennaDataTable tr.antennaData').remove();
                $.each(data.antennaData, function(i) {
                    let tr = data.antennaData[i]['unique_item']
                        ? getUniqueItemRowDisabled(data.antennaData[i]['mac'], data.antennaData[i]['unique_item'])
                        : getUniqueItemRowTuPlug(data.antennaData[i]['mac']) ;
                    $('.antennaDataTable ').append(tr);
                });
            },
        });
    }

    function getUniqueItemRowDisabled(mac, uniqueItem) {
        return `<tr class='antennaData'>
            <td>${mac}</td>
            <td>${uniqueItem['article']}</td>
            <td>${uniqueItem['item']['name']}</td>
            <td>
                <form action="/watcher/item_unique/disable/${uniqueItem['id']}" method="POST">
                    <input type="hidden" name="_token" value="${token}">
                    <button  type="submit" class="btn btn-danger disableButton" data-mac='${uniqueItem['id']}'>
                        ${ translations.btn_disable}
                    </button>
                </form>
            </td>
        </tr>`;
    }

    function getUniqueItemRowTuPlug(mac) {
        return `<tr class='antennaData'>
            <td>${mac}</td>
            <td>Not connected</td>
            <td>Not connected</td>
            <td>
                <div class="pull-left">
                    <button type="button" class="btn btn-primary macUniqueItem" 
                    data-mac='${mac}' data-bs-toggle="modal" data-bs-target="#antennaDataModal">
                        ${ translations.btn_to_plug} 
                    </button>
                </div>
            </td>
         </tr>`;
    }
});

