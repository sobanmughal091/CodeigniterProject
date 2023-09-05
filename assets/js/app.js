
$("#datetimepicker_start").datetimepicker({
    step: 1,
    format: "H:i:s",
});



$("#datetimepicker_end").datetimepicker({
    step: 1,
    format: "H:i:s",
});



var base_url = $("#main-body").attr("base-url");


$(document).ready(function () {

    var page_name = $('.page_name').val();

    if (page_name != undefined && page_name != '' && page_name != null) {


        if (page_name == 'consultancy_page') {
            $.ajax({
                url: base_url + "consultancy-list-show",
                type: "get",
                dataType: "json",
                success: function (response) {
                    var current_page = parseInt($('#load_more_consultancies').attr('current_page'));
                    var total_pages = response.total_pages;
                    var consultancies = response.consultancies;
                    var html = "";
                    $.each(consultancies, function (key, data) {
                        html += "<tr class='text-center'>" +
                            "<td>" +
                            data.id +
                            "</td>" +
                            "<td>" +
                            data.patient_firstname +
                            "</td>" +
                            "<td>" +
                            data.patient_lastname +
                            "</td>" +
                            "<td>" +
                            data.patient_mobile +
                            "</td>" +
                            "<td>" +
                            data.consultant_name +
                            "</td>" +
                            "<td>" +
                            data.consultant_mobile +
                            "</td>" +
                            "<td>" +
                            data.con_time_start +
                            "</td>" +
                            "<td>" +
                            data.con_time_end +
                            "</td>" +
                            "<td>" +
                            data.consultancy_fee +
                            "</td>" +
                            "<td>" +
                            "<a href='javascript:void(0);' class='btn btn-inverse-info btn-fw' onclick='editConsultancyBtn(" + data.id + ")' data-id='" +
                            data.id +
                            "'>Edit</a>" +
                            "<a href='javascript:void(0);' class='btn btn-inverse-danger btn-fw' onclick='deleteConsultancyBtn(" + data.id + ")' data-id='" +
                            data.id +
                            "'>Delete</a>" +
                            "</td>" +
                            "<tr>";
                    });
                    $('#listRecords').append(html);
                    $('#load_more_consultancies').attr('total_pages', total_pages);
                    jQuery('#load_more_consultancies').attr('current_page', (current_page + 1));
                    if (total_pages > 1) {
                        $("#load_more_consultancies").show();
                    }
                },
            });
        }
    }
    if (page_name == 'billing_page') {
        loadPagination(0);
    }
});



$("#load_more_consultancies").on("click", function (e) {
    e.preventDefault();
    total_pages = $('#load_more_consultancies').attr('total_pages');
    current_page = parseInt($('#load_more_consultancies').attr('current_page'));
    if (current_page <= total_pages) {
        $('#load_more_consultancies').text('Loading...');
        $.getJSON(base_url + 'consultancy-list-show?page=' + current_page, function (response) {
            var consultancies = response.consultancies;
            if (response.statusCode == 200) {
                var html = "";
                $.each(consultancies, function (key, data) {
                    html += "<tr class='text-center'>" +
                        "<td>" +
                        data.id +
                        "</td>" +
                        "<td>" +
                        data.patient_firstname +
                        "</td>" +
                        "<td>" +
                        data.patient_lastname +
                        "</td>" +
                        "<td>" +
                        data.patient_mobile +
                        "</td>" +
                        "<td>" +
                        data.consultant_name +
                        "</td>" +
                        "<td>" +
                        data.consultant_mobile +
                        "</td>" +
                        "<td>" +
                        data.con_time_start +
                        "</td>" +
                        "<td>" +
                        data.con_time_end +
                        "</td>" +
                        "<td>" +
                        data.consultancy_fee +
                        "</td>" +
                        "<td>" +
                        "<a href='javascript:void(0);' class='btn btn-inverse-info btn-fw' onclick='editConsultancyBtn(" + data.id + ")' data-id='" +
                        data.id +
                        "'>Edit</a>" +
                        "<a href='javascript:void(0);' class='btn btn-inverse-danger btn-fw' onclick='deleteConsultancyBtn(" + data.id + ")' data-id='" +
                        data.id +
                        "'>Delete</a>" +
                        "</td>" +
                        "<tr>";
                });
                // console.log(html); return;
                jQuery('#listRecords').append(html);
                jQuery('#load_more_consultancies').attr('current_page', (current_page + 1));
                jQuery('#load_more_consultancies').attr('total-pages', response.total_pages);
                $('#load_more_consultancies').text('Load More');
                if (current_page >= response.total_pages) {
                    jQuery('#load_more_consultancies').hide();
                }
            }
        })
    }
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
            $.each(data, function (key, data) {
                html +=
                    "<tr class='text-center'>" +
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
                    "<a hrtf='javascript:void(0)' class ='btn btn-inverse-info btn-fw' onclick='editBillBtn(" + data.id + ")' data_id='" +
                    data.id +
                    "'>Edit</a>" +
                    "<a href='javascript:void(0)' class='btn btn-inverse-danger btn-fw' onclick='deleteBillBtn(" + data.id + ")' data_id='" + data.id +
                    "'>Delete</a>" +
                    "</td>" +
                    "</tr>"
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


// $(".consultancy-paginationn").on("click", "a", function (e) {
//     e.preventDefault();
//     var pageno = $(this).attr("data-ci-pagination-page");
//     loadPagination(pageno);
// });





$("#bills-list-search-btn").click(function (e) {
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
                    '<a href="javascript:void(0);" class="btn btn-inverse-info btn-fw" onclick="editBillBtn(' + data.id + ')" data_id="' +
                    data.id +
                    '">Edit</a>' +
                    '<a href="javascript:void(0);" class="btn btn-inverse-danger btn-fw" onclick="deleteBillBtn(' + data.id + ')" data_id="' +
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



$(".add-consultancy-btn").click(function () {
    $("#add-consultancy-modal").modal("show");
});



$(".close-add-bill-btn").click(function () {
    $("#add-bill-modal").modal("hide");
});



$(".close-add-consultancy-btn").click(function () {
    $("#add-consultancy-modal").modal("hide");
});


$(".close-modal-x-button").click(function () {
    $("#add-bill-modal").modal("hide");
});


$(".close-modal-x-button").click(function () {
    $("#add-consultancy-modal").modal("hide");
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


// $(".save-add-consultancy-btn").click(function (e) {
//     e.preventDefault();
//     var patient_firstname = $('#patient_firstname').val();
//     var patient_lastname = $('#patient_lastname').val();
//     var patient_mobile = $('#patient_mobile').val();
//     var consultant_name = $('#consultant_name').val();
//     var consultant_mobile = $('#consultant_mobile').val();
//     var start_time = $('#con_time_start').val();
//     var end_time = $('#con_time_end').val();
//     var consultation_fee = $('#consultancy_fee').val();
//     $.ajax({
//         url: base_url + "add-consultancy",
//         type: 'POST',
//         data: {
//             firstname: patient_firstname,
//             lastname: patient_lastname,
//             patientMobile: patient_mobile,
//             consultantName: consultant_name,
//             consultantMobile: consultant_mobile,
//             startTime: start_time,
//             endTime: end_time,
//             consultationFee: consultation_fee,
//         },
//         dataType: 'JSON',
//         success: function (response) {
//             if (response.statusCode == 200) {
//                 toastr.success(response.message);
//                 loadPagination(0);
//                 $('#add-consultancy-modal').modal('hide');

//             } else if (response.statusCode == 422) {
//                 $.each(response.errors, function (key, item) {
//                     toastr.error(item);
//                 });
//             } else {
//                 toastr.error(response.message);
//             }
//         }
//     });
// });



$(".close-modal-x-edit-button").click(function () {
    $("#edit-bill-modal").modal("hide");
});

// $(".close-modal-x-edit-button").click(function () {
//     $("#edit-consultancy-modal").modal("hide");
// });


$(".close-edit-bill-btn").click(function () {
    $("#edit-bill-modal").modal("hide");
});


// $(".close-edit-consultancy-btn").click(function () {
//     $("#edit-consultancy-modal").modal("hide");
// });



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


// function editConsultancyBtn(id) {
//     $.ajax({
//         url: base_url + "edit-consultancy",
//         type: 'POST',
//         data: {
//             id: id,
//         },
//         dataType: 'JSON',
//         success: function (response) {
//             if (response.statusCode == 200) {
//                 $('.consultancy-id').val(response.consultancy.id);
//                 $('#edit_patient_firstname').val(response.consultancy.patient_firstname);
//                 $('#edit_patient_lastname').val(response.consultancy.patient_lastname);
//                 $('#edit_patient_mobile').val(response.consultancy.patient_mobile);
//                 $('#edit_consultant_name').val(response.consultancy.consultant_name);
//                 $('#edit_consultant_mobile').val(response.consultancy.consultant_mobile);
//                 $('#edit_con_time_start').val(response.consultancy.start_time);
//                 $('#edit_con_time_end').val(response.consultancy.end_time);
//                 $('#edit_consultancy_fee').val(response.consultancy.consultation_fee);
//                 $('#edit-consultancy-modal').modal('show');
//             } else {
//                 toastr.error(response.message);
//             }
//         }
//     });
// }


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


// function deleteConsultancyBtn(id) {
//     if (!confirm("Are you sure you want to delete this consultancy?")) {
//         return;
//     }
//     $.ajax({
//         url: base_url + "delete-consultancy",
//         type: 'POST',
//         data: {
//             id: id,
//         },
//         dataType: 'JSON',
//         success: function (response) {
//             if (response.statusCode == 200) {
//                 toastr.success(response.message);
//                 loadPagination(0);
//             } else {
//                 toastr.error(response.message);
//             }
//         }
//     });
// }



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



// $(".update-edit-consultancy-btn").click(function (e) {
//     e.preventDefault();

//     var id = $('.consultancy-id').val();
//     var patient_firstname = $('#edit_patient_firstname').val();
//     var patient_lastname = $('#edit_patient_lastname').val();
//     var patient_mobile = $('#edit_patient_mobile').val();
//     var consultant_name = $('#edit_consultant_name').val();
//     var consultant_mobile = $('#edit_consultant_mobile').val();
//     var start_time = $('#edit_con_time_start').val();
//     var end_time = $('#edit_con_time_end').val();
//     var consultation_fee = $('#edit_consultancy_fee').val();
//     $.ajax({
//         url: base_url + "update-bill",
//         type: 'POST',
//         data: {
//             id: id,
//             patientName: patient_name,
//             netTotal: net_total,
//         },
//         dataType: 'JSON',
//         success: function (response) {
//             if (response.statusCode == 200) {
//                 toastr.success(response.message);
//                 loadPagination(0);
//                 $('#edit-bill-modal').modal('hide');

//             } else if (response.statusCode == 422) {
//                 $.each(response.errors, function (key, item) {
//                     toastr.error(item);
//                 });
//             } else {
//                 toastr.error(response.message);
//             }
//         }
//     });

// });


function isconfirmAppointment() {

    if (!confirm('Are you sure to delete this appointment?')) {
        event.preventDefault();
        return;
    }
    return true;
}

function isconfirmInpatient() {

    if (!confirm('Are you sure to delete this inpatient?')) {
        event.preventDefault();
        return;
    }
    return true;
}




function isconfirmDoctor() {
    if (!confirm('Are you sure to delete this Doctior?')) {
        event.preventDefault();
        return;
    }
    return true;
}


function isconfirmPatient() {
    if (!confirm('Are you sure to delete this patient?')) {
        event.preventDefault();
        return;
    }
    return true;
}







// $("#consultancies-list-search-btn").click(function (e) {
//     e.preventDefault();
//     var search_input = $("#search_text").val();

//     $.ajax({
//         type: "GET",
//         url: base_url + "consultancy-list-show?search=" + search_input,
//         dataType: "json",
//         success: function (response) {
//             if (
//                 response.statusCode != undefined &&
//                 response.statusCode != null &&
//                 response.statusCode == 404
//             ) {
//                 toastr.error(response.message);
//                 return;
//             }

//             var html = "";
//             var data = response.consultancies;

//             $.each(data, function (index, data) {
//                 html +=
//                     '<tr class="text-center">' +
//                     "<td>" +
//                     data.id +
//                     "</td>" +
//                     "<td>" +
//                     data.patient_firstname +
//                     "</td>" +
//                     "<td>" +
//                     data.patient_lastname +
//                     "</td>" +
//                     "<td>" +
//                     data.patient_mobile +
//                     "</td>" +
//                     "<td>" +
//                     data.consultant_name +
//                     "</td>" +
//                     "<td>" +
//                     data.consultant_mobile +
//                     "</td>" +
//                     "<td>" +
//                     data.start_time +
//                     "</td>" +
//                     "<td>" +
//                     data.end_time +
//                     "</td>" +
//                     "<td>" +
//                     data.consultation_fee +
//                     "</td>" +
//                     "<td>" +
//                     '<a href="javascript:void(0);" class="btn btn-inverse-info btn-fw" onclick="editConsultancyBtn(' + data.id + ')" data-id="' +
//                     data.id +
//                     '">Edit</a>' +
//                     '<a href="javascript:void(0);" class="btn btn-inverse-danger btn-fw" onclick="deleteConsultancyBtn(' + data.id + ')" data-id="' +
//                     data.id +
//                     '">Delete</a>' +
//                     "</td>" +
//                     "</tr>";
//             });
//             $("#listRecords").html(html);
//             $(".consultancy-paginationn").html("");
//         },
//     });
// });

