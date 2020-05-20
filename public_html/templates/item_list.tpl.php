{include 'header.tpl.php' title={$title}}

<div class='row'>
	<div class='small-10 columns small-centered'>
		<h1>{$title}</h1>
		<!-- 3 items 1 row -->
		<div class="row">
			{foreach $results as $item}
				<div class='small-4 columns end'>
					{if !empty($item.former_price)}
						<small class='sale'><b>SALE!</b></small>
					{/if}
					<h4>{$item.name}</h4>
					{if !empty($item.image)}
						<img src="{$item.image}" />
					{else}
						<img src="{$smarty.const.IMAGE_DIR}image_not_found.jpg" />
					{/if}
					<div class="row">
						<div class='small-7 columns'>
							Price:
						</div>
						<div class='small-5 columns text-center'>
							&euro; {$item.price}
						</div>
					</div>

					{if !empty($item.former_price)}
						<div class="row">
							<div class='small-7 columns'>
								New price:
							</div>
							<div class='small-5 columns text-center'>
								&euro; {$item.former_price}
							</div>
						</div>
					{/if}

				</div>
			{/foreach}
		</div>
	</div>
</div>

{include 'footer.tpl.php'}