{if !empty($popups)}
	<div class='row'>
		<div class='small-10 columns text-center'>
			{foreach $popups as $popup}
				<span class='success'>{$popup}</span>
			{/foreach}
		</div>
	</div>
{/if}