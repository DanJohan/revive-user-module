<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<button id="add-item">Add item</button>
<div id="list-item">
	<li class="item">1</li>
	<li class="item">2</li>
</div>

<script src="<?php echo base_url();?>public/revive-car/assets/js/jquery-3.3.1.min.js"></script> 
<script type="text/javascript">

	$(document).on('click','#add-item',function(){
		$('#list-item').append('<li class="item">3</li>');
	})


	$('.item').click(function(){
		alert("hello");
	});

</script>
</body>
</html>