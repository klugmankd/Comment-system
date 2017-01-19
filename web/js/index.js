$(function () {
    $(document).ready(function () {
        $(".btn").click(function () {
            var id = $(".field").attr('id');
            $.ajax({
                type: "POST",
                url: "../CommentController/createAction",
                data: {'content': $("textarea[name='field']").val(),
                    'parentId': 0},
                response: "text",
                success: function (data) {
                    var list = document.getElementById('list');
                    var firstLi = list.getElementsByTagName('LI')[0];
                    var newListElem = document.createElement('LI');
                    newListElem.innerHTML = data;
                    list.insertBefore(newListElem, firstLi);
                    $("textarea[name='field']").attr('value', "");
                    edit();
                    remove();
                    addCommentToComment();
                }
            })
        });
        $(".showComments").click(function () {
            var parentId = $(this).val();
            var listId = "#list_"+parentId;
            var buttonId = "#hideBtn_"+parentId;
            if ($(listId).css("display") == "none") {
                $(listId).animate({height: 'show'}, 200);
                $(this).hide();
                $(buttonId).show();
            }
        });

        $(".hideComments").click(function () {
            var parentId = $(this).val();
            var listId = "#list_"+parentId;
            var buttonId = "#showBtn_"+parentId;
            if ($(listId).css("display") == "block") {
                $(listId).animate({height: 'hide'}, 200);
                $(this).hide();
                $(buttonId).show();
            }
        });

        showComments();

        addCommentToComment();

        remove();

        edit();

    });
});

function showComments() {
    $(".showComments").click(function () {
        var parentId = $(this).val();
        var listId = "#list_"+parentId;
        $.ajax({
            type: "POST",
            url: "../CommentController/getAllChildAction",
            data: {'parentId': parentId},
            response: "text",
            success: function (data) {
                $(listId).html(data);
                edit();
                remove();
            }
        })
    });
}

function addCommentToComment() {
    $(".commentFieldShow").click(function () {
        var id = $(this).val();
        var block = "#addCommentBlock"+id;
        var tAreaId = "#comment_to_comment_"+id;
        var listId = "#list_"+id;
        $(block).show(500);
        if ( $(block).css('display') == 'none' ) {
            $(block).show(400);
        }
        $(".addComment").click(function () {
            var id_button = $(this).attr('id');
            if ($(tAreaId).val() == "") {
                $(block).hide(200);
            } else
                $.ajax({
                    type: "POST",
                    url: "../CommentController/createAction",
                    data: {'content': $(tAreaId).val(), 'parentId': id},
                    response: "text",
                    success: function (data) {
                        var id_list = "list_"+id;
                        var list = document.getElementById(id_list);
                        var firstLi = list.getElementsByTagName('LI')[0];
                        var newListElem = document.createElement('LI');
                        newListElem.innerHTML = data;
                        newListElem.className = "commentChild";
                        list.insertBefore(newListElem, firstLi);
                        $(tAreaId).attr('value', "");
                        $(block).hide(200);
                        $(listId).show();
                        edit();
                        remove();
                        addCommentToComment()
                    }
                });
        })
    })
}

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