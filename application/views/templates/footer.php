
</div><!-- /.row -->

</div><!-- /#page-wrapper -->
</div><!-- /#wrapper -->

<footer class="footer">
  <div class="container">
    <div class="text-muted">
        <small>
            <p><strong>Chịu trách nhiệm chính:</strong> Ông Nguyễn Thành Nhân - Phó Chủ tịch Ủy ban nhân dân huyện Bến Lức</p>
            <p><strong>Địa chỉ:</strong> Số 213 QL1A Khu phố 3, Thị trấn Bến Lức, huyện Bến Lức, tỉnh Long An - <strong>Điện thoại:</strong> (072) 3871201 - <strong>Fax:</strong> (072) 3872223 - <strong>Email:</strong> benluc@longan.gov.vn - <strong>Ban biên tập:</strong> bbtbenluc@longan.gov.vn​​</p>
        </small>
    </div>
</footer>
    
<button type="button" class="btn btn-danger back-to-top btn-circle"><i class="fa fa-arrow-up"></i></button>

<script src="<?php echo base_url('js/jquery-ui.min.js'); ?>"></script><!-- jQuery -->
<script src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script><!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url('js/jasny-bootstrap.min.js'); ?>"></script><!-- Jasny Bootstrap Core JavaScript -->
<script src="<?php echo base_url('js/metisMenu.min.js'); ?>"></script><!-- Metis Menu Plugin JavaScript -->
<script src="<?php echo base_url('js/jtruncate.js'); ?>"></script><!-- Truncate JavaScript -->
<script src="<?php echo base_url('js/masonry.min.js'); ?>"></script><!-- Masonry JavaScript -->
<script src="<?php echo base_url('js/demo-2.js'); ?>"></script><!-- Custom Theme JavaScript -->
<script src="<?php echo base_url('js/jquery.amaran.min.js'); ?>"></script><!-- Amaran jQuery -->

<!-- dataTables jQuery -->
<script src="<?php echo base_url('js/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url('js/dataTables.bootstrap.min.js'); ?>"></script>


<!-- Kiet JavaScript -->
<script src="<?php echo base_url('js/yingjie.js'); ?>"></script>
<script src="<?php echo base_url('js/bootstrap-select.min.js'); ?>"></script>
<script src="<?php echo base_url(); ?>js/node_modules/socket.io/node_modules/socket.io-client/dist/socket.io.js"></script>
<script src="<?php echo base_url(); ?>js/nodeClient.js"></script>
<script src="<?php echo base_url(); ?>js/moment.min.js"></script>
<script src="<?php echo base_url(); ?>js/fullcalendar.min.js"></script>
<script src="<?php echo base_url(); ?>js/validate.min.js"></script>
<script>
    $('.Start_noti').on('click',function(){
        $.amaran({
            'theme'     :'colorful',
            'content'   :{
                bgcolor:'#27ae60',
                color:'#fff',
                message:'Bạn có hồ sơ mới chuyển qua',
            },
            'position'  :'top right',
            'inEffect' :'slideRight',
            'outEffect' :'slideRight',
            'delay' : 5000
        });
    });
</script>

</body>
</html>