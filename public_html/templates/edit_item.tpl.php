{include 'header.tpl.php' title={$title}}

<form method="POST" action="?p=edit_item&id={$item.id}">
	<input type="hidden" name="csrf_token"  value="{$smarty.session.csrf_token}">
	<input type="hidden" name="id" 			value="{$item.id}">
	<div class="row">
		<div class='small-10 columns small-centered'>
			<div class="row">
				<div class='small-5 columns'>
					<label for='item_name'>Item name:</label>
					<input id='item_name' type="text" name="item_nameR" value="{if !empty($input.item_nameR)}{$input.item_nameR}{else}{$item.item_name}{/if}">
					<small><b class='error'>{if !empty($messages.item_nameR)}{$messages.item_nameR}{/if}</b></small>
				</div>
			</div>
			<div class="row">
				<div class='small-8 columns'>
					<label for='item_url'>Item url:</label>
					<input id='item_url' type="text" name="item_urlR" value="{if !empty($input.item_urlR)}{$input.item_urlR}{else}{$item.item_url}{/if}">
					<small><b class='error'>{if !empty($messages.item_urlR)}{$messages.item_urlR}{/if}</b></small>
				</div>
			</div>
			<div class='row'>
				<div class='small-8 columns'>
					<input type="submit" value="Opslaan">
				</div>
			</div>
			<div class='row'>
				<div class='small-3 columns'>
					<label for='delete'>Verwijder item:</label>
					<input id='delete' type="checkbox" name='delete' value="d">
				</div>
			</div>
		</div>
	</div>
</form>

{include 'footer.tpl.php'}