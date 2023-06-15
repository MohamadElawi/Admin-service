$(function () {
    $(document).ready(function(){
        setTimeout(() => {
            $(".alert").hide();
        }, 3000);
   })

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


///////// delete
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




// edit 
// function editItem(id) {
//     $.get("category/" + id, function (category) {
//         $("#id").val(category.id);
//         $("#name").val(category.name);
//         $("#description").val(category.description);
//         $("#image").attr('src', category.image);
//     });
// }


// $("#sub-edit").click(function () {
//     // e.preventDefault();
//     var form = new FormData($("#form-edit")[0]);
//     var id = $("#id").val();
//     console.log(id);
//     $('#editnameError').addClass('d-none');
//     $('#editpriceError').addClass('d-none');
//     $('#editdescriptionError').addClass('d-none');
//     $.ajax({
//         type: "post",
//         headers: {
//             "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content"),
//             "accept": "application/json"
//         },
//         url: "category/" + id,
//         data: form,
//         dataType: "text",
//         processData: false, // tell jQuery not to process the data
//         contentType: false,
//         success: function (data) {
//             $("#categories").DataTable().ajax.reload();
//             $("#close").click();
//             $("#success-msg").html(data.message);
//             $("#success-msg").show();
//             setTimeout(() => {
//                 $(".alert-success").hide();
//             }, 3000);
//         },
//         error: function (data) {
//             console.log(data)
//             var errors = JSON.parse(data.responseText);
//             console.log(errors)
//             if ($.isEmptyObject(errors) == false) {

//                 $.each(errors.errors, function (key, value) {
//                     console.log(key)
//                     console.log(value)
//                     var ErrorID = '#edit' + key + 'Error';

//                     $(ErrorID).removeClass("d-none");
//                     $(ErrorID).text(value)
//                 })

//             }
//         },
//     });
// });





function showItem(id) {
    $.get("product/" + id, function (product) {
        console.log(product)
        $("#show-name").html(product.name);
        $("#show-category").html(product.category_name);
        $("#show-description").html(product.description);
        $("#show-details").html(product.details);
        $("#show-quantity").html(product.quantity);
        $("#show-price").html(product.price);
        $("#show-is-special").html(product.is_special == 1 ? 'yes' : 'no');
        $("#show-status").html(product.status);
        $("#show-created-at").html(product.created_at);
        $("#show-image").attr('src', product.image);
    });
}
