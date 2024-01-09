<?php 
                 include "./config/conn.php";

                 $result = mysqli_query($conn, "SELECT * FROM footer_content");
                 while ($data = mysqli_fetch_array($result)) {
                  
                  $about = $data['about'];
                  $contact = $data['contact'];
                  $phone = $data['phone'];
                  $email = $data['email'];

                 } ?>
<footer>
        <div class="footer-main">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="footer-widget">
                            <h4>About DND</h4>
                            <p><?=$about;?></p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="footer-widget">
                            <h4>Information</h4>
                                <p>
                                    Admin lanira 1 fildzah <b>0857-3144-0209</b> <br>
                                    Admin lanira 2 zahro <b>0856-4651-8427</b> <br>
                                    Admin lanira 3 lidya <b>0856-4651-8467</b> <br>
                                    Admin D&D <b>0857-9195-9993</b> <br>
                                    Admin Divana <b>0857-7343-6376</b>
                                </p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="footer-link-contact">
                            <h4>Contact Us</h4>
                            <ul>
                                <li>
                                    <p><i class="fas fa-map-marker-alt"></i>Address: <?=$contact;?>
                                </li>
                                <li>
                                    <p><i class="fas fa-envelope"></i>Email: <?=$email?></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>