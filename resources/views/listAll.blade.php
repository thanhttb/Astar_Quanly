@extends('layouts.master')
@section('content')
<div class="row">
    <?php
    include(app_path().'/xcrud/xcrud.php');
    include(app_path().'/xcrud/functions.php');
    echo Xcrud::load_css();
    echo Xcrud::load_js();
    $xcrud = Xcrud::get_instance();
    $xcrud->table('transaction');
    // $xcrud->relation('office','offices','officeCode','city');
    // $xcrud->relation('manager','employees','employeeNumber',array('firstName','lastName'),'','','',' ','','officeCode','office');
     
    // $xcrud->relation('country','meta_location','id','local_name','type = \'CO\'');
    // $xcrud->relation('region','meta_location','id','local_name','type = \'RE\'','','','','','in_location','country');
    // $xcrud->relation('city','meta_location','id','local_name','type = \'CI\'','','','','','in_location','region');
    
    $type = array('1' => 'Học sinh' , '2' => 'Lớp' ,'3' =>'Giáo viên' );
    $xcrud->relation('from','accounts','id', array('type','name','dob')); 
    $xcrud->relation('to','accounts','id', array('type','name','dob')); 

    echo $xcrud->render('list');
?>
 
<link href="http://select2.github.io/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://select2.github.io/dist/js/select2.full.js"></script>
<script type="text/javascript">
// jQuery(document).on("xcrudbeforerequest", function(event, container) {
//     if (container) {
//         jQuery(container).find("select").select2("destroy");
//     } else {
//         jQuery(".xcrud").find("select").select2("destroy");
//     }
// });

window.onload = function(){
    jQuery(document).on("xcrudafterrequest",function(event,container){
       if (container) {
        jQuery(container).find("select").select2();
    } else {
        jQuery(".xcrud").find("select").select2();
    }
    })};
// jQuery(document).on("xcrudbeforedepend", function(event, container, data) {
//     jQuery(container).find('select[name="' + data.name + '"]').select2("destroy");
// });
// jQuery(document).on("xcrudafterdepend", function(event, container, data) {
//     jQuery(container).find('select[name="' + data.name + '"]').select2();
// });
</script>
    
</div>

@endsection