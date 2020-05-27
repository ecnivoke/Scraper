{include 'header.tpl.php'}

<div class="row">
	<div class='small-10 columns small-centered'>
		{foreach $users as $user}
			<div class='row'>
				<div class='small-3 columns'>
					{$user.id}: "{$user.user_group}" /
				</div>
				<div class='small-3 columns'>
					{$user.username}
				</div>
				<div class='small-6 columns'>
					{$user.email}
				</div>
			</div>
			<div class='row'>
				<div class='small-3 columns'>
					<a href="?p=manager&u={$user.id}&a=user_group">role</a>
				</div>
				<div class='small-3 columns'>
					<a href="?p=manager&u={$user.id}&a=username">username</a>
				</div>
				<div class='small-3 columns'>
					<a href="?p=manager&u={$user.id}&a=email">email</a>
				</div>
				<div class='small-3 columns'>
					{if $user.id !== $smarty.session.user_id}
						<a href="?p=manager&u={$user.id}&a=login">login</a>
					{else}
						this you
					{/if}
				</div>
			</div>
			<br />
		{/foreach}
	</div>
</div>

{include 'footer.tpl.php'}