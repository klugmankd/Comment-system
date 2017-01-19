<div class="container form">
    <a class="link animation" href="../">Додому</a>
    <a class="link animation" href="authAction">Вхід</a>
    <form action="../UserController/createAction" method="post" autocomplete="off">
        <h2>Реєстрація</h2>
        <input class="formField" type="text" name="username" placeholder="логін">
        <input class="formField" type="password" name="password" placeholder="пароль">
        <input class="formField" type="email" name="email" placeholder="електронна пошта">
        <input class="formField" type="text" name="firstName" placeholder="ім’я">
        <input class="formField" type="text" name="lastName" placeholder="прізвище">
        <input class="formBtn animation" type="submit" value="Приєднатись">
    </form>
</div>