$(function () {
    $(document).ready(function () {
        $("#showComments").click(function () {
            $.ajax({
                type: "GET",
                url: "controller/getAllAction",
                data: {'id': "show"},
                response: "text",
                success: function (data) {
                    // $("#comments").html(data);
                    alert(data);
                }
            })
        });
    });
});