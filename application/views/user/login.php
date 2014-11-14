<h2>Log in</h2>
<form action="{base_url}user/login" method="post">
    <ul>
        <li>
            <label>Email</label>
            <div class="controls">
                <input type="text" name="email" />
            </div>
        </li>
        <li>
            <label>Password</label>
            <div class="controls">
                <input type="password" name="password" />
            </div>
        </li>
    </ul>
    <input type="hidden" name="returnto" value="{returnto}" />
    <p class="form-actions"><input name="submit-login" type="submit" value="Log in" /></p>
</form>