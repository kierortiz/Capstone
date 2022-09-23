<button class="trigger-custom" data-izimodal-open="#modal-custom">Login/Custom example</button>


<div id="modal-custom" data-iziModal-group="grupo1">
        <button data-iziModal-close class="icon-close">x</button>
        <header>
            <a href="" id="signin">Sign in</a>
            <a href="" class="active">New Account</a>
        </header>
        <section class="hide">
            <form action="../action.php" method="post">
            <input type="text" placeholder="Email" name="user">
            <input type="password" placeholder="Password" name="pass">
            <footer>
                <button data-iziModal-close>Cancel</button>
                <button class="submit"><input type="submit" name="sub-login" value="Login" style="background: #28CA97;color: white;"></button>
            </footer>
            </form>
        </section>
        <section>
            <form action="action.php" method="post">
            <input type="text" placeholder="Username" placeholder="Email">
            <input type="pass" placeholder="Email" placeholder="Password">
            <input type="rpass" placeholder="Re Enter Password">
            <footer>
                <button data-iziModal-close>Cancel</button>
                <button class="submit"><input type="submit" value="Create Account" name="sub-register" style="background: #28CA97;color: white;"></button>
            </footer>
            </form>
        </section>
    </div>
