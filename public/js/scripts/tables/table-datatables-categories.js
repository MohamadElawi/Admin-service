$(function () {
    function datatable() {
        var table = $("#specializations").DataTable({
            responsive: true,
            processing: false,
            serverSide: false,
            ajax: {
                type: "get",
                url: "getData",
            },
            columns: [
                {
                    data: function (data) {
                        return data.id;
                    },
                    name: "#",
                },
                {
                    data: function (data) {
                        return data.name;
                    },
                    name: "Name",
                },
                {
                    data: function (data) {
                        return data.price;
                    },
                    name: "Price",
                },

                {
                    data: function (data) {
                        return (
                            '<a onclick="showItem(' + data.id + ')"  data-toggle="modal" data-target="#category-show" style="color:#f5cb42;">' +
                            feather.icons["alert-circle"].toSvg({
                                class: "font-large-1 me-2",
                            }) +
                            "</a>" +
                            '<a onclick="editItem(' +
                            data.id +
                            ')" class="item-edit" data-toggle="modal" data-target="#category-edit" style="color:#7367f0;"> ' +
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
                            "</a>" +
                            '<meta name="csrf-token" content="{{ csrf_token() }}"></meta>'
                        );
                    },
                    name: "action",
                },
            ],
        });
    }
    datatable();
});



function deleteItem(id) {
    $("#delete-btn").click(function () {
        $.ajax({
            type: "delete",
            url: "category/" + id,
            headers: {
                "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content"),
            },
            success: function () {
                $("#specializations").DataTable().ajax.reload();
                $("#delete-msg").show();
                setTimeout(() => {
                    $(".alert-success").hide();
                }, 3000);
                $("#close").click();
            },
            error: function () {
                $("#error-msg").show();
                setTimeout(() => {
                    $(".alert-danger").hide();
                }, 3000);
            },
        });
    });
}


// edit category

function editItem(id) {
    $.get("show/" + id, function (category) {
        $("#id").val(category.id);
        $("#name").val(category.name);
        $("#price").val(category.price);
        $("#description").val(category.description);
    });

    $("#sub-edit").click(function () {
        // e.preventDefault();
        var form = new FormData($("#form-edit")[0]);
        $('#editnameError').addClass('d-none');
        $('#editpriceError').addClass('d-none');
        $('#editdescriptionError').addClass('d-none');
        $.ajax({
            type: "post",
            headers: {
                "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content"),
                "accept" : "application/json"
            },
            url: "category/update/"+id,
            data: form,
            dataType: "text",
            processData: false, // tell jQuery not to process the data
            contentType: false,
            success: function (data) {
                $("#specializations").DataTable().ajax.reload();
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



// create category
$(document).on("click", "#submit", function (e) {
    e.preventDefault();
    $("#addnameError").addClass('d-none');
    $("#addpriceError").addClass('d-none');
    $("#adddescriptionError").addClass('d-none');
    var form = new FormData($("#form")[0]);
    var headers = {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    };
    $.ajax({
        type: "post",
        headers: headers,
        url: "category/store",
        data: form,
        processData: false,
        contentType: false,
        cache: false,
        success: function (data) {
            $("#specializations").DataTable().ajax.reload();
            $("#close-modal").click();
            $("#create-msg").show();
            setTimeout(() => {
                $(".alert-success").hide();
            }, 3000);
        },
        error: function (data) {
            console.log(data)
            var errors = data.responseJSON;
            if ($.isEmptyObject(errors) == false) {
                if (data.status == 422) {
                    $.each(errors.errors, function (key, value) {
                        var ErrorID = '#add' + key + 'Error';
                        $(ErrorID).removeClass("d-none");
                        $(ErrorID).text(value)
                    })
                }
                else {
                    $("#error-msg").show()
                    $('#close-modal').click()
                    setTimeout(() => {
                        $('.alert-danger').hide()
                    }, 3000)
                }
            }



        },
    });
});


function showItem(id) {
    $.get("show/" + id, function (category) {
        console.log(category)
        $("#show-name").html(category.name);
        $("#show-price").html(category.price);
        $("#show-description").html(category.description);
    });
}
