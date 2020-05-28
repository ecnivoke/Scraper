{include 'header.tpl.php' title={$title}}

<div class='row'>
	<div class='small-10 columns small-centered'>
		<h1>{$title}</h1>
		{if !empty($results)}
			<!-- 3 items 1 row -->
			<div class="row">
				{foreach $results as $item}
					<div class='small-4 columns end'>
						{if !empty($item.former_price)}
							<small class='sale'><b>SALE!</b></small>
						{/if}
						<h4><a href="{$item.url}" target="_blank">{$item.name}</a></h4>
						{if !empty($item.image)}
							<img src="{$item.image}" alt="Product Image" />
						{else}
							<img src="{$smarty.const.IMAGE_DIR}image_not_found.jpg" alt="Image not Found" />
						{/if}
						<div class="row">
							<div class='small-3 columns'>
								Price:
							</div>
							<div class='small-9 columns text-right'>
								{if !empty($item.former_price)}
									&euro; <s>{$item.former_price}</s> {$item.price}
								{else}
									{$item.price}
								{/if}
							</div>
						</div>
					</div>
				{/foreach}
			</div>
		{else}
			<h4>Geen items gevonden</h4>
			<a href="?p=add_item">Voeg hier een item toe</a> 
		{/if}
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