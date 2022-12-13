<!DOCTYPE html>
<html lang="en">

<head>
    <title>Yoga Admission</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</head>

<body>
    <style>
        body {
            font-family: Verdana, Geneva, sans-serif;
            font-size: 14px;
            background: #f2f2f2;
        }

        .form_wrapper {
            background: #fff;
            width: 450px;
            max-width: 100%;
            box-sizing: border-box;
            padding: 25px;
            margin: 8% auto 0;
            position: relative;
            z-index: 1;
            border-top: 5px solid blue;
        }

        .form_wrapper h2 {
            font-size: 1.5em;
            line-height: 1.5em;
            margin: 0;
        }

        .form_wrapper .title_container {
            text-align: center;
            padding-bottom: 15px;
        }

        .form_wrapper h3 {
            font-size: 1.1em;
            font-weight: normal;
            line-height: 1.5em;
            margin: 0;
        }

        .form_wrapper label {
            font-size: 15px;
        }

        .form_wrapper .row {
            margin: 10px -15px;
            padding: 0 15px;
            box-sizing: border-box;
        }

        .input_field {
            position: relative;
            margin-bottom: 20px;
        }

        #loginform {
            display: none;
        }

        .form_wrapper .textarea_field span i {
            padding-top: 10px;
        }
    </style>


    <?php

    $conn = mysqli_connect('localhost', 'Heman', 'Khmp2232@', 'heman');
    if (mysqli_connect_error()) {
        die("Connection failed : " . mysqli_connect_error());
    }

    date_default_timezone_set('Asia/Kolkata');

    if (isset($_POST['joinnow'])) {
        $id = mysqli_insert_id($conn) + 1;
        $email = $_POST['email'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $mobile = $_POST['mobile'];
        $age = $_POST['age'];
        $fees = $_POST['fees'];
        $joined = time();
        $batch = $_POST['slot'];
        $valid = 1;
        $gender = $_POST['gender'];

        $entry = "SELECT * FROM yoga where `email`='$email'";

        $result = mysqli_query($conn, $entry);

        if (mysqli_num_rows($result) > 0) {
            $some = mysqli_fetch_assoc($result);
            echo $some['duration'];
            echo '<script>alert("Account aleready exists.");</script>';
        } else {
            $duration = 0;
            $sql = "INSERT INTO yoga (fname, lname, email, mobile, age, fees, batch, duration, joined, valid, gender) VALUES ('$fname', '$lname', '$email', '$mobile', '$age', '$fees', '$batch', '$duration', '$joined', '$valid', '$gender')";

            if (mysqli_query($conn, $sql)) {
                echo '<script>alert("Successfully joined class");</script>';
                echo '<script>window.location.href = "/flexmoney"</script>';
                $success = true;
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    }

    $done = false;
    $success = false;

    $update_query = "SELECT * FROM yoga";

    $update_result = mysqli_query($conn, $update_query);

    if (mysqli_num_rows($update_result) > 0) {
        $d1 = date("\n d/m/Y H:i:s", time());
        while ($row = mysqli_fetch_assoc($update_result)) {
            $d2 = date("\n d/m/Y H:i:s", date($row['joined']));
            $diff = (strtotime($d1) - strtotime($d2))/60;
            $diff = number_format((float)$diff, 2, '.', '');

            $new_update = "update yoga set duration='$diff'";
            mysqli_query($conn, $new_update);
        }
    }

    if (isset($_POST['fetch'])) {
        $loggedemail =  $_POST['loginemail'];
        $entry = "SELECT * FROM yoga where `email`='$loggedemail'";

        $result = mysqli_query($conn, $entry);

        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            $done = true;
            $row = mysqli_fetch_assoc($result);
            setcookie('email', $loggedemail, time() * 60);
        } else {
            echo '<script>alert("You are not a user\nPlease login")</script>';
        }
    }


    if (isset($_POST['paynow'])) {
        $slot =  $_POST['updateslot'];
        $loggedemail = $_COOKIE['email'];
        $update = "update yoga set batch='$slot' where email='$loggedemail'";
        if (mysqli_query($conn, $update)) {
            echo '<script>alert("Record updated successfully");</script>"';
            echo '<script>window.location.href = "/flexmoney"</script>';
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    }


    $time = time();
    //echo date("\n d/m/Y H:i:s", $time);

    ?>

    <div class="form_wrapper">
        <div class="form_container">
            <div class="title_container">
                <h2>Yoga Classes Admission Form</h2>
            </div>
            <hr>
            <div class="row clearfix">

                <!-- Register Panel -->
                <div id="registerform">
                    <form method="POST" id="register">
                        <!-- First Name  -->
                        <div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
                            <label style="float: left;">First name</label>
                            <div style="float: right;">
                                <input type="text" name="fname" id="fname" placeholder="First Name" />
                                <div class="col-sm" id="nameerror"></div>
                            </div>
                        </div><br><br>
                        <!-- Last Name  -->
                        <div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
                            <label style="float: left;">Last name</label>
                            <input style="float: right;" type="text" name="lname" id="lname" placeholder="Last Name" />
                        </div><br>
                        <!-- Email -->
                        <div class="input_field"> <span><i aria-hidden="true" class="fa fa-envelope"></i></span>
                            <label style="float: left;">Email</label>
                            <div style="float: right;">
                                <input type="text" name="email" id="email" placeholder="Email" /><br>
                                <div class="col-sm" id="emailerror"></div>
                            </div>
                        </div><br>
                        <!-- Mobile  -->
                        <div class="input_field"> <span><i aria-hidden="true" class="fa fa-envelope"></i></span>
                            <label style="float: left;">Mobile</label>
                            <div style="float: right;">
                                <input type="text" name="mobile" id="mobile" placeholder="Mobile No" />
                                <div class="col-sm" id="mobileerror"></div>
                            </div>
                        </div><br>
                        <!-- Age -->
                        <div class="input_field"> <span><i aria-hidden="true" class="fa fa-envelope"></i></span>
                            <label style="float: left;">Age</label>
                            <div style="float: right;">
                                <input type="text" name="age" id="age" placeholder="Age" />
                                <div class="col-sm" id="ageerror"></div>
                            </div>
                        </div><br>
                        <!-- Fees -->
                        <div class="input_field"> <span><i aria-hidden="true" class="fa fa-envelope"></i></span>
                            <label style="float: left;">Fees</label>
                            <input style="float: right;" type="text" name="fees" id="fees" value="500" readonly />
                        </div><br>
                        <!-- Gender -->
                        <div class="input_field radio_option">
                            <label style="float: left;">Gender</label>
                            <div style="float: right;">
                                <input type="radio" name="gender" id="rd1" value="male" checked>
                                <label for="rd1">Male</label>
                                <input type="radio" name="gender" id="rd2" value="female">
                                <label for="rd2">Female</label>
                                <input type="radio" name="gender" id="rd3" value="others">
                                <label for="rd2">Others</label>
                            </div>
                        </div><br>
                        <!-- Batch -->
                        <div class="input_field select_option">
                            <label style="float: left;">Choose Batch</label>
                            <div style="float: right;">
                                <select style="width: 100px" name="slot" id="slot">
                                    <option selected value="1">6-7 AM</option>
                                    <option value="2">7-8 AM</option>
                                    <option value="3">8-9 AM</option>
                                    <option value="4">5-6 AM</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div>
                            <label> <?php if ($success) echo "New record created successfully";
                                    else echo ""; ?> </label>
                        </div><br>
                        <div class="col-sm" id="comment"></div><br>
                        <div style="text-align : center">
                            <input id="joinnow" name="joinnow" class="button" type="submit" value="Join Now" />
                        </div>

                        <div class="text-center switchform">
                            <p>Already a member? <a href="#registerform" name="second">Pay to Join</a></p>
                        </div>
                    </form>
                </div>

                <!-- Login Panel -->

                <div id="loginform">
                    <form method="POST" action="#loginform">
                        <!-- Email -->
                        <div class="input_field"> <span><i aria-hidden="true" class="fa fa-envelope"></i></span>
                            <label style="float: left;">Email</label>
                            <div style="float: right;">
                                <input type="text" name="loginemail" id="loginemail" placeholder="Email" /><br>
                                <div class="col-sm" id="loginemailerror"></div>
                            </div>
                        </div><br><br>
                        <div class="col-sm" id="errormail"><small style='float:left; color: red'></small></div>
                        <div style="text-align: center;">
                            <input id="fetch" name="fetch" type="submit" value="Fetch details" hidden />
                        </div><br>
                    </form>



                    <!-- First Name  -->
                    <form method="POST" id="login">
                        <div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
                            <label style="float: left;">First name</label>
                            <div style="float: right;">
                                <label> <?php if ($done) echo $row['fname'];
                                        else echo "" ?> </label>
                            </div>
                        </div><br><br>
                        <!-- Last Name  -->
                        <div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
                            <label style="float: left;">Last name</label>
                            <div style="float: right;">
                                <label> <?php if ($done) echo $row['lname']; ?> </label>
                            </div>
                        </div><br>
                        <!-- Mobile  -->
                        <div class="input_field"> <span><i aria-hidden="true" class="fa fa-envelope"></i></span>
                            <label style="float: left;">Mobile</label>
                            <div style="float: right;">
                                <label> <?php if ($done) echo $row['mobile']; ?> </label>
                            </div>
                        </div><br>
                        <!-- Age -->
                        <div class="input_field"> <span><i aria-hidden="true" class="fa fa-envelope"></i></span>
                            <label style="float: left;">Age</label>
                            <div style="float: right;">
                                <label> <?php if ($done) echo $row['age']; ?> </label>
                            </div>
                        </div><br>
                        <!-- Fees -->
                        <div class="input_field"> <span><i aria-hidden="true" class="fa fa-envelope"></i></span>
                            <label style="float: left;">Fees</label>
                            <div style="float: right;">
                                <label> <?php if ($done) echo $row['fees']; ?> </label>
                            </div>
                        </div><br>
                        <!-- Date joined -->
                        <div class="input_field"> <span><i aria-hidden="true" class="fa fa-envelope"></i></span>
                            <label style="float: left;">Date Joined</label>
                            <div style="float: right;">
                                <label> <?php if ($done) echo date('m/d/Y H:i:s', $row['joined']); ?> </label>
                            </div>
                        </div><br>
                        <!-- Duration -->
                        <div class="input_field"> <span><i aria-hidden="true" class="fa fa-envelope"></i></span>
                            <label style="float: left;">Duration</label>
                            <div style="float: right;">
                                <label> <?php if ($done) echo $row['duration']; ?> </label>
                            </div>
                        </div><br>
                        <!-- Gender -->
                        <div class="input_field radio_option">
                            <label style="float: left;">Gender</label>
                            <div style="float: right;">
                                <label> <?php if ($done) echo $row['gender']; ?> </label>
                            </div>
                        </div><br>
                        <!-- Batch -->
                        <div class="input_field select_option">
                            <label style="float: left;">wanna change Batch</label>
                            <div style="float: right;">
                                <select style="width: 100px" name="updateslot" id="updateslot">
                                    <option value="1" selected>6-7 AM</option>
                                    <option value="2">7-8 AM</option>
                                    <option value="3">8-9 AM</option>
                                    <option value="4">5-6 AM</option>
                                </select>
                            </div>
                        </div>
                        <br><br>
                        <div style="text-align : center">
                            <input id="paynow" name="paynow" class="button" type="submit" value="Renew Application" />
                        </div>

                        <div class="text-center switchform">
                            <p>New to Class? <a href="#registerform">Register</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(e) {
            var email_flag = false;
            var name_flag = false;
            var mobile_flag = false;
            var age_flag = false;
            var iscomplete = false;

            $("#email").change(function() {
                if (validateEmail()) {
                    $("#email").css("border", "2px solid green");
                    $("#emailerror").css("display", "none");
                    email_flag = true;
                } else {
                    $("#email").css("border", "2px solid red");
                    $("#emailerror").html("<small style='float:left; color: red'>Please enter a valid email</small>");
                    email_flag = false;
                }
            });

            $("#loginemail").change(function() {
                if (validateloginEmail()) {
                    $("#loginemail").css("border", "2px solid green");
                    $("#loginemailerror").css("display", "none");
                    $("#fetch").removeAttr("hidden");

                } else {
                    $("#loginemail").css("border", "2px solid red");
                    $("#loginemailerror").html("<small style='float:left; color: red'>Please enter a valid email</small>");
                    $("fetch").attr("hidden");
                }
            });

            $("#fname").focusout(function() {
                if ($("#fname").val() == "") {
                    $("#nameerror").html("<small style='float:left; color: red'>Name cannot be empty</small>");
                    name_flag = false;
                } else {
                    $("#nameerror").css("display", "none");
                    name_flag = true;
                }
            });

            $("#age").focusout(function() {
                var age = $("#age").val();
                age = parseInt(age);
                if (!age) {
                    $("#ageerror").html("<small style='float:left; color: red'>Age cannot be empty</small>");
                    age_flag = false;
                } else if (age < 18 || age > 65) {
                    $("#ageerror").html("<small style='float:left; color: red'>Age must be between 18-65</small>");
                    age_flag = false;
                } else {
                    $("#ageerror").css("display", "none");
                    age_flag = true;
                }
            });

            $("#mobile").change(function() {
                check = true;
                if (!validateMobile()) {
                    $("#mobileerror").html("<small style='float:left; color: red'>enter a valid Mobile number</small>");
                    mobile_flag = false;
                } else {
                    $("#mobileerror").css("display", "none");
                    mobile_flag = true;
                }
            });

            function validateMobile() {
                var mobNum = $("#mobile").val();
                var filter = /^[6-9][0-9]{9}$/;

                if (filter.test(mobNum)) {
                    if (mobNum.length == 10) {
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            }

            function validateloginEmail() {
                // get value of input email
                var email = $("#loginemail").val();
                var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/.test(email);

                if (emailReg && email) {
                    return true;
                } else {
                    return false;
                }
            }

            function validateEmail() {
                // get value of input email
                var email = $("#email").val();
                var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/.test(email);

                if (emailReg && email) {
                    return true;
                } else {
                    return false;
                }
            }

            $("#register").submit(function(event) {

                if (mobile_flag && name_flag && email_flag && age_flag) {
                    completePayment();
                    return true;
                } else {
                    alert("Please fill all details correctly");
                    event.preventDefault();
                }
            });

            $(".switchform").click(function() {
                $("#registerform").toggle();
                $("#loginform").toggle();
            })

        });

        function completePayment() {
            init = "Initializing."
            $("#comment").html("<small style='float:left; color: red'>" + init + "</small>");
        }
    </script>

</body>

</html>