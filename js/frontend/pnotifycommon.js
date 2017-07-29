// shows the pnotify success messages.......

function showSuccessMessage(message){
	PNotify.removeAll();
	var stack_topleft = {"dir1": "down", "dir2": "left", "push": "top"};
	new PNotify({
	   type: 'success',
	   title: 'Success',
	   text: message,
	   addclass: "stack_topleft",
	   stack: stack_topleft
	});
}

//function to show error messages
function showErrorMessage(message){
	PNotify.removeAll();
	var stack_topleft = {"dir1": "down", "dir2": "left", "push": "top"};
	new PNotify({
	   type: 'error',
	   title: 'Error',
	   text: message,
	   addclass: "stack_topleft",
	   stack: stack_topleft
	});
}
