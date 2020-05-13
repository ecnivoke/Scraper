{include 'header.tpl.php' title={$title}}

{if !empty($messages[1])}
	{foreach $messages[1] as $msg}
		<div class='row'>
			<div class='small-10 columns small-centered'>
				<b class='error'>{$msg}</b>
			</div>
		</div>	
	{/foreach}
{/if}

<form method="POST" action="?p=register">

	<div class='row'>
		<div class='small-10 columns small-centered'>
			<div class="row">
				<div class='small-3 columns'>
					<label for='username'>Username:</label>
					<input id='username' type="text" name="username">
				</div>
				<div class='small-3 columns end'>
					<label for='password'>password:</label>
					<input id='password' type="password" name="password">
				</div>
			</div>
			<div class="row">
				<div class='small-3 columns'>
					<input type="submit" value="Register">
				</div>
			</div>
		</div>
	</div>

</form>

{include 'footer.tpl.php'}