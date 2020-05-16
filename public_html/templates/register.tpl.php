{include 'header.tpl.php' title={$title}}

<form method="POST" action="?p=register" enctype="multipart/form-data">
	<div class='row'>
		<div class='small-10 columns small-centered'>
			<h1>{$title}</h1>
			<div class="row">
				<div class='small-3 columns'>
					<label for='username'>Username:</label>
					<input id='username' type="text" name="usernameR" value="{if !empty($input)}{$input.usernameR}{/if}">
					<small><b class='error'>{if !empty($messages.usernameR)}{$messages.usernameR}{/if}</b></small>
				</div>
				<div class='small-3 columns end'>
					<label for='password'>Password:</label>
					<input id='password' type="password" name="passwordR" value="{if !empty($input)}{$input.passwordR}{/if}">
					<small><b class='error'>{if !empty($messages.passwordR)}{$messages.passwordR}{/if}</b></small>
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
					<input type="submit" value="Register">
				</div>
			</div>
		</div>
	</div>

</form>

{include 'footer.tpl.php'}