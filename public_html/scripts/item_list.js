
function showItemContent(item, index){
	
	// Create all html
	$('div[data-container="items"]').append([
		$('<div />', {'class': 'small-4 columns end'}).append([
			item.former_price ? $('<small />', {'class': 'sale'}).append(document.createTextNode('SALE!')) : '',
			$('<h4 />').append([
				$('<a />', {'href': '?p=edit_item&id='+item.item_id}).append(document.createTextNode('✏')),
				$('<a />', {'href': item.item_url, 'target': '_blank'}).append(document.createTextNode(item.item_name))
			]),
			$('<img />', {'src': item.image ? item.image : '../images/image_not_found.jpg', 'alt': 'Product Image'}),
			$('<div />', {'class': 'row'}).append([
				$('<div />', {'class': 'small-3 columns'}).append(document.createTextNode('Price:')),
				$('<div />', {'class': 'small-9 columns text-right'}).append([
					document.createTextNode('€'),
					item.former_price ? $('<s />').append(document.createTextNode(item.former_price)) : '',
					document.createTextNode(item.price)
				]),
			]),
		])
	]);
}

function getItems(){
	debug.push('function - getItems');

	// Get page
	let page = location.href;
	page = page.split('&c=')[1];

	// Make ajax call
	$.ajax({
		type: 'GET',
		url:  'ajax.php?',
		data: {
			'action': 'getItems',
			'page':   page
		},
		beforeSend: function(){
			// Show loading
			$('.loading').append('loading...');
		},
		complete: function(){
			// Hide loading
			$('.loading').empty();
		},
		success: function(result){
			result = JSON.parse(result);

			// app.js function
			result.forEach(showItemContent);

		},
		error: function(xhr){
			console.log('error: '+ xhr.responseText);
		}
	});
}

$(document).ready( function(){
	// Call functions
	debug.push('Ready - item_list.js');
	getItems();
});
