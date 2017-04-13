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
            <th>problem</th>
            <th>Code</th>
            <th>Submit Time</th>
            <th>Evaluation Status</th>
            <th width="50">Evaluation</th>
        </tr>
        </thead>
        <tbody>
        <?php for ($i = 0; $i < count($test_answer); ++$i) { ?>
        <tr>
            <td><?php echo $test_answer[$i]->title;?></td>
            <td><?php echo $test_answer[$i]->answer_code;?></td>
            <td><?php echo $test_answer[$i]->update_at;?></td>
            <td><?php echo $test_answer[$i]->evaluation_status;?></td>
            <td>
                <?php
                if(($test_answer[$i]->evaluation_status)=='Yes'){
                    $link='Evaluated';
                }
                else{
                    $link='<a href="'.base_url().'c/Evaluation/compare/'.$test_answer[$i]->id.'">Evaluate</a>';
                }
                echo $link;
                ?>
            </td>
            <!--<a href="<?/*=base_url();*/?>Evaluation/compare/<?php /*echo $test_answer[$i]->id;*/?>">Evaluate</a>-->
        </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

<?php
$this->load->view('c/common/footer');
?>
