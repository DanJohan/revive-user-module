$(document).ready(function(){  

    total = $('ul.row li').length + 1; 

	$('li img').on('click',function(){
		var src = $(this).attr('src');
		var img = '<img src="' + src + '" class="img-responsive"/>';
		
		//start of new code new code
		var index = $(this).parent('li').index();   
       // console.log(index);
		if(index == 0) {
            index= total-1;
        }
        if(index == total-2){
            index = -1;
        }
		var html = '';
		html += img;                
		html += '<div style="height:25px;clear:both;display:block;">';
		html += '<a class="controls g-next" href="javascript:void(0)" data-href="'+ (index+2) + '">next &raquo;</a>';
		html += '<a class="controls g-previous" href="javascript:void(0)" data-href="' + (index) + '">&laquo; prev</a>';
		html += '</div>';
		
		$('#galleryModal').modal();
		$('#galleryModal').on('shown.bs.modal', function(){
			$('#galleryModal .modal-body').html(html);
			//new code
			//$('a.controls').trigger('click');
		})
		$('#galleryModal').on('hidden.bs.modal', function(){
			$('#galleryModal .modal-body').html('');
		});
		
		
		
		
   });	
})
        
         
$(document).on('click', 'a.controls', function(){
	var index = $(this).data('href');
   // console.log('index : ',index);
	var src = $('ul.row li:nth-child('+ index +') img').attr('src');             
	
	$('.modal-body img').attr('src', src);
	
	var newPrevIndex = parseInt(index) - 1; 
   // console.log('prevIndex :',newPrevIndex);
	var newNextIndex = parseInt(newPrevIndex) + 2; 
	//console.log('newIndex : ',newNextIndex);
	if($(this).hasClass('g-previous')){               
		$(this).data('href', newPrevIndex); 
		$('a.g-next').data('href', newNextIndex);
	}else{
		$(this).data('href', newNextIndex); 
		$('a.g-previous').data('href', newPrevIndex);
	}
    //console.log('total : ',total);
	//hide next button
	if(total === newNextIndex){
		$('a.g-next').data('href',1);
	}else{
		$('a.g-next').show()
	}            
	//hide previous button
	if(newPrevIndex === 0){
        $('a.g-previous').data('href',total-1);
		//$('a.g-previous').hide();
	}else{
		$('a.g-previous').show()
	}
	
	
	return false;
});
