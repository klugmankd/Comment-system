<div class="container" id="comments">
    <?php
        while ($record = mysqli_fetch_array($result)) {?>
            <div class="comment">
                <div class="author"><?=$record['user_id']?></div>
                <div class="content"><?=$record['content']?></div>
                <div class="createDate"><?=$record['create_date']?></div>
            </div>
    <?php }?>
</div>