
function addLoader(id){
//console.log("inside loader");
	$(id).waitMe({
	effect : 'ios', 
	text : 'Loading', 
	bg : 'rgba(255,255,255,0.7)', 
	color : ' #3498db', 
	sizeW : '100px', 
	sizeH : '100px', 
	source : ''
	});
}

function removeLoader(id){
	$(id).waitMe("hide");
}
