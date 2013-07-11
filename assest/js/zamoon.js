$(function(){
	$('input.required, textarea.required, select.required').prev('label').append('<em class="required">*</em>');
});


Zamoon.utility = {
	buildSelectOption : function (obj,map){
		if(typeof(obj) !== 'object')
			return '';
		if(obj.length == 0)
			return '';
		
		var html = '';
		
		$.each(obj,function(i,item){
			var value = map.call(window,item,'value'),
				name = map.call(window,item,'name');
			html+= '<option value="'+value+'">'+name+'</option>';
		});
		return html;
	}	
};

Zamoon.Table = function(selector){
	if(selector == '' || typeof selector != 'string')
		return;
	
	var _table = $(selector);
	if(!_table.is('table'))
		return false;
	
	return new ZamoonTable(_table);
};

ZamoonTable = function(table){
	this.table = table;
};

ZamoonTable.prototype.appendRow = function(data){
	var numCol = this.table.find('tr').eq(1).children('td').length;
	var newRow = $('<tr></tr>');
	for(var i = 0; i < numCol; i++){
		var cell = $('<td></td>').appendTo(newRow);
		cell.html(data[i]);
	}
	newRow.appendTo(this.table);
//	return;
};