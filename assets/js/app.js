var base_url = $('#main-body').attr('base-url');

jQuery('#datetimepicker').datetimepicker({
    step: 1,
    format: 'd/m/Y H:i:s',
});

$(document).ready(function () {
    loadPagination(0);
});


function loadPagination(pagno) {
    $.ajax({
        url: base_url + 'bill-list-show/' + pagno,
        type: 'get',
        dataType: 'json',
        success: function (response) {
            $('#pagination').html(response.pagination);

            var data = response.bills;
            var html = '';
            $.each(data, function (index, data) {
                html += '<tr class="text-center">' +
                    '<td>' + data.id + '</td>' +
                    '<td>' + data.patient_name + '</td>' +
                    '<td>' + data.total_charges + '</td>' +
                    '<td>' +
                    '<a href="javascript:void(0);" class="btn btn-inverse-info btn-fw" data-id="' + data.id + '">Edit</a>' +
                    '<a href="javascript:void(0);" class="btn btn-inverse-danger btn-fw" data-id="' + data.id + '">Delete</a>' +
                    '</td>' +
                    '</tr>';
            });

            $('#listRecords').html(html);
            $('.bill-paginationn').html(response.links);
        }
    });
}



$('.bill-paginationn').on('click', 'a', function (e) {
    e.preventDefault();
    var pageno = $(this).attr('data-ci-pagination-page');
    loadPagination(pageno);
});



$('#bills-list-search-btn').click(function (e) {
    e.preventDefault();
    var search_input = $('#search_text').val();

    $.ajax({
        type: "GET",
        url: base_url + "bills/show?search=" + search_input,
        // data: {
        //     search: search_input
        // },
        success: function (response) {
            console.log(response);
        }
    });
});

