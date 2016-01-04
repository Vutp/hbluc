var socket = io.connect( 'http://localhost:8080' );
var id_user = $( "#id_user" ).val();
var nameVal = $( "#name_user" ).val();
var chat_vs = $( "#chat_vs" ).val();
var base_url = $( "#base_url" ).val();

var list_sent1 = $( "#list_sent_tp" ).val();
var list_sent2 = $( "#list_sent_dd" ).val();
var list_sent3 = $( "#list_sent_tv" ).val();
var num_count1 = $( "#num_count1" ).val();
var num_count2 = $( "#num_count2" ).val();
var num_count3 = $( "#num_count3" ).val();
socket.emit( 'new_user',  {name_user: nameVal, id_user: id_user,chat_vs:chat_vs} );

function chatViewed(){
	//alert("Hello");
}

$( "#messageForm" ).submit( function(e) {
	e.preventDefault();
//	alert('h');
	var msg = $( "#messageInput" ).val();
	var avatar = $( "#avatar" ).val();
	var nameVal = $( "#name_user" ).val();
	var chat_vs = $( "#chat_vs" ).val();
	var vs = $( "#vs" ).val();
	var id_user = $( "#id_user" ).val();
    if ($.trim(msg)!=''){
	socket.emit( 'sent_message', { n: nameVal, mess: msg , chat_vs: chat_vs,avatar:avatar,base_url:base_url} );
	$.ajax({

		url:  ""+base_url+"admin/Chat/push",
		type: "POST",

		data: {'name': nameVal , 'message': msg, 'chat_vs': chat_vs},
		success: function(data) {
           	var actualContent = $( "#messages_new" ).html();
			var newMsgContent ='<div class="col-xs-12 col-md-12 col-lg-12 pad"><div class="bubble you ">'+ msg +'</div></div>';
			var content =  actualContent+newMsgContent ;
			$( "#messages_new" ).html( content );  
			document.getElementById("messageForm").reset();
			$(".panel-body").scrollTop($(".panel-body")[0].scrollHeight);
		}

	});
}
	
	return false;
});
function addDays(date, days) {
    var result = new Date(date);
   // result.format("dd/MM/yyyy");
    result.setDate(result.getDate() + days);
    return (result.getFullYear() + '-' + (result.getMonth() + 1) + '-' + result.getDate() );
}
$( "input#load_more" ).on( 'click',function() {

	var week_back = $( "#week_back" ).val();
	var vs = $( "#vs" ).val();
	$.post(""+base_url+"admin/Chat/load_more",{name: nameVal,week_back:week_back,chat_vs:chat_vs,vs:vs},
	 function(data) {
	// var dat = new Date();
	 var week_move=	addDays(week_back, -7);
	// var week_move= date("Y-m-d", strtotime(' -7 day')) parseInt(week_back)-1;

	
	var actualContent = $( "#messages_load_more" ).html();
	var newMsgContent =data;
	var content = newMsgContent + actualContent;
	$('div#messages_load_more').html(content);
	//$( "#messages_new" ).html( content );
	document.getElementById('week_back').value=week_move;
	});

});
$('.sent_noti_tp').on('click',function(){

	//var list_sent1 = $( "#list_sent_tp" ).val();
	socket.emit( 'sent_notify', {num:num_count1,list_sent: list_sent1} );
});
$('.sent_noti_dd').on('click',function(){

//	var list_sent2 = $( "#list_sent_dd" ).val();
	
	socket.emit( 'sent_notify', {num:num_count2,list_sent: list_sent2} );
});
$('.sent_noti_tv').on('click',function(){
//	var list_sent2 = $( "#list_sent_dd" ).val();
	
	socket.emit( 'sent_notify', {num:num_count3,list_sent: list_sent3} );
});
/*
$(document).ready(function(){
	//var nameVal = $( "#nameInput" ).val();
	//var msg = $( "#messageInput" ).val();
	$("#btnfuck").click(function(){
	//var nameVal = $( "#nameInput" ).val();
	var msg = $( "#messageInput" ).val();
	var nameVal = $( "#name_user" ).val();
	var nameRoom = $( "#name_user" ).val();
	socket.emit( 'sent_message', { name: nameVal, message: msg } );
	
	$.ajax({

		url:  "http://localhost/Demo/chat/push",
		type: "POST",

		data: {'name': nameVal , 'message': msg },
		success: function(data) {
           	var actualContent = $( "#messages_new" ).html();
			var newMsgContent = ' <p class="text-right">' + msg + '</p> ';
			var content =  actualContent+newMsgContent ;
			$( "#messages_new" ).html( content );   

   			var div = document.getElementById("chat_wrap_cont");
   			div.scrollTop = div.scrollHeight - div.clientHeight;
	}

	});
	});


});*/
socket.on( 'new_message', function( data ) {
	var actualContent = $( "#messages_new" ).html();
	var newMsgContent =data.text;
	var content =  actualContent+newMsgContent ;
	
	$( "#messages_new" ).html( content );
});
socket.on( 'new_notify', function( data ) {

        $.amaran({
            'theme'     :'colorful',
            'clearAll':true,
            'content'   :{
                bgcolor:'#27ae60',
                color:'#fff',
                message:'Bạn có '+data.num+' hồ sơ đang chờ nhận xử lý',
            },
            'position'  :'top right',
            'inEffect' :'slideRight',
            'outEffect' :'slideRight',
            'delay' : 3600000
        });
});
