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
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .info-container:hover, .account-container:hover, .apply-container:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .info-container img, .account-container img, .apply-container img {
            max-width: 100%;
            border-radius: 8px;
            transition: transform 0.3s ease-in-out;
        }

        .info-container:hover img, .account-container:hover img, .apply-container:hover img {
            transform: scale(1.05);
        }

        .info-container .btn, .account-container .btn, .apply-container .btn {
            align-self: center;
            margin-top: auto;
        }

        #p1 {
            color: #00008B;  
        }

        span {
            color: #013220;
            /* padding-left: 50px;   */
        }

        .h_name {
            text-align: center;
            margin-top: 20px;
        }

        .h_name p {
            margin: 0;
            font-size: 32px;
            font-weight: bold;
        }

        .container {
            margin-top: 50px;
        }

        .btn {
            transition: background-color 0.3s ease-in-out, transform 0.3s ease-in-out;
        }

        .btn:hover {
            background-color: #28a745;
            transform: scale(1.05);
        }
        span{
            color:orange;
        }
    </style>
</head>
<body>
    <?php include("include/header.php"); ?>



    <div class="h_name">
        <p id="p1">NARAYAN  <span>HOSPITAL</span></p>
        <!-- <p id="p2"></p> -->
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
