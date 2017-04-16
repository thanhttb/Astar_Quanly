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
            <th width="20%" >Balance</th>
        </tr>
    </thead>
    <tbody>
        @foreach($allTransaction as $value)
            <tr>
                <td>{{$value->date}}</td>
                <td>{!!$value->description!!}</td>
                <td>{{ ($value->from == $accountId)? '-'.asVnd($value->amount) : asVnd($value->amount) }}</td>
                <?php $balance += ($value->from == $accountId)? intval('-'.$value->amount) : intval($value->amount) ?>
                <td>{{asVnd($balance)}}</td>
                
            </tr>
        @endforeach
    </tbody>
</table>
        