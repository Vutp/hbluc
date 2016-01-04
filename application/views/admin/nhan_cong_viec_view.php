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
<h3 class="page-header marTop"><i class="fa fa-file-o"></i> Công việc được giao</h3>
<div id="fullCalModalSayYes" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Xác nhận </h4>
            </div><!--header-->
            <div class="modal-body">
                <p>Bạn có chắc chắn nhận công việc này ? </p>
            </div>

            <div class="modal-footer">
                <button  type="button" class="btn btn-default" data-dismiss="modal">Không </button>
                <button id="agree" type="button" class="btn btn-success" data-dismiss="modal" >Chắc chắn</button>
            </div>
        </div>
    </div>
</div><!--end modal-->

<div id="fullCalModalSayNo" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Xác nhận </h4>
            </div><!--header-->
            <div class="modal-body">
                <p>Bạn có chắc chắn không muốn nhận công việc này ? </p>
            </div>

            <div class="modal-footer">
                <button  type="button" class="btn btn-default" data-dismiss="modal">Không </button>
                <button  id="disagree"type="button" class="btn btn-success" data-dismiss="modal" >Chắc chắn</button>
            </div>
        </div>
    </div>
</div><!--end modal-->


<?php
if(count($data2)<=0){
    echo'<p style="color:red;">Không có công việc nào được giao</p>';
}
else{
    echo '
    <div class="Ying main-box no-header clearfix">
    <div class="main-box-body clearfix">
            <table class="Ying table user-list">
                <thead>
                <tr >
                    <th class="col-xs-2 col-sm-3">Người giao việc</th>
                    <th class="col-xs-1 col-sm-3">Tên công việc</th>
                    <th class="col-xs-2 col-sm-2"><span>Ngày kết thúc</th>
                    <th class="col-xs-5 col-sm-2">Tiến độ</th>
                    <th class="col-xs-1 col-sm-2" >Quyết định</th>
                </tr>
                </thead>
                <tbody>';
                for($i = 0; $i<count($data2); $i++) {
                    $listTask = $this->db->where('ma_can_bo', $data2[$i]->ma_can_bo_giao)->get('user');
                    $myUserRow = $listTask->result()[0];
                    $this->load->model('Cong_viec');
                    $my_phong_ban = $this->Cong_viec->my_phong_ban($listTask->result());
                    echo '<tr>';
                    echo '<td><img src="' . base_url('upload/' . $myUserRow->avatar) . '" alt="">' . $myUserRow->hoten . '<span class="user-link user-subhead" >' . $my_phong_ban[0]. '</span></td>';
                    echo '<td class="setWidth concat"><div style="font-weight: 500; font-size: larger;">'.$data2[$i]->title.'</div></td>';
                    $dbdate = $data2[$i]->enddate;
                    $myDate = substr($dbdate,8,2).'/'.substr($dbdate,5,2).'/'.substr($dbdate,0,4);
                    echo '<td>'.$myDate.'</td>';
                if($data2[$i]->status==2) {
                    echo '<td >
<form class="form-inline" style="margin-top: 10px;">
  <div class="my2015 form-group" >
      <div class="input-group" >
          <input  value="'.$data2[$i]->phan_tram.'" type="number" step="10" min="0" max="100" style="width: 100px;" data-file="'.$data2[$i]->id.'" class="form-control"  >
          <div class="input-group-addon">%</div>
      </div>
        <div  class="progress" style="margin-top: 20px;">
            <div id = "'.$data2[$i]->id.'"   class=" progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="'.$data2[$i]->phan_tram.'" aria-valuemin="0" aria-valuemax="100" style="width:'.$data2[$i]->phan_tram.'%">'.$data2[$i]->phan_tram.'%
            </div>
        </div>
  </div>
</form>

                    </td>';
                }else{
                    echo '<td></td>';
                }

                    echo '<td>';
                    if($data2[$i]->status==1) {
                        echo '
                        <button data-lovely = "1" data-file=' . $data2[$i]->id . ' class="giaoviec btn btn-block btn-success"  data-love="type_1">Nhận việc</button>
                        <button data-lovely = "2"  data-file=' . $data2[$i]->id . ' class="giaoviec btn btn-block btn-danger"  data-love="type_1">Không nhận</button>
                        ';
                    }else{
                        echo '<button style="background-color:gray;" data-file=' . $data2[$i]->id . ' class="giaoviec mauButton  btn btn-block btn-success" data-love="type_2" id = "'."k".$data2[$i]->id.'"  disabled >Chưa hoàn thành</button>';
                    }
                    echo '</td>';
                echo '</tr>';
                }
                echo '</tbody>
            </table>
    </div>
</div>';
}
?>
</div>
<input type="text"  id="base_html" value="<?php echo base_url();?>" style="visibility: hidden;">
<script type="text/javascript">
    var mylink = document.getElementById('base_html').value;
    var linkUpdate = mylink+"admin/nhan_viec/updateCongViec";
    var link2 = mylink+"admin/nhan_viec";
    var status = 0;
    var myValue = 0;

    $(function() {

        var myProgressBar = $('.progress-bar');
        var myButton = $('.mauButton');
        var theSize = myProgressBar.size();
        for( var i = 0; i<theSize;i++){
            if($(myProgressBar[i]).attr('aria-valuenow')<30){
                $(myProgressBar[i]).css('background-color','red');
            }else if($(myProgressBar[i]).attr('aria-valuenow')<100){
                $(myProgressBar[i]).css('background-color','rgb(251,149,0)');
            }else{
                $(myProgressBar[i]).css('background-color','rgb(66,238,66)');
                $(myButton[i]).css('background-color','rgb(66,238,66)');
            }
        }


        var myID = $("input[value~='100']");//.size();
        var myVar = 0;
        for ( var i = 0; i<myID.size();i++){
            myVar = $(myID[i]).data('file');
            $('#k'+myVar).attr('disabled',false).html('Báo hoàn thành');
        }
    });


    $('.form-control').on('change keyup', function(e){
        var $this = $(this),
            id = $this.data('file');

        myValue = parseInt($(this).val());
        if (myValue> 100
            && e.keyCode != 46 // delete
            && e.keyCode != 8 // backspace
        ) {
            myValue = 100;
            e.preventDefault();
            $(this).val(100);

        }
            if(myValue <=20){
                $('#'+id).css({'width': myValue+'%' ,'background-color':'red'}).attr('aria-valuenow', myValue).html(myValue+"%");
                $('#k'+id).attr('disabled',true).html('Chưa hoàn thành').css('background-color','gray');
            }else if(myValue <= 90){
                $('#'+id).css({'width': myValue+'%' ,'background-color':'rgb(251,149,0)'}).attr('aria-valuenow', myValue).html(myValue+"%");
                $('#k'+id).attr('disabled',true).html('Chưa hoàn thành').css('background-color','gray');
            }else {
                $('#'+id).css({'width': myValue+'%' ,'background-color':'rgb(66,238,66)'}).attr('aria-valuenow', myValue).html(myValue+"%");
                $('#k'+id).attr('disabled',false).html('Báo hoàn thành').css('background-color','rgb(66,238,66)');
            }


        $.post(linkUpdate,
            { // Data Sending With Request To Server
                id:id,
                status:2,
                percent:myValue

            },
            function (response) {
            }
        );


    });

    $('.giaoviec').on("click",function(){
        var $this = $(this),
            type_button = $this.data('love'),id = $this.data('file');
        $('#agree').on("click",function(){
            status=2;
            $.post(linkUpdate,
                { // Data Sending With Request To Server
                    id:id,
                    percent:0,
                    status: status

                },
                function (response) {
                    alert(response);
                    window.location.href = link2;

                }
            );
        });
        $('#disagree').on("click",function(){
            status=0;
            $.post(linkUpdate,
                { // Data Sending With Request To Server
                    id:id,
                    percent:0,
                    status: status

                },
                function (response) {
                    window.location.href = link2;

                }
            );
        });

        if(type_button=="type_2"){
            status=3;
            $.post(linkUpdate,
                { // Data Sending With Request To Server
                    id:id,
                    percent:100,
                    status: status

                },
                function (response) {
                    window.location.href = link2;

                }
            );
        }else{
            var $this1 = $(this),
                type_button1 = $this1.data('lovely');
            if(type_button1==1){

                $('#fullCalModalSayYes').modal();

            }else{
                $('#fullCalModalSayNo').modal();

            }
        }

    });



</script>
