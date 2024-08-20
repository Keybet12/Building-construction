<?php

include('connectionForeman.php');

if (isset($_GET['county']) && !empty($_GET['county'])) {
    $selected_county = $_GET['county'];
    $query = "SELECT * FROM const_sites WHERE _location LIKE '$selected_county%'";
} else {
    $query = "SELECT * FROM const_sites"; // This runs when "All counties" or the default option is selected
}

$result = mysqli_query($con, $query);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $statusColor = ($row['application_status'] == 'open') ? 'rgb(9, 37, 82)' : 'red';

        echo '<div class="site">'; ?>
        <img src ="<?php echo $row['site_photo']; ?>" alt="Site Photo">
        <?php
        echo '<p><i class="fas fa-building"></i><h3>Infrastructure</h3>: ' . $row['infrastructure'] . '</p>';
        echo '<p><i class="fas fa-map-marker"></i> :  ' . $row['_location'] . '</p>';
        echo '<p><h3>Workforce Needed: </h3>' . $row['workforce_needed'] . '</p>';
        echo '<p><h3>Arrival Time: </h3>' . $row['arrival_time'] . '</p>';
        echo '<p><h3>Closing Time: </h3>' . $row['closing_time'] . '</p>';
        echo '<p><h3>Application Status: </h3> <span style="color: ' . $statusColor . '; font-weight: bold;"> ' . ucfirst($row['application_status']) . '</span></p>';
        echo '<button class="contact-btn" onclick="toggleContact(this) onclick="showContact()""><span>Pay To Show Contact</span></button>';
        echo '<p class="contact-info" style="display: none;"><i class="fas fa-phone-alt"></i> : ' . $row['contact'] . '</p>';
        echo '</div>';
    }
} else {
    echo "<div class = 'emptymessage'><h2 class='message'>Sorry Dear No Related Data!!</h2>
    <i class='fas fa-box-open' id='empty'></i></div>";
}

$con->close();
?>

