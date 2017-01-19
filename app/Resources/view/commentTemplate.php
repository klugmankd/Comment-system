<li id="comment_<?=$record['id']?>" class="comment">
    <div class="createDate"><?=$record['create_date']?></div>
    <div class="author"><?=$record['username']?></div>
    <div class="content"><?=$record['content']?></div>
    <div class="panel_<?=$record['id']?>">
        <?php if($record['user_id'] == $_SESSION['id']) {?>
            <button class="commentButtons edit btn-link" value="<?=$record['id']?>">Edit</button>
            <span class="slash">/</span>
            <button class="commentButtons delete btn-link" value="<?=$record['id']?>">Delete</button>
            <span class="slash">/</span>
        <?php } ?>
        <button id="showBtn_<?=$record['id']?>" class="showComments btn-link commentButtons" style="display: block;" value="<?=$record['id']?>">Show Comments</button>
        <button id="hideBtn_<?=$record['id']?>" class="hideComments btn-link commentButtons" style="display: none;" value="<?=$record['id']?>">Hide Comments</button>
    </div>
    <div class="commentBlock">
        <button class="commentButtons commentFieldShow btn-link" value="<?=$record['id']?>">Show comment field</button>
        <div id="addCommentBlock<?=$record['id']?>" style="display: none">
            <textarea id="comment_to_comment_<?=$record['id']?>" placeholder="message"></textarea>
            <button class="addComment" id="addComment<?=$record['id']?>">Add Comment</button>
        </div>
        <ul id="list_<?=$record['id']?>" style="display: none">
        </ul>
    </div>
</li>
