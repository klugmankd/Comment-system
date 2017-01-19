<div class="container" id="comments">
    <h1>Коментарі</h1>
    <div id="commentField">
        <textarea id="area" class="field input-lg" name="field" placeholder="повідомлення"></textarea>
        <button id="addComment" class="btn input-lg addComment messageBtn formBtn animation" type="button" value="0">Надіслати</button>
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