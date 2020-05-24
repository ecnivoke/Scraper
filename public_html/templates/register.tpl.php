{include 'header.tpl.php' title={$title}}

<form method="POST" action="?p=register" enctype="multipart/form-data">
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
				<div class='small-3 columns'>
					<label for='password'>Password:</label>
					<input id='password' type="password" name="passwordR" value="{if !empty($input.passwordR)}{$input.passwordR}{/if}">
					<small><b class='error'>{if !empty($messages.passwordR)}{$messages.passwordR}{/if}</b></small>
				</div>
				<div class='small-3 columns end'>
					<label for='email'>Email:</label>
					<input id='email' type="text" name="emailR" value="{if !empty($input.emailR)}{$input.emailR}{/if}">
					<small><b class='error'>{if !empty($messages.emailR)}{$messages.emailR}{/if}</b></small>
				</div>

				{if !empty($smarty.session.user_id)}
					{if $smarty.session.user_group === 'super_admin'}
						<div class='small-3 columns end'>
							<label for='user_group'>User group:</label>

							<select id='user_group' name="user_group">
								<option value="3">User</option>
								<option value="2">Admin</option>
								<option value="1">Super admin</option>
							</select>

						</div>
					{/if}
				{/if}

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