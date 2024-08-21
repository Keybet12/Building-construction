
<?php
if (isset($_POST['submit'])) {
    date_default_timezone_set('Africa/Nairobi');

    # Access token details
    $consumerKey = 'cCBLUhWdLDqaGqtrZmtM2XLCo1O8KtqiNu3EJJBzQRtAzgoZ'; // Fill with your app Consumer Key
    $consumerSecret = 'JH93cv4kUyGaxwxU5U1NMngG4kATFCklVtLba4ZVAKOSkDr6clOxztpvGSEkZ5yC'; // Fill with your app Secret

    # Define variables
    $BusinessShortCode = '4629242';
    $Passkey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';  
    $PartyA = $_POST['phone']; // This is the phone number entered by the user
    $AccountReference = 'Foreman Services';
    $TransactionDesc = 'Payment X';
    $Amount = '50';
    $Timestamp = date('YmdHis');    
    $Password = base64_encode($BusinessShortCode.$Passkey.$Timestamp);

    # Headers for access token
    $headers = ['Content-Type:application/json; charset=utf8'];

    # M-PESA endpoint URLs
    $access_token_url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
    $initiate_url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';

    # Callback URL
    $CallBackURL = 'https://blooming-badlands-84005-a8db784487d5.herokuapp.com/callback_url.php';  

    # Get the access token
    $curl = curl_init($access_token_url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($curl, CURLOPT_HEADER, FALSE);
    curl_setopt($curl, CURLOPT_USERPWD, $consumerKey.':'.$consumerSecret);
    $result = curl_exec($curl);
    $result = json_decode($result);
    $access_token = $result->access_token;  
    curl_close($curl);

    # Header for STK push
    $stkheader = ['Content-Type:application/json','Authorization:Bearer '.$access_token];

    # Initiating the transaction
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $initiate_url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $stkheader); // Setting custom header

    $curl_post_data = array(
        'BusinessShortCode' => $BusinessShortCode,
        'Password' => $Password,
        'Timestamp' => $Timestamp,
        'TransactionType' => 'CustomerPayBillOnline',
        'Amount' => $Amount,
        'PartyA' => $PartyA,
        'PartyB' => $BusinessShortCode,
        'PhoneNumber' => $PartyA,
        'CallBackURL' => $CallBackURL,
        'AccountReference' => $AccountReference,
        'TransactionDesc' => $TransactionDesc
    );

    $data_string = json_encode($curl_post_data);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

    
    // Debug: Log the request to M-Pesa
$logFile = "M_PESADebug.txt";
$log = fopen($logFile, "a");
fwrite($log, "Request to M-Pesa: " . $data_string . "\n");

// Execute the cURL request
$curl_response = curl_exec($curl);

// Check for cURL errors
if (curl_errno($curl)) {
    $error_message = 'Curl error: ' . curl_error($curl);
    fwrite($log, "Curl Error: " . $error_message . "\n");
    echo json_encode(array('error' => $error_message));
} else {
    $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    fwrite($log, "HTTP Status: " . $http_status . "\n");
    fwrite($log, "M-Pesa Response: " . $curl_response . "\n");

    if ($http_status != 200) {
        $error_message = 'HTTP error: ' . $http_status;
        echo json_encode(array('error' => $error_message, 'response' => $curl_response));
    } else {
        echo $curl_response;
    }
}

fclose($log);
curl_close($curl);


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Construction Services</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

    <style>
        
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap");

@keyframes fadeIn {
  0% { opacity: 0; }
  100% { opacity: 1; }
}

@keyframes fallIn {
    0% {
        transform: translateY(-100%); /* Start from above the viewport */
        opacity: 0; /* Start invisible */
    }
    40% {
        transform: translateY(0); /* Fall to the original position */
        opacity: 1; /* Fade in */
    }
    50% {
        transform: translateY(-20px); /* First bounce up */
    }
    60% {
        transform: translateY(10px); /* First bounce down */
    }
    70% {
        transform: translateY(-10px); /* Second bounce up */
    }
    80% {
        transform: translateY(5px); /* Second bounce down */
    }
    90% {
        transform: translateY(-5px); /* Third bounce up */
    }
    100% {
        transform: translateY(0); /* End at its original position */
    }
}


* {
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}

body {
    font-family: "Poppins", sans-serif;
    background-color: white;
    user-select: none;
}


nav {
    box-shadow: 2px 2px 3px grey;
}
.navbar {
    background: rgb(9, 37, 82);
    display: flex;
    position: fixed;
    justify-content: center;
    align-items: center;
    width: 100%;
    margin: 0;
    padding: 30px 0;  
    top: 0;
    z-index: 9999; 
    opacity: 0; /* Initially hidden */
    animation: fadeIn 0.5s ease-in forwards;
    animation-delay: 0.3s; 

}

.mainbody{
    margin-top: 130px;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    animation: fallIn 2s ease-out forwards;  
    animation-delay: 0s;  
    position: relative;  
    z-index: 1;  
    margin-top: 130px;

}

.toggle-btn {
    display: flex;
    flex-direction: column;
    cursor: pointer;
    position: absolute;
    left: 20px;
    z-index: 2;
}

.line {
    width: 25px;
    height: 3px;
    background-color: #fff;
    margin: 4px 0;
}

.menu {
    list-style-type: none;
    padding: 0;
    margin: 0;
    background: rgb(9, 37, 82);
    width: 250px;
    z-index: 1;
    position: fixed;
    top: 115px;  
    left: -250px;
    bottom: 0;
    overflow-y: auto;
    transition: left 0.5s ease;
}

.menu.open {
    left: 0;
}

.menu li {
    padding: 20px;
}

.menu li a {
    color: #fff;
    text-decoration: none;
    font-size: 18px;
}

.logo {
    position: absolute;
    right: 10px;  
}

.logo video {
    width: 198px;
    height:128px;  
    border-radius: 12px;  
    padding: 15px;
    
}

.main-top {
    border-bottom: 1px solid darkgray;
    display: flex;
    width: 100%;
    background: #fff;
    padding: 10px;
    justify-content: space-around;
    text-align: center;
    font-size: 18px;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: rgb(43, 43, 43);
}

.main {
    width: 100%;
    padding: 20px;
}

.headertxt {
    margin-left: 25%;
    margin-top: 3%;
}

select {
    width: 200px;
    height: 30px;
    color: white;
    background-color: rgb(9, 37, 82);
    border: none;
    outline: none;
    border-radius: 6px;
    font-size: 18px;
    padding: 5px;  
    padding-left: 0;
    left: 0px;
}

option {
    color: white;  
    font-size: 18px;
    padding: 10px 0; 
}
h1{
  color: white;
}
.user-info {
    display: flex;
    align-items: center;
    padding: 10px;
}

.user-info img {
    width: 70px;  
    height: 70px;  
    border-radius: 50%;
}

.user-info .username {
    color: #fff;
    margin-left: 20px;
    font-size: 18px;
}
.site {
    border: none;
    background-color: whitesmoke;
    padding: 10px;
    margin: 10px;
    background: whitesmoke;
    width: calc(30.333% - 20px);  
    box-sizing: border-box;
    flex-grow: 1;
}
.site img {
     max-width: 100%;
     height: 250px;
}
.contact-btn{
    width: 300px;
    height: 36px;
    margin-top: 30px;
    margin-left: 50px;
    background: rgb(9, 37, 82);
    color: white;
    font-size:large;
    border-radius: 2px;
    border: none;
}
button {
            transition: background 0.5s ease-in-out;
            position: relative;
            overflow: hidden;
        }

          button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 36px;
            border-radius: 2px;
            background-color:  rgb(94, 130, 187);  
            transition: left 0.5s ease-in-out;
            z-index: 0;
        }
          
        button:hover::before {
            left: 0;
        }

        button span {
            position: relative;
            z-index: 1;
        }
     
        .message{
            color: rgb(9, 37, 82);
        }
        .emptymessage{
            margin-left: 37%;
            margin-top:6%;
        }
        #empty{
            margin-left: 10%;
            margin-top:10%;
            font-size: 200px;
            color: rgb(9, 37, 82);
        }
     
 </style>
   </head>
<body>

    <div class="navbar">

        <div class="toggle-btn">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>
        <div class = "Heading">
              <h1>CONSTRUCTION JOBS IN KENYA</h1>

        </div>
        <div class="logo">
            <video src="foreman logo.mp4" autoplay muted loop></video>
        </div>
        <nav class="menu">
            <ul>

            <li>
            <div class="user-info">
                <img src="logopic.jpg" alt="User Avatar">
                <span class="username"><?php echo htmlspecialchars($username); ?></span>
            </div>
        </li>
                <li>
                     
                        <i class="fas fa-new Dashboard"></i>
                        <span class="nav-item">
                        <form method="GET" action="">
                        <select name="county" onchange="this.form.submit()">
                                <option value ="--">Search Counties</option>
                                <option value="">All counties</option>
                                <option value="Baringo">Baringo</option>
                                <option value="Bomet">Bomet</option>
                                <option value="Bungoma">Bungoma</option>
                                <option value="Busia">Busia</option>
                                <option value="Elgeyo Marakwet">Elgeyo Marakwet</option>
                                <option value="Embu">Embu</option>
                                <option value="Garissa">Garissa</option>
                                <option value="Homa Bay">Homa Bay</option>
                                <option value="Isiolo">Isiolo</option>
                                <option value="Kajiado">Kajiado</option>
                                <option value="Kakamega">Kakamega</option>
                                <option value="Kericho">Kericho</option>
                                <option value="Kiambu">Kiambu</option>
                                <option value="Kilifi">Kilifi</option>
                                <option value="Kirinyaga">Kirinyaga</option>
                                <option value="Kisii">Kisii</option>
                                <option value="Kisumu">Kisumu</option>
                                <option value="Kitui">Kitui</option>
                                <option value="Kwale">Kwale</option>
                                <option value="Laikipia">Laikipia</option>
                                <option value="Lamu">Lamu</option>
                                <option value="Machakos">Machakos</option>
                                <option value="Makueni">Makueni</option>
                                <option value="Mandera">Mandera</option>
                                <option value="Marsabit">Marsabit</option>
                                <option value="Meru">Meru</option>
                                <option value="Migori">Migori</option>
                                <option value="Mombasa">Mombasa</option>
                                <option value="Muranga">Muranga</option>
                                <option value="Nairobi">Nairobi</option>
                                <option value="Nakuru">Nakuru</option>
                                <option value="Nandi">Nandi</option>
                                <option value="Narok">Narok</option>
                                <option value="Nyamira">Nyamira</option>
                                <option value="Nyandarua">Nyandarua</option>
                                <option value="Nyeri">Nyeri</option>
                                <option value="Samburu">Samburu</option>
                                <option value="Siaya">Siaya</option>
                                <option value="Taita Taveta">Taita Taveta</option>
                                <option value="Tana RiverNairobi">Tana River</option>
                                <option value="Tharaka Nithi">Tharaka Nithi</option>
                                <option value="Trans Nzoia">Trans Nzoia</option>
                                <option value="Turkana">Turkana</option>
                                <option value="Uasin Gishu">Uasin Gishu</option>
                                <option value="Vihiga">Vihiga</option>
                                <option value="Wajir">Wajir</option>
                                <option value="West Pokot">West Pokot</option>
                            </select>
                       </form>
                        </span>
                    
                </li>
                 <li><a href="upload1.php">
                    <i class="fas fa-upload"></i>
                    <span class="nav-item">Post an Ad</span>
                </a></li>
                <li><a href="#">
                    <i class="far fa-question-circle"></i>
                    <span class="nav-item">About Us</span>
                </a></li>
                <li><a href="" class="help">
                    <i class="far fa-question-circle"></i>
                    <span class="nav-item">Help</span>
                </a></li>
                <li><a href="index.php" class="logout">
                    <i class="fas fa-sign-out-alt"></i>
                    <span class="nav-item">Logout</span>
                </a></li>
            </ul>
        </nav>
    </div>
    

<div class = "mainbody">

<?php include 'Addisp.php'; ?>
 
  
</div>


<script>


function preventBack(){window.history.forward()}
       setTimeout("preventBack()", 0)
    window.onunload = function(){null}


window.onscroll = function() {
    var navbar = document.querySelector(".navbar");
    if (window.scrollY > 20) {
        navbar.style.position = "fixed";
        navbar.style.top = "0";
    } else {
        navbar.style.position = "fixed";
        
    }
}

document.querySelector('.toggle-btn').addEventListener('click', function() {
    const menu = document.querySelector('.menu');
    menu.classList.toggle('open');
    
});


function showContact(buttonElement) {
    const phoneNumber = prompt("Please enter your M-Pesa number:");

    if (phoneNumber) {
fetch('https://blooming-badlands-84005-a8db784487d5.herokuapp.com/path-to-index4.php', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
    },
    body: new URLSearchParams({
        'phone': phoneNumber,
        'submit': 'Submit'
    })
})
.then(response => response.json())
.then(data => {
    if (data.error) {
        alert("Error: " + data.error);
        if (data.response) {
            console.log("Full response:", data.response);
        }
    } else if (data.Body && data.Body.stkCallback && data.Body.stkCallback.ResultCode === 0) {
        alert("Payment successful! Displaying contact information.");
        const contactInfoElement = buttonElement.nextElementSibling;
        contactInfoElement.style.display = 'block'; // Show the contact info
    } else if (data.Body && data.Body.stkCallback) {
        alert("Payment failed: " + data.Body.stkCallback.ResultDesc);
    } else {
        alert("Unexpected response format: " + JSON.stringify(data));
    }
})
.catch(error => {
    console.error('Fetch error:', error);
    alert("An error occurred. Please try again.");
});


    </script>

</body>
</html>
