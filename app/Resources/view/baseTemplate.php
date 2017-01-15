<body>

<header class="nav navbar-form">
    <form action="UserController/regAction" method="post">
        <input type="submit" class="btn navbar-btn" name="registration" value="registration">
    </form>
    <form action="UserController/authAction" method="post">
        <input type="submit" class="btn navbar-btn" name="auth" value="auth">
    </form>


    <hr>
</header>
<div class="container">
    <h2>Insert</h2>
    <form action="CommentController/createAction" method="post">
        <textarea name="content" placeholder="content"></textarea>
        <input type="submit" value="ok">
    </form>
    <hr>
    <h2>Update</h2>
    <form action="CommentController/updateAction" method="post">
        <input type="text" name="id" placeholder="id"><br><br>
        <textarea name="content" placeholder="content"></textarea><br>
        <input type="submit" value="ok">
    </form>
    <hr>
    <button id="showComments">Comments</button>
</div>