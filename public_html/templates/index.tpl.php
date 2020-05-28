{include 'header.tpl.php' title={$title}}

<div class="row">
	<div class='ds-cap welcome'>
		{if isset($smarty.session.user_id)}
			<h1>Welcome {$smarty.session.username}</h1>
		{else}
			<b class='error'>Please log in or register</b>
		{/if}
	</div>
</div>

{include 'footer.tpl.php'}