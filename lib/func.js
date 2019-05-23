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
  	var rowData = [];
  	var tablerow = $('#my-table-content');
  	var i = 0;
  	while(i< tablerow.children().length){
  		if(tablerow.children().eq(i).css('display') != 'none')	rowData.push(encapTableRow(tablerow.children().eq(i)));
  		i++;
  	}
  	sendToExport(rowData);
  });
  $('#import-table').on("click", function(){
  	$('#upload-excel').toggle(500);
  	$('#wrapperr').toggleClass('blurr');
  });
});

function encapTableRow(tablerowrow){
	var rowrowData = [];
	var j = 0;
	while(j < tablerowrow.children().length){
		rowrowData.push(tablerowrow.children().eq(j).text());
		j++;
	}
	return rowrowData;
}

function sendToExport(dataa){
	$.ajax({
		url: 'export',
		type: 'get',
		dataType: 'json',
		// contentType: "application/json; charset=utf-8",
        traditional: true,
		success: function(){
			console.log('da gui');
		},
        error: function( jqXhr, textStatus, errorThrown ){
            console.log( errorThrown );
        },
        data: {
        	data: JSON.stringify(dataa)
        }
		// data: JSON.stringify(dataa)
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