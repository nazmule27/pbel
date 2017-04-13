<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('c/common/header');
$this->load->view('c/common/navbar');
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
<link rel="stylesheet" href="<?=base_url();?>assets/js/text_area/css/froala_editor.css">
<link rel="stylesheet" href="<?=base_url();?>assets/js/text_area/css/froala_style.css">
<link rel="stylesheet" href="<?=base_url();?>assets/js/text_area/css/plugins/code_view.css">
<link rel="stylesheet" href="<?=base_url();?>assets/js/text_area/css/plugins/image_manager.css">
<link rel="stylesheet" href="<?=base_url();?>assets/js/text_area/css/plugins/image.css">
<link rel="stylesheet" href="<?=base_url();?>assets/js/text_area/css/plugins/table.css">
<link rel="stylesheet" href="<?=base_url();?>assets/js/text_area/css/plugins/video.css">
<link rel="stylesheet" href="<?=base_url();?>assets/js/text_area/css/codemirror.min.css">


<style>
    div#editor {
        width: 81%;
        margin: auto;
        text-align: left;
    }
</style>
<div class="col-md-9 col-sm-8 col-xs-12">
    <h3>Add Content</h3>
    <hr>
    <form role="form" action="<?=base_url();?>c/Content/updateContentById" method="post">
        <input type="hidden" name="id" value="<?php echo  $content[0]->id;?>">
        <div class="row">
            <div class="form-group col-md-6 required">
                <label for="section" class="control-label">Section:</label>
                <?php
                $section=$section;
                $section = array('0' => 'Select Section') + $section;
                $s_section = $content[0]->section_id;
                echo form_dropdown('section', $section,  $selected=$s_section, 'class="form-control custom-text" id="section" required');
                ?>
            </div>
            <div class="form-group col-md-6 required">
                <label for="sub_section" class="control-label">Sub Section:</label>
                <?php
/*                $sub_section=$sub_section;
                $sub_section = array('0' => 'Select Sub Section') + $sub_section;
                echo form_dropdown('sub_section', $sub_section, '', 'class="form-control custom-text" required');
                */?>
                <select name="sub_section" id="sub_section" class="form-control" required>
                    <option value="<?php echo $content[0]->sub_id;?>"><?php echo $content[0]->sub_title;?></option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-12 required">
                <label for="description" class="control-label">Content Description:</label>
                <textarea name="description" id='edit' style="margin-top: 30px;" placeholder="Type some text" required>
                <?php echo $content[0]->description;?>
                </textarea>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-12">
                <button type="submit" class="btn btn-success pull-right">Update</button>
            </div>
        </div>
    </form>
    <?php if (isset($success_msg)) { echo $success_msg; } ?>
</div>

<?php
$this->load->view('c/common/footer');
?>
<script type="text/javascript" src="<?=base_url();?>assets/js/text_area/js/codemirror.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/js/text_area/js/xml.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/js/text_area/js/froala_editor.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/js/text_area/js/plugins/align.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/js/text_area/js/plugins/code_beautifier.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/js/text_area/js/plugins/code_view.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/js/text_area/js/plugins/draggable.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/js/text_area/js/plugins/image.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/js/text_area/js/plugins/image_manager.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/js/text_area/js/plugins/link.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/js/text_area/js/plugins/lists.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/js/text_area/js/plugins/paragraph_format.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/js/text_area/js/plugins/paragraph_style.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/js/text_area/js/plugins/table.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/js/text_area/js/plugins/video.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/js/text_area/js/plugins/url.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/js/text_area/js/plugins/entities.min.js"></script>

<script>
    $(function(){
        $('#edit')
            .on('froalaEditor.initialized', function (e, editor) {
                $('#edit').parents('form').on('submit', function () {
                })
            })
            .froalaEditor({enter: $.FroalaEditor.ENTER_P, placeholderText: null})
    });
</script>
<script type="text/javascript">
    $("#section").change(function(){
        /*dropdown post *///
        $.ajax({
            type: "POST",
            url: '<?=base_url()?>'+"c/Content/get_sub_content",
            data: {id:$(this).val()},
            success:function(data){
                $("#sub_section").html(data);
            }
        });
    });
</script>
