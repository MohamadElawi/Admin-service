$(function () {
    function datatable() {
        var table = $("#users").DataTable({
            responsive: true,
            processing: false,
            serverSide: false,
            ajax: {
                type: "get",
                url: "users/getData",
            },
            columns: [
                // {
                //     data: function (data) {
                //         return data.id;
                //     },
                //     name: "#",
                // },

                {
                    data: function (data) {
                        return data.DT_RowIndex;
                    },
                    name: "#",
                },
                // {
                //     data: function (data) {
                //         return (
                //             "<img src='http://127.0.0.1:8000" +
                //             data.icon +
                //             "' width='100px' style='border-radius: 10%;'/>"
                //         );
                //     },
                //     name: "Icon",
                // },
                {
                    data: function (data) {
                        return data.user_name;
                    },
                    name: "Name",
                },
                {
                    data: function (data) {
                        return data.email;
                    },
                    name: "Email",
                },
                {
                    data: function (data) {
                        return data.phone;
                    },
                    name: "Phone",
                },
                {
                    data: function (data) {
                        return data.address;
                    },
                    name: "Address",
                },
                {
                    data: function (data) {
                        if (data.status == 'blocked' || data.status == 'deleted')
                            return "<small class='badge rounded-pill  badge-light-danger'>" + data.status + "<small>";
                        else
                            return "<small class='badge rounded-pill  badge-light-success'>" + data.status + "</small>";
                    },
                    name: "status",
                },
                {
                    data: function (data) {
                        return data.created_at;
                    },
                    name: "Created At",
                },

                {
                    data: function (data) {
                        if(data.status != 'deleted')
                        return (
                            '<a onclick=showItem(' + data.id + ')  data-toggle="modal" data-target="#user-show" style="color:#f5cb42;">' +
                            feather.icons["alert-circle"].toSvg({
                                class: "font-large-1 me-2",
                            }) +
                            "</a>" +
                            '<a  onclick=editItem(' + data.id + ') class="item-edit" data-toggle="modal" data-target="#user-edit" style="color:#7367f0">' +
                            feather.icons["edit"].toSvg({
                                class: "font-large-1 me-2",
                            }) +
                            "</a>" +
                            '<a onclick="blockedItem(' + data.id +')" class="delete-record" data-toggle="modal" data-target="#block-modal" style="color: #6780E5;">' +
                            feather.icons["lock"].toSvg({
                                class: "font-large-1 me-2",
                            }) +
                            "</a>" +
                            '<a onclick="deleteItem(' + data.id + ')" class="delete-record" data-toggle="modal" data-target="#delete-modal" style="color: #EE4B2B;">' +
                            feather.icons["trash-2"].toSvg({
                                class: "font-large-1 me-2",
                            }) +
                            "</a>"
                            + '<meta name="csrf-token" content="{{ csrf_token() }}"></meta>'
                        );
                        else
                            return (
                                '<a onclick="restoreItem(' + data.id + ')"  data-toggle="modal" data-target="#restore-modal" style="color: #2C9151;">' +
                            feather.icons["rotate-cw"].toSvg({
                                class: "font-large-1 me-2",
                            }) +
                            "</a>"
                            + '<meta name="csrf-token" content="{{ csrf_token() }}"></meta>'
                            );

                    },
                    name: "action",
                },
            ]
        });
    }

    datatable();
});


$(document).on("click", "#submit", function (e) {
    e.preventDefault();
    var form = new FormData($("#form")[0]);
    $('#addnameError').addClass('d-none');
    $('#addemailError').addClass('d-none');
    $('#addpasswordError').addClass('d-none');
    $.ajax({
        type: "post",
        headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"), },
        url: "users/store",
        data: form,
        processData: false,
        contentType: false,
        cache: false,
        success: function (data) {
            $("#users").DataTable().ajax.reload();
            $("#success-msg").html(data.message)
            $("#success-msg").show();
            setTimeout(() => {
                $("#success-msg").hide();
            }, 3000);
        },
        error: function (data) {
            // console.log(data)
            var errors = data.responseJSON;
            if ($.isEmptyObject(errors) == false) {
                $.each(errors.errors, function (key, value) {
                    var ErrorID = '#add' + key + 'Error';

                    $(ErrorID).removeClass("d-none");
                    $(ErrorID).text(value)
                })
            }
        },
    });
});


function editItem(id) {
    $.get("users/" + id, function (data) {
        $("#id").val(data.user.id);
        $("#name").val(data.user.user_name);
        $("#email").val(data.user.email);
        $("#phone").val(data.user.phone);
        $("#address").val(data.user.address);
        $("#gender").val(data.user.address); gender
    });

}
$("#sub-edit").click(function () {
    var id = $("#id").val();
    var form = new FormData($("#form-edit")[0]);

    $('#editnameError').addClass('d-none');
    $('#editemailError').addClass('d-none');
    $('#editphoneError').addClass('d-none');
    $('#editaddressError').addClass('d-none');

    $.ajax({
        type: "POST",
        headers: {
            "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content"),
            "accept": "application/json",

        },
        url: "users/" + id,
        data: form,
        dataType: "text",
        processData: false, // tell jQuery not to process the data
        contentType: false,
        success: function (data) {
            console.log(data)
            $("#users").DataTable().ajax.reload();
            $("#success-msg").html(data);
            $("#success-msg").show();
            setTimeout(() => {
                $("#success-msg").hide();
            }, 3000);
            $('#close-btn').click();
        },
        error: function (data) {
            var errors = JSON.parse(data.responseText);
            console.log(errors.message.error)
            if ($.isEmptyObject(errors) == false) {

                $.each(errors.errors, function (key, value) {
                    var ErrorID = '#edit' + key + 'Error';
                    $(ErrorID).removeClass("d-none");
                    $(ErrorID).text(value)
                })

            }
        },
    });
});


function deleteItem(id) {
    $("#user-id").val(id);
}

$("#delete-btn").click(function () {
    var id = $("#user-id").val();
    $.ajax({
        type: "delete",
        url: "users/" + id,
        headers: {
            "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content"),
        },
        success: function (data) {
            $('#users').DataTable().ajax.reload()
            $('#success-msg').html(data.message);
            $('#success-msg').show();
            setTimeout(() => {
                $('.alert').hide()
            }, 3000);
        },
        error: function () {

        }
    });
})


function restoreItem(id) {
    $("#user-id").val(id);
}

$("#restore-btn").click(function () {
    var id = $("#user-id").val();
    $.ajax({
        type: "get",
        url: "users/restore/" + id,
        headers: {
            "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content"),
        },
        success: function (data) {
            $('#users').DataTable().ajax.reload()
            $('#success-msg').html(data.message);
            $('#success-msg').show();
            setTimeout(() => {
                $('.alert').hide()
            }, 3000);
        },
        error: function () {

        }
    });
})

function blockedItem(id) {
    $('#item-id').val(id)
    $.get("users/" + id, function (data) {
       var status = data.user.status ;
       console.log(status)
    if (status != 'blocked')
        $('.block_user').html('block');
    else
        $('.block_user').html('unblock');
    });

}

$("#block-btn").click(function () {
    var id = $("#item-id").val();
    console.log(id)
    $.ajax({
        type: "get",
        url: "users/block/" + id,
        headers: {
            "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content"),
        },
        success: function (data) {
            $('#users').DataTable().ajax.reload()
            $('#success-msg').html(data.message);
            $('#success-msg').show();
            setTimeout(() => {
                $('.alert').hide()
            }, 3000);
        },
        error: function (data) {
            console.log(data)
        }
    });
})



function showItem(id) {
    $.get("users/" + id, function (data) {
        $("#show-name").html(data.user.user_name);
        $("#show-email").html(data.user.email);
        $("#show-phone").html(data.user.phone);
        $("#show-address").html(data.user.address);
        $("#show-status").html(data.user.status);
        $("#show-created-at").html(data.user.created_at);
    });
}

