var counter = 1 ;
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
                {
                    data: function (data) {
                        return counter++;
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
                        return data.status;
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
                            '<a onclick=showItem('+data.id+')  data-toggle="modal" data-target="#user-show" style="color:#f5cb42;">' +
                            feather.icons["alert-circle"].toSvg({
                                class: "font-large-1 me-2",
                            }) +
                            "</a>" +
                            '<a  onclick=editItem('+data.id+') class="item-edit" data-toggle="modal" data-target="#user-edit" style="color:#7367f0">'  +
                            feather.icons["edit"].toSvg({
                                class: "font-large-1 me-2",
                            }) +
                            "</a>" +
                            '<a onclick="deleteItem(' +
                            data.id +
                            ')" class="delete-record" data-toggle="modal" data-target="#delete-modal" style="color: #EE4B2B;">' +
                            feather.icons["trash-2"].toSvg({
                                class: "font-large-1 me-2",
                            }) +
                            "</a>"
                            +'<meta name="csrf-token" content="{{ csrf_token() }}"></meta>'
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
        headers: {"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),},
        url: "users/store",
        data: form,
        processData: false,
        contentType: false,
        cache: false,
        success: function (data) {
            $("#users").DataTable().ajax.reload();
            $("#close-modal").click();
            $("#create-msg").show();

            setTimeout(() => {
                $(".alert-success").hide();
            }, 3000);
        },
        error: function (data) {
            console.log(data)
            var errors = data.responseJSON;
                    if($.isEmptyObject(errors) == false) {
                        $.each(errors.errors,function (key, value) {
                            var ErrorID = '#add'+ key +'Error';

                            $(ErrorID).removeClass("d-none");
                            $(ErrorID).text(value)
                        })
                    }
        },
    });
});


function editItem(id) {
    $.get("users/show/" + id, function (user) {
        $("#id").val(user.id);
        $("#name").val(user.name);
        $("#email").val(user.email);
    });

    $("#sub-edit").click(function () {
        var form = new FormData($("#form-edit")[0]);
        $('#editnameError').addClass('d-none');
        $('#editemailError').addClass('d-none');

        $.ajax({
            type: "post",
            headers: {
                "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content"),
                "accept" : "application/json"
            },
            url: "users/update",
            data: form,
            dataType: "text",
            processData: false, // tell jQuery not to process the data
            contentType: false,
            success: function () {
                $("#users").DataTable().ajax.reload();
                $("#close-modal-edit").click();
                $("#update-msg").show();
                setTimeout(() => {
                    $(".alert-success").hide();
                }, 3000);
            },
            error: function (data) {
                console.log(data)
                var errors = JSON.parse(data.responseText);
                    console.log(errors)
                    if($.isEmptyObject(errors) == false) {

                        $.each(errors.errors,function (key, value) {
                            console.log(key)
                            console.log(value)
                            var ErrorID = '#edit'+ key +'Error';

                            $(ErrorID).removeClass("d-none");
                            $(ErrorID).text(value)
                        })

                    }
            },
        });
    });
}

function deleteItem(id) {
    $("#user-id").val(id);
}

$("#delete-btn").click(function () {
    var id=$("#user-id").val();
    $.ajax({
        type: "delete",
        url: "users/" + id,
        headers: {
            "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content"),
        },
        success: function () {
            $('#users').DataTable().ajax.reload()
            $('#delete_msg').show() ;
            setTimeout(() => {
               $('.alert').hide()
            }, 3000);
        },
        error:function(){

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

