<html>

<head>
    <title>Note Jobs</title>
</head>

<body>


    <style>
        .heading {
            color: #fff;
            background-color: #508bfc;
            padding: 15px;
            border-radius: 20px;
        }

        #error {
            position: relative;
            width: 300px;
            z-index: 2;
        }


        .vh-100 {
            z-index: 1;
        }

        #formcard {
            border-radius: 50px;
            box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
        }

        .form-label {
            font-size: 30px;
            float: left;
        }

        #loginform {
            display: none;
        }
    </style>


    <?php
    $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/todoapp";
    include($path . "/header.php");
    ?>

    <?php

    $conn = mysqli_connect('localhost', 'Heman', 'Khmp2232@', 'heman');
    if (mysqli_connect_error()) {
        die("error");
    }

    //print_r($_POST);




    if ($_POST) {

        $id = mysqli_insert_id($conn) + 1;
        $email = $_POST['registerEmail'];
        $name = $_POST['registerName'];
        $mobile = $_POST['registerMobile'];
        $pw1 = $_POST['password1'];
        $pw2 = $_POST['password2'];
    }


    date_default_timezone_set('Asia/Kolkata');
    $time = time();
    //echo date("d/m/Y H:i:s", $time);






    //$query = "INSERT INTO users VALUES($id, $name, 45000, 'VZM')";

    //$query = "UPDATE emp SET salary=35000 where id=2232";


    //mysqli_query($link, $query);
    /*
    $query = "SELECT * FROM emp";
    if ($data = mysqli_query($link, $query)) {
        while ($row = mysqli_fetch_array($data)) {
            print_r($row);
            echo "<br>";
        }
    } else {
        echo "error fetching";
    }


    setcookie('age', "19", time() * 60);

    echo $_COOKIE['age'];
*/
    ?>


    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-200">
                <div class="col-12 py-5 col-md-8 col-lg-6 col-xl-6">
                    <div class="card shadow-5-strong" id="formcard">
                        <div class="card-body p-5 text-center">


                            <!-- Login Panel -->
                            <div id="loginform">
                                <h3 class="mb-4 heading">Sign in</h3>
                                <hr>
                                <form>

                                    <!-- Email input -->
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="loginName">Email</label>
                                        <input type="text" id="loginName" name="loginName" class="form-control" />
                                    </div>

                                    <!-- Password input -->
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="loginPassword">Password</label>
                                        <input type="password" id="loginPassword" name="loginPassword" class="form-control" />
                                    </div>

                                    <!-- Checkbox -->
                                    <div class="form-check d-flex justify-content-start mb-4">
                                        <input class="form-check-input" type="checkbox" name="checkbox1" value="" id="checkbox1" />
                                        <label class="form-check-label" for="checkbox1">&nbsp Remember password </label>
                                    </div>


                                    <!-- Submit button -->
                                    <button type="submit" class="btn btn-primary btn-block mb-4">Sign in</button>
                                    <hr class="my-4">

                                    <div class="text-center switchform">
                                        <p>Not a member?<a href="#registerform">Register</a></p>
                                    </div>

                                </form>
                            </div>

                            <!-- Register Panel -->

                            <div id="registerform">
                                <h3 class="mb-4 heading">Register</h3>
                                <form id="register" method="POST" class="row">

                                    <!-- Email input -->
                                    <div class="form-outline has-validation mb-4">
                                        <label class="form-label" for="registerEmail">Email</label>
                                        <input type="text" name="registerEmail" id="registerEmail" class="form-control" />

                                        <div class="col-sm" id="emailerror"></div>
                                    </div>

                                    <!-- Name input -->
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="registerName">Name</label>
                                        <input type="text" name="registerName" id="registerName" class="form-control" />

                                        <div class="col-sm" id="nameerror"></div>
                                    </div>

                                    <!-- Mobile input -->
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="registerMobile">Mobile</label>
                                        <input type="text" name="registerMobile" id="registerMobile" class="form-control" />
                                        <div class="col-sm" id="mobileerror"></div>
                                    </div>

                                    <!-- Password input -->
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="password1">Password</label>
                                        <input type="text" name="password1" id="password1" class="form-control" />
                                        <div class="col-sm" id="password1error"></div>
                                    </div>
                                    <!-- Repeat Password input -->
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="password2">Confirm password</label>
                                        <input type="text" name="password2" id="password2" class="form-control" />
                                        <div class="col-sm" id="password2error"></div>
                                    </div>

                                    <!-- Checkbox -->
                                    <div class="form-check d-flex justify-content-center mb-4">
                                        <input class="form-check-input me-2" type="checkbox" value="" required name="registerCheck" checked aria-describedby="registerCheckHelpText" />
                                        <label class="form-check-label" for="registerCheck">
                                            I have read and agree to the terms
                                        </label>
                                    </div>

                                    <!-- Submit button -->
                                    <button type="submit" class="btn btn-primary btn-block mb-3">Register</button>
                                    <hr class="my-4">

                                    <div class="text-center switchform">
                                        <p>Already a member? <a href="#registerform">Log In</a></p>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function() {

            var flag = false;

            $("#registerEmail").keyup(function() {
                if (validateEmail()) {
                    $("#registerEmail").css("border", "2px solid green");
                    $("#emailerror").html("<small class='text-success' style='float:left'>Valid Email</small>");
                } else {
                    $("#registerEmail").css("border", "2px solid red");
                    $("#emailerror").html("<small class='text-danger' style='float:left'>Please enter a vaid email</small>");
                }
            });

            $("#registerName").keyup(function() {
                if ($("#registerName").val() == "") {
                    $("#nameerror").html("<small class='text-danger' style='float:left'>Name cannot be empty</small>");
                } else {
                    $("#nameerror").html("<small class='text-danger' style='float:left'></small>");
                }
            });

            $("#registerMobile").keyup(function() {
                if (!validateMobile()) {
                    $("#mobileerror").html("<small class='text-danger' style='float:left'>Please enter a valid Mobile number</small>");
                } else {
                    $("#mobileerror").html("<small class='text-danger' style='float:left'></small>");
                }
            });

            $("#password1").keyup(function() {
                if (!validatepw1()) {
                    $("#password1error").html("<small style='float:left'>\
                                                Must contain :\
                                                <ul align='left'>\
                                                    <li>length of >=8</li>\
                                                    <li>atleast one uppercase letter</li>\
                                                    <li>atleast one lowercase letter</li>\
                                                    <li>atleast one special character </li>\
                                                </ul>\
                                            </small>");
                } else {
                    $("#password1error").html("");
                }
            });


            $("#password2").keyup(function() {
                if (!validatepw2()) {
                    $("#password2error").html("<small class='text-danger' style='float:left'>Password and Confirm Password must be same.</small>");
                } else {
                    $("#password2error").html("");
                }
            });
        });

        function validatepw1() {
            var pw1 = $("#password1").val();
            var filter = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/
            if (filter.test(pw1)) {
                return true;
            } else {
                return false;
            }
        }

        function validatepw2() {
            var pw1 = $("#password1").val();
            var pw2 = $("#password2").val();

            if (pw1 === pw2) {
                return true;
            } else {
                return false;
            }
        }

        function validateMobile() {
            var mobNum = $("#registerMobile").val();
            1
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

        function validateEmail() {
            // get value of input email
            var email = $("#registerEmail").val();
            var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/.test(email);

            if (emailReg && email) {
                return true;
            } else {
                return false;
            }
        }

        $(".switchform").click(function() {
            $("#registerform").toggle();
            $("#loginform").toggle();
        });
    </script>

</body>

</html>