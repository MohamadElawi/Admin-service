$(function () {

        function datatable() {
            var table = $("#specializations").DataTable({
                responsive: !0,
                processing: true,
                serverSide: true,
                ajax: {
                    type: "get",
                    url: "/question/datatabel",
                    // headers: {
                    //     "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    //         "content"
                    //     ),
                    // },
                    // success:function(data){
                    //     console.log(data);
                    // },
                    error: function (jqXHR, textStatus, errorThrown) {
                        alert(
                            "An error occurred... Look at the console (F12 or Ctrl+Shift+I, Console tab) for more information!"
                        );

                        $("#result").html(
                            "<p>status code: " +
                                jqXHR.status +
                                "</p><p>errorThrown: " +
                                errorThrown +
                                "</p><p>jqXHR.responseText:</p><div>" +
                                jqXHR.responseText +
                                "</div>"
                        );
                        console.log("jqXHR:");
                        console.log(jqXHR);
                        console.log("textStatus:");
                        console.log(textStatus);
                        console.log("errorThrown:");
                        console.log(errorThrown);
                    },

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
                            return data.question;
                        },
                        name: "Question",
                    },
                    {
                        data: function (data) {
                            return data.oreder;
                        },
                        name: "Order",
                    },
                    {
                        data: function (data) {
                            return data.answer;
                        },
                        name: "Answer",
                    },
                    {
                        data: function (data) {
                            return '<a href="/question/'+data.id+'/edit" class="item-edit">' +
                            feather.icons['edit'].toSvg({ class: 'font-large-1 me-2' }) +
                            '</a>'+
                            '<a onclick="deleteQuestion('+data.id+')" class="delete-record">' +
                            feather.icons['trash-2'].toSvg({ class: 'font-large-1 me-2' }) +
                            '</a>' ;
                        },
                        name: "action",
                    }
                ],
            });
        }


        datatable();
    });

    function deleteQuestion(id){
        $.ajax({
            type: "delete",
            url: "/question/" + id + "/delete",
            headers: {
                "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content"),
            },
            success: function () {
                $("#specializations").DataTable().draw();
            },
        });}
