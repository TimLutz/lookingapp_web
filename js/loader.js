function addLoader(){
	$('#waitMeLoader').waitMe({
	effect : 'bounce', 
	text : 'Loading', 
	bg : 'rgba(255,255,255,0.7)', 
	color : '#008d4c', 
	sizeW : '20px', 
	sizeH : '20px', 
	source : ''
	});
}

function removeLoader(){
	$('#waitMeLoader').waitMe("hide");
}

function addLoaders(id){
//console.log("inside loader");
	$(id).waitMe({
	effect : 'bounce', 
	text : 'Loading', 
	bg : 'rgba(255,255,255,0.7)', 
	color : '#008d4c', 
	sizeW : '20px', 
	sizeH : '20px', 
	source : ''
	});
}

function removeLoaders(id){
	$(id).waitMe("hide");
}
