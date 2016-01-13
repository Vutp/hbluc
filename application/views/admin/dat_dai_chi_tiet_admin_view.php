<div class="col-lg-12">
    <ol class="breadcrumb">
        <li class="cursor back">
            <i class="fa fa-arrow-left"></i>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Trang chủ</a>
        </li>
        <li>
            <a href="<?php echo base_url('dat_dai'); ?>"><i class="fa fa-files-o"></i> Hành chính trong lĩnh vực đất đai</a>
        </li>
    </ol>
    <h3 class="page-header marTop"><i class="fa fa-file-o"></i> <?php echo html_escape($node_map->node_name); ?></h3>

    <script>
        var k = <?php echo json_encode(base_url()); ?>;
        var today_1 = <?php echo json_encode(date("His",time()+1)); ?>;
        var today_2 = <?php echo json_encode(date("dmy")); ?>;
        var so_ngay = <?php echo json_encode(""); ?>;
        var node_id = <?php echo json_encode($node_map->node_id); ?>;

    </script>
    <?php
    $today_1 =  date("Ymd");
    //Lấy dữ liệu từ $thanh_phan_data truyen qua de dung cho viec ho so dinh kem
    $arrayThutuc = explode("+", $thanh_phan_data);
    if(isset($message)){

        echo "<script type='text/javascript'>alert('Thông tin đã được nhập!'); window.location = k;</script>";

    }
    ?>
            <form class="form-horizontal"  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h4 class="panel-title">Thông tin của người làm hồ sơ </h4>
                    </div>
                    <div class="container-fluid panel-body">
                        <div class="row">
                            <div class="col-sm-offset-1 col col-xs-3 col-sm-2">
                                <div class="row">
                                    <div class="col-sm-10 col-sm-offset-2">
                                        <label>Họ và tên</label>
                                    </div>
                                </div>

                            </div>
                            <div class="col-xs-5 col-sm-4">
                                <input class="form-control" id="dname" type="text" name="dname">
                            </div>

                            <div class="col-xs-4 col-sm-5">
                                <div class="error">* <?php echo form_error('dname'); ?><br ></div>
                            </div>
                        </div>
                        <div class="row setTop">
                            <div class="col-sm-offset-1 col col-xs-3 col-sm-2">
                                <div class="row">
                                    <div class="col-sm-10 col-sm-offset-2">
                                        <label>Số CMND</label>
                                    </div>
                                </div>

                            </div>
                            <div class="col-xs-5 col-sm-4">
                                <input  class="form-control" id="inputCMND" type="text" name="dcmnd" >
                            </div>

                            <div class="col-xs-4 col-sm-5">
                                <div class="error">* <?php echo form_error('dcmnd'); ?></div>
                            </div>
                        </div>


                        <!--So dien thoai -->
                        <div class="row setTop">
                            <div class="col-sm-offset-1 col col-xs-3 col-sm-2">
                                <div class="row">
                                    <div class="col-sm-10 col-sm-offset-2">
                                        <label>Số điện thoại </label>
                                    </div>
                                </div>

                            </div>
                            <div class="col-xs-5 col-sm-4">
                                <input class="form-control" id="inputPhone" type="text" name="dmobile" >
                            </div>

                            <div class="col-xs-4 col-sm-5">
                                <div class="error">* <?php echo form_error('dmobile'); ?></div>
                            </div>
                        </div>



                        <!-- Dia chi-->

                        <div class="row setTop">
                            <div class="col-sm-offset-1 col col-xs-3 col-sm-2">
                                <div class="row">
                                    <div class="col-sm-10 col-sm-offset-2">
                                        <label>Địa chỉ </label>
                                    </div>
                                </div>

                            </div>
                            <div class="col-xs-5 col-sm-4">
                                <input class="form-control"  type="text" name="diachi" >
                            </div>
                        </div>

                        <!--So ngay-->

                        <div class="row setTop">
                            <div class="col-sm-offset-1 col col-xs-3 col-sm-2">
                                <div class="row">
                                    <div class="col-sm-10 col-sm-offset-2">
                                        <label>Số ngày giải quyết </label>
                                    </div>
                                </div>

                            </div>
                            <div class="col-xs-2 col-sm-1">
                                <input class="form-control" style="width: 65px;" size="1" id="songay" onchange="doMacBookProCaseChange()" onkeyup="doMacBookPro()" type="number" min="0" name="songay" >
                            </div>

                            <div class="col-xs-4 col-sm-5">
                                <div><span class="error">* <?php echo form_error('songay'); ?></span></div>
                            </div>
                        </div>

                        <div class="row setTop">
                            <div class="col-sm-offset-1 col col-xs-3 col-sm-2">
                                <div class="row">
                                    <div class="col-sm-10 col-sm-offset-2">
                                        <label>Ngày trả dự kiến </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-6 ">
                                <label id="time_info"></label>
                            </div>
                        </div>
                        <!-- For saving purpose-->
                        <input type="text" id="ma_Ho_So" name="ma_Ho_So" style="visibility: hidden" >
                    </div><!--Panel body-->
                </div>

                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h4 class="panel-title">Giấy tờ kèm theo</h4>
                    </div>
                    <div class="panel-body">

                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th><input id="yingcheckbox" type="checkbox"  onclick="checkbox();" ></th>
                                <th>Loại giấy tờ </th>
                                <th>Số lượng </th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php for ($i = 1; $i <= count($arrayThutuc); $i+=1) { ?>
                                <?php if ($i < count($arrayThutuc)) {?>

                                    <?php
                                    $checkBox = "chk".$i;
                                    $number = "myNumber".$i;
                                    ?>
                                    <tr id="2015">
                                        <td class=" col-xs-1"><input class="lovecheckbox"type="checkbox"  name="chk_group" id= <?php echo $checkBox?> onclick="display(<?php echo $i ?>)" value="<?php echo $arrayThutuc[$i];?>"></td>
                                        <td class="col-xs-9"><label style="font-weight: normal;"><?php echo $arrayThutuc[$i]?></label></td>
                                        <td class="col-xs-1"><input style="width: 65px;" class=" lovetextbox form-control"  id = <?php echo $number ?> type="number" min="0" onkeyup="forIndividualCase(<?php echo $i ?>)" onchange="forIndividualCaseChanged(<?php echo $i ?>)"  step="1" value="0" size="1"></td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>

                            </tbody>

                        </table>
                    </div>
                </div>

                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h4 class="panel-title">Ghi chú đính kèm   </h4>
                    </div>
                    <div class="panel-body">
                        <textarea class="form-control"   name="note" ></textarea>
                        <!--List of temporary textboxs-->
                        <input type="text" id="ying_ho_so_da_nhan" name = "dying" style="visibility: hidden" >


                        <!-- <input type="checkbox" onclick="myCheckboxFunction();"> -->
                        <input type="submit"  onclick="compileInputs();" class="btn btn-success btn-lg btn-block" id = 'submit'name="submit" value="Nhập hồ sơ">
                    </div>
                </div>
            </form>
    </div>
<script>

    var string_1 = "DD";
    var theLifeOfWolf = 0;
    var theLifeOfYing = 0;

    var songayJquery = $('#songay');
    songayJquery.val(so_ngay);

    if (node_id > 1) {
        theLifeOfWolf = node_id - 1;
        if (theLifeOfWolf < 10) {
            theLifeOfYing = "0" + theLifeOfWolf;
        } else {
            theLifeOfYing = theLifeOfWolf;
        }
    }
    var theString = today_1 + "-" + today_2 + "-" + string_1 + theLifeOfYing + "-";
    var addCode = songayJquery.val();
    addCode = parseInt(addCode);

    theString = theString + addCode;
    var ma_Ho_So_Jquey = $('#ma_Ho_So');
    ma_Ho_So_Jquey.val(theString);



    var myDayVar = songayJquery.val();

    var myDate = new Date();

    var ngayTra = new Date(myDate.getTime() + myDayVar * 24 * 3600 * 1000);

    var dd = (ngayTra.getDate() < 10 ? '0' : '') + ngayTra.getDate();
    var MM = ((ngayTra.getMonth() + 1) < 10 ? '0' : '') + (ngayTra.getMonth() + 1);
    var yyyy = ngayTra.getFullYear();
    var thu = ngayTra.getDay();
    var weekday;

    switch (thu) {
        case 1:
            weekday = 'Thứ hai';
            break;
        case 2:
            weekday = 'Thứ ba';
            break;
        case 3:
            weekday = 'Thứ tư';
            break;
        case 4:
            weekday = 'Thứ năm';
            break;
        case 5:
            weekday = 'Thứ sáu';
            break;
        case 6:
            weekday = 'Thứ bảy';
            break;
        default:
            weekday = 'Chủ nhật';
            break;
    }

    var myTimeString = weekday + ", Ngày " + dd + " Tháng " + MM + " Năm " + yyyy;
    if (myDayVar == "") {
        document.getElementById("time_info").innerHTML = "";
    } else {
        var time_info = $('#time_info');
        if (thu == 0 || thu == 6) {
            document.getElementById("time_info").innerHTML = myTimeString;
            time_info.removeClass('anotherClass');
            time_info.addClass('myClass');
        } else {
            document.getElementById("time_info").innerHTML = myTimeString;
            time_info.removeClass('myClass');
            time_info.addClass('anotherClass');
        }
    }
    //OK


</script>