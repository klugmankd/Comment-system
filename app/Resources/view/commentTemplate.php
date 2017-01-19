<li id="comment_<?=$record['id']?>" class="comment">
    <div class="createDate"><?=$record['create_date']?></div>
    <div class="author"><?=$record['username']?></div>
    <div class="content"><?=$record['content']?></div>
    <div class="panel_<?=$record['id']?>">
        <?php if($record['user_id'] == $_SESSION['id']) {?>
            <button class="commentButtons edit btn-link" value="<?=$record['id']?>">Редагувати</button>
            <span class="slash">/</span>
            <button class="commentButtons delete btn-link" value="<?=$record['id']?>">Видалити</button>
            <span class="slash">/</span>
        <?php } ?>
        <button id="showBtn_<?=$record['id']?>" class="showComments btn-link commentButtons" style="display: block;" value="<?=$record['id']?>">Показати коментарі</button>
        <button id="hideBtn_<?=$record['id']?>" class="hideComments btn-link commentButtons" style="display: none;" value="<?=$record['id']?>">Приховати коментарі</button>
    </div>
    <div class="commentBlock">
        <button id="commentFieldShow<?=$record['id']?>" class="commentButtons commentFieldShow btn-link" style="display: block" value="<?=$record['id']?>">Показати поле для вводу</button>
        <button id="commentFieldHide<?=$record['id']?>" class="commentButtons commentFieldHide btn-link" style="display: none" value="<?=$record['id']?>">Приховати поле для вводу</button>
        <div id="addCommentBlock<?=$record['id']?>" class="addCommentBlock" style="display: none">
            <textarea id="area<?=$record['id']?>" class="formField inComment" placeholder="повідолення"></textarea>
            <button class="addComment formBtn animation" id="addComment<?=$record['id']?>" value="<?=$record['id']?>">Надіслати</button>
        </div>
        <ul id="list<?=$record['id']?>" style="display: none">
        </ul>
    </div>
</li>
