<table class="table table-striped table-bordered table-hover dt-responsive" id="table" width="100%">
    <thead>
        <tr>
            <th>Họ tên</th>
            <th>Ngày sinh</th>
            <th>Số điện thoại</th>
            <th>Tiền học</th>
            <th>Tổng phụ phí</th>
            <th>Số dư kỳ trước</th>
            <th>Tổng</th>
            <th width="5%">Truy thu</th>

        </tr>
    </thead>
    
    <tbody style="font-weight: normal;">
        @foreach($students as $value)
        <tr>
            <td>{{$value['lastName']}} {{$value['firstName']}}</td>
            <td>{{empty($value['dob']? " ": date('d/m/Y', strtotime($value['dob'])))}}</td>
            <td>{{$value['phone']}}</td>
            <td>{{asVnd($value['tuition'])}}</td>
            <td>{{asVnd($value['otherFee'])}}</td>
            <td>{{asVnd($value['lastBalance'])}}</td>
            <td>{{asVnd($value['lastBalance'] + $value['tuition'] + $value['otherFee'])}}</td>
            <td>
                <div class="btn-group">
                    <button type="button" class="btn red dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="{{route('printHp',$value)}}"> In thông báo </a>
                        </li>
                        <li>
                            <a href="#" class="get-edit" data-value= 12>SMS</a>
                        </li>
                        <li>
                            <a href="javascript:;"> Email </a>
                        </li>
                        <li>
                            <a href="javascript:;"> Gọi điện </a>
                        </li>
                    </ul>
                </div>
            </td>
        </tr>  
        @endforeach                
    </tbody>
</table>
<script type="text/javascript">

 var UIExtendedModals = function () {    
    return {
        //main function to initiate the module
        init: function () {
        
            // general settings
            $.fn.modal.defaults.spinner = $.fn.modalmanager.defaults.spinner = 
              '<div class="loading-spinner" style="width: 200px; margin-left: -100px;">' +
                '<div class="progress progress-striped active">' +
                  '<div class="progress-bar" style="width: 100%;"></div>' +
                '</div>' +
              '</div>';

            $.fn.modalmanager.defaults.resize = true;

            //dynamic demo:
            $('.dynamic .demo').click(function(){
              var tmpl = [
                // tabindex is required for focus
                '<div class="modal hide fade" tabindex="-1">',
                  '<div class="modal-header">',
                    '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>',
                    '<h4 class="modal-title">Modal header</h4>', 
                  '</div>',
                  '<div class="modal-body">',
                    '<p>Test</p>',
                  '</div>',
                  '<div class="modal-footer">',
                    '<a href="#" data-dismiss="modal" class="btn btn-default">Close</a>',
                    '<a href="#" class="btn btn-primary">Save changes</a>',
                  '</div>',
                '</div>'
              ].join('');
              
              $(tmpl).modal();
            });

            //ajax demo:
            var $modal = $('#ajax-modal');

            $('#ajax-edit').on('click', function(){
              // create the backdrop and wait for next modal to be triggered
              $('body').modalmanager('loading');
              var el = $(this);

              setTimeout(function(){
                  $modal.load(el.attr('data-url'), '', function(){
                  $modal.modal();
                });
              }, 1000);
            });

            $modal.on('click', '.update', function(){
              $modal.modal('loading');
              setTimeout(function(){
                $modal
                  .modal('loading')
                  .find('.modal-body')
                    .prepend('<div class="alert alert-info fade in">' +
                      'Updated!<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                    '</div>');
              }, 1000);
            });
        }

    };

}();
jQuery('.get-edit').click(function(){
    console.log($(this).data('value'));
    $('#ajax-edit').attr('data-url','sendSms/'+$(this).data('value'));    
    $('#ajax-edit')[0].click();
})
$(document).ready(function(){
    UIExtendedModals.init();
    $('#table').dataTable({
            fixedHeader: true,
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
            "pageLength": 100,
            "dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable
        });
 
});


</script>