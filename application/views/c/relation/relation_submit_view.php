<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('c/common/header');
$this->load->view('c/common/navbar');
$k=1;
$j=1;
?>

<div class="col-md-9 col-sm-8 col-xs-12">
    <h3>Problem Relation Set</h3>
    <hr>
    <h4>Title: <?php echo $this->input->get('title').' (Level:'.$this->input->get('level').')'  ?></h4>
    <br>
    <div class="row">
        <div class="col-md-3">
            <label class="control-label">All Child problems:</label>
            <div class="droptarget" ondrop="drop(event)" ondragover="allowDrop(event)">
                <?php for ($i = 0; $i < count($child); ++$i) { ?>
                    <p ondragstart="dragStart(event)" draggable="true" id="child<?php echo $k;?>"><?php echo $child[$i]->title;?>
                        <input type="hidden" name="child<?php echo $k;?>" value="<?php echo $child[$i]->id;?>">
                    </p>

                    <?php $k++;} ?>
            </div>
            <i class="glyphicon glyphicon-resize-horizontal left-absolute"></i>
        </div>
        <form class="relative" role="form" action="<?=base_url();?>c/Relation/save/<?php echo $this->input->get('pid')?>" method="post">
        <div class="col-md-3">
            <label class="control-label">Childes problems of this:</label>
            <div class="droptarget" ondrop="drop(event)" ondragover="allowDrop(event)">
                <?php for ($i = 0; $i < count($existChild); ++$i) { ?>
                    <p ondragstart="dragStart(event)" draggable="true" id="child<?php echo $k;?>"><?php echo $existChild[$i]->title;?>
                        <input type="hidden" name="child<?php echo $k;?>" value="<?php echo $existChild[$i]->id;?>">
                    </p>

                    <?php $k++;} ?>
            </div>
        </div>
        <div class="col-md-3">
            <label class="control-label">Parent problems of this:</label>
            <div class="droptarget" ondrop="drop(event)" ondragover="allowDrop(event)">
                <?php for ($i = 0; $i < count($existParent); ++$i) { ?>
                    <p ondragstart="dragStart(event)" draggable="true" id="parent<?php echo $i+1;?>"><?php echo $existParent[$i]->title;?>
                        <input type="hidden" name="parent<?php echo $j;?>" value="<?php echo $existParent[$i]->id;?>">
                    </p>
                <?php $j++;} ?>
            </div>
        </div>
            <button type="submit" class="btn btn-success relation-btn">Submit</button>
        </form>
        <div class="col-md-3">
            <i class="glyphicon glyphicon-resize-horizontal right-absolute"></i>
            <label class="control-label">All Parent problems:</label>
            <div class="droptarget" ondrop="drop(event)" ondragover="allowDrop(event)">
                <?php for ($i = 0; $i < count($parent); ++$i) { ?>
                    <p ondragstart="dragStart(event)" draggable="true" id="parent<?php echo $i+1;?>"><?php echo $parent[$i]->title;?>
                        <input type="hidden" name="parent<?php echo $j;?>" value="<?php echo $parent[$i]->id;?>">
                    </p>
                <?php $j++;} ?>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
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


    function dragStart2(event) {
        event.dataTransfer.setData("Text", event.target.id);
    }

    /* Events fired on the drop target */
    function allowDrop2(event) {
        event.preventDefault();
    }

    function drop2(event) {
        event.preventDefault();
        var data = event.dataTransfer.getData("Text");
        event.target.appendChild(document.getElementById(data));
    }
</script>