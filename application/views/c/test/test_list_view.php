<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('c/common/header');
$this->load->view('c/common/navbar');
?>

<div class="col-md-9 col-sm-8 col-xs-12">
    <h3>Test/Group List for Subscription</h3>
    <hr>
    <table id="problems" class="display " cellspacing="0" width="100%" >
        <thead>
        <tr>
            <th>Test Id</th>
            <th>Test Name</th>
            <th>Subscription By</th>
            <th>User Add</th>
        </tr>
        </thead>
        <tbody>
        <?php for ($i = 0; $i < count($test_name); ++$i) { ?>
        <tr>
            <td><?php echo $test_name[$i]->id;?></td>
            <td><?php echo $test_name[$i]->name;?></td>
            <td><?php echo $test_name[$i]->subscription_end_time;?></td>
            <td><a href="<?=base_url();?>c/Test/add_in_group?id=<?php echo $test_name[$i]->id;?>&name=<?php echo $test_name[$i]->name;?>">Add/Remove Users</a> </td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

<?php
$this->load->view('c/common/footer');
?>
