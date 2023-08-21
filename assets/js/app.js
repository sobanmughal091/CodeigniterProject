jQuery("#datetimepicker").datetimepicker({
    step: 1,
    format: "d/m/Y H:i:s",
});


var base_url = $("#main-body").attr("base-url");


$(document).ready(function () {
    loadPagination(0);
});


function loadPagination(pagno) {
    $.ajax({
        url: base_url + "bill-list-show/" + pagno,
        type: "get",
        dataType: "json",
        success: function (response) {
            $("#pagination").html(response.pagination);

            var data = response.bills;
            var html = "";
            $.each(data, function (index, data) {
                html +=
                    '<tr class="text-center">' +
                    "<td>" +
                    data.id +
                    "</td>" +
                    "<td>" +
                    data.patient_name +
                    "</td>" +
                    "<td>" +
                    data.total_charges +
                    "</td>" +
                    "<td>" +
                    '<a href="javascript:void(0);" class="btn btn-inverse-info btn-fw" onclick="editBillBtn(' + data.id + ')" data-id="' +
                    data.id +
                    '">Edit</a>' +
                    '<a href="javascript:void(0);" id="deleteBtn" class="btn btn-inverse-danger btn-fw" onclick="deleteBillBtn(' + data.id + ')" data-id="' +
                    data.id +
                    '">Delete</a>' +
                    "</td>" +
                    "</tr>";
            });

            $("#listRecords").html(html);
            $(".bill-paginationn").html(response.links);
        },
    });
}



$(".bill-paginationn").on("click", "a", function (e) {
    e.preventDefault();
    var pageno = $(this).attr("data-ci-pagination-page");
    loadPagination(pageno);
});

$("#bills-list-search-btn").click(function (e) {

    dsfd
    e.preventDefault();
    var search_input = $("#search_text").val();

    $.ajax({
        type: "GET",
        url: base_url + "bills/show?search=" + search_input,
        dataType: "json",
        success: function (response) {
            if (
                response.statusCode != undefined &&
                response.statusCode != null &&
                response.statusCode == 404
            ) {
                toastr.error(response.message);
                return;
            }

            var html = "";
            var data = response.bills;

            $.each(data, function (index, data) {
                html +=
                    '<tr class="text-center">' +
                    "<td>" +
                    data.id +
                    "</td>" +
                    "<td>" +
                    data.patient_name +
                    "</td>" +
                    "<td>" +
                    data.total_charges +
                    "</td>" +
                    "<td>" +
                    '<a href="javascript:void(0);" class="btn btn-inverse-info btn-fw" onclick="editBillBtn(' + data.id + ')" data-id="' +
                    data.id +
                    '">Edit</a>' +
                    '<a href="javascript:void(0);" id="deleteBtn" class="btn btn-inverse-danger btn-fw" onclick="deleteBillBtn(' + data.id + ')" data-id="' +
                    data.id +
                    '">Delete</a>' +
                    "</td>" +
                    "</tr>";
            });
            $("#listRecords").html(html);
            $(".bill-paginationn").html("");
        },
    });
});




$(".add-bill-btn").click(function () {
    $("#add-bill-modal").modal("show");
});





$(".close-add-bill-btn").click(function () {
    $("#add-bill-modal").modal("hide");
});




$(".close-modal-x-button").click(function () {
    $("#add-bill-modal").modal("hide");
});





$(".save-add-bill-btn").click(function (e) {
    e.preventDefault();
    var patient_name = $('#patient_name').val();
    var net_total = $('#net_total').val();
    $.ajax({
        url: base_url + "add-bill",
        type: 'POST',
        data: {
            patientName: patient_name,
            netTotal: net_total,
        },
        dataType: 'JSON',
        success: function (response) {
            if (response.statusCode == 200) {
                toastr.success(response.message);
                loadPagination(0);
                $('#add-bill-modal').modal('hide');

            } else if (response.statusCode == 422) {
                $.each(response.errors, function (key, item) {
                    toastr.error(item);
                });
            } else {
                toastr.error(response.message);
            }
        }
    });
});



$(".close-modal-x-edit-button").click(function () {
    $("#edit-bill-modal").modal("hide");
});


$(".close-edit-bill-btn").click(function () {
    $("#edit-bill-modal").modal("hide");
});


function editBillBtn(id) {
    $.ajax({
        url: base_url + "edit-bill",
        type: 'POST',
        data: {
            id: id,
        },
        dataType: 'JSON',
        success: function (response) {
            if (response.statusCode == 200) {
                $('.bill-id').val(response.bill.id);
                $('#edit_patient_name').val(response.bill.patient_name);
                $('#edit_net_total').val(response.bill.total_charges);
                $('#edit-bill-modal').modal('show');
            } else {
                toastr.error(response.message);
            }
        }
    });
}


function deleteBillBtn(id) {
    if (!confirm("Are you sure you want to delete this bill?")) {
        return;
    }
    $.ajax({
        url: base_url + "delete-bill",
        type: 'POST',
        data: {
            id: id,
        },
        dataType: 'JSON',
        success: function (response) {
            if (response.statusCode == 200) {
                toastr.success(response.message);
                loadPagination(0);
            } else {
                toastr.error(response.message);
            }
        }
    });
}



$(".update-edit-bill-btn").click(function (e) {
    e.preventDefault();

    var id = $('.bill-id').val();
    var patient_name = $('#edit_patient_name').val();
    var net_total = $('#edit_net_total').val();
    $.ajax({
        url: base_url + "update-bill",
        type: 'POST',
        data: {
            id: id,
            patientName: patient_name,
            netTotal: net_total,
        },
        dataType: 'JSON',
        success: function (response) {
            if (response.statusCode == 200) {
                toastr.success(response.message);
                loadPagination(0);
                $('#edit-bill-modal').modal('hide');

            } else if (response.statusCode == 422) {
                $.each(response.errors, function (key, item) {
                    toastr.error(item);
                });
            } else {
                toastr.error(response.message);
            }
        }
    });

});