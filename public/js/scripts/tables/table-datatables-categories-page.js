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
                        return data.price;
                    },
                    name: "Price",
                },

                {
                    data: function (data) {
                        return (
                            '<a onclick="showItem('+data.id+')" data-toggle="modal" data-target="#category-show" style="color:#f5cb42;">' +
                            feather.icons["alert-circle"].toSvg({
                                class: "font-large-1 me-2",
                            }) +
                            "</a>" +
                            '<a href="category/edit/'+data.id+'" class="item-edit"  style="color:#7367f0;"> ' +
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

f

function showItem(id) {
    $.get("show/" + id, function (category) {
        console.log(category)
        // $("#id").val(category.id);
        $("#show-name").html(category.name);
        $("#show-price").html(category.price);
        $("#show-description").html(category.description);
    });
}
