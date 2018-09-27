<link href="{{asset('assets/global/plugins/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}" rel="stylesheet" type="text/css" />
<?php
	// include(app_path().'/xcrud/xcrud.php');
	// include(app_path().'/xcrud/functions.php');
 //    echo Xcrud::load_css();
 //    echo Xcrud::load_js();
    function asVnd($value){
        return number_format($value,'0','','.');
    }
    $balance = 0;
?>
<table class="table table-condensed table-hover" id="transaction">
    <thead>
        <tr>         
            <th width="15%"> Ngày </th>
            <th>Miêu tả</th>
            <th width="20%"> Số Tiền </th>
        </tr>
    </thead>
    <tbody>
        @foreach($allTransaction as $value)
            @if($value->from != $debts[0]['id'])
            <tr class="font-green-jungle">
            @else
            <tr class="font-red">
            @endif
                <td>{{$value->date}}</td>
                <td>{!!$value->description!!}</td>
                <td>{{ ($value->from == $accountId)? '-'.asVnd($value->amount) : asVnd($value->amount) }}</td>
                
            </tr>
        @endforeach
    </tbody>
</table>
<script src="{{asset('assets/global/scripts/datatable.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/datatables/datatables.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}" type="text/javascript"></script>
<script type="text/javascript">
    $('.table').dataTable({
            fixed_header:true,
            buttons: [
                { extend: 'print', className: 'btn dark btn-outline' },
                { extend: 'copy', className: 'btn red btn-outline' },
                { extend: 'pdf', className: 'btn green btn-outline' },
                { extend: 'excel', className: 'btn yellow btn-outline ' },
                { extend: 'csv', className: 'btn purple btn-outline ' },
                { extend: 'colvis', className: 'btn dark btn-outline', text: 'Columns'}
            ],
            // setup responsive extension: http://datatables.net/extensions/responsive/
            responsive: {
                details: {                   
                }
            },
            "ordering": false,
            //"ordering": false, disable column ordering 
            //"paging": false, disable pagination

            // "order": [
            //     [0, 'asc']
            // ],
            
            "lengthMenu": [
                [5, 10, 15, 20, -1],
                [5, 10, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 10
           
        });


</script>
        