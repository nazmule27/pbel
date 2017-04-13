<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('c/common/header');
$this->load->view('c/common/navbar');
?>

<div class="col-md-9 col-sm-8 col-xs-12">
    <input type="hidden" name="start_time" value="<?php if (isset($test[0]->start_time)) { echo $test[0]->start_time; } ?>" />
    <input type="hidden" id="id" value="<?php if (isset($test[0]->id)) { echo $test[0]->id; } ?>" />
    <div class="alert alert-warning text-center">'<?php echo $test[0]->name?>' Exam yet not stared! It will start on <b><?php echo $test[0]->start_time;?></b> (with in: <code id="start_time"></code>) <a href="<?=base_url();?>c/home">Go home</a></div>
</div>

<?php
$this->load->view('c/common/footer');
?>
<script type="text/javascript">
    var data = $("input[name=start_time]").val();
    var id = $("#id").val();
    $("#start_time").countdown(data, function(event) {
        $(this).text(event.strftime('%D days %H:%M:%S'));
    }).on('finish.countdown', function() {
        window.location = '<?=base_url()?>'+'c/Give_test/home/'+id;
    });
</script>