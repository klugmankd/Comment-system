$(function () {
    $(document).ready(function () {
        commentsShow();
        commentsHide();
        addComment();
        commentFieldShow();
        commentFieldHide();
        showComments();
        remove();
        edit();
    });
});

function showComments() {
    $(".showComments").click(function () {
        var parentId = $(this).val();
        var listId = "#list"+parentId;
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

function addComment() {
    $(".addComment").click(function () {
        var id = $(this).attr('id');
        var parentId = $(this).val();
        var listId = "list";
        var areaId = "#area";
        var list;
        if (id != "addComment") {
            listId = "list"+parentId;
            areaId = "#area"+parentId;
        }
        var areaVal = $(areaId).val();
        if (areaVal != "")
        $.ajax({
            type: "POST",
            url: "../CommentController/createAction",
            data: {'content': areaVal,
                'parentId': parentId},
            response: "text",
            success: function (data) {
                var list = document.getElementById(listId);
                var firstLi = list.getElementsByTagName('LI')[0];
                var newListElem = document.createElement('LI');
                newListElem.innerHTML = data;
                list.insertBefore(newListElem, firstLi);
                $(areaId).attr('value', "");
                $(list).show();
                edit();
                remove();
                showComments();
                addComment();
                commentFieldShow();
                commentFieldHide();
            }
        });
    });
}

function commentFieldShow() {
    $(".commentFieldShow").click(function () {
        var id = $(this).val();
        var block = "#addCommentBlock"+id;
        var buttonId = "#commentFieldHide"+id;
        if ($(block).css("display") == "none") {
            $(block).animate({height: 'show'}, 200);
            $(this).hide();
            $(buttonId).show();
        }
    });
}

function commentFieldHide() {
    $(".commentFieldHide").click(function () {
        var id = $(this).val();
        var block = "#addCommentBlock"+id;
        var buttonId = "#commentFieldShow"+id;
        if ($(block).css("display") == "block") {
            $(block).animate({height: 'hide'}, 200);
            $(this).hide();
            $(buttonId).show();
        }
    });
}

function commentsShow() {
  $(".showComments").click(function () {
    var parentId = $(this).val();
    var listId = "#list"+parentId;
    var buttonId = "#hideBtn_"+parentId;
    var fieldBtnShow = "#commentFieldShow"+parentId;
    if ($(listId).css("display") == "none") {
      $(listId).animate({height: 'show'}, 200);
      $(this).hide();
      $(buttonId).show();
      $(fieldBtnShow).hide();
    }
  });
}

function commentsHide() {
    $(".hideComments").click(function () {
        var parentId = $(this).val();
        var listId = "#list"+parentId;
        var buttonId = "#showBtn_"+parentId;
        var fieldBtnShow = "#commentFieldShow"+parentId;
        if ($(listId).css("display") == "block") {
            $(listId).animate({height: 'hide'}, 200);
            $(this).hide();
            $(buttonId).show();
            $(fieldBtnShow).show();
        }
    });
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
