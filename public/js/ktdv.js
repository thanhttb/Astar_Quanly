function editInline(){
	$.fn.editable.defaults.params = function (params){
                params._token = $("#_token").data("token");
                return params;
            };    
    $('.appointment').editable({
        type: 'datetime',
        title: 'Select date',
        placement: 'right',
        format: 'yyyy-mm-dd hh:ii',    
        viewformat: 'dd-mm-yyyy hh:ii',
        datetimepicker: {
                weekStart: 1
           }
                     

    });
    $('.testInform').editable({                
        value: 2,    
        source: [
          {value: 0, text: 'Chưa thông báo'},
          {value: 1, text: 'Đã thông báo'},
          
        ]             

    });
    $('.showUp').editable({                
        value: 2,    
        source: [
          {value: 0, text: 'Chưa đến thi'},
          {value: 1, text: 'Đã đến thi'},
          
        ]             

    });
}
