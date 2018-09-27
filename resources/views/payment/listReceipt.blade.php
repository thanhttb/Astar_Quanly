<?php
	include(app_path().'/xcrud/xcrud.php');
	include(app_path().'/xcrud/functions.php');
    echo Xcrud::load_css();
    echo Xcrud::load_js(); ?>

<ul class="nav nav-tabs">
            
    <li>
        <a href="#tab_1_1" data-toggle="tab"> Danh sách trong ngày </a>
    </li>
    <li>
    	<a href="#tab_1_2" data-toggle="tab"> Danh sách tổng</a>
    </li>
</ul>
<div class="tab-content">
    <div class="tab-pane fade" id="tab_1_1">
	    <div class="portlet light bordered">	            
	            <div class="portlet-body">
	            	<?php
					    $r = Xcrud::get_instance();
					    $r->table('receipt')->where('created_at >',date('Y-m-d 00:00:00'))->where('created_at <',date('Y-m-d 23:59:59'));
					    $r->table_name('Phiếu thu ngày hôm nay');
					    $r->order_by('created_at','desc');
					    $r->columns('id,account,description,amount,type,receiver,created_at');
					    $r->label(['id'=>'#','account'=>'Người nộp','description'=>'Diễn giải','amount'=>'Số tiền','type'=>'Loại','receiver'=>'Người nhận','created_at'=>'Ngày nhận']);
					    $r->sum('amount');
					    $r->change_type('amount','price','0');
					    if(Auth::user()->permission < 2){
					    	$r->disabled('amount,type,receiver','edit');
					    	$r->unset_remove();

					    }
					    $r->hide_button('add');
					    echo $r->render('list');
						?>
	            </div>
	    </div>
    </div>

    <div class="tab-pane fade" id="tab_1_2">
	    <div class="portlet light bordered">	            
            <div class="portlet-body">
            	<?php
					    $r = Xcrud::get_instance();
					    $r->table('receipt');
					    $r->table_name('Tổng');
					    $r->order_by('created_at','desc');
					    $r->columns('id,account,description,amount,type,receiver,created_at');
					    $r->label(['id'=>'#','account'=>'Người nộp','description'=>'Diễn giải','amount'=>'Số tiền','type'=>'Loại','receiver'=>'Người nhận','created_at'=>'Ngày nhận']);
					    $r->sum('amount');
					    $r->change_type('amount','price','0');
					    if(Auth::user()->permission < 2){
					    	$r->disabled('amount,type,receiver','edit');
					    	$r->unset_remove();

					    }
					    $r->hide_button('add');
					    echo $r->render('list');

					?>
            </div>
	    </div>
    </div>
</div>  