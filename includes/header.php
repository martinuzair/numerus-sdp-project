<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        h1 {
        font: var(--h1);
        margin-top: .5rem;
        }

        h2 {
            font: var(--h2);
            margin-top: .5rem;
        }

        h3 {
            font: var(--h3);
            margin-top: .3rem;
        }

        a {
            font: var(--links);
            margin-top: .3rem;
        }

        p {
            font: var(--p);
            margin-top: .3rem;
        }
        
        .header .container{
            top: 0; left: 0; right: 0;
            background-color: rgba(255,255,255, 0.1);
            -webkit-backdrop-filter: blur(5px);
            backdrop-filter: blur(5px);
            padding: 1rem 8%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            z-index: 1000;
            box-shadow: 0 .5rem 1rem rgba(0,0,0,.1)
        }


        .header .logo img{
            margin-left: 20px;
            height: 90px;
            width: 90px;
        }

        .header .container .navigation a{
            font-size: 1rem;
            padding: 0 1.5rem;
            color: black;
        }

        .header .container .navigation a:hover{
            color: var(--colour7);
        }

        .header .container .profile a{
            background-color: transparent;
            font-size: 1.5rem;
            color: black;
            margin-left: 1.5rem;
            cursor: pointer;
        }

        .header .container .profile a:hover{
            color: var(--colour7);
        }

        @media (max-width: 768px){}
    </style>
</head>
<body>
        <!--Header-->
    <header class="header">
        <div class="container">
            <span class="logo"><a href="p1_pmain.php"><img src="image/Logo.png" alt="logo"></a></span>
            
            <div class="navigation">
                <a href="p2_childRegistration.php"><strong>Register For Children</strong></a>
                <a href="p4_Child_progression.php"><strong>View Children Progression</strong></a>
                <a href="includes/logOut.inc.php"><strong>Log Out</strong></a>

            </div>

            <div class="profile">
                <a href="p6_viewProfile.php"><i class="fa-solid fa-user" id="profile"></i></a>
            </div>
        </div>
    </header>
</body>
</html>