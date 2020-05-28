<div class='main-nav'>
	<div class='nav'>
		{if isset($smarty.session.user_id)}
			<a class='nav' href="?p=item_list">List</a>
			<a class='nav' href="?p=add_item">Add item</a>
			<a class='nav' href="?p=logout">Logout</a>

			{if $smarty.session.user_group === 'super_admin' || 
				$smarty.session.user_group === 'admin'}

					<a class='nav' href="?p=register">Register new user</a>
					<a class='nav' href="?p=manager">Manage users</a>

				{/if}
		{else}
			<div class=''>
				<a href="?p=login">Login</a>
			</div>
			<div class=''>
				<a href="?p=register">Register</a>
			</div>
			<div class=''>
				<a href="?p="></a>
			</div>
			<div class=''>
				<a href="?p="></a>
			</div>
		{/if}
			</ul>
	</div>
</div>