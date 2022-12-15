$(document).ready(function() {
    window.setInterval(async function () {
        await updateTable();
    }, 60000);

    function updateTable() {
        let workplaceId = window.location.pathname.split("/").pop();
        $.ajax({
            url: "/workplace/" + workplaceId,
            data: {},
            type: "GET",
            dataType: 'json',
            success: function (data) {
                $('#workplaceAntennaDataTable tr.workplaceAntennaData').remove();
                $.each(data.antenas, function(i) {
                    let style = data.antenas[i]['is_online'] ? 'success': 'danger';
                    let tr =`<tr class='workplaceAntennaData'>
                        <td>${data.antenas[i]['mac_address']}</td>
                        <td>${data.antenas[i]['pivot']['type']}</td>
                        <td><span class="logged-in text-${style}">●</span></td>
                        <td>
                            <form action="/workplace/${data.workplace.id}/antena/${data.antenas[i].id}" method="POST">
                                <input type="hidden" name="_token" value="${tokenStatus}">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger">${translation.btn_delete}</button>
                             </form>
                        </td>
                    </tr>`;
                    $('#workplaceAntennaDataTable').append(tr);
                });
            },
        });
    }
});

