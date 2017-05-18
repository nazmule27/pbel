<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('c/common/header');
$this->load->view('c/common/navbar');
$k=1;
?>

<div class="col-md-9 col-sm-8 col-xs-12">
    <h3>Add Student to a Test/Group</h3>
    <hr>
    <div class="test-container">&nbsp;

    </div>
    <div class="row">
        <div class="col-md-6">
            <label class="control-label">All unsubscribed users:</label>
            <div class="droptarget" ondrop="drop(event)" ondragover="allowDrop(event)">
                <?php for ($i = 0; $i < count($child); ++$i) { ?>
                    <p ondragstart="dragStart(event)" draggable="true" id="child<?php echo $k;?>"><?php echo $child[$i]->title;?>
                        <input type="hidden" name="child<?php echo $k;?>" value="<?php echo $child[$i]->id;?>">
                    </p>
                    <?php $k++;} ?>
            </div>
            <i class="glyphicon glyphicon-resize-horizontal left-absolute"></i>
        </div>
    <form role="form" action="<?=base_url();?>c/Test/update_group_user/<?php echo $this->input->get('id')?>" method="post">
            <div class="col-md-6">
                <label class="control-label">Subscribed users for this test:</label>
                <div class="droptarget" ondrop="drop(event)" ondragover="allowDrop(event)">
                    <?php for ($i = 0; $i < count($existChild); ++$i) { ?>
                        <p ondragstart="dragStart(event)" draggable="true" id="child<?php echo $k;?>"><?php echo $existChild[$i]->title;?>
                            <input type="hidden" name="child<?php echo $k;?>" value="<?php echo $existChild[$i]->id;?>">
                        </p>
                        <?php $k++;} ?>
                </div>
            </div>
        </div>
        <div class="pos-top row">
            <div class="form-group col-md-12 required">
                <label class="control-label">Test/Group Name:</label>
                <input type="text" name="test_name" maxlength="255" class="form-control" value="<?php echo $this->input->get('name') ?>" readonly>
                <input type="hidden" name="test_id" value="<?php echo $this->input->get('id') ?>">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-12">
                <button type="submit" class="btn btn-success margin-t-15 pull-right">Submit</button>
            </div>
        </div>
    </form>
    <?php if (isset($success_msg)) { echo $success_msg; } ?>
</div>

<?php
$this->load->view('c/common/footer');
?>
<script type="text/javascript">
    /* Event fired on the drag target */
    function dragStart(event) {
        event.dataTransfer.setData("Text", event.target.id);
    }

    /* Events fired on the drop target */
    function allowDrop(event) {
        event.preventDefault();
    }

    function drop(event) {
        event.preventDefault();
        var data = event.dataTransfer.getData("Text");
        event.target.appendChild(document.getElementById(data));
    }


</script>