<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Toggleable Navbar</title>
   <style>

body {
  margin: 0;
  background-color: yellow;
  font-family: Arial, sans-serif;
}

.navbar {
  background-color: #333;
  display: flex;
  width: 10px;
  justify-content: space-between;
  align-items: center;
  padding: 10px 20px;
   
}

.toggle-btn {
  display: flex;
  flex-direction: column;
  cursor: pointer;
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
  display: none;
}

.menu li {
  display: block;
}

.menu li a {
  color: black;
  text-decoration: none;
  padding: 10px;
}

.menu li a:hover {
  background-color: green;
}
.logo {
            margin-left: 20px;
        }

        .logo video {
            width: 200px;  
            height: auto;  
        }

   </style>
</head>
<body>
<div class="logo">
        <video src="ForeMan logo.MP4" autoplay muted loop></video>
        </div>
  <div class="navbar">
    <div class="toggle-btn">
      <div class="line"></div>
      <div class="line"></div>
      <div class="line"></div>
    </div>
  </div>

  <ul class="menu">
    <li><a href="#">Home</a></li>
    <li><a href="#">About</a></li>
    <li><a href="#">Services</a></li>
    <li><a href="#">Contact</a></li>
  </ul>

  <script src="script.js"></script>
</body>
<script>
    document.querySelector('.toggle-btn').addEventListener('click', function() {
  const menu = document.querySelector('.menu');
  menu.style.display = menu.style.display === 'none' ? 'block' : 'none';
});

</script>
</html>

<option value="County">County</option>
                                <option value="Nairobi">Baringo County</option>
                                <option value="Kiambu">Bomet County</option>
                                <option value="Nakuru">Bungoma County</option>
                                <option value="Nairobi">Busia County</option>
                                <option value="Nairobi">Elgeyo Marakwet County</option>
                                <option value="Nairobi">Embu County</option>
                                <option value="Nairobi">Garissa County</option>
                                <option value="Nairobi">Homa Bay County</option>
                                <option value="Nairobi">Isiolo County</option>
                                <option value="Nairobi">Kajiado County</option>
                                <option value="Nairobi">Kakamega County</option>
                                <option value="Nairobi">Kericho County</option>
                                <option value="Nairobi">Kiambu County</option>
                                <option value="Nairobi">Kilifi County</option>
                                <option value="Nairobi">Kirinyaga County</option>
                                <option value="Nairobi">Kisii County</option>
                                <option value="Nairobi">Kisumu County</option>
                                <option value="Nairobi">Kitui County</option>
                                <option value="Nairobi">Kwale County</option>
                                <option value="Nairobi">Laikipia County</option>
                                <option value="Nairobi">Lamu County</option>
                                <option value="Nairobi">Machakos County</option>
                                <option value="Nairobi">Makueni County</option>
                                <option value="Nairobi">Mandera County</option>
                                <option value="Nairobi">Marsabit County</option>
                                <option value="Nairobi">Meru County</option>
                                <option value="Nairobi">Migori County</option>
                                <option value="Nairobi">Mombasa County</option>
                                <option value="Nairobi">Muranga County</option>
                                <option value="Nairobi">Nairobi County</option>
                                <option value="Nairobi">Nakuru County</option>
                                <option value="Nairobi">Nandi County</option>
                                <option value="Nairobi">Narok County</option>
                                <option value="Nairobi">Nyamira County</option>
                                <option value="Nairobi">Nyandarua County</option>
                                <option value="Nairobi">Nyeri County</option>
                                <option value="Nairobi">Samburu County</option>
                                <option value="Nairobi">Siaya County</option>
                                <option value="Nairobi">Taita Taveta County</option>
                                <option value="Nairobi">Tana River County</option>
                                <option value="Nairobi">Tharaka Nithi County</option>
                                <option value="Nairobi">Trans Nzoia County</option>
                                <option value="Nairobi">Turkana County</option>
                                <option value="Nairobi">Uasin Gishu County</option>
                                <option value="Nairobi">Vihiga County</option>
                                <option value="Nairobi">Wajir County</option>
                                <option value="Nairobi">West Pokot County</option>