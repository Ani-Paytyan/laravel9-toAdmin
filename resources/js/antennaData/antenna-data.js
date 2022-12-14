$(document).ready(function() {
    let token = $("input[name='_token']").val();

    const $uniqueItems = $('#uniqueItems');

    $uniqueItems.prop('disabled', true);

    $('#items').on('change', function(e) {
        if (e.target.value) {
            $uniqueItems.prop('disabled', false);
        } else {
            $uniqueItems.prop('disabled', true);
        }

        $uniqueItems.empty();

        let itemId = $('#items').val();
        if(itemId)
        {
            $.ajax({
                url: "/watcher/item_unique",
                data: {itemId},
                type: "GET",
                dataType: 'json',
                success: function (data) {
                    $uniqueItems.append(new Option());

                    $.each(data.uniqueItems, function(key, value) {
                        let optionData = $("<option/>", {
                            value: key,
                            text: value
                        });
                        $uniqueItems.append(optionData);
                    });
                },
                error: function (data) {}
            });
        }
    });

    $('.addAntennaData').on('click', function(e) {
        console.log('Click');

        let mac = $('#exampleModalLabel').data('mac');
        let uniqueItemId = $("#uniqueItems").val();

        console.log(`MAC: ${mac}, id: ${uniqueItemId}`);

        if(mac && uniqueItemId) {
            console.log('Send request');

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
        }
    });

    window.setInterval(async function () {
        await updateTable();
    }, 3000);

    function updateTable() {
        let registrationBoxId = window.location.pathname.split("/").pop();
        $.ajax({
            url: "/registrationBox/" + registrationBoxId,
            data: {},
            type: "GET",
            dataType: 'json',
            success: function (data) {
                $('.antennaDataTable tr.antennaData').remove();
                $.each(data.antennaData, function(i) {
                    let tr = data.antennaData[i]['unique_item']
                        ? getUniqueItemRowDisabled(data.antennaData[i])
                        : getUniqueItemRowTuPlug(data.antennaData[i]['mac'], Math.abs(data.antennaData[i]['rssi'])) ;
                    $('.antennaDataTable ').append(tr);
                });
            },
        });
    }

    function getUniqueItemRowDisabled(antennaData) {
        return `<tr class='antennaData'>
            <td>${antennaData['mac']}</td>
            <td>${Math.abs(antennaData['rssi'])}</td>
            <td>${antennaData['unique_item']['article'] ?? ''}</td>
            <td>${antennaData['unique_item']['item']['name'] ?? ''}</td>
            <td>
                <form action="/watcher/item_unique/disable/${antennaData['unique_item']['id']}" method="POST">
                    <input type="hidden" name="_token" value="${token}">
                    <button  type="submit" class="btn btn-danger disableButton" data-mac='${antennaData['unique_item']['id']}'>
                        ${ translations.btn_disable}
                    </button>
                </form>
            </td>
        </tr>`;
    }

    function getUniqueItemRowTuPlug(mac, rssi) {
        return `<tr class='antennaData'>
            <td>${mac}</td>
            <td>${rssi}</td>
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

    $(document).on('click','.macUniqueItem', function(e) {
        let mac = $(e.target).data('mac');

        const $label = $('#exampleModalLabel');

        $label.find('.macHeader').html('['+mac+']');
        $label.attr('data-mac', mac);
    });
});

