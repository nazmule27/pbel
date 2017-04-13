<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('c/common/book-header');
$this->load->view('c/common/tutorial_nav');
?>
<style>
    .col-md-9 {
        font: normal 14px 'SolaimanLipi';
    }
</style>
<div class="col-md-9 col-sm-9 col-xs-12">
    <h3>Tutorial Home</h3>
    <hr>
    <center><img id="loading" style="display: none;" src="<?=base_url();?>assets/img/loading.gif" width="100px" alt="loading"></center>
    <div class="tutorial_box" id="tutorial_box">
        <?php echo '<big><b>'.$first_content[0]->sub_title.'</b></big><br>'; echo $first_content[0]->title;?>
    </div>


</div>

<?php
$this->load->view('c/common/footer');
?>
<!--<script type="text/javascript" src="<?/*=base_url();*/?>assets/js/treemenu/tree.menu.js"></script>-->
<!--<script type="text/javascript">
    make_tree_menu('tree');
</script>-->

<script type="text/javascript">
    $(".menu_id").click(function() {
        $("#loading").show();
        $("#tutorial_box").html("");
        $.ajax({
            type: "POST",
            //dataType:'json',
            contentType: "application/x-www-form-urlencoded;charset=UTF-8",
            url: '<?=base_url()?>'+"c/Tutorial/content_view",
            data: {code: $(this).attr('title')},
            success:
                function(data){
                    $('#tutorial_box').html(data);
                    $("#loading").hide();
                }
        });
    });

</script>
