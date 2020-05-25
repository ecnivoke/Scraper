{include 'header.tpl.php' title={$title}}

<form method="POST" action="?p=login" enctype="multipart/form-data">
	<input type="hidden" name="csrf_token" value="{$smarty.session.csrf_token}">
	<div class='row'>
		<div class='small-10 columns small-centered'>
			<h1>{$title}</h1>
			<div class="row">
				<div class='small-3 columns'>
					<label for='username'>Username:</label>
					<input id='username' type="text" name="usernameR" value="{if !empty($input.usernameR)}{$input.usernameR}{/if}">
					<small><b class='error'>{if !empty($messages.usernameR)}{$messages.usernameR}{/if}</b></small>
				</div>
				<div class='small-3 columns end'>
					<label for='password'>Password:</label>
					<input id='password' type="password" name="passwordR" value="{if !empty($input.passwordR)}{$input.passwordR}{/if}">
					<small><b class='error'>{if !empty($messages.passwordR)}{$messages.passwordR}{/if}</b></small>
				</div>
				<div class='small-3 columns end'>
					<label for='remember'>Remember me:</label>
					<input id='remember' type="checkbox" name="remember" {if !empty($input.remember)}checked{/if}>
				</div>
			</div>
			{if !empty($errors)}
				<div class="row">
					<div class='small-12 columns'>
						<b class='error'>{$errors}</b>
					</div>
				</div>
			{/if}
			<div class="row">
				<div class='small-3 columns'>
					<input type="submit" value="Login">
				</div>
			</div>
		</div>
	</div>
</form>

{include 'footer.tpl.php'}