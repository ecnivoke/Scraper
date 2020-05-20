{include 'header.tpl.php' title={$title}}

<form method="POST" action="?p=add_item" enctype="multipart/form-data">
	<div class='row'>
		<div class='small-10 columns small-centered'>
			<h1>{$title}</h1>
			<div class="row">
				<div class='small-3 columns'>
					<label for='item_name'>Item name:</label>
					<input id='item_name' type="text" name="item_nameR" value="{if !empty($input.item_nameR)}{$input.item_nameR}{/if}">
					<small><b class='error'>{if !empty($messages.item_nameR)}{$messages.item_nameR}{/if}</b></small>
				</div>
				<div class='small-9 columns end'>
					<label for='url'>Full URL:</label>
					<input id='url' type="text" name="urlR" value="{if !empty($input.urlR)}{$input.urlR}{/if}">
					<small><b class='error'>{if !empty($messages.urlR)}{$messages.urlR}{/if}</b></small>
				</div>

			</div>
			{if !empty($errors)}
				<div class="row">
					<div class='small-12 columns'>
						<b class='error'>{$errors}</b>
					</div>
				</div>
			{/if}
			<div class="row">
				<div class='small-3 columns'>
					<input type="submit" value="Add">
				</div>
			</div>
		</div>
	</div>
</form>

{include 'footer.tpl.php'}