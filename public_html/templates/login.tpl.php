{include 'header.tpl.php' title={$title}}

<form method="POST" action="?p=login" enctype="multipart/form-data">
	<div class='row'>
		<div class='small-10 columns small-centered'>
			<div class="row">
				<div class='small-3 columns'>
					<label for='username'>Username:</label>
					<input id='username' type="text" name="usernameR" value="{if !empty($input)}{$input.usernameR}{/if}">
					<small><b class='error'>{if !empty($messages.usernameR)}{$messages.usernameR}{/if}</b></small>
				</div>
				<div class='small-3 columns end'>
					<label for='password'>password:</label>
					<input id='password' type="password" name="passwordR" value="{if !empty($input)}{$input.passwordR}{/if}">
					<small><b class='error'>{if !empty($messages.passwordR)}{$messages.passwordR}{/if}</b></small>
				</div>
			</div>
			<div class="row">
				<div class='small-3 columns'>
					<input type="submit" value="Login">
				</div>
			</div>
		</div>
	</div>
</form>

{include 'footer.tpl.php'}