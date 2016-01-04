// Metis Menu
$(function() {
    $('#side-menu').metisMenu();
});

//Loads the correct sidebar on window load,
//collapses the sidebar on window resize.
// Sets the min-height of #page-wrapper to window size
$(function() {
    $(window).bind("load resize", function() {
        topOffset = 50;
        width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
        if (width < 768) {
            $('div.navbar-collapse').addClass('collapse');
            topOffset = 100; // 2-row-menu
        } else {
            $('div.navbar-collapse').removeClass('collapse');
        }

        height = ((this.window.innerHeight > 0) ? this.window.innerHeight : this.screen.height) - 1;
        height = height - topOffset;
        if (height < 1) height = 1;
        if (height > topOffset) {
            $("#page-wrapper").css("min-height", (height) + "px");
        }
    });

    var url = window.location;
    var element = $('ul.nav a').filter(function() {
        return this.href == url || url.href.indexOf(this.href) == 0;
    }).addClass('active').parent().parent().addClass('in').parent();
    if (element.is('li')) {
        element.addClass('active');
    }
});

// Truncate
$('.truncate').jTruncate({
    length: 100
});

// Masonry
$('.masonry').masonry({
    // options
    itemSelector: '.col-md-6'
});

//  Back to top
$(document).ready(function() {
    var offset = 20;
    var duration = 200;
    $(window).scroll(function() {
        if ($(this).scrollTop() > offset) {
            $('.back-to-top').fadeIn(duration);
        } else {
            $('.back-to-top').fadeOut(duration);
        }
    });

    $('.back-to-top').click(function(event) {
        event.preventDefault();
        $('html, body').animate({scrollTop: 0}, duration);
        return false;
    })
});

// Tooltip
$(function () {
    $('[data-toggle="tooltip"]').tooltip({
        delay: { "show": 500}
    })
});

// DataTable
$(document).ready(function() {
    $('#table').DataTable( {
        "dom": '<"row"<"marTop col-sm-2"l><"marTop col-sm-5"f><"col-sm-5"p><"clear">>rt<"row"<"marTop col-sm-6"l><"marTop col-sm-6"p><"clear">>',
        "decimal": false,
        "info": false,
        "infoEmpty": false,
        "infoFiltered": false,
        "infoPostFix": false,
        "pagingType": "full_numbers",
        "displayLength": 25,
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Tất cả"]],
        "language": {
            "emptyTable": "Không có dữ liệu",
            "thousands": ",",
            "lengthMenu": "Hiển thị _MENU_",
            "loadingRecords": "Đang tải...",
            "processing": "Đang xử lý...",
            "search": "Tìm kiếm",
            "zeroRecords": "Không tìm thấy",
            "paginate": {
                "first": "<i class='fa fa-angle-double-left'></i>",
                "last": "<i class='fa fa-angle-double-right'></i>",
                "next": "<i class='fa fa-angle-right'></i>",
                "previous": "<i class='fa fa-angle-left'></i>"
            }
        }
    } );
} );

// Back
$('.back').click(function(){
    parent.history.back();
    return false;
});

// Chat sroll
$(".panel-body").scrollTop($(".panel-body")[0].scrollHeight);