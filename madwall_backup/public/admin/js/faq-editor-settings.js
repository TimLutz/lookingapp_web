// text editor settings
$("#answer").Editor({

'l_align':true,

'r_align':true,

'c_align':true,
'justify':true,
'indent':true,

'outdent':false,
'block_quote':false,
'undo':true,

'redo':true,

'insert_link':true,

'unlink':false,

'insert_img':false,
'insert_table':true,
'strikeout':false,
'splchars':true,
'hr_line':true,
'print':false,

'rm_format':false,
'select_all':false,
'source':false,
'togglescreen':true
});

// set text in text editor
	var editor_data = $( "#answer" ).val();
	$( "#answer" ).Editor( "setText",editor_data );
	
	$("#addfaq").click(function() {
		$('#answer').val($('#answer').Editor("getText") );
	});