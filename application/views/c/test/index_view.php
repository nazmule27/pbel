<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('c/common/header');
$this->load->view('c/common/navbar');
?>

<div class="col-md-9 col-sm-8 col-xs-12">
    <h3>Test List</h3>
    <hr>
    <table id="problems" class="display " cellspacing="0" width="100%" >
        <thead>
        <tr>
            <th>Test Name</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th width="50">Details</th>
        </tr>
        </thead>
        <tbody>
        <?php for ($i = 0; $i < count($all_test); ++$i) { ?>
            <tr>
                <td><?php echo $all_test[$i]->name;?></td>
                <td><?php echo $all_test[$i]->start_time;?></td>
                <td><?php echo $all_test[$i]->end_time;?></td>
                <td><a href="<?=base_url();?>c/Test/home/<?php echo $all_test[$i]->id;?>">Details</a> </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

</div>

<?php
$this->load->view('c/common/footer');
?>
