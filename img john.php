<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tour Selection</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
    <style>
    body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
  background-color:;
   background: url('bannaer_15.jpg') no-repeat center center fixed;
}

.container {
  display: flex;
  justify-content: space-around;
}

.tour {
  background-color: black;
  width: 250px;
  height: 350px;
  position: relative;
  overflow: hidden;
  margin: 20px;
}

.tour img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.3s ease-in-out;
}

.tour:hover img {
  transform: scale(1.1);
}

.tour-info {
  position: absolute;
  bottom: 0;
  left: 0;
  width: 100%;
  padding: 10px;
  background-color: rgba(0, 0, 0, 0.7);
  color: white;
  text-align: center;
}


        
.tour-info h4 {
  margin: 0;
}

.tour-info p {
  margin: 5px 0;
}

</style>

<h1 align="center">POPULAR TOURS</h1>
  <div class="container">
    <div class="tour">
      <img src="destination_6.jpg" alt="Tour 1">
      <div class="tour-info">
        <h4>TOUR 1</h4>
        
      </div>
    </div>
    <div class="tour">
      <img src="bannaer_13.jpg" alt="Tour 2">
      <div class="tour-info">
        <h4>TOUR 2</h4>
        
      </div>
    </div>
    <div class="tour">
      <img src="destination_3.jpg" alt="Tour 3">
      <div class="tour-info">
        <h4>TOUR 3</h4>
        
      </div>
    
    </div>
    <div class="tour">
      <img src="destination_2.jpg" alt="Tour 4">
      <div class="tour-info">
        <h4>TOUR 4</h4>
        
      </div>
    </div>
  </div>
 <?php include "footer/footer.php"; ?>

</body>
</html>