<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HMS Home Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        .info-container, .account-container, .apply-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            height: 100%;
            padding: 20px;
        }

        .info-container img, .account-container img, .apply-container img {
            max-width: 100%;
        }

        .info-container .btn, .account-container .btn, .apply-container .btn {
            align-self: center;
            margin-top: auto;
        }
        #p1 {
            color:#00008B;  
        }
        #p1 {
            color:#013220;
            padding-left:50px;  
        }
    </style>
</head>
<body>
    <?php include("include/header.php"); ?>



    <div class="h_name">
        <p id="p1">NARAYAN</p>
        <p id="p2">HOSPITAL</p>
    </div>

    <div style="margin-top: 50px;"></div> 
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="info-container shadow">
                    <img src="img/info.jpg" alt="More Info">
                    <h5 class="text-center">Click on the button for more information</h5>
                    <a href="#">
                        <button class="btn btn-success my-3">More Information</button>
                    </a>
                </div>
            </div>

            <div class="col-md-4">
                <div class="account-container shadow">
                    <img src="img/patient.jpg" alt="Create Account">
                    <h5 class="text-center">Create Account so that we can take good care of you.</h5>
                    <a href="#">
                        <button class="btn btn-success my-3">Create Account!!</button>
                    </a>
                </div>
            </div>

            <div class="col-md-4">
                <div class="apply-container shadow">
                    <img src="img/doctor.jpg" alt="Apply Now">
                    <h5 class="text-center">We are employing for doctors</h5>
                    <a href="#">
                        <button class="btn btn-success my-3">Apply Now!!</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
