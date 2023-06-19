$(function () {
    $(document).ready(function() {
        $('.datetimepicker').daterangepicker({
          singleDatePicker: true,
          timePicker: true,
          locale: {
            format: 'YYYY-MM-DD HH:mm'
          }
        });
      });

      function populateDateTime() {
        var datetime1 = moment($('#datetime1').val(), 'YYYY-MM-DD HH:mm').format('YYYY-MM-DD HH:mm');
        var datetime2 = moment($('#datetime2').val(), 'YYYY-MM-DD HH:mm').format('YYYY-MM-DD HH:mm');
        var datetime3 = moment($('#datetime3').val(), 'YYYY-MM-DD HH:mm').format('YYYY-MM-DD HH:mm');

        $('#datetime1').val(datetime1);
        $('#datetime2').val(datetime2);
        $('#datetime3').val(datetime3);
      }


    $(document).ready(function(){
        setTimeout(() => {
            $(".alert").hide();
        }, 3000);
     })

    function datatable() {
        var table = $("#maintenances").DataTable({
            responsive: false,
            processing: false,
            serverSide: false,
            ajax: {
                type: "get",
                url: "maintenance/getData",
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
                        return data.service_name;
                    },
                    name: "Servcie Name",
                },
                {
                    data: function (data) {
                        return data.user_name;
                    },
                    name: "User Name",
                },
                {
                    data: function (data) {
                        return data.user_phone;
                    },
                    name: "User phone",
                },
                {
                    data: function (data) {
                        if (data.status == 'pending')
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
    $("#item-id").val(id);
}

$("#delete-btn").click(function () {
    var id =$('#item-id').val();
    $.ajax({
        type: "delete",
        url: "maintenance/" + id,
        headers: {
            "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content"),
        },
        success: function (data) {
            $("#maintenances").DataTable().ajax.reload();
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


function addPrice(id) {
    $("#main-id").val(id);
}

$("#add-price-sub").click(function () {
    console.log('dd')
    var id = $("#item-id").val();
    var price_form = new FormData($("#form-add-price")[0]);
    console.log('id',id)
    console.log('form',price_form)
    $.ajax({
        type: "post",
        url: "maintenance/addPrice/" + id,
        headers: {
            "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content"),
            "accept" : "application/json"
        },
        data: price_form,
        success: function (data) {
            $('#maintenance').DataTable().ajax.reload()
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





function editItem(id) {
        $("#id").val(id);
}

$("#sub-edit").click(function () {
    var form = new FormData($("#form-edit")[0]);
    var id =$("#id").val();
    $.ajax({
        type: "post",
        headers: {
            "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content"),
            "accept" : "application/json"
        },
        url: "maintenance/"+id,
        data: form,
        dataType: "text",
        processData: false, // tell jQuery not to process the data
        contentType: false,
        success: function (data) {
            $('#maintenances').DataTable().ajax.reload()
            $("#close").click();
            $("#success-msg").html(data.message);
            $("#success-msg").show();
            setTimeout(() => {
                $(".alert-success").hide();
            }, 3000);
        },
        error: function (data) {
            console.log(data)
     
        },
    });
});



function showItem(id) {
    $.get("maintenance/" + id, function (maintenance) {
        $("#show-service-name").html(maintenance.service_name);
        $("#show-user-name").html(maintenance.user_name);
        $("#show-user-phone").html(maintenance.user_phone);
        $("#show-location").html(maintenance.location);
        $("#show-street").html(maintenance.street);
        $("#show-area").html(maintenance.area);
        $("#show-description").html(maintenance.description);
        $("#show-status").html(maintenance.status);
        $("#show-appointment").html(maintenance.appointment_at);
        $("#show-created-at").html(maintenance.created_at);
    });
}
