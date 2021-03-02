<!DOCTYPE html>
<html>
<title>ticket</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style>
  *{
  padding:0px;
  margin:0px;
}
  table,td{
    padding: 20px;
    font-size: 20px;
    border: 2px solid white;
    border-collapse:collapse;
    margin-left: 50px;
    margin-top: 80px;
    background-color: black;
    color: white;
  }
  .bi{
  background-image:url("../img/wp1853425.jpg");
  background-size:cover;
}

h1{
  text-align: center;
  color: black;
  font-size: 50px;
}
nav{
    font-size: 20px;
    background-color: rgba(0,0,0,0.8);
    
    text-align: center;
    
  }
  body{
  background-image:url("../img/13.jpg");
background-size:cover;
}
.menubar ul{
  list-style:none;
  display:inline-flex;
  padding:5px;
  margin-top: 0px;
  font-size: 20px;
}
.menubar ul li a{
  color:white;
  text-decoration:none;
  padding:10px;
}
.menubar ul li{
     padding:15px;
}
.menubar ul li a:hover{
  background-color:red;
  display:block;
  border-radius:10px;
}
.submenu1 {
  display:none;
  margin:10px;
}
.submenu2 {
  display:none;
  margin:10px;
}
.menubar ul li:hover .submenu1 {
  display:block;
  position:absolute;
  background-color:rgba(0,0,0,0.5);
  border-radius:20px;
}
.menubar ul li:hover .submenu2 {
  display:block;
  position:absolute;
  background-color:rgba(0,0,0,0.5);
  border-radius:20px;
}
.submenu1  ul{
  display:block;
}
.submenu1 ul li{
  border-bottom:2px solid red;
}
.submenu2  ul{
  display:block;
}
.submenu2 ul li{
  border-bottom:2px solid red;
}
.h2
{
  text-align: center;
  margin-top: 20px;
  font-size: 50px;
  
}
.head{
text-align:center;
color: rgba(0,0,0,0.7);
}

  </style>
</head>
<body class="bi">
  <nav class="menubar">
    <nav class=" navbar navbar-expand-lg top1">
      <div class="container-fluid">
        <a class="text-decoration-none text-white" href="#"><h1><h4>AFRS-USER</h4></h1></a>
      <div>
        <ul class="navbar-nav">
          <li class="nav-item"> <a class="nav-link" href="<?php echo base_url()?>main/user">Home</a></li>
          <li class="nav-item"> <a class="nav-link" href="<?php echo base_url()?>main/searchflight">Booking</a>
          <li class="nav-item"> <a class="nav-link" href="#">Profile</a>
            <div class="submenu1">
        <ul>
          <li class="nav-item"> <a class="nav-link" href="<?php echo base_url()?>main/regupdate"">update</a></li>
        </ul>
      </div>
          </li>
          <li class="nav-item"> <a class="nav-link" href="#">VIEW</a>
            <div class="submenu2">
              <ul>
                    <li class="nav-item"> <a class="nav-link" href="<?php echo base_url()?>main/viewbookinguser">Booking Details</a></li>
                    <li class="nav-item"> <a class="nav-link" href="<?php echo base_url()?>main/ticket">Ticket view</a></li>
                    <li class="nav-item"> <a class="nav-link" href="<?php echo base_url()?>main/viewnotif">View Notification</a></li>
              </ul>
            </div>
          </li>
              <li class="nav-item"> <a class="nav-link" href="<?php echo base_url()?>main/index">Logout</a></li>
    
            </ul> 
          </ul>
        </div>
      </div>
    </nav>
  </div>
</nav>
  <div >
<div class="w3-container w3-grey w3-cell" style="width: 250px; background-image: url('../img/02.jpg');">
  <input type="hidden" name="">
</div>
<div class="w3-container w3-white w3-cell">
  <p><input type="text" name="name"></p>
  <p><input type="email" name="email"></p>
  <p><input type="text" name="booking number"></p>
  <p><input type="text" name="flight number"></p>
  <p><input type="text" name="amount"></p>
</div>

<div class="w3-container w3-grey w3-cell">
  <p><input type="text" name="name"></p>
  <p><input type="email" name="email"></p>
  <p><input type="text" name="booking number"></p>
  <p><input type="text" name="flight number"></p>
  <p><input type="text" name="amount"></p>
</div>
</div>
</body>
</html>
