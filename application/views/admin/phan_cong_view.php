<div class="col-lg-12">
<ol class="breadcrumb">
    <li class="cursor back">
        <i class="fa fa-arrow-left"></i>
    </li>
    <li>
        <a href="<?php echo base_url(); ?>">
            <i class="fa fa-home"></i> Trang chủ
        </a>
    </li>
</ol>
<h3 class="page-header marTop"><i class="fa fa-file-o"></i> Lịch công việc</h3>


    <div id="eventContent"  style="display:none;">
        <i style="font-weight: bold; font-style: italic;">Tên công việc:</i> <span id="nameTask"></span><br>
        <i style="font-weight: bold; font-style: italic;">Mô tả công việc:</i> <span id="description"></span><br>
        <i style="font-weight: bold; font-style: italic;">Ngày bắt đầu:</i> <span id="startTime"></span><br>
        <i style="font-weight: bold; font-style: italic;">Ngày kết thúc:</i> <span id="endTime"></span><br>
        <i style="font-weight: bold; font-style: italic;">Tình trạng công việc:</i><span id="status"></span><br>
        <p id="eventInfo"></p>
    </div>


    <div id='calendar'></div>
    <div id="fullCalModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
                    <h4 id="modalTitle" class="modal-title"></h4>
                </div><!--header-->
                <form id="taskForm">
                    <div id="modalBody" class="modal-body">
                        <div class="containter">
                            <div class="row">
                                <div class="col-xs-3">
                                    <label>Tên công việc:</label>
                                </div>
                                <div class="col-xs-9">
                                    <input id = "Hello"type="text" name="task" class="form-control">
                                </div>
                            </div>

                            <div class="row " style="margin-top: 5px;">
                                <div class="col-xs-3">
                                    <label>Bắt đầu </label>
                                </div>
                                <div class="col-xs-9">
                                    <input type="text" id="datetimepickerStart" class="form-control">
                                </div>
                            </div>

                            <div class="row " style="margin-top: 5px;">
                                <div class="col-xs-3">
                                    <label>Kết thúc </label>
                                </div>
                                <div class="col-xs-9">
                                    <input type="text" id="datetimepickerEnd"  class="form-control">
                                </div>
                            </div>

                        </div>

                    </div><!--End modal body -->
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                    <button class="btn btn-success" id="submit">Nhập</button>
                </div><!--Footer -->
            </div>
        </div>
    </div><!--end modal-->

    <input type="text"  id="base_html" value="<?php echo base_url();?>" style="visibility: hidden;">
    <script type="text/javascript">
        var mylink = document.getElementById('base_html').value;
        var link2 = mylink+"admin/phan_cong/getCongViec";
        var link3 = mylink+"admin/phan_cong/getIndividual";


        $.ajax({
            url: link2,
            type: 'POST',
            data: 'type=fetch',
            async: false,
            success: function(response){
                json_events = response;
            }
        });


        $(document).ready(function() {
            var calendar =   $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title'
                    /*with week and day*/
                },

                eventRender: function (event, element) {

                    var mystuff="";
                    var myStatus;
                    element.attr('href', 'javascript:void(0);');
                    element.click(function () {

                        var theID = event.id;
                        $.post(
                            link3,
                            {
                                id:theID
                            },
                            function (response){
                                mystuff = JSON.parse(response);
                                $('#startTime').html(moment(mystuff.startTime).format('DD-MM-YYYY'));
                                $("#endTime").html(moment(mystuff.endTime).format('DD-MM-YYYY'));
                                if(mystuff.phan_tram == 100 ){
                                    myStatus = "Đã hoàn thành, chưa báo hoàn thành cho người giao việc";
                                }else{
                                    myStatus = "Đã hoàn thành được "+mystuff.phan_tram+"%";
                                }
                                $('#nameTask').html(event.title);
                                $('#description').html(event.description);
                                $("#status").html(myStatus);
                                $("#eventContent").dialog({modal: true, title: "Chi tiết công việc", width: 450,
                                    open: function(ui) {
                                        $('.ui-dialog-titlebar-close').html('X');
                                    }});
                            }
                        );

                    });
                },
                eventTextColor: 'black',
                eventTextSize:'12',

                timeFormat: 'h:ma',      // the output i.e. "10:00pm"
                monthNames: ["Tháng một","Tháng hai","Tháng ba","Tháng tư","Tháng năm","Tháng sáu","Tháng bảy", "Tháng tám", "Tháng chín", "Tháng mười", "Tháng mười một", "Tháng mười hai" ],
                monthNamesShort: ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sept","Oct","nov","Dec"],
                dayNames: ["Chủ nhật","Thứ hai","Thứ ba","Thứ tư","Thứ năm","Thứ sáu ","Thứ bảy"],
                dayNamesShort: ["Chủ nhật","Thứ 2","Thứ 3","Thứ 4","Thứ 5","Thứ 6 ","Thứ 7"],

                columnFormat: {
                    month: 'ddd',
                    week: 'ddd D/M',
                    day: 'dddd D/M'
                },
                firstDay:1,
                titleFormat:{
                    month:'MMMM YYYY' ,
                    week:'D MMMM YYYY',
                    day:'D MMMM YYYY'

                },

                selectable: true,
                defaultDate: '2015-12-01',
                editable: true,
                selectHelper: true,
                eventLimit: true,
                events: JSON.parse(json_events)

            });

        });



    </script>
