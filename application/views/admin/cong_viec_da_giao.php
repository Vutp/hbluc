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
<h3 class="page-header marTop"><i class="fa fa-file-o"></i> Công việc đã giao</h3>
<?php
if(count($data2)<=0){
    echo'<p style="color:red;">Không có công việc nào được giao</p>';
}
else{
    echo '
    <div class="Ying main-box no-header clearfix">
    <div class="main-box-body clearfix">
            <table class="Ying table user-list table-hover">
                <thead>
                <tr >
                    <th class="col-xs-2 col-sm-3">Người nhận </th>
                    <th class="col-xs-1 col-sm-3 ">Tên công việc</th>
                    <th class="col-xs-2 col-sm-2 ">Ngày kết thúc</th>
                    <th class="col-xs-2 col-sm-2 ">Trạng thái </th>
                    <th class="col-xs-1 col-sm-2" ><button id="deleteButton" class="btn btn-block btn-danger">Xoá hết công việc</button></th>
                </tr>
                </thead>
                <tbody>';
    $should_I_Hide = "nen";
    for($i = 0; $i<count($data2); $i++) {
        if($data2[$i]->status==0 || $data2[$i]->status==3 ){
            $should_I_Hide = "khong_nen";
        }
        $listTask = $this->db->where('ma_can_bo', $data2[$i]->ma_can_bo_nhan)->get('user');
        $myUserRow = $listTask->result()[0];
        $this->load->model('Cong_viec');
        $my_phong_ban = $this->Cong_viec->my_phong_ban($listTask->result());
        echo '<tr>';
        echo '<td><img src="' . base_url('upload/' . $myUserRow->avatar) . '" alt="">' . $myUserRow->hoten . '<span class="user-link user-subhead" >' . $my_phong_ban[0] . '</span></td>';
        echo '<td class="setWidth concat"><div class="myOtherFont">'.$data2[$i]->title.'</div></td>';
        $dbdate = $data2[$i]->enddate;
        $myDate = substr($dbdate,8,2).'/'.substr($dbdate,5,2).'/'.substr($dbdate,0,4);
        echo '<td><div class="myfont">'.$myDate.'</div></td>';
        echo '<td >';
            if ($data2[$i]->status == 1) {
                echo '<div class=" label label-primary myFont">Đang chờ xác nhận</div>';
                echo '</td>';
                echo '<td></td>';
            } else if ($data2[$i]->status == 2) {
                echo ' <div class="label label-info myFont">Đã hoàn thành '.$data2[$i]->phan_tram.' %</div>';
                echo '</td>';
                echo '<td></td>';
            } else if ($data2[$i]->status == 0) {
                echo '<div <div class="label label-danger myFont">Không được chấp nhận</div>';
                echo '</td>
                        <td class="text-center">';
                echo '<button value='.$data2[$i]->id.' class="giaoviec btn btn-danger" data-file="1">Xoá </button>';
                echo '</td>';
            }else if ($data2[$i]->status == 3) {
                echo '<div class="label la label-success myFont">Đã giải  quyết xong</div>';
                echo '</td>
                        <td class="text-center">';
                echo '<button value='.$data2[$i]->id.' class="giaoviec btn btn-danger" data-file="1">Xoá </button>';
                echo '</td>';
            }

        }

        echo '</tr>';
    echo '</tbody>
            </table>
    </div>
</div>';

}
?>


<div id="fullCalModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"  id="myModalLabel">Xác nhận </h4>
            </div><!--header-->
            <div class="modal-body">
                <p id="myTitle" value="something" data-hide="<?php echo $should_I_Hide; ?>" data-file="<?php echo $_SESSION['ma_can_bo']; ?>">Bạn có muốn xoá công việc này ? </p>
            </div>

            <div class="modal-footer">
                <button id="agree" type="button" class="btn btn-success" data-dismiss="modal" >Có</button>
                <button  type="button" class="btn btn-default" data-dismiss="modal">Không </button>
            </div>
        </div>
    </div>
</div><!--end modal-->
</div>
<input type="text"  id="base_html" value="<?php echo base_url();?>" style="visibility: hidden;">
<script type="text/javascript">
    var mylink = document.getElementById('base_html').value;
    var link1 = mylink+"admin/giao_viec/addCongViec";
    var link2 = mylink+"admin/viec_da_giao";
    var linkDelete = mylink+"admin/giao_viec/xoaCongViec";
    var linkDeleteAll = mylink+"admin/giao_viec/xoaTatCaTheoMaCanBo";
    var mscbNhan =0;


    $(function() {
       if($('#myTitle').data('hide')=="nen"){
           $('#deleteButton').attr('disabled',true);
       }else {
           $('#deleteButton').attr('disabled',false);
       }
    });
    $('.giaoviec').on("click",function(){
        $('#myTitle').html('Bạn có muốn xoá công việc này?').attr("value","one");//Delete one
        $('#fullCalModal').modal();
        id = $(this).attr("value");

    });

    $('#deleteButton').on("click",function(){
        $('#myTitle').html('Bạn có muốn xoá hết tất cả các công việc?').attr("value","all");//Delete one
        $('#fullCalModal').modal();
        mcb = $('#myTitle').data('file');

    });

    $("#agree").on("click",function() {

        if($('#myTitle').attr("value")=="one"){
            $.post(linkDelete,
                { // Data Sending With Request To Server
                    id:id

                },
                function () {
                    window.location.href = link2;

                }
            ) ;
        }else{
            $.post(linkDeleteAll,
                { // Data Sending With Request To Server
                    mcb:mcb

                },
                function () {
                    window.location.href = link2;

                }
            ) ;
        }



    });






</script>
