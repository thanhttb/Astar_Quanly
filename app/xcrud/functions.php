<?php
// function add_modal($value, $fieldname, $primary_key, $row, $xcrud){
// 	return '

// 	<!-- Trigger the modal with a button -->
// <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>

// <!-- Modal -->
// <div id="myModal" class="modal fade" role="dialog">
//   <div class="modal-dialog">

//     <!-- Modal content-->
//     <div class="modal-content">
//       <div class="modal-header">
//         <button type="button" class="close" data-dismiss="modal">&times;</button>
//         <h4 class="modal-title">Modal Header</h4>
//       </div>
//       <div class="modal-body">
//         <p>Some text in the modal.</p>
//       </div>
//       <div class="modal-footer">
//         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
//       </div>
//     </div>

//   </div>
// </div>';
// }add_firstDay_showUp
function deactive($xcrud){
    if($xcrud->get('primary')){
        $db = Xcrud_db::get_instance();
        $query='UPDATE enrolls set firstday_showup = -1 WHERE id ='.(int)$xcrud->get('primary');
        //echo $query;
        $db->query($query);
    }
}
function active($xcrud){
    if($xcrud->get('primary')){
        $db = Xcrud_db::get_instance();
        $query='UPDATE enrolls set firstday_showup = 0 WHERE id ='.(int)$xcrud->get('primary');
        //echo $query;
        $db->query($query);
    }
}
function class_detail($value, $fieldname, $primary_key, $row, $xcrud){
   return '<a href="classDetail/'. $row['classes.name']. '">' . $value. '</a>';

}
function edit_class($value, $fieldname, $primary_key, $row, $xcrud){
	return '<a href="#" class ="editClass" data-type="select2" data-value="'.$value.'" data-pk='.$primary_key.' data-title="Xếp lớp"></a>';

}
function add_firstDay_showUp($value, $fieldname, $primary_key, $row, $xcrud)
{
	$array=['Chưa đến học buổi đầu','Đã đến học buổi đầu']	;
	return '<a href="#" class="showUp" data-type="select" data-pk="'.$primary_key.'" data-title="Select options">'.$array[$value].'</a>';

}
function add_inform($value, $fieldname, $primary_key, $row, $xcrud){
	$array=['Chưa thông báo','Đã thông báo']	;
  	return '<a href="#" class="testInform" data-type="select" data-pk="'.$primary_key.'" data-title="Select options">'.$array[$value].'</a>';

}

function add_edit_teacher($value, $fieldname, $primary_key, $row, $xcrud){
	if($value != '0'){
		return '<a href="#">'.$value.'</a>';
	}
	else{
		return '<a href="#" class ="teacher" data-type="select2" data-value="'.$value.'" data-pk='.$primary_key.' data-title="Gửi bài"></a>';

	}
}
function add_edit_result($value, $fieldname, $primary_key, $row, $xcrud){
	return '<a href="#" class ="result" data-type="textarea" data-pk='.$primary_key.' data-title="Kết quả + Nhận xét">'.$value.'</a>';

}
function add_note($value, $fieldname, $primary_key, $row, $xcrud){
	return '<a href="#" class ="ghichu" data-type="textarea" data-pk='.$primary_key.' data-title="Ghi chú">'.$value.'</a>';

}
function add_edit_informed($value, $fieldname, $primary_key, $row, $xcrud){
	$array=['Chưa thông báo','Đã thông báo']	;

	return '<a href="#" class ="resultInform" data-type="select" data-pk='.$primary_key.' data-title="Thông báo phụ huynh">'.$array[$value].'</a>';

}
function add_edit_decision($value, $fieldname, $primary_key, $row, $xcrud){
	return '<a href="#" class ="decision" data-type="select" data-pk='.$primary_key.' data-title="Phản hồi của phụ huynh">'.$value.'</a>';
}
function add_class($value, $fieldname, $primary_key, $row, $xcrud){
	return '<a href="#" class ="officalClass" data-type="select2" data-value="'.$value.'" data-pk='.$primary_key.' data-title="Xếp lớp"></a>';

}
function add_firstDay($value, $fieldname, $primary_key, $row, $xcrud){
	$old_date = isset($value) ? date("d-m-Y h:i", strtotime($value)) : NULL;	
   	return '<a href="#" class ="firstDay" data-type="datetime" data-pk="'.$primary_key.'" data-title="Nhập Buổi học đầu tiên">'. $old_date.'</a>'  ;
}
function add_testInform($value, $fieldname, $primary_key, $row, $xcrud)
{
  $array=['Chưa thông báo','Đã thông báo']	;
  return '<a href="#" class="testInform" data-type="select" data-pk="'.$primary_key.'" data-title="Select options">'.$array[$value].'</a>';
}
function add_showUp($value, $fieldname, $primary_key, $row, $xcrud)
{
	$array=['Chưa đến thi','Đã đến thi']	;
	return '<a href="#" class="showUp" data-type="select" data-pk="'.$primary_key.'" data-title="Select options">'.$array[$value].'</a>';

}
function add_appointment($value, $fieldname, $primary_key, $row, $xcrud)
{
   $old_date = isset($value) ? date("d-m-Y h:i", strtotime($value)) : NULL;	
   return '<a href="#" class ="appointment" id = "appointment'.$primary_key.'" data-type="datetime" data-pk="'.$primary_key.'" data-title="Nhập Ngày Hẹn">'. $old_date.'</a>'  ;
}
function add_enroll($xcrud){
    $maxStudentId = Xcrud_db::get_instance();
    $query = 'UPDATE enrolls SET student_id = (SELECT MAX(id) FROM students) ORDER BY id DESC LIMIT 1';
    $maxStudentId->query($query);

    //app('App\Http\Controllers\StudentController')->addAccount(1,$xcrud->get('primary'));
}
function add_user_created_at($xcrud){
	$add_name_time = Xcrud_db::get_instance();
	$user = Auth::user()->name;
	$created_at = date('Y-m-d');
	$query= 'UPDATE enrolls SET receiver ='.$user.', created_at = '. $created_at. 'ORDER BY id  DESC LIMIT 1';
	$add_name_time->query($query);
}
function result_status($postdata, $xcrud){
    if($postdata->get('result') != NULL){
        $postdata->set('statusNumber', 4 );
    }
}
function result_function($xcrud){
    if($xcrud->get('primary')){
        $db = Xcrud_db::get_instance();
        $query='UPDATE enrolls set statusNumber = 4 WHERE enrollNumber ='.(int)$xcrud->get('primary');
        //echo $query;
        $db->query($query);
    }
}
function tested_function($xcrud){
    if($xcrud->get('primary')){
        $db = Xcrud_db::get_instance();
        $query='UPDATE enrolls set statusNumber = 3 WHERE enrollNumber ='.(int)$xcrud->get('primary');
        //echo $query;
        $db->query($query);
    }
}
function unscheduled_function($xcrud){
    if($xcrud->get('primary')){
        $db = Xcrud_db::get_instance();
        $query='UPDATE enrolls set statusNumber = 1 WHERE enrollNumber ='.(int)$xcrud->get('primary');
        //echo $query;
        $db->query($query);
    }
}
function scheduled_function($xcrud){
    if($xcrud->get('primary')){
        $db = Xcrud_db::get_instance();
        $query='UPDATE enrolls set statusNumber = 2 WHERE enrollNumber ='.(int)$xcrud->get('primary');
        $db->query($query);
    }
}
function publish_action($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE base_fields SET `bool` = b\'1\' WHERE id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function unpublish_action($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE base_fields SET `bool` = b\'0\' WHERE id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}

function exception_example($postdata, $primary, $xcrud)
{
    // get random field from $postdata
    $postdata_prepared = array_keys($postdata->to_array());
    shuffle($postdata_prepared);
    $random_field = array_shift($postdata_prepared);
    // set error message
    $xcrud->set_exception($random_field, 'This is a test error', 'error');
}

function test_column_callback($value, $fieldname, $primary, $row, $xcrud)
{
    return $value . ' - nice!';
}

function after_upload_example($field, $file_name, $file_path, $params, $xcrud)
{
    $ext = trim(strtolower(strrchr($file_name, '.')), '.');
    if ($ext != 'pdf' && $field == 'uploads.simple_upload')
    {
        unlink($file_path);
        $xcrud->set_exception('simple_upload', 'This is not PDF', 'error');
    }
}

function movetop($xcrud)
{
    if ($xcrud->get('primary') !== false)
    {
        $primary = (int)$xcrud->get('primary');
        $db = Xcrud_db::get_instance();
        $query = 'SELECT `officeCode` FROM `offices` ORDER BY `ordering`,`officeCode`';
        $db->query($query);
        $result = $db->result();
        $count = count($result);

        $sort = array();
        foreach ($result as $key => $item)
        {
            if ($item['officeCode'] == $primary && $key != 0)
            {
                array_splice($result, $key - 1, 0, array($item));
                unset($result[$key + 1]);
                break;
            }
        }

        foreach ($result as $key => $item)
        {
            $query = 'UPDATE `offices` SET `ordering` = ' . $key . ' WHERE officeCode = ' . $item['officeCode'];
            $db->query($query);
        }
    }
}
function movebottom($xcrud)
{
    if ($xcrud->get('primary') !== false)
    {
        $primary = (int)$xcrud->get('primary');
        $db = Xcrud_db::get_instance();
        $query = 'SELECT `officeCode` FROM `offices` ORDER BY `ordering`,`officeCode`';
        $db->query($query);
        $result = $db->result();
        $count = count($result);

        $sort = array();
        foreach ($result as $key => $item)
        {
            if ($item['officeCode'] == $primary && $key != $count - 1)
            {
                unset($result[$key]);
                array_splice($result, $key + 1, 0, array($item));
                break;
            }
        }

        foreach ($result as $key => $item)
        {
            $query = 'UPDATE `offices` SET `ordering` = ' . $key . ' WHERE officeCode = ' . $item['officeCode'];
            $db->query($query);
        }
    }
}

function show_description($value, $fieldname, $primary_key, $row, $xcrud)
{
    $result = '';
    if ($value == '1')
    {
        $result = '<i class="fa fa-check" />' . 'OK';
    }
    elseif ($value == '2')
    {
        $result = '<i class="fa fa-circle-o" />' . 'Pending';
    }
    return $result;
}

function custom_field($value, $fieldname, $primary_key, $row, $xcrud)
{
    return '<input type="text" readonly class="xcrud-input" name="' . $xcrud->fieldname_encode($fieldname) . '" value="' . $value .
        '" />';
}
function unset_val($postdata)
{
    $postdata->del('Paid');
}

function format_phone($new_phone)
{
    $new_phone = preg_replace("/[^0-9]/", "", $new_phone);

    if (strlen($new_phone) == 7)
        return preg_replace("/([0-9]{3})([0-9]{4})/", "$1-$2", $new_phone);
    elseif (strlen($new_phone) == 10)
        return preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "($1) $2-$3", $new_phone);
    else
        return $new_phone;
}

function before_list_example($list, $xcrud)
{
    var_dump($list);
}

function after_update_test($pd, $pm, $xc)
{
    $xc->search = 0;
}

