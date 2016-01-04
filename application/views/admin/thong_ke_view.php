
<?php //For initiation
$myDay = 0;
$myMonth = 0;
$myQuarter = 0;
$myYear = 0;
$myWeek = 0;
$luaChon = 0;
$myListDate = [];
$myDateOfWeekArray = [];
$quarter = 0;
$nam = 0;
$thangDaChon = 0;

function functionForSelectTag($str,$length){
    if(strlen($str) > $length ){
        $stringCut = substr($str,0,$length);
        $string = substr($stringCut, 0, strrpos($stringCut, ' '))."...";
        return $string;
    }else{
        return $str;
    }
}

?>


<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

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
    <h3 class="page-header marTop"><i class="fa fa-bar-chart-o"></i> Thống kê</h3>
        <div class="demo" id="demo-one">
            <nav class="subnav tabs">
                <ul>
                    <li ><a href="#panel-1">Theo ngày </a></li>
                    <li ><a href="#panel-2">Theo tuần</a></li>
                    <li ><a href="#panel-3">Theo tháng</a></li>
                    <li ><a href="#panel-4">Theo quý </a></li>
                    <li ><a href="#panel-5">Theo năm </a></li>
                </ul>
            </nav><!--end nav-->
            <div class="panel" id="panel-1">
                <input type="hidden" id="phpVarDay" value="<?php echo $myDay; ?>">
                <form class="container-fluid" action="<?php echo base_url('admin/thong_ke/day_filter') ?>" method="post">
                    <div class="row">

                        <div class="col-xs-6  setTop col-sm-3 ">
                            <input class="form-control" readonly type="text" id ="datepicker1" name="datepicker1" placeholder="Từ ngày">
                        </div>

                        <div class="col-xs-6 setTop col-sm-3">
                            <input class="form-control" readonly type="text" id ="datepicker2" name="datepicker2" placeholder="Đến ngày">
                        </div>

                        <div class="kiet  setTop col-xs-6  col-sm-4 ">

                            <li> <input type="text" id="yahooday"  class=" form-control" name="searchq" placeholder="Tìm thủ tục... " onkeyup="searchday();" ></li>
                            <li id="outputday" class="wrapper-dropdown">

                            </li>

                            <input type="text" name="luachon" id="yunday" style="visibility: hidden;">
                            <input type="text"  id="base_html" value="<?php echo base_url();?>" style="visibility: hidden;">

                        </div>
                        <div class=" col-xs-6 setTop col-sm-2 ">
                            <input class=" btn btn-info" type="submit" value="Xem thông tin" data-style="btn-primary"  >
                        </div>
                        </div>

                </form>
            </div><!-- .panel-1-Ngay-->
            <div class="panel" id="panel-2">
                <input type="hidden" id="phpVarWeek" value="<?php echo $myWeek; ?>">
                <form class="container-fluid" action="<?php echo base_url('admin/thong_ke/week_filter') ?>" method="post">
                    <div class="row">
                        <div class="col-xs-6 setTop col-sm-3" >
                            <input  class="form-control" readonly type="text" id ="datepickerWeek" name="weekName" placeholder="Chọn ngày trong tuần " >
                        </div>

                        <div class="kiet setTop col-xs-7 col-sm-offset-3 col-sm-4">

                            <li> <input type="text" id="yahooweek" class="form-control" name="searchweeks" placeholder="Tìm thủ tục..." onkeyup="searchweek();"></li>
                            <li id="outputweek" class="wrapper-dropdown"></li>
                            <input type="text" name="luachon" id="yunweek" style="visibility: hidden;">

                        </div>

                        <div class="col-xs-5 setTop col-sm-2">
                            <input class=" btn btn-info" type="submit" value="Xem thông tin" data-style="btn-primary"  >
                        </div>

                    </div>

                </form>
            </div><!-- End panel-2-Tuan -->
            <div class="panel" id="panel-3">
                <input type="hidden" id="phpVarMonth" value="<?php echo $myMonth; ?>">
                <form class="container-fluid" action="<?php echo base_url('admin/thong_ke/month_filter') ?>" method="post">
                    <div class="row">
                        <div class="col-xs-6 setTop col-sm-3">
                            <select name="thangName" class="selectpicker form-control " data-style="btn-success rm-relish " >
                                <option value='#'>Chọn tháng</option>
                                <option value='01'>Tháng 1</option>
                                <option value='02'>Tháng 2</option>
                                <option value='03'>Tháng 3</option>
                                <option value='04'>Tháng 4</option>
                                <option value='05'>Tháng 5</option>
                                <option value='06'>Tháng 6</option>
                                <option value='07'>Tháng 7</option>
                                <option value='08'>Tháng 8</option>
                                <option value='09'>Tháng 9</option>
                                <option value='10'>Tháng 10</option>
                                <option value='11'>Tháng 11</option>
                                <option value='12'>Tháng 12</option>
                            </select>
                        </div>
                        <div class="col-xs-3  setTop col-sm-2 ">
                            <input  class="form-control"   id ="myYearMonth" name="yearName" type="number" min="2015" step="1" value="2015" >
                        </div>
                        <div class="kiet col-xs-6 setTop col-sm-offset-1 col-sm-4">

                            <li><input type="text" id="yahoomonth" class="form-control" name="searchmonths" placeholder="Tìm thủ tục..." onkeyup="searchmonth();"></li>
                            <li id="outputmonth" class="wrapper-dropdown"></li>
                            <input type="text" name="luachon" id="yunmonth" style="visibility: hidden;">
                        </div>

                        <div class="col-xs-6 setTop col-sm-2 ">
                            <input class=" btn btn-info" type="submit" value="Xem thông tin" data-style="btn-primary"  >
                        </div>
                    </div>
                </form>
            </div><!-- end panel-3Thang-->
            <div class="panel" id="panel-4">
                <input type="hidden" id="phpVarQuarter" value="<?php echo $myQuarter; ?>">
                <form class="container-fluid" action="<?php echo base_url('admin/thong_ke/quarter_filter') ?>" method="post">
                    <div class="row">
                        <div class="col-xs-6 setTop col-sm-3">
                            <select name="quarter" class="selectpicker form-control "  data-style="btn-success rm-relish " >
                                <option value=''>Chọn quý </option>
                                <option value='1'>Quý I</option>
                                <option value='2'>Quý II</option>
                                <option value='3'>Quý III</option>
                                <option value='4'>Quý IV</option>
                            </select>
                        </div>
                        <div class="col-xs-3 setTop col-sm-2 ">
                            <input  class="form-control"   id ="myYearQuarter" name="yearQuarter" type="number" min="2015" step="1" value="2015" >
                        </div>
                        <div class="kiet col-xs-6 setTop col-sm-offset-1 col-sm-4 ">

                            <li><input type="text" id="yahooquarter" class="form-control" name="searchquarters" placeholder="Tìm thủ tục..." onkeyup="searchquarter();"></li>
                            <li id="outputquarter" class="wrapper-dropdown"></li>
                            <input type="text" name="luachon" id="yunquarter" style="visibility: hidden;">

                        </div>

                        <div class="col-xs-6 setTop col-sm-2 ">
                            <input class=" btn btn-info" type="submit" value="Xem thông tin" data-style="btn-primary"  >
                        </div>

                    </div>

                </form>

            </div><!-- end panel-4-Quy -->
            <div class="panel" id="panel-5"><!-- .panel-4 -->

                <input type="hidden" id="phpVarYear" value="<?php echo $myYear; ?>">

                <form  action="<?php echo base_url('admin/thong_ke/year_filter') ?>" method="post">
                    <div class="container-fluid">
                        <div class="row">
                            <div class=" col-xs-3 setTop col-sm-2 ">
                                <input  class="form-control"   id ="myYear" name="year"  type="number" min="2015" step="1" value="2015" >
                            </div>
                            <div class="kiet col-xs-5 setTop col-sm-4 col-sm-offset-4 ">
                                <li><input type="text" id="yahooyear" class="form-control" name="searchyears" placeholder="Tìm thủ tục..." onkeyup="searchyear();"></li>
                                <li id="outputyear" class="wrapper-dropdown"></li>
                                <input type="text" name="luachon" id="yunyear" style="visibility: hidden;">
                            </div>
                            <div class="col-xs-2 setTop">
                                <input class=" btn btn-info" type="submit" value="Xem thông tin" data-style="btn-primary"  >
                            </div>
                        </div>

                </form>

            </div><!--end panel 5-Nam-->

        </div><!--end Demo-->
    </div><!--end body-->

<?php

if (isset($tuNgay)){
    $myDay = 1;
    $myMonth = 0;
    $myQuarter = 0;
    $myYear = 0;
    $myWeek = 0;
    $myListDate = $myListDateCaseDay;
    $luaChon = $luaChonCaseDay;
}

if(isset($tuanDaChon)){
    $myDay = 0;
    $myMonth = 0;
    $myQuarter = 0;
    $myYear = 0;
    $myWeek = 1;
    $myDateOfWeekArray = $myDateOfWeekArrayCaseWeek;
    $luaChon = $luaChonCaseWeek;
    echo '<input type="text" id="myWeekLove" style="visibility: hidden" value = "1">';
}

if (isset($monthSet)){

    $myDay = 0;
    $myMonth = 1;
    $myQuarter = 0;
    $myYear = 0;
    $myWeek = 0;
    $thangDaChon = $thangDaChonCaseMonth;
    $luaChon = $luaChonCaseMonth;
    $nam = $namCaseMonth;
    echo '<input type="text" id="myMonthLove" style="visibility: hidden" value = "1">';
}

if(isset($quarterSet)){
    $myDay = 0;
    $myMonth = 0;
    $myQuarter = 1;
    $myYear = 0;
    $myWeek = 0;
    $quarter = $quarterCaseQuarter;
    $luaChon = $luaChonCaseQuarter;
    $nam   = $namCaseQuarter;
    echo '<input type="text" id="myQuarterLove" style="visibility: hidden" value = "1">';
}

if(isset($yearSet)){
    $myDay = 0;
    $myMonth = 0;
    $myQuarter = 0;
    $myYear = 1;
    $myWeek = 0;
    $nam = $namCaseYear;
    $luaChon = $luaChonCaseYear;
    echo '<input type="text" id="myYearLove" style="visibility: hidden" value = "1">';
}

/*Conditions*/

function dieuKienCoLuaChon($data2,$i,$luaChon){
    $luaChon = (int)($luaChon);
    $myString = (int)(substr($data2[$i]->mshs, 16, 2));
    return ($luaChon == $myString);
}
function showContentOfTable($data2,$i,$k){
    echo '<tr>
                      <td>' . $k . '</td>
                                <td><a href="'.base_url().'admin/xem_ho_so/details/'.$data2[$i]->id.'"><h5 class="truncate">'.$data2[$i]->mshs.' </h5></a></td>
                                <td>' . $data2[$i]->name . '</td>
                                <td>' . $data2[$i]->cmnd . '</td>
                                <td> ' . $data2[$i]->tien_thu . ' </td>

                            </tr>';

}
function dieuKienChoThongKeNgay($data2,$i,$myTempVarDateString){

    return substr($data2[$i]->mshs, 7, 6) == $myTempVarDateString;
}
function dieuKienChoThongKeTuan($data2,$i,$j,$myDateOfWeekArray){
    return substr($data2[$i]->mshs, 7, 6) == $myDateOfWeekArray[$j];
}
function dieuKienChoThongKeThang($data2,$i,$thangDaChon,$nam){
    return substr($data2[$i]->mshs, 9, 4) == $thangDaChon.$nam;
}
function dieuKienChoThongKeQuy($data2,$i,$nam,$quarter){

    return (
        ((substr($data2[$i]->mshs, 9, 2) == "01" ||substr($data2[$i]->mshs, 9, 2) == "02"||substr($data2[$i]->mshs, 9, 2) == "03" )
            &&(substr($data2[$i]->mshs, 11, 2)==$nam)
            &&$quarter==1)
        ||
        ((substr($data2[$i]->mshs, 9, 2) == "04" ||substr($data2[$i]->mshs, 9, 2) == "05"||substr($data2[$i]->mshs, 9, 2) == "06" )
            &&(substr($data2[$i]->mshs, 11, 2)==$nam)
            &&$quarter==2)
        ||
        ((substr($data2[$i]->mshs, 9, 2) == "07" ||substr($data2[$i]->mshs, 9, 2) == "08"||substr($data2[$i]->mshs, 9, 2) == "09" )
            &&(substr($data2[$i]->mshs, 11, 2)==$nam)
            &&$quarter==3)
        ||
        ((substr($data2[$i]->mshs, 9, 2) == "10" ||substr($data2[$i]->mshs, 9, 2) == "11"||substr($data2[$i]->mshs, 9, 2) == "12" )
            &&(substr($data2[$i]->mshs, 11, 2)==$nam)
            &&$quarter==4));
}
function dieuKienChoThongKeNam($data2,$i,$nam){

    return substr($data2[$i]->mshs, 11, 2) == $nam;
}
$tempForShowingCondion = 0;
$tongSoTienThuDuoc = 0;

//Calculations

for ($i = 0; $i < count($data2); $i++) {
    if ($luaChon == 'all') {
        if (isset($tuNgay)) {
            for ($j = 0; $j < count($myListDate); $j++) {
                $myTempVarDateString = substr($myListDate[$j], 0, 2) . substr($myListDate[$j], 3, 2) . substr($myListDate[$j], 8, 2);
                if (dieuKienChoThongKeNgay($data2, $i, $myTempVarDateString)) {
                    $tongSoTienThuDuoc = $tongSoTienThuDuoc + $data2[$i]->tien_thu;
                    $tempForShowingCondion++;
                }
            }
        }
        if (isset($tuanDaChon)) {
            for ($j = 0; $j < count($myDateOfWeekArray); $j++) {
                if (
                    dieuKienChoThongKeTuan($data2, $i, $j, $myDateOfWeekArray)
                ) {
                    $tongSoTienThuDuoc = $tongSoTienThuDuoc + $data2[$i]->tien_thu;
                    $tempForShowingCondion++;
                }
            }
        }
        if (isset($monthSet)) {
            if (dieuKienChoThongKeThang($data2, $i, $thangDaChon, $nam)
            ) {
                $tongSoTienThuDuoc = $tongSoTienThuDuoc + $data2[$i]->tien_thu;
                $tempForShowingCondion++;
            }
        }
        if (isset($quarterSet)) {
            if (dieuKienChoThongKeQuy($data2, $i, $nam, $quarter)
            ) {
                $tongSoTienThuDuoc = $tongSoTienThuDuoc + $data2[$i]->tien_thu;
                $tempForShowingCondion++;
            }

        }
        if (isset($yearSet)) {
            if (dieuKienChoThongKeNam($data2, $i, $nam)
            ) {
                $tongSoTienThuDuoc = $tongSoTienThuDuoc + $data2[$i]->tien_thu;
                $tempForShowingCondion++;
            }

        }
    } else {
        //TODO-Else
            if (isset($tuNgay)) {
                for ($j = 0; $j < count($myListDate); $j++) {
                    $myTempVarDateString = substr($myListDate[$j], 0, 2) . substr($myListDate[$j], 3, 2) . substr($myListDate[$j], 8, 2);
                    if (
                        dieuKienChoThongKeNgay($data2, $i, $myTempVarDateString) && dieuKienCoLuaChon($data2, $i, $luaChon)
                    ) {
                        $tongSoTienThuDuoc = $tongSoTienThuDuoc + $data2[$i]->tien_thu;
                        $tempForShowingCondion++;
                    }
                }
            }
            if (isset($tuanDaChon)) {
                for ($j = 0; $j < count($myDateOfWeekArray); $j++) {
                    if (
                        dieuKienChoThongKeTuan($data2, $i, $j, $myDateOfWeekArray) && dieuKienCoLuaChon($data2, $i, $luaChon)
                    ) {
                        $tongSoTienThuDuoc = $tongSoTienThuDuoc + $data2[$i]->tien_thu;
                        $tempForShowingCondion++;
                    }
                }

            }
            if (isset($monthSet)) {
                if (dieuKienChoThongKeThang($data2, $i, $thangDaChon, $nam) && dieuKienCoLuaChon($data2, $i, $luaChon)
                ) {
                    $tongSoTienThuDuoc = $tongSoTienThuDuoc + $data2[$i]->tien_thu;
                    $tempForShowingCondion++;
                }
            }
            if (isset($quarterSet)) {
                if (dieuKienChoThongKeQuy($data2, $i, $nam, $quarter) && dieuKienCoLuaChon($data2, $i, $luaChon)
                ) {
                    $tongSoTienThuDuoc = $tongSoTienThuDuoc + $data2[$i]->tien_thu;
                    $tempForShowingCondion++;
                }

            }
            if (isset($yearSet)) {
                if (dieuKienChoThongKeNam($data2, $i, $nam) && dieuKienCoLuaChon($data2, $i, $luaChon)) {
                    $tongSoTienThuDuoc = $tongSoTienThuDuoc + $data2[$i]->tien_thu;
                    $tempForShowingCondion++;
                }
            }
        }
}


//Show table

if($tempForShowingCondion==0){
    echo'<p style="color: red;font-style: italic ">Không có hồ sơ nào</p>';
} else {

    echo '<table id="myTable" class="table table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>MSHS</th>
                        <th>Tên</th>
                        <th>CMND</th>
                        <th>Tiền đã thu</th>
                    </tr>
                    </thead>
                    <tbody>';

    $k = 1;

    for ($i = 0; $i < count($data2); $i++) {
        if ($luaChon == 'all') {

            //TODO

            if (isset($tuNgay)) {
                $myDay = 1;
                for ($j = 0; $j < count($myListDate); $j++) {
                    $myTempVarDateString = substr($myListDate[$j], 0, 2) . substr($myListDate[$j], 3, 2) . substr($myListDate[$j], 8, 2);
                    if (dieuKienChoThongKeNgay($data2, $i, $myTempVarDateString)
                    ) {
                        showContentOfTable($data2, $i, $k);
                        $k = $k + 1;
                    }
                }
            }

            if (isset($tuanDaChon)) {
                for ($j = 0; $j < count($myDateOfWeekArray); $j++) {
                    if (dieuKienChoThongKeTuan($data2, $i, $j, $myDateOfWeekArray)
                    ) {
                        showContentOfTable($data2, $i, $k);
                        $k++;
                    }
                }
            }

            if (isset($monthSet)) {
                if (dieuKienChoThongKeThang($data2, $i, $thangDaChon, $nam)
                ) {
                    showContentOfTable($data2, $i, $k);
                    $k++;
                }
            }

            if (isset($quarterSet)) {
                if (dieuKienChoThongKeQuy($data2, $i, $nam, $quarter)
                ) {
                    showContentOfTable($data2, $i, $k);
                    $k++;
                }

            }

            if (isset($yearSet)) {
                if (dieuKienChoThongKeNam($data2, $i, $nam)
                ) {
                    showContentOfTable($data2, $i, $k);
                    $k++;
                }

            }

        } else {
            //TODO
            if (isset($tuNgay)) {
                for ($j = 0; $j < count($myListDate); $j++) {
                    $myTempVarDateString = substr($myListDate[$j], 0, 2) . substr($myListDate[$j], 3, 2) . substr($myListDate[$j], 8, 2);
                    if (dieuKienChoThongKeNgay($data2, $i, $myTempVarDateString) && dieuKienCoLuaChon($data2, $i, $luaChon)
                    ) {
                        showContentOfTable($data2, $i, $k);
                        $k = $k + 1;
                    }
                }
            }

            if (isset($tuanDaChon)) {
                for ($j = 0; $j < count($myDateOfWeekArray); $j++) {
                    if (dieuKienChoThongKeTuan($data2, $i, $j, $myDateOfWeekArray) && dieuKienCoLuaChon($data2, $i, $luaChon)
                    ) {
                        showContentOfTable($data2, $i, $k);
                        $k = $k + 1;
                    }
                }

            }

            if (isset($monthSet)) {
                if (dieuKienChoThongKeThang($data2, $i, $thangDaChon, $nam) && dieuKienCoLuaChon($data2, $i, $luaChon)
                ) {
                    showContentOfTable($data2, $i, $k);
                    $k = $k + 1;
                }
            }

            if (isset($quarterSet)) {
                if (dieuKienChoThongKeQuy($data2, $i, $nam, $quarter) && dieuKienCoLuaChon($data2, $i, $luaChon)
                ) {
                    showContentOfTable($data2, $i, $k);
                    $k = $k + 1;
                }

            }

            if (isset($yearSet)) {
                if (dieuKienChoThongKeNam($data2, $i, $nam) && dieuKienCoLuaChon($data2, $i, $luaChon)
                ) {
                    showContentOfTable($data2, $i, $k);
                    $k = $k + 1;
                }

            }

        }
    }

    //For the same purpose

    echo '<tr>
                                  <td colspan="3"></td>
                                  <td><b><em>Tổng tiền:</em></b></td>
                                  <td><b style="font-style: italic; color: red" >' . number_format($tongSoTienThuDuoc, 0, ',', '.') . '  <b><em>đồng</em></b></b></td>
                              </tr>';

    echo '</tbody></table>';
}

?>


<script type="text/javascript">

    var myTable = $('#myTable');

    $('#outputday').on('click',"a", function() {
        var txt = $(this).text();
        document.getElementById("yahooday").value = txt;
        document.getElementById("yunday").value = $(this).attr('href');
        if ( ! $('#outputday').is(':focus') ) {
            $('#outputday').addClass('hiddenClass');
        }
        $('#yahooday').on("focus",function(){
            $('#outputday').removeClass('hiddenClass');
            $(this).val("");
            $('.lo').remove();
        });

    });

    $('#outputweek').on('click',"a", function() {
        var txt = $(this).text();
        document.getElementById("yahooweek").value = txt;
        document.getElementById("yunweek").value = $(this).attr('href');
        if ( ! $('#outputweek').is(':focus') ) {
            $('#outputweek').addClass('hiddenClass');
        }

        $('#yahooweek').on("focus",function(){
            $('#outputweek').removeClass('hiddenClass');
            $(this).val("");
            $('.lo').remove();
        });

    });

    $('#outputmonth').on('click',"a", function() {
        var txt = $(this).text();
        document.getElementById("yahoomonth").value = txt;
        document.getElementById("yunmonth").value = $(this).attr('href');
        if ( ! $('#outputmonth').is(':focus') ) {
            $('#outputmonth').addClass('hiddenClass');
        }

        $('#yahoomonth').on("focus",function(){
            $('#outputmonth').removeClass('hiddenClass');
            $(this).val("");
            $('.lo').remove();
        });

    });
    $('#outputquarter').on('click',"a", function() {
        var txt = $(this).text();
        document.getElementById("yahooquarter").value = txt;
        document.getElementById("yunquarter").value = $(this).attr('href');
        if ( ! $('#outputquarter').is(':focus') ) {
            $('#outputquarter').addClass('hiddenClass');
        }

        $('#yahooquarter').on("focus",function(){
            $('#outputquarter').removeClass('hiddenClass');
            $(this).val("");
            $('.lo').remove();
        });

    });
    $('#outputyear').on('click',"a", function() {
        var txt = $(this).text();
        document.getElementById("yahooyear").value = txt;
        document.getElementById("yunyear").value = $(this).attr('href');
        if ( ! $('#outputyear').is(':focus') ) {
            $('#outputyear').addClass('hiddenClass');
        }

        $('#yahooyear').on("focus",function(){
            $('#outputyear').removeClass('hiddenClass');
            $(this).val("");
            $('.lo').remove();
        });

    });

    $('#yahooday').on("keydown",function() {
        myTable.addClass('hiddenClass');
    });
    $('#yahooweek').on("keydown",function() {
        myTable.addClass('hiddenClass');
    });
    $('#yahoomonth').on("keydown",function() {
        myTable.addClass('hiddenClass');
    });

    $('#yahooquarter').on("keydown",function() {
        myTable.addClass('hiddenClass');
    });

    $('#yahooyear').on("keydown",function() {
        myTable.addClass('hiddenClass');
    });


    var mylink = document.getElementById('base_html').value;
    var link = mylink+"admin/thong_ke/search";

    function searchday(){
        var searchTxt = $("input[name='searchq']").val();

     $.post(link,
            { // Data Sending With Request To Server
                searchVal:searchTxt
            },
            function(response){ // Required Callback Function
                $("#outputday").html(response);
            });
    }
    function searchweek(){
        var searchTxt = $("input[name='searchweeks']").val();

        $.post(link,
            { // Data Sending With Request To Server
                searchVal:searchTxt
            },
            function(response){ // Required Callback Function
                $("#outputweek").html(response);
            });
    }
    function searchmonth(){
        var searchTxt = $("input[name='searchmonths']").val();

        $.post(link,
            { // Data Sending With Request To Server
                searchVal:searchTxt
            },
            function(response){ // Required Callback Function
                $("#outputmonth").html(response);
            });
    }
    function searchquarter(){

        var searchTxt = $("input[name='searchquarters']").val();

        $.post(link,
            { // Data Sending With Request To Server
                searchVal:searchTxt
            },
            function(response){ // Required Callback Function
                $("#outputquarter").html(response);
            });
    }
    function searchyear(){
        var searchTxt = $("input[name='searchyears']").val();
        $.post(link,
            { // Data Sending With Request To Server
                searchVal:searchTxt
            },
            function(response){ // Required Callback Function
                $("#outputyear").html(response);
            });
    }

    $(function() {
        $("#datepicker1").datepicker();
        $("#datepicker2").datepicker();
        $("#datepickerWeek").datepicker();
    });

    (function($) {

        $(document).ready(function() {
            $('.demo').each(function() {

                var tabs = $(this).find('.tabs a'),
                    panels = $(this).find('.panel').hide();
                $(".tabs li:eq(0)").addClass("active").show(); //Activate second tab
                $(".panel:eq(0)").show(); //Show second tab content

                if($('#phpVarDay').val()==1){
                    tabs.parent().removeClass('active');
                    $(".tabs li:eq(0)").addClass("active").show(); //Activate second tab
                    $(".panel:eq(0)").show();

                }

                if($('#phpVarWeek').val()==1||$('#myWeekLove').val()==1){

                    tabs.parent().removeClass('active');
                    $(".panel:eq(0)").hide();
                    $(".tabs li:eq(1)").addClass("active").show(); //Activate second tab
                    $(".panel:eq(1)").show();

                }

                if($('#phpVarMonth').val()==1||$('#myMonthLove').val()==1){

                    tabs.parent().removeClass('active');
                    // Toggle active class
                    $(".panel:eq(0)").hide();

                    //$(this).parent().addClass('active');
                    $(".tabs li:eq(2)").addClass("active").show(); //Activate second tab
                    $(".panel:eq(2)").show();

                }

                if($('#phpVarQuarter').val()==1||$('#myQuarterLove').val()==1){

                    tabs.parent().removeClass('active');
                    // Toggle active class
                    $(".panel:eq(0)").hide();

                    //$(this).parent().addClass('active');
                    $(".tabs li:eq(3)").addClass("active").show(); //Activate second tab
                    $(".panel:eq(3)").show();

                }

                if($('#phpVarYear').val()==1||$('#myYearLove').val()==1){

                    tabs.parent().removeClass('active');
                    // Toggle active class
                    $(".panel:eq(0)").hide();

                    //$(this).parent().addClass('active');
                    $(".tabs li:eq(4)").addClass("active").show(); //Activate second tab
                    $(".panel:eq(4)").show();

                }

                tabs.click(function() {
                    var active = $(this).attr("href");
                    //Something with the table
                    // Toggle active class
                    tabs.parent().removeClass('active');
                    $(this).parent().addClass('active');

                    // Toggle selected panel
                    panels.hide();
                    myTable.hide();
                    $(active).show();

                    // Prevent default behavior
                    return false;
                });
            });
        });

    })(jQuery);
</script>




