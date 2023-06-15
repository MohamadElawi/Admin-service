$(function () {
    $(document).ready(function(){
        setTimeout(() => {
            $(".alert").hide();
        }, 3000);
   })


    function datatable() {
        var table = $("#orders").DataTable({
            responsive: true,
            processing: false,
            serverSide: false,
            ajax: {
                type: "get",
                url: "order/getData",
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
                        return data.user_name;
                    },
                    name: "User Name",
                },
                {
                    data: function (data) {
                        return data.user_email;
                    },
                    name: "User Email",
                },
                {
                    data: function (data) {
                        return data.user_phone;
                    },
                    name: "User Phone",
                },
                {
                    data: function (data) {
                        return data.total_amount;
                    },
                    name: "Total Amount",
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
