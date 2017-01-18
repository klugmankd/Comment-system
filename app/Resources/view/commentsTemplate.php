<div class="container" id="comments">
    <center><h1>Comments<hr></h1></center>
    <div>
        <textarea id="field" class="field input-lg" name="field" placeholder="повідомлення"></textarea>
        <input class="btn input-lg" type="button" value="ok">
    </div>
    <ul id="list">
    <?php
        while ($record = mysqli_fetch_array($result)) { ?>
            <li id="comment_<?=$record['id']?>">
                <?php
                    require 'commentTemplate.php';
                ?>
            </li>
        <?php } ?>
    </ul>
</div>