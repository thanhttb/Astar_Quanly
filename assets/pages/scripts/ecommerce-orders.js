$.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {
        var dateMin = Date.parse($('#fini').val());
        console.log(dateMin);
        var dateMax = Date.parse($('#ffin').val());
        var date = Date.parse(data[4]) || 0; 
        if (( isNaN( dateMin ) && isNaN( dateMax ) ) ||
             ( isNaN( dateMin ) && date <= dateMax ) ||
             ( dateMin <= date   && isNaN( dateMax ) ) ||
             ( dateMin <= date   && date <= dateMax ) )
        {
            return true;
        }
        return false;
        }
    );
var Transaction = function () {
    var initSelect2 = function () {
        $('.acc').select2({              
          ajax: {
            url: '/astar/searchAccount',
            type: "GET",    
            dataType: 'json',
            delay : 250,
            data: function (params) {

                    var queryParameters = {
                        term: params.term
                    }
                    return queryParameters;
            },
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.name +" "+ item.dob + " "+ item.phone,
                            id: item.id
                        }
                    })
                };
            }                  
         }
        });
        $('.accwithoutdob').select2({
            ajax: {
            url: '/astar/searchAccount',
            type: "GET",    
            dataType: 'json',
            delay : 250,
            data: function (params) {

                    var queryParameters = {
                        term: params.term
                    }
                    return queryParameters;
            },
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.name,
                            id: item.id
                        }
                    })
                };
            }                  
         }
        });
    }
    var initPickers = function () {
        //init date pickers
        $('.date-picker').datepicker({
            rtl: App.isRTL(),
            format: 'yyyy/mm/dd',
            autoclose: true
        });
    }

    var handleTransaction = function () {       

        $('#accSelect').on('select2:select',function(e){
            
            var table = $('#transaction').DataTable({
                "responsive": true,
                "ajax": {
                    "url": 'getTransaction/' + $('#accSelect').val(),
                    "method": 'GET'
                },
                "lengthMenu": [
                    [10, 20, 50, 100, 150, -1],
                    [10, 20, 50, 100, 150, "All"] // change per page values here
                ],
                "pageLength": 10, // default record count per page
                
                "ordering": false,
                "footerCallback": function ( row, data, start, end, display ) {
                    var api = this.api(), data;
         
                    // Remove the formatting to get integer data for summation
                    var intVal = function ( i ) {
                        return typeof i === 'string' ?
                            i.replace(/[\$,đ.]/g , '')*1 :
                            typeof i === 'number' ?
                                i : 0;
                    };
         
                    // Total over all pages
                    total = api
                        .column( 5 )
                        .data()
                        .reduce( function (a, b) {
                            if(api.column( 2 ).data() === 'Trần Thu Giang') return intVal(a) + intVal(b);
                            else return intVal(a) - intVal(b);
                        }, 0 );
         
                    // Total over this page
                    pageTotal = api
                        .column( 5, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
         
                    // Update footer
                    $( api.column( 5 ).footer() ).html(
                        'Sum: '+pageTotal +'vnd' +' ('+ total +'vnd total)'
                    );
                }
            });  
            // Check/uncheck all checkboxes in the table
            $('#select-all').on('click', function(){            
                var rows = table.rows({ 'search': 'applied' }).nodes();
                $('input[type="checkbox"]', rows).prop('checked', this.checked);
            }); 
            //FILTER DATE         
            $('#fini, #ffin').keyup( function() {
                table.draw();
            });
            
            
            $('#accFrom').on( 'select2:select', function (e) {
                console.log($('#accFrom option:selected').text());
                table
                    .columns( 2 )
                    .search( $('#accFrom option:selected').text())
                    .draw();
            } );
            $('#accTo').on( 'select2:select', function (e) {
                console.log($('#accTo option:selected').text());
                table
                    .columns( 3 )
                    .search( $('#accTo option:selected').text())
                    .draw();
            } );
            $('#status').change(function(){
                console.log($('#status option:selected').text());
                table
                    .columns( 7 )
                    .search( $('#status option:selected').val())
                    .draw();
            });
            $('#id').change(function(){
                console.log($('#id option:selected').text());
                table
                    .columns( 1 )
                    .search( $('#id').val())
                    .draw();
            });

        });        

    }
    return {

        //main function to initiate the module
        init: function () {  
            initSelect2();          
            initPickers();
            handleTransaction();
        }

    };

}();

var filterAccount = function(){
    var accFrom = function(){

    }

}
jQuery(document).ready(function() {  
    
    Transaction.init();
       
   $('#accSelect').on('select2:selecting', function(e){
        $('#transaction').DataTable().destroy();             
   })
});