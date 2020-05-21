<div class='row'>
	<div class='small-10 columns small-centered'>
		{if isset($smarty.session.user_id)}
			<div class='small-3 columns'>
				<a href="?p=item_list">List</a>
			</div>
			<div class='small-3 columns'>
				<a href="?p=add_item">Add item</a>
			</div>
			<div class='small-3 columns'>
				<a href="?p=register">Register new user</a>
			</div>
			<div class='small-3 columns'>
				<a href="?p=logout">Logout</a>
			</div>
			{if $smarty.session.user_group === 'super_admin' || 'admin'}
				<div class='small-3 columns'>
					<a href="?p=manager">Manage users</a>
				</div>
			{/if}
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
</div>