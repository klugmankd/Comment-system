
    //your code here
$(function () {
    $(document).ready(function () {
        $(".btn").click(function () {
            var id = $(".field").attr('id');
            $.ajax({
                type: "POST",
                url: "../CommentController/createAction",
                data: {'content': $("textarea[name='field']").val()},
                response: "text",
                success: function (data) {
                    var list = document.getElementById('list');
                    var firstLi = list.getElementsByTagName('LI')[0];
                    var newListElem = document.createElement('LI');
                    newListElem.innerHTML = data;
                    newListElem.className = "comment";
                    list.insertBefore(newListElem, firstLi);
                    $("textarea[name='field']").attr('value', "");
                    remove();
                }
            })
        });
        remove();
        edit();
    });
});


function edit() {
    $(".edit").click(function () {
        var id = $(this).val();
        var id_comment = "comment_"+id;
        var block = document.getElementById(id_comment);
        $.ajax({
            type: "POST",
            url: "../CommentController/readAction",
            data: {'id': id},
            response: "text",
            success: function (data) {
                block.innerHTML = data;
                $(".sendEdit").click(function () {
                    $.ajax({
                        type: "POST",
                        url: "../CommentController/updateAction",
                        data: {'id': id, 'content': $("textarea[name='editArea']").val()},
                        response: "text",
                        success: function (data) {
                            block.innerHTML = data;
                            edit();
                        }
                    })
                })
            }
        })
    })
}

function remove() {
    $(".delete").click(function () {
        var id = $(this).val();
        var id_comment = "comment_"+id;
        var comment = document.getElementById(id_comment);
        $.ajax({
            type: "POST",
            url: "../CommentController/deleteAction",
            data: {'id': id},
            response: "text",
            success: function () {
                comment.parentNode.removeChild(comment);
            }
    })
    })
}