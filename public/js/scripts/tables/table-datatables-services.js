$(function () {
    $(document).ready(function(){
        setTimeout(() => {
            $(".alert").hide();
        }, 3000);
     })

    function datatable() {
        var table = $("#services").DataTable({
            responsive: false,
            processing: false,
            serverSide: false,
            ajax: {
                type: "get",
                url: "service/getData",
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
                        return data.truncated_description;
                    },
                    name: "description",
                },
                {
                    data: function (data) {
                        if (data.active == 'not active')
                            return "<small class='badge rounded-pill  badge-light-danger'>" + 'not-active' + "<small>";
                        else
                            return "<small class='badge rounded-pill  badge-light-success'>" + 'active' + "</small>";
                    },
                    name: "status",
                },
                {
                    data: function (data) {
                        return data.createdAt;
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
    $("#item-id").val(id);
   console.log($('#item-id').val())
}

$("#delete-btn").click(function () {
    var id =$('#item-id').val();
    console.log(id)
    $.ajax({
        type: "delete",
        url: "service/" + id,
        headers: {
            "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content"),
        },
        success: function (data) {
            console.log(data.message)
            $("#services").DataTable().ajax.reload();
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


// edit

function editItem(id) {
    $.get("service/" + id, function (service) {
        $("#id").val(service._id);
        $("#name").val(service.name);
        $("#description").val(service.description);
        $("#active").val(service.active);
    });
}


$("#sub-edit").click(function () {
    // e.preventDefault();
    var form = new FormData($("#form-edit")[0]);
    var id =$("#id").val();
    $.ajax({
        type: "post",
        headers: {
            "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content"),
            "accept" : "application/json"
        },
        url: "service/"+id,
        data: form,
        dataType: "text",
        processData: false, // tell jQuery not to process the data
        contentType: false,
        success: function (data) {
            console.log(data)
            $("#services").DataTable().ajax.reload();
            $("#close").click();
            $("#success-msg").html(data.message);
            $("#success-msg").show();
            setTimeout(() => {
                $(".alert-success").hide();
            }, 3000);
        },
        error: function (data) {
            console.log(data)
            $("#error-msg").html(data.message);
            $("#error-msg").show();
            setTimeout(() => {
                $(".alert-error").hide();
            }, 3000);
        },
    });
});

