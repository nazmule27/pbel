<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('c/common/header');
$this->load->view('c/common/navbar');
?>

<div class="col-md-9 col-sm-8 col-xs-12">
    <h3>
        Sub Sections
        <a class="pull-right font14" target="_blank" href="<?=base_url();?>c/Sub_section/create">Add Sub Section</a>
    </h3>

    <hr>
    <table id="sub_section_table" class="display " cellspacing="0" width="100%" >
        <thead>
        <tr>
            <th>Section Tittle</th>
            <th>Sub Section Tittle</th>
        </tr>
        </thead>
        <tbody>
        <?php for ($i = 0; $i < count($all_sub_section); ++$i) { ?>
            <tr>
                <td><?php echo $all_sub_section[$i]->title;?></td>
                <td><?php echo $all_sub_section[$i]->sub_title;?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

<?php
$this->load->view('c/common/footer');
?>

