{include 'header.tpl.php' title={$title}}

<div class='main-items'>
	<h1>{$title}</h1>

	{if !empty($results)}
		<!-- 3 items 1 row -->
		<div class="items-container">
			{foreach $results as $item}
				<div class='ds-inlineB ds-center items'>
					{if !empty($item.former_price)}
						<small class='sale'><h3>SALE!</h3></small>
					{/if}
					<h4 class='item-name'><a class='item-link ds-cap' href="{$item.url}" target="_blank">{$item.name}</a></h4>
					{if !empty($item.image)}
						<img src="{$item.image}" alt="Product Image" />
					{else}
						<img src="{$smarty.const.IMAGE_DIR}image_not_found.jpg" alt="Image not Found" />
					{/if}
					<div class='price'>
						Price:
					</div>
					<div class='price'>
						{if !empty($item.former_price)}
							&euro; <s class='ds-colorW'>{$item.former_price}</s> ➱ {$item.price}
						{else}
							{$item.price}
						{/if}
					</div>
				</div>
			{/foreach}
		</div>
		{else}
			<h4>Geen items gevonden</h4>
			<a href="?p=add_item">Voeg hier een item toe</a> 
	{/if}
</div>

<div class="page ds-colorW">
	<div class='ds-center'>
		{for $i = 1 to $count}
			{if $i != $page}
				<a class='ds-colorW pages' href="?p=item_list&c={$i}">{$i}</a>
			{else}
				<span class='current-page'>{$i}</span>
			{/if}
		{/for}
	</div>
</div>

{include 'footer.tpl.php'}