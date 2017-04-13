<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('c/common/header');
$this->load->view('c/common/navbar');
?>

<div class="col-md-9 col-sm-8 col-xs-12">
    <h3>This Test Problems List
    </h3>

    <hr>
    <table id="problems" class="display " cellspacing="0" width="100%" >
        <thead>
        <tr>
            <th>Test Name</th>
            <th>Tittle</th>
            <th>Description</th>
            <th>Level</th>
            <th width="50">Details</th>
        </tr>
        </thead>
        <tbody>
        <?php for ($i = 0; $i < count($test_problem); ++$i) { ?>
        <tr>
            <td><?php echo $test_problem[$i]->name;?></td>
            <td><?php echo $test_problem[$i]->title;?></td>
            <td><?php echo $test_problem[$i]->description;?></td>
            <td><?php echo $test_problem[$i]->level;?></td>
            <td><a href="<?=base_url();?>c/Test/single_view/<?php echo $test_problem[$i]->id;?>">Details</a> </td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

<?php
    $this->load->view('c/common/footer');
?>
