<h2>Log in</h2>
<form action="{base_url}user/login" method="post" class="form-horizontal">
    <ul>
        <li class="form-group">
            <label>Email</label>
            <div class="controls">
                <input type="text" name="email" />
            </div>
        </li>
        <li class="form-group">
            <label>Password</label>
            <div class="controls">
                <input type="password" name="password" />
            </div>
        </li>
    </ul>
    <input type="hidden" name="returnto" value="{returnto}" />
    <div class="form-group form-end">
        <p class="controls">
            <input name="submit-login" type="submit" value="Log in" />
            <a class="pull-right" href="{base_url}user/password/request_reset">Forgot your password?</a>
        </p>
    </div>
</form>