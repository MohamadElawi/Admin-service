$(function () {
    $(document).ready(function(){
        setTimeout(() => {
            $(".alert").hide();
        }, 3000);
   })


    function datatable() {
        var table = $("#admins").DataTable({
            responsive: true,
            processing: false,
            serverSide: false,
            ajax: {
                type: "get",
                url: "admins/getData",
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
                        return data.name;
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
                        return data.type;
                    },
                    name: "Type",
                },
                {
                    data: function (data) {
                        if ( data.status == 'notActive')
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
                        return (
                            '<a onclick=show(' + data.id + ')  data-toggle="modal" data-target="#show" style="color:#f5cb42;">' +
                            feather.icons["alert-circle"].toSvg({
                                class: "font-large-1 me-2",
                            }) +
                            "</a>" +
                            '<a  onclick=editItem(' + data.id + ') class="item-edit" data-toggle="modal" data-target="#edit-modal" style="color:#7367f0">' +
                            feather.icons["edit"].toSvg({
                                class: "font-large-1 me-2",
                            }) +
                            "</a>" +
                            '<a onclick="changeStatus(' + data.id +')"  data-toggle="modal" data-target="#change-status-modal" style="color: #6780E5;">' +
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
                    },
                    name: "action",
                },
            ]
        });
    }

    datatable();
});

function editItem(id) {
    $.get("admins/" + id, function (data) {
        console.log(data.admin.all_roles[0])
        console.log(data);
        $("#id").val(data.admin.id);
        $("#name").val(data.admin.name);
        $("#email").val(data.admin.email);
        $("#phone").val(data.admin.phone);
        $("#type").val(data.admin.type);
        $('#role_name').val(String(data.admin.roles[0].id));

    });

}
$("#sub-edit").click(function () {
    var id = $("#id").val();
    var form = new FormData($("#form-edit")[0]);

    $('#editnameError').addClass('d-none');
    $('#editemailError').addClass('d-none');
    $('#editphoneError').addClass('d-none');

    $.ajax({
        type: "POST",
        headers: {
            "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content"),
            "accept": "application/json",

        },
        url: "admins/" + id,
        data: form,
        dataType: "text",
        processData: false, // tell jQuery not to process the data
        contentType: false,
        success: function (data) {
            $("#admins").DataTable().ajax.reload();
            $("#success-msg").html(data);
            $("#success-msg").show();
            setTimeout(() => {
                $("#success-msg").hide();
            }, 3000);
            $('#close-btn').click();
        },
        error: function (data) {;
            var errors = JSON.parse(data.responseText);
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
    $("#admin-id").val(id);
}

$("#delete-btn").click(function () {
    var id = $("#admin-id").val();
    $.ajax({
        type: "delete",
        url: "admins/" + id,
        headers: {
            "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content"),
        },
        success: function (data) {
            $('#admins').DataTable().ajax.reload()
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

function show(id) {
    $.get("admins/" + id, function (data) {
        console.log(data)
        $("#show-name").html(data.admin.name);
        $("#show-email").html(data.admin.email);
        $("#show-phone").html(data.admin.phone);
        $("#show-type").html(data.admin.type);
        $("#show-role").html(data.admin.all_roles);
        $("#show-status").html(data.admin.status);
        $("#show-created-at").html(data.admin.created_at);
    });
}



function changeStatus(id) {
    $("#admin-id").val(id);
}

$("#change-btn").click(function () {
    var id = $("#admin-id").val();
    $.ajax({
        type: "get",
        url: "admins/change-status/" + id,
        headers: {
            "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content"),
        },
        success: function (data) {
            $('#admins').DataTable().ajax.reload()
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
