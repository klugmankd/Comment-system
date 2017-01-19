<div class="container" id="comments">
    <center><h1>Comments<hr></h1></center>
    <div id="commentField">
        <textarea id="field" class="field input-lg" name="field" placeholder="повідомлення"></textarea>
        <input id="addComment" class="btn input-lg messageBtn" type="button" value="ok">
    </div>
    <ul id="list" class="list">
    <?php
        while ($record = mysqli_fetch_array($result)) {
            if($record['parent_id'] == 0) {
                    require 'commentTemplate.php';
            }
        }
    ?>
    </ul>
</div>