
@extends('layouts.general')
@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                
            </div>
            <!-- /.col-lg-12 -->
            <?php
            include(app_path().'\xcrud\xcrud.php'); 
            include(app_path().'\xcrud\functions.php');
                echo Xcrud::load_css();
                echo Xcrud::load_js();
                $addnew = Xcrud::get_instance();
                // $addnew->table('enrolls');
                // $addnew->join('enrolls.student_id', 'students', 'id', 't1');
                // $addnew->join('t1.parent_id', 'parents', 'id', 't2');
                $addnew->table('parents');

                $addnew->join('parents.id','students','parent_id', 't1');

                $addnew->join('id','enrolls','parent_id', 't2');
                //$addnew->relation('class','classes','id')
                $addnew->fields('t1.firstName , t1.lastName, t1.dob, t1.gender,t1.school,
                                 parents.name, parents.phone, parents.email', false,'Thông tin học sinh'    );
                $addnew->fields('t2.subject, t2.class, t2.appointment', false,'Kiểm tra đầu vào');
                $addnew->label(array(
                        'students.firstName'=>'Tên học sinh',
                        'students.lastName' => 'Họ đệm',
                        'students.dob' => 'Ngày sinh',
                        'students.gender' => 'Giới tính',
                        'students.school' => 'Trường',
                        'parents.name' => 'Họ tên phụ huynh',
                        'parents.phone' => 'Số điện thoại phụ huynh',
                        'parents.email' => 'Email phụ huynh',
                        'enrolls.subject' => 'Môn học',
                        'enrolls.class' => 'Khối lớp',
                        'enrolls.appointment' => 'Hẹn lịch KT đầu vào'

                    )); 
                $addnew->after_insert('add_enroll');
                echo $addnew->render("create");
                
            ?>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>



<!-- /#page-wrapper -->            
@endsection()