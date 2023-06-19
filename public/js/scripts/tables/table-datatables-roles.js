$(function () {
    $(document).ready(function(){
        setTimeout(() => {
            $(".alert").hide();
        }, 3000);
   })


    function datatable() {
        var table = $("#roles").DataTable({
            responsive: true,
            processing: false,
            serverSide: false,
            ajax: {
                type: "get",
                url: "roles/getData",
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
                    name: "Name",
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
                        return data.action ;
                    },
                    name: "action",
                },
            ]
        });
    }

    datatable();
});


function deleteItem(id) {
    $("#role-id").val(id);
}

$("#delete-btn").click(function () {
    var id = $("#role-id").val();
    $.ajax({
        type: "delete",
        url: "roles/" + id,
        headers: {
            "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content"),
        },
        success: function (data) {
            $('#roles').DataTable().ajax.reload()
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

function changeStatus(id) {
    $("#role-id").val(id);
}

$("#change-btn").click(function () {
    var id = $("#role-id").val();
    $.ajax({
        type: "get",
        url: "roles/change-status/" + id,
        headers: {
            "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content"),
        },
        success: function (data) {
            $('#roles').DataTable().ajax.reload()
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
