<style type="text/css">
    .dataTables_filter{
        float:right;
    }
</style>
<div class="table-scrollable">
    <table class="table">
        <thead>
            <tr>
                <th> # </th>
                <th> Họ tên </th>
                <th> Ngày sinh </th>
                <th> SĐT phụ huynh </th>
                <th> Lớp </th>
                <th> Ngày nghỉ </th>
                <th> Ngày học bù</th>
                <th> Trợ giảng </th>
                <th> Nội dung </th>
                <th> Trạng thái </th>
            </tr>
        </thead>
        <tbody>
            @foreach($result as $cxl)
                @if($cxl['label'] == 'chuaxeplich')
                <tr class="warning">
                @endif
                @if($cxl['label'] == 'daxeplich')
                <tr class="active">
                @endif
                @if($cxl['label'] == 'nhaclichhoc')
                <tr class="success">
                @endif
                @if($cxl['label'] == 'qualichhoc')
                <tr class="danger">
                @endif
                    <td></td>
                    <td>{{$cxl['from'][1]." ".$cxl['from'][0]}}</td>
                    <td>{{ date('d-m-Y',strtotime($cxl['from'][2])) }}</td>
                    <td>{{ $cxl['from'][3] }}</td>
                    <td>{{ $cxl['to'][0] }}</td>
                    <td>{{ date('d-m-Y',strtotime($cxl['date'])) }}</td>
                    <td><a href="#" class="ngayhocbu" data-pk="{{$cxl['id']}}">{{ $cxl['description']['hb_date'] }}</a></td>
                    <td><a href="#" class ="teacher" data-type="select2" data-value="{{ $cxl['description']['hb_trogiang'][1]}}" data-pk="{{$cxl['id']}}" data-title="">{{$cxl['description']['hb_trogiang'][0]}}</a></td>
                    <td><a href="#" class="content" data-pk="{{$cxl['id']}}">{{ $cxl['description']['hb_content'] }}</a></td>
                    <td><a href="#" class="status" data-type="select2" data-pk="{{$cxl['id']}}">{{ $cxl['description']['hb_status'] }}</a></td>
                </tr>

            @endforeach
            
    <div id="_token" class="hidden" data-token="{{ csrf_token() }}"></div>
        </tbody>
    </table>

    <link href="{{asset('assets/global/plugins/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('app/bootstrap3-editable/css/bootstrap-editable.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('select2-4.0.3/dist/css/select2.min.css')}}" rel="stylesheet" type="text/css"></link> 
    <link href="{{ asset('select2-4.0.3/select2-bootstrap-css-master/docs/select2-bootstrap.css')}}" rel="stylesheet" type="text/css"></link> 

    <script src="{{ asset('select2-4.0.3/dist/js/select2.full.js') }}"></script>     
    <script src="{{asset('assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('app/bootstrap3-editable/js/bootstrap-editable.min.js')}}"></script>
    <script src="{{asset('assets/global/plugins/datatables/datatables.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
         $.fn.editable.defaults.params = function (params){
                params._token = $("#_token").data("token");
                return params;
            };
        var teachers_src = [{id: '0', text: '' }];        
        <?php 
            foreach ($allTeachers as $key => $value) {
                # code...
                echo 'teachers_src.push({id : "'.$value['id'].'", text: "'.$value['name'].'"});';                
            }
        ?> 
        $(document).ready(function(){
            $('.table').DataTable();
                        $('#DataTables_Table_0_wrapper').removeClass('dataTables_wrapper');

            $('.ngayhocbu').editable({
                type: 'datetime',                
                url: '{{route("editHocBu")}}',
                title: 'Thêm ngày học',
                viewformat: 'dd/mm/yyyy hh:ii',
                placement: 'left',
                name: 'hb_date'
            });
            $('.content').editable({
                type: 'textarea',
                url: '{{route("editHocBu")}}',
                title: 'Nội dung bài học',
                placement: 'left',
                name: 'hb_content'
            });
            $('.teacher').editable({
                source: teachers_src,
                select2: {
                    placeholder: 'Chọn Trợ Giảng'
                },
                url: '{{route("editHocBu")}}',
                title: 'Nội dung bài học',
                placement: 'left',
                name: 'hb_trogiang'
            });
            $('.status').editable({
                source: [
                    {id: 'Đã xếp lịch', text:'Đã xếp lịch'},
                    {id: 'Chưa xếp lịch', text:'Chưa xếp lịch'},
                    {id: 'Từ chối', text:'Từ chối'},
                    {id: 'Đã học bù', text:'Đã học bù'}
                ],
                select2: {
                    placeholder: 'Chọn Trạng Thái'
                },
                url: '{{route("editHocBu")}}',
                title: 'Trạng thái',
                placement: 'left',
                name: 'hb_status'
            });
        });

    </script>
</div>
