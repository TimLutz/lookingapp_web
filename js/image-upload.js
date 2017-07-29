$(document).ready(function() { /*Image Changes 03-08-2016*/
	$('body').on('change', ".image-upload", function(){
	var fileCount = parseInt($('#img-upload-count').val());
		var divId = $(this).attr('data-append');
		$(this).hide();
		$( '<input type="file" class="image-upload" data-append="thumbnail_apend" name="imagepro[]" count="'+(fileCount+1)+'"/>' ).insertAfter( this );
        readURL(this, divId);
    });
	$('body').on('click', ".image-remove", function(){
		var e = $(this).attr('img-count');
		$("input.image-upload[count="+e+"], .img"+e+" ").remove();
    });
});
function readURL(input, obj) {
	var i = 0;
	var fileCount = $('#img-upload-count').val();
	 if (input.files && input.files[0]) {
		var reader = new FileReader();			
		reader.onload = function (e) {
			$('#'+obj).append('<div class="col-sm-6 col-md-3 img'+fileCount+'"><a class="glyphicon glyphicon-remove image-remove" img-count='+fileCount+'></a><a class="thumbnail" href="javascript:;"><img style="height: 100px; width: 100%; display: block;" alt="100%x180" src="'+e.target.result+'"></a></div>');				
		}			
		reader.readAsDataURL(input.files[0]);
	}
	i++;
	$('#'+obj).css({'padding':'5px'});
	$('#img-upload-count').val(parseInt(fileCount)+1);
}
