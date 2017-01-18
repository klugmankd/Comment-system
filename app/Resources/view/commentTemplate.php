    <div class="author"><?=$record['user_id']?></div>
    <div class="content"><?=$record['content']?></div>
    <div class="createDate"><?=$record['create_date']?></div>
    <div class="panel_<?=$record['id']?>">
        <?php if($record['user_id'] == $_SESSION['id']) {?>
            <button class="edit btn-link" value="<?=$record['id']?>">Edit</button>/
            <button class="delete btn-link" value="<?=$record['id']?>">Delete</button>/
        <?php } ?>
        <button class="showComments btn-link">Show Comments</button>
    </div>
    <div class="commentBlock">
        <button class="addComment btn-link" value="<?=$record['id']?>">Add Comment</button>
        <ul id="comments_<?=$record['id']?>"></ul>
    </div>

