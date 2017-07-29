// text editor settings
$("#txtEditor").Editor({

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
'source':true,
'togglescreen':true

});

// set text in text editor
var editor_data = $("#txtEditor").val();
$("#txtEditor").Editor("setText",editor_data);
 // get text from text editor
  $("#add_template").submit(function()
  {  
	$('#txtEditor').val($('#txtEditor').Editor("getText"));
  });
