//Created by Nazmul

/*var editor = CodeMirror.fromTextArea(document.getElementById("solution_code"), {
    lineNumbers: true,
    mode: "text/x-csrc",
});*/

var mes='<a href="javascript:void(0)" class="infoLink" title="Developer Information"></a><div class="per_InfoWhole"><div class="per_infoBlock"><a href="javascript:void(0)" id="diamond-shield"></a><div class="per_flowRow"><div class="per_leftPart"><h3>Nazmul Haque</h3><p>Asst. Programmer, CSE, BUET</p><div class="per_flowRow"><a href="mailto:nlnazmul@gmail.com?subject=Hello">nlnazmul@gmail.com</a><em>E-mail: &nbsp;</em></div><div class="per_flowRow"><a href="http://www.linkedin.com/profile/view?id=178516225&trk=nav_responsive_tab_profile" target="_blank">LinkedIn Profile</a></div></div><div class="per_rightPart"><div class="per_profile">&nbsp;</div></div></div></div></div>';
document.body.insertAdjacentHTML( 'afterbegin', mes );
$(".infoLink").click(function(){
    $(".per_InfoWhole").slideDown(function(){
        $("#diamond-shield").click(function(){
            $(".per_InfoWhole").slideUp();
        });
    });
});

function isPasswordMatch() {
    var password = $("#new_password").val();
    var confirmPassword = $("#confirmPassword").val();

    if (password != confirmPassword) {
        $("#divCheckPassword").html("Passwords do not match!");
        return false;
    }
    else{
        $("#divCheckPassword").html("");
        return true
    }
}
$('#problems').dataTable( {
    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
    "pagingType": "full_numbers",
    "order": [[ 3, "asc" ]],
});
$('#section_table').dataTable( {
    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
    "pagingType": "full_numbers",
});
$('#sub_section_table').dataTable( {
    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
    "pagingType": "full_numbers",
});
$('#content_table').dataTable( {
    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
    "pagingType": "full_numbers",
});
$('#test_table').dataTable( {
    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
    "pagingType": "full_numbers",
});
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#profile_img')
                .attr('src', e.target.result)
                .width(200)
        };
        reader.readAsDataURL(input.files[0]);
    }
}
function readPhotoURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#gallery_img')
                .attr('src', e.target.result)
                //.width(200)
        };
        reader.readAsDataURL(input.files[0]);
    }
}
function view(img) {
	imgsrc = img.src;
	viewwin = window.open(imgsrc,"_blank","toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=yes, copyhistory=yes, width=600,height=600");
}