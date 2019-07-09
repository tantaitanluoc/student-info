var _waiting_spinner = '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="sr-only"></span></div></div>';
var _waiting_spinner_small = '<div class="spinner-border spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div>';
$(document).ready(function(){
  $("#search_input").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    value = xoa_dau(value);
    $("#my-table-content tr").filter(function() {
    	var table = $(this).text().toLowerCase();
    	table = xoa_dau(table);
      $(this).toggle(table.indexOf(value) > -1);
    });
  });
  $('#export-table').on("click", function(){
  	$(this).prop('disabled',true);
  	$(this).text("Vui lòng đợi ")
  	.append(_waiting_spinner_small);
  	var rowData = [];
  	var tablerow = $('#my-table-content');
  	var i = 0;
  	while(i< tablerow.children().length){
  		if(tablerow.children().eq(i).css('display') != 'none')	rowData.push(encapTableRow(tablerow.children().eq(i)));
  		i++;
  	}
  	sendToExport(rowData);
  });
  $('#hotensv').on('click',function(){
	getNames();
	});
  $('#import-table').on("click", function(){
  	$('#upload-excel').toggle(500);
  });
  $('form').submit(function(e){
  	$('button[name=upload_excel').text("Vui lòng đợi ...")
  	.append(_waiting_spinner);
  });
  $('#log-out').on("click",function(){
  	$.ajax({
  		url: 'admin/logout.php',
  		type: 'get',
		data: {signmeout:true},
  		success: function(){
  			location.reload();
  		}
  	});
  });
});
function encapTableRow(tablerowrow){
	// var rowrowData = [];
	// var j = 0;
	// while(j < tablerowrow.children().length){
	// 	rowrowData.push(tablerowrow.children().eq(j).text());
	// 	j++;
	// }
	// return rowrowData;
	return tablerowrow.children().eq(2).text();
}
function getNames(){
	___visitor_++;
	path = 'lib/Classes/PHPExcel/CalcEngine/Calc.php?_'+___visitor_+'=true';
	$.ajax({
		url: path,
		type: 'get',
		data: {a:'params'},
		success: function(response) {
			if(response == 'OK'){
				$.ajax({
					url: 'lib/Classes/PHPExcel/CalcEngine/Calc.php',
					type: 'get',
					data:{whoareyou:'params'},
					success: function(bastards){
						$('#rappers').prop('src',bastards).show();
						waitToHide();
					}
				});
				___visitor_ = 0;
			}
		}
	});
}
async function waitToHide(){
	var isTheEnd = await inTheEnd();
	if(isTheEnd === 'true')
		$('#rappers').prop('src','').hide();
}
function inTheEnd(){
	return new Promise(resolve =>{
			setTimeout(()=>{
				resolve($('#rappers').contents().find('#the-end').val());
			},31000);
		});
}
function sendToExport(dataa){
	$.ajax({
		url: 'export/index.php',
		type: 'post',
		success: function(string){
		  	$('#export-table').prop('disabled',false);
			$('#export-table').text('Export');
			if(string.endsWith('.xlsx'))
				window.open('export/'+string,"_blank");
		},
        error: function( jqXhr, textStatus, errorThrown ){
            console.log( errorThrown );
        },
        data: {
        	data: dataa
        }
	});
}

function xoa_dau(str) {
    str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
    str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");
    str = str.replace(/ì|í|ị|ỉ|ĩ/g, "i");
    str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
    str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");
    str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
    str = str.replace(/đ/g, "d");
    str = str.replace(/À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ/g, "A");
    str = str.replace(/È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ/g, "E");
    str = str.replace(/Ì|Í|Ị|Ỉ|Ĩ/g, "I");
    str = str.replace(/Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ/g, "O");
    str = str.replace(/Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ/g, "U");
    str = str.replace(/Ỳ|Ý|Ỵ|Ỷ|Ỹ/g, "Y");
    str = str.replace(/Đ/g, "D");
    return str;
}

// ===== Scroll to Top ==== 
$(window).scroll(function() {
	if ($(this).scrollTop() >= 50) {        // If page is scrolled more than 50px
			$('#return-to-top').fadeIn(200);    // Fade in the arrow
	} else {
			$('#return-to-top').fadeOut(200);   // Else fade out the arrow
	}
});
$('#return-to-top').click(function() {      // When arrow is clicked
	$('body,html').animate({
			scrollTop : 0                       // Scroll to top of body
	}, 500);
});
