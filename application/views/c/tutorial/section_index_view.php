<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('c/common/header');
$this->load->view('c/common/navbar');
?>

<div class="col-md-9 col-sm-8 col-xs-12">
    <h3>
        Sections
        <a class="pull-right font14" target="_blank" href="<?=base_url();?>c/Section/create">Add Section</a>
    </h3>

    <hr>
    <table id="section_table" class="display " cellspacing="0" width="100%" >
        <thead>
        <tr>
            <th>Tittle</th>
        </tr>
        </thead>
        <tbody>
        <?php for ($i = 0; $i < count($all_section); ++$i) { ?>
            <tr>
                <td><?php echo $all_section[$i]->title;?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

<?php
$this->load->view('c/common/footer');
?>

