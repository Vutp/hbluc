<div class="col-lg-12">
<ol class="breadcrumb">
    <li class="cursor back">
        <i class="fa fa-arrow-left"></i>
    </li>
    <li>
        <a href="<?php echo base_url('trang_chu'); ?>">
            <i class="fa fa-home"></i> Trang chủ
        </a>
    </li>
</ol>
<h3 class="page-header marTop"><i class="fa fa-file-o"></i> Giao công việc</h3>
<div id="baoloi" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Báo lỗi  </h4>
            </div><!--header-->
            <div class="modal-body">
                <p id="thongbao"> This work is amazing ! </p>
            </div>

            <div class="modal-footer">
                <button id="closeButton"  class="btn btn-default" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div><!--end modal-->


<div class="Ying main-box no-header clearfix">
    <div class="main-box-body clearfix">
        <div class="table-responsive">
            <table class="Ying table user-list">
                <thead>
                <tr >
                    <th ><span>Cán bộ</span></th>
                    <th class=" text-center"><span>Áp dụng</span></th>
                </tr>
                </thead>
                <tbody>
                <?php

                for($i = 0; $i<count($data1); $i++){
                    echo '<tr>
                    <td>
                        <img src="'.base_url('upload/'.$data1[$i]->avatar).'" alt="">
                        '.$data1[$i]->hoten.'
                        <span class="user-link user-subhead" >'.$my_phong_ban[$i].'</span>
                    </td>
                    <td class="text-center">';
                   echo '<button value='.$data1[$i]->ma_can_bo.' class="giaoviec btn btn-info">Giao Việc</button>';

                    echo '</td>

                </tr>';
                }

                ?>

                </tbody>
            </table>
        </div>
    </div>
</div>


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
                                <input type="text" value="<?php echo date("d/m/Y"); ?>" id="datetimepickerStart" class="form-control" readonly >
                            </div>
                        </div>

                        <div class="row " style="margin-top: 5px;">
                            <div class="col-xs-3">
                                <label>Kết thúc </label>
                            </div>
                            <div class="col-xs-9">
                                <input type="text" id="datetimepickerEnd"  class="form-control" readonly>
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
</div>
<input type="text"  id="base_html" value="<?php echo base_url();?>" style="visibility: hidden;">
<script type="text/javascript">
    var mylink = document.getElementById('base_html').value;
    var link1 = mylink+"admin/giao_viec/addCongViec";
    var link2 = mylink+"admin/giao_viec";
    var mscbNhan =0;

    var typeSuccess = 0;
    var typeFail = 0;


    $('.giaoviec').on("click",function(){
        $('#fullCalModal').modal();
        $('#datetimepickerStart').datepicker();
        $('#datetimepickerEnd').datepicker();
        mscbNhan = $(this).attr("value");

        });
    $('#closeButton').on("click",function(){
        if(typeSuccess == 1){
            window.location.href = link2;
        }

        if(typeFail == 1 ){
            document.getElementById('Hello').value="";
            document.getElementById('datetimepickerEnd').value="";
            $("#fullCalModal").modal();
        }
    });

    $("#submit").on("click",function() {
        var title = document.getElementById('Hello').value;
        var startFromSource = document.getElementById('datetimepickerStart').value;
        var endFromSource = document.getElementById('datetimepickerEnd').value;
        if(title=="" || startFromSource==""||endFromSource==""){
            $("#fullCalModal").modal('hide');
            if(title==""){
                $('#thongbao').html('Tên công việc chưa nhập').css('color','red');
            }else if(endFromSource==""){
                $('#thongbao').html('Ngày kết thúc chưa nhập').css('color','red');
            }
            $('#baoloi').modal();
            typeFail = 1;
        }else{

            var start =startFromSource.substr(6,4)+"-"+startFromSource.substr(3,2)
                +"-"+startFromSource.substr(0,2);
            var end =endFromSource.substr(6,4)+"-"+endFromSource.substr(3,2)
                +"-"+endFromSource.substr(0,2);
            var status = 1;

            var x = new Date(start);
            var y = new Date(end);
            if(x<=y){
                $.post(link1,
                    { // Data Sending With Request To Server
                        myTitle: title,
                        startDate: start,
                        endDate: end,
                        mcbNhan: mscbNhan,
                        status: status

                    },
                    function (response) {
                        if(response=="ok"){
                            $("#fullCalModal").modal('hide');
                            $('#thongbao').html('Công việc đã được chuyển đi !').css('color','Blue');
                            $('#myModalLabel').html("Giao việc thành công")
                            $('#baoloi').modal();
                            typeSuccess  = 1;
                            //window.location.href = link2;
                        }
                    }
                ) ;

            }else{
                $("#fullCalModal").modal('hide');
                $('#thongbao').html('Lỗi ngày kết thúc !').css('color','red');
                $('#baoloi').modal();
                typeFail = 1;

            }

        }

    });






</script>
