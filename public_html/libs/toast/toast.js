var toasts = [];
var toastid = 0;
function toast( message, options ) {
	
	if( !options ) {
		options = {
			color : "default"
		};
	}
	
	toastid++;
	toasts.push(toastid);
	setTimeout(function() {
		var id = toasts.shift();
		$("#"+id).animate({
			opacity: "0"
		}, 400, function() {
			$(this).remove();
		});
	}, 3000);
	
	var icon = "";
	switch( options.color ) {
		case 'success': 
			icon = '<i class="fa fa-check fa-3x" aria-hidden="true"></i>';
			break;
		
		case 'danger':
			icon = '<i class="fa fa-exclamation-triangle fa-3x" aria-hidden="true"></i>';
			break;
			
		case 'warning':
			icon = '<i class="fa fa-exclamation-triangle fa-3x" aria-hidden="true"></i>';
			break;
			
		case 'info':
			icon = '<i class="fa fa-info fa-3x" aria-hidden="true"></i>';
			break;
	}
	
	
	if ( options.color ) {
		clas = options.color;
	}
	
	var t = '<div id="'+toastid+'" class="toast '+clas+'">'+icon+'<span class="text">'+message+'</span></div>';
	$("#toast").append(t);
	
}