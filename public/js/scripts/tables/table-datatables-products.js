$(function () {

    function datatable() {
        var table = $("#products").DataTable({
            responsive: false,
            processing: false,
            serverSide: false,
            ajax: {
                type: "get",
                url: "product/getData",
            },
            columns: [
                {
                    data: function (data) {
                        return data.DT_RowIndex;
                    },
                    name: "#",
                },
                {
                    data: function (data) {
                        return data.name;
                    },
                    name: "name",
                },
                {
                    data: function (data) {
                        return data.category_name;
                    },
                    name: "Category",
                },
                {
                    data: function (data) {
                        return data.price;
                    },
                    name: "price",
                },
                {
                    data: function (data) {
                        return (
                            "<img src='" +
                            data.image +
                            "' width='50px' style='border-radius: 10%;'/>"
                        );
                    },
                    name: "image",
                },
                {
                    data: function (data) {
                      if (data.is_special == 1)
                        return 'yes'
                      else
                        return 'no'
                    },
                    name: "is special",
                },
                {
                    data: function (data) {
                        if (data.status == 'notActive')
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
                        return data.action;
                    },
                    name: "action",
                },
            ],
        });
    }
    datatable();
});



function deleteItem(id) {
    console.log(id)
    $("#item-id").val(id);
    console.log($('#item-id').val())
}

$("#delete-btn").click(function () {
    var id = $('#item-id').val();
    console.log(id)
    $.ajax({
        type: "delete",
        url: "product/" + id,
        headers: {
            "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content"),
        },
        success: function (data) {
            $("#categories").DataTable().ajax.reload();
            $('#success-msg').html(data.message);
            $('#success-msg').show();
            setTimeout(() => {
                $(".alert-success").hide();
            }, 3000);
        },
        error: function (data) {
            $('#error-msg').html(data.message);
            $("#error-msg").show();
            setTimeout(() => {
                $(".alert-danger").hide();
            }, 3000);
        },
    });
});

$('#edit-modal').on('hidden.bs.modal', function () {
    // Clear data when the modal is closed
    $(this).find('.modal-body').empty();
});

$("#close").click(function () {
    console.log('dd')
    $("#image").removeAttr('src');
})
// change status

function changeStatus(id) {
    $("#item-id").val(id);
}

$("#change-btn").click(function () {
    var id = $("#item-id").val();
    $.ajax({
        type: "get",
        url: "product/change-status/" + id,
        headers: {
            "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content"),
        },
        success: function (data) {
            $('#products').DataTable().ajax.reload()
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




// edit category

function editItem(id) {
    $.get("category/" + id, function (category) {
        $("#id").val(category.id);
        $("#name").val(category.name);
        $("#description").val(category.description);
        $("#image").attr('src', category.image);
    });
}


$("#sub-edit").click(function () {
    // e.preventDefault();
    var form = new FormData($("#form-edit")[0]);
    var id = $("#id").val();
    console.log(id);
    $('#editnameError').addClass('d-none');
    $('#editpriceError').addClass('d-none');
    $('#editdescriptionError').addClass('d-none');
    $.ajax({
        type: "post",
        headers: {
            "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content"),
            "accept": "application/json"
        },
        url: "category/" + id,
        data: form,
        dataType: "text",
        processData: false, // tell jQuery not to process the data
        contentType: false,
        success: function (data) {
            $("#categories").DataTable().ajax.reload();
            $("#close").click();
            $("#success-msg").html(data.message);
            $("#success-msg").show();
            setTimeout(() => {
                $(".alert-success").hide();
            }, 3000);
        },
        error: function (data) {
            console.log(data)
            var errors = JSON.parse(data.responseText);
            console.log(errors)
            if ($.isEmptyObject(errors) == false) {

                $.each(errors.errors, function (key, value) {
                    console.log(key)
                    console.log(value)
                    var ErrorID = '#edit' + key + 'Error';

                    $(ErrorID).removeClass("d-none");
                    $(ErrorID).text(value)
                })

            }
        },
    });
});





function showItem(id) {
    $.get("category/" + id, function (category) {
        $("#show-name").html(category.name);
        $("#show-description").html(category.description);
        $("#show-image").attr('src', category.image);
        $("#show-status").html(category.status);
        $("#show-created-at").html(category.created_at);
    });
}
