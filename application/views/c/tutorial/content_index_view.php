<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('c/common/header');
$this->load->view('c/common/navbar');
?>

<div class="col-md-9 col-sm-8 col-xs-12">
    <h3>
        Contents
        <a class="pull-right font14" target="_blank" href="<?=base_url();?>c/Content/create">Add Content</a>
    </h3>

    <hr>
    <table id="content_table" class="display " cellspacing="0" width="100%" >
        <thead>
        <tr>
            <th>Tittle</th>
            <th>Description</th>
            <th>Edit</th>
        </tr>
        </thead>
        <tbody>
        <?php for ($i = 0; $i < count($all_content); ++$i) { ?>
            <tr>
                <td><?php echo $all_content[$i]->sub_title;?></td>
                <td><?php echo $all_content[$i]->description;?></td>
                <td><a href="<?=base_url();?>c/Content/edit/<?php echo $all_content[$i]->id;?>">Edit</a></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

<?php
$this->load->view('c/common/footer');
?>

