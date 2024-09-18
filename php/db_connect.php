<?php
    // Allow only specific IP addresses to access this page
    // List of allowed IP addresses
    // by default, only localhost is allowed use what is the output of $_SERVER['REMOTE_ADDR'] to get the IP address of the client.
    // or tan awa sa imong terminal ang IP address sa imong computer.
    // or kung wala kay idea unsa imong IP address, ask your instructor or classmates.
    // or use the IP address of the computer that you are using.
    // or kuan ::1 kay ga use man ka ug localhost.
    $allow_ip = ['192.168.56.1', '::1'];

    // Get client's IP address
    $client_ip = $_SERVER['REMOTE_ADDR'];

    if (!in_array($client_ip, $allow_ip)) {
        die("Access denied: Your IP address ($client_ip) is not allowed to access this page.");
    }

    $servername = "localhost";  //change if needed
    $username = "root";     //your database username
    $password = "";         //your database password
    $dbname = "project_webapp";

    //Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    //check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error); //connection error
    } 
    // else {
    //     echo "You are connected to the database";
    // }`
?>