<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('c/common/header');
$this->load->view('c/common/navbar');
?>

<div class="col-md-9 col-sm-8 col-xs-12">
    <h3>Problems Bank</h3>
    <hr>
    <table id="problems" class="display " cellspacing="0" width="100%" >
        <thead>
        <tr>
            <th>Tittle</th>
            <th>Description</th>
            <th>Level</th>
            <th width="50">Details</th>
            <th width="50">Pick for Test</th>
        </tr>
        </thead>
        <tbody>
        <?php for ($i = 0; $i < count($all_problem); ++$i) { ?>
        <tr>
            <td><?php echo $all_problem[$i]->title;?></td>
            <td><?php echo $all_problem[$i]->description;?></td>
            <td><?php echo $all_problem[$i]->level;?></td>
            <td><a href="<?=base_url();?>c/Problem_list/single_view/<?php echo $all_problem[$i]->id;?>">Details</a> </td>
            <td><a href="<?=base_url();?>c/Pick_problem/pick/<?php echo $all_problem[$i]->id;?>">Pick</a> </td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

<?php
$this->load->view('c/common/footer');
?>
