{include 'header.tpl.php'}

<div class="row">
	<div class='small-10 columns small-centered'>
		{foreach $error as $msg}
			<b>{$msg}</b> <br>
		{/foreach}
	</div>
</div>

{include 'footer.tpl.php'}