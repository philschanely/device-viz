<h2>Log in</h2>

{show_message?}
<p class="alert alert-warning">{message}</p>
{/show_message?}

<form action="{base_url}user/login" method="post">
    <ul>
        <li class="control-group">
            <label class="control-label">Email</label>
            <div class="controls">
                <input type="text" name="email" />
            </div>
        </li>
        <li class="control-group">
            <label class="control-label">Password</label>
            <div class="controls">
                <input type="password" name="password" />
            </div>
        </li>
    </ul>
    <input type="hidden" name="returnto" value="{returnto}" />
    <p class="form-actions"><input name="submit-login" type="submit" value="Log in" /></p>
</form>