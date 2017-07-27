$( document ).ready( function(){
	//var old_image =$( '.preview' ).attr('src');
	/**
	 * File Preview on Image Change
	 */
	function readURL( input ) {
		if ( input.files && input.files[0] ) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$( '.preview' ).attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	$( "#pic" ).change(function(){
		readURL(this);
		$('#clear-preview').show();
	});

	$( "#clear-preview" ).click(function(e){
		
		location.reload();
		//$('.preview').attr('src', '');
		//$('.preview').attr('alt', '');
	});
});