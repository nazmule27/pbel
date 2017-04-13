<?php
$this->load->view('common/header');
$this->load->view('common/navbar');
?>
    <div class="container paddingT75">
        <div class="row">
            <div class="col-lg-9">
                <h3 class="">Contact Us</h3>
                <br>
                <div class="row">
                    <form role="form" method="post" action="<?=base_url();?>contact/contact_form">
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control custom-text" name="name" id="name" placeholder="Your Name *" required>
                        </div>
                        <div class="form-group col-md-6">
                            <input type="email" class="form-control custom-text" name="email" id="email" placeholder="Your Email *" required>
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control custom-text" name="subject" id="subject" placeholder="Subject *" required>
                        </div>
                        <div class="form-group col-md-12">
                            <textarea class="form-control col-md-12 custom-area" name="message" id="message" placeholder="Tell us somthing...*" required></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-default col-md-12 custom-text">Submit</button>
                        </div>
                    </form>
                </div>
                <?php if (isset($success_msg)) { echo $success_msg; } ?>
                <?php if (isset($error_msg)) { echo $error_msg; } ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="map-con">
                            <div id="googleMap" style="width:100%;height:300px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /contact -->

    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js"></script>
    <script type="text/javascript">
        var myCenter=new google.maps.LatLng(23.726366,90.3886865);
        function initialize()
        {
            var mapProp = {
                center: myCenter,
                zoom:18,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
            var marker = new google.maps.Marker({
                position: myCenter,
                title:'Click to zoom'
            });
            marker.setMap(map);
// Zoom to 9 when clicking on marker
            google.maps.event.addListener(marker,'click',function() {
                map.setZoom(14);
                map.setCenter(marker.getPosition());
            });
        }
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>

<?php
$this->load->view('common/footer');
?>