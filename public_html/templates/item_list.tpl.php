{include 'header.tpl.php' title={$title}}

<div class='row'>
	<div class='small-10 columns small-centered'>
		<h1>{$title}</h1>
		<div class='loading'></div>
		<!-- 3 items 1 row -->
		<div class="row" data-container='items'></div>
	</div>
</div>
<div class="row">
	<div class='small-12 columns text-center'>
		{for $i = 1 to $count}
			{if $i != $page}
				<a href="?p=item_list&c={$i}">{$i}</a>
			{else}
				{$i}
			{/if}
		{/for}
	</div>
</div>

{include 'footer.tpl.php'}