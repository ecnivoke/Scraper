<div class='row text-center'>
	{if isset($smarty.session.user_id)}
		<div class='small-3 columns'>
			<a href="?p=item_list">List</a>
		</div>
		<div class='small-3 columns'>
			<a href="?p="></a>
		</div>
		<div class='small-3 columns'>
			<a href="?p="></a>
		</div>
		<div class='small-3 columns'>
			<a href="?p="></a>
		</div>
	{else}
		<div class='small-3 columns'>
			<a href="?p=login">Login</a>
		</div>
		<div class='small-3 columns'>
			<a href="?p=register">Register</a>
		</div>
		<div class='small-3 columns'>
			<a href="?p="></a>
		</div>
		<div class='small-3 columns'>
			<a href="?p="></a>
		</div>
	{/if}
</div>