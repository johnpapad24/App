<!DOCTYPE html>
<?php
require 'Credentials.php';
require 'Functions.php';
connectdb($servername, $username, $password);
//echo "db updated";
?>
<html lang="en">
<head>
  <!-- Use correct character set. -->
  <meta charset="utf-8">
  <!-- Tell IE to use the latest, best version. -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Make the application on mobile take up the full browser screen and disable user scaling. -->
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
  <title>Hello World!</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="popupwindow.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="../Build/Cesium/Cesium.js"></script>
<script src="popupwindow.js"></script>
<script>
function searchSatellite() {
  // Declare variables
  var input, filter,satwindowselect,options, i, optval, txtValue;
   input = document.getElementById('satellitesearchInput');
   filter = input.value.toUpperCase();
   satwindowselect=document.getElementById("sateliteselect");
   options = satwindowselect.getElementsByTagName('option');

  // Loop through all list items, and hide those who don't match the search query
  for (i = 0; i < options.length; i++) {
    optval=options[i].value;
    //txtValue = a.textContent || a.innerText;
    if (optval.toUpperCase().indexOf(filter) > -1) {
      options[i].style.display = "";
    } else {
      options[i].style.display = "none";
    }
  }
}
function czmlload(){
  var czmlDataSource1 = new Cesium.CzmlDataSource();
  czmlDataSource1.load('orbit.czml');
  viewer.dataSources.add(czmlDataSource1);
}
</script>
  <style>
      @import url(../Build/Cesium/Widgets/widgets.css);
      html, body, #cesiumContainer {
          width: 100%; height: 100%; margin: 0; padding: 0; overflow: hidden;
      }

* {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}
button.close {
    -webkit-appearance: none;
    padding: 0;
    cursor: pointer;
    background: 0 0;
    border: 0;
    display: inline-block;
}


.dropbtn {
  background-color: #3498DB;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
  cursor: pointer;
}

.dropbtn:hover, .dropbtn:focus {
  background-color: #2980B9;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 160px;
  overflow: auto;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown a:hover {background-color: #ddd;}



.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: hidden!important;
}

/* Modal Content/Box */
.modal-content {

  margin: 15% auto; /* 15% from the top and centered */
  border: 1px solid #888;
  width: 80%; /* Could be more or less, depending on screen size */zccccccc
  position: relative;
  background-color: #fff;
  -webkit-background-clip: padding-box;
  background-clip: padding-box;
  border: 1px solid rgba(0,0,0,.2);
  border-radius: 6px;
  outline: 0;
  -webkit-box-shadow: 0 3px 9px rgba(0,0,0,.2);
  box-shadow: 0 3px 9px rgba(0,0,0,.2);

}

.modal-header {
    padding: 15px;
    border-bottom: 1px solid #e5e5e5;
    cursor:move;


}

.modal-title {
    margin: 0;
    line-height: 1;

}
/* The Close Button */
.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bolder;
  margin: -10px auto;
}

.close:hover,
.close:focus {
  color: red;
  text-decoration: none;
  cursor: pointer;
}

.show {display: block;}

.example_content {
    display : none;
}
/* The whole thing */
.custom-menu {
    display: none;
    z-index: 1000;
    position: absolute;
    overflow: hidden;
    border: 1px solid #CCC;
    white-space: nowrap;
    font-family: sans-serif;
    background: #FFF;
    color: #333;
    border-radius: 5px;
    padding: 0;
}
input {
    border: 1px solid #c4c4c4;
    padding: 8px;
    border-radius: 10px;
    -moz-border-radius: 4px;
    -webkit-border-radius: 4px;
    box-shadow: 0px 0px 8px #d9d9d9;
    -moz-box-shadow: 0px 0px 8px #d9d9d9;
    -webkit-box-shadow: 0px 0px 8px #d9d9d9;
}

input:focus {
    outline: none;
    border: 1px solid #7bc1f7;
    box-shadow: 0px 0px 8px #7bc1f7;
    -moz-box-shadow: 0px 0px 8px #7bc1f7;
    -webkit-box-shadow: 0px 0px 8px #7bc1f7;

}
input:required:invalid {
  border: 1px solid #f90c0c;
  padding: 4px;
  border-radius: 4px;
  -moz-border-radius: 4px;
  -webkit-border-radius: 4px;
  box-shadow: 0px 0px 8px #fe2f2f;
  -moz-box-shadow: 0px 0px 8px #fe2f2f;
  -webkit-box-shadow: 0px 0px 8px #fe2f2f;
}

/* Each of the items in the list */
.custom-menu li {
    padding: 8px 12px;
    cursor: pointer;
    list-style-type: none;
    transition: all .3s ease;
    user-select: none;
}

.custom-menu li:hover {
    background-color: #DEF;
}
  </style>
</head>
<body>


  <div id="cesiumContainer"></div>

<ul class='custom-menu'>
  <li data-action="first">First thing</li>
  <li data-action="second">Second thing</li>
  <li data-action="third">Third thing</li>
</ul>

<div class="toolbar-left">
  <div id="selectsatwindow" class="example_content" style="display: block;"><div>
    <div style="margin-left: 50%;  margin-right: 50%;" id="selectsatellitewindowdiv">
      <input type="text" name="search" placeholder="Search Satellite..." onkeyup="searchSatellite()" id="satellitesearchInput" >
          <?php getsatnames($conn); ?>
    </div>
    <div>
         <button type="button" class="btn btn-danger" onclick="this._Close('selectsatwindow')">Close</button>
          <button type="button" class="btn btn-primary" onclick="czmlload()" >Save changes</button>
  </div>
</div>
</div>

  <div id="basic-demo2" class="example_content">
    Add Satellite <br>
    Name:  <input type="text" id="addsatellitename" > <br>
    TLE Line 1: <input type="text" id="addsatellitetle1" > <br>
    TLE Line 2: <input type="text" id="addsatellitetle2" > <br>
    <button type="button" class="btn btn-primary" onclick="checkaddsatellite();" >Add Satellite</button>

  </div>
  <div id="deletesatwindow" class="example_content" style="display: block;"><div>
    <div style="margin-left: 50%;  margin-right: 50%;" id="deletesatellitewindowdiv">
      <input type="text" name="search" placeholder="Search Satellite..." onkeyup="searchSatellite()" id="satellitesearchInput" >
          <?php getsatnames($conn); ?>
    </div>
    <div>
          <button type="button" class="btn btn-danger" onclick="czm" >Save changes</button>
  </div>
</div>
<div id="genbeamwindow" class="example_content" style="display: block;">
  Generate Targeted Spotbeam <br>
  Usage: <select id="beamusage" onchange="beamunitchange();">
      <option selected="selected" value="D">Downlink</option>
      <option value="U">Uplink</option>
    </select> <br>
 Band: <select id="Beamband" onchange="beamunitchange();">
     <option value="L">L</option>
     <option value="S">S</option>
     <option value="C">C</option>
     <option selected="selected" value="Ku">ku</option>
     <option value="Ka">Ka</option>
   </select> <br>
Beam Center Location: <br>
Longitude: <input type="text" id="beamcenterlongtitude" >
Latitude: <input type="text" id="beamcenterlatitude" > <br>
Beam Characteristics: <br>
Max gain:  <input type="text" placeholder="50" id="beamcenterlongtitude" > <label id="beamunit1">dBW</label>
Min gain:  <input type="text" placeholder="42" id="beamcenterlongtitude" > <label id="beamunit2">dBW</label> <br>
Semi-major axis Max gain: <input type="text" placeholder="350" id="beamrsmmaxgain" > Km <br>
Step: <input type="text" placeholder="1" id="beamstep" > <br>
Eccentricity: <input type="text" placeholder="1" id="beameccentricity" > <br>
Rotation: <input type="text" placeholder="0" id="beamrotation" > degrees <br>
Tightness: <input type="text" placeholder="1" id="beamtightness" > <br>

<div>
      <button type="button" class="btn btn-primary" onclick="checkandgeneratebeam();" >Generate Beam</button>
</div>



</div>
  <div id="edit-dish" class="example_content">
    Edit dish <br>
    Name:  <input type="text" id="editdishname" > <br>
    Antenna Location: <br>
    Longitude: <input type="text" id="editdishlongtitude" >
    Latitude: <input type="text" id="editdishlatitude" > <br>
    Antenna characteristics:
    Size: <input type="text" id="editdishsize" > cm
    Gain: <input type="text" id="editdishgain" > dB
    Usage:
    <input type="radio" id="" name="dishusageselecte" value="1">
    <label for="1">Downlink</label><br>
    <input type="radio" name="dishusageselecte" value="2">
    <label for="2">Uplink</label><br>
     <br>
     <input type="hidden" id="editdishid" value="">
    <button type="button" class="btn btn-primary" onclick="checkeditdish(document.getElementById('editdishid').value);" >Edit Dish</button>
  </div>
  <div id="add-dish" class="example_content">
    Add dish <br>
    Name:  <input type="text" id="adddishname" placeholder="Example dish"> <br>
    Antenna Location: <br>
    longitude: <input type="text" id="adddishlongtitude" placeholder="0.0000000">
    Latitude: <input type="text" id="adddishlatitude" placeholder="0.0000000"> <br>
    Antenna characteristics:
    Size: <input type="text" id="adddishsize" placeholder="100"> cm
    Gain: <input type="text" id="adddishgain" placeholder="40.0"> dB
    Usage:
    <input type="radio" id="" name="dishusageselect" value="1" checked>
    <label for="1">Downlink</label><br>
    <input type="radio" name="dishusageselect" value="2">
    <label for="2">Uplink</label><br>
     <br>
    <button type="button" class="btn btn-primary" onclick="checkadddish();" >Add dish</button>

  </div>
 <div id="manage-dishes" class="example_content">
   Dish list: <br>
   <table id="dishtable" style="display:none">
     getdishlist();
   </table>
<button type="button" class="btn btn-primary" onclick="showadddish();" >Add new dish</button>
<button type="button" class="btn btn-warning" onclick="showeditdish();" >Edit dish</button>
<button type="button" class="btn btn-danger" onclick="deletedish();" >Delete dish</button>

 </div>

</div>
  <script>
  var viewer = new Cesium.Viewer('cesiumContainer', {
      terrainProvider: Cesium.createWorldTerrain()
  });

  var dishlookup= new Array();

  $(".custom-menu li").click(function(){
       switch($(this).attr("data-action")) {
        case "Add dish": alert("first"); break;
        case "Measure distance": alert("second"); break;
        case "third": alert("third"); break;
   }$(".custom-menu").hide(0);});

    viewer.scene.canvas.addEventListener('contextmenu', (event) => {
      event.preventDefault();
      const mousePosition  = new Cesium.Cartesian2(event.clientX, event.clientY);
     const selectedLocation = viewer.scene.pickPosition(mousePosition);
     var validpos=testPos(selectedLocation);
     if(validpos==0){
	 setMarkerInPos(Cesium.Cartographic.fromCartesian(selectedLocation));

     $(".custom-menu").hide(0);
     $(".custom-menu").finish().toggle(50).css({
                top: event.pageY + "px",
                left: event.pageX + "px"
      });
    }}, false);
    viewer.scene.canvas.addEventListener('mousedown', (event) => {
      $(".custom-menu").hide(0);
    }, false);

   function testPos(positionCartographic){
     try{
       var test=Cesium.Cartesian3.fromRadians(positionCartographic.longitude, positionCartographic.latitude, 10);
       return 0;
     }
     catch (Err){
       return 1;
     }
   }

    function setMarkerInPos(positionCartographic){

      viewer.entities.removeById("locationMarker");

     viewer.pickTranslucentDepth = true;
        var locationMarker = viewer.entities.add({
          id : 'locationMarker',
          name : 'location',
          position : Cesium.Cartesian3.fromRadians(positionCartographic.longitude, positionCartographic.latitude, 10),
          point : {
            pixelSize : 5,
            color : Cesium.Color.RED,
            outlineColor : Cesium.Color.WHITE,
            outlineWidth : 2,
            heightReference: Cesium.HeightReference.RELATIVE_TO_GROUND
          },
          label : {
            text : Cesium.Cartesian3.fromRadians(positionCartographic.longitude, positionCartographic.latitude, 10).toString(),
            font : '14pt monospace',
            style: Cesium.LabelStyle.FILL_AND_OUTLINE,
            outlineWidth : 2,
            verticalOrigin : Cesium.VerticalOrigin.BOTTOM,
            pixelOffset : new Cesium.Cartesian2(0, -9),
              heightReference: Cesium.HeightReference.RELATIVE_TO_GROUND
          }
        });

    }

    var windows = (function($, undefined){
      $(function(){
            showsatellites();
            showaddsatellte();
        });

  function isNumber(n){
    return n!=null && !isNaN(n) && isFinite(n);
  }
  function checkaddsatellite(){
    document.getElementById("addsatellitename").setCustomValidity('');
    document.getElementById("addsatellitetle1").setCustomValidity('');
    document.getElementById("addsatellitetle2").setCustomValidity('');
    var namestr=document.getElementById("addsatellitename").value.trim();
    var tle1line=document.getElementById("addsatellitetle1").value.trim();
    var tle2line=document.getElementById("addsatellitetle2").value.trim();
    var er=0;
    if(namestr==""){
      document.getElementById("addsatellitename").setCustomValidity('Name is required.');
      er=1;
    }
    if(tle1line==""){
      document.getElementById("addsatellitetle1").setCustomValidity('First line of TLE is required.');
      er=1;
    }
    if(tle2line==""){
      document.getElementById("addsatellitetle2").setCustomValidity('Second line of TLE is required.');
      er=1;
    }
    if(tle1line.charAt(0)!="1" tle1line.length!=69){
      document.getElementById("addsatellitetle1").setCustomValidity('Invalid first line of TLE.');
      er=1;
    }
    if(tle2line.charAt(0)!="2" tle2line.length!=69){
      document.getElementById("addsatellitetle2").setCustomValidity('Invalid second line of TLE.');
      er=1;
    }
    if(er==0){
        $.ajax({
          url: ""
          type: "POST",
          data:{"Name":addsatellitename, "TLE1":addsatellitetle1, "TLE2":addsatellitetle2}
        })
    }

  }
  function removesatellite(){
        $.ajax({
          url: ""
          type: "POST",
          data:{"Name":removesatellitename}
        })
    }

  }
  function beamSelectorChange(){
    var beamSel=document.getElementById("beamSelector");
    var sel=beamSel.value;
    if(sel=="null"){
      return;
    }
    else if(sel=="generate"){
      showgenbeamwindow();
    }

  }
  function checkadddish(){
    document.getElementById("adddishname").setCustomValidity('');
    document.getElementById("adddishlatitude").setCustomValidity('');
    document.getElementById("adddishlongtitude").setCustomValidity('');
    document.getElementById("adddishsize").setCustomValidity('');
    document.getElementById("adddishgain").setCustomValidity('');

    var namestr=document.getElementById("adddishname").value;
    var latitude=document.getElementById("adddishlatitude").value;
    var longitude=document.getElementById("adddishlongtitude").value;
    var size=document.getElementById("adddishsize").value;
    var gain=document.getElementById("adddishgain").value;
    var er=0;

    if(namestr.trim()==""){
      document.getElementById("adddishname").setCustomValidity('Name is required.');
      er=1;
    }
    if(longtitude.trim()==""){
      document.getElementById("adddishname").setCustomValidity('Longitude is requied.');
      er=1;
    }
    else{
      if(!isNumber(longitude.trim()){
        document.getElementById("adddishname").setCustomValidity('Invalid Longtitude.');
        er=1;
      }
      else{
        if(Number(longtitude.trim())>180 || Number(longtitude.trim())<-180){
          document.getElementById("adddishname").setCustomValidity('Longtitude must be in [-180,180] range.');
          er=1;
        }
      }
    }
    if(latitude.trim()==""){
      document.getElementById("adddishname").setCustomValidity('Latitude is required.');
      er=1;
    }
    else {
      if(!isNumber(latitude.trim()){
        document.getElementById("adddishname").setCustomValidity('Invalid Latitude.');
        er=1;
      }
      if(Number(longtitude.trim())>180 || Number(longtitude.trim())<-180){
        document.getElementById("adddishname").setCustomValidity('Latitude must be in [-90,90] range.');
        er=1;
      }
    }
    if(size.trim()==""){
      document.getElementById("adddishname").setCustomValidity('Size is required.');
      er=1;
    }
    else{
      if(!isNumber(size.trim()) || Number(size.trim())<=0){
        document.getElementById("adddishname").setCustomValidity('Invalid Size.');
        er=1;
      }
    }
    if(gain.trim()==""){
      document.getElementById("adddishname").setCustomValidity('Gain is required.');
      er=1
    }
    else{
      if(!isNumber(Gain.trim()){
        document.getElementById("adddishname").setCustomValidity('Invalid Gain.');
        er=1;
      }
    }
    if(er!=1){
      adddishinterrain();
    }
    return;
}
    function checkeditish(dishid){
      document.getElementById("editdishname").setCustomValidity('');
      document.getElementById("editdishlatitude").setCustomValidity('');
      document.getElementById("editdishlongtitude").setCustomValidity('');
      document.getElementById("editdishsize").setCustomValidity('');
      document.getElementById("editdishgain").setCustomValidity('');

      var namestr=document.getElementById("editdishname").value;
      var latitude=document.getElementById("editdishlatitude").value;
      var longitude=document.getElementById("editdishlongtitude").value;
      var size=document.getElementById("editdishsize").value;
      var gain=document.getElementById("editdishgain").value;
      var er=0;

      if(namestr.trim()==""){
        document.getElementById("editdishname").setCustomValidity('Name is required.');
        er=1;
      }
      if(longtitude.trim()==""){
        document.getElementById("editdishname").setCustomValidity('Longitude is requied.');
        er=1;
      }
      else{
        if(!isNumber(longitude.trim()){
          document.getElementById("editdishname").setCustomValidity('Invalid Longtitude.');
          er=1;
        }
        else{
          if(Number(longtitude.trim())>180 || Number(longtitude.trim())<-180){
            document.getElementById("editdishname").setCustomValidity('Longtitude must be in [-180,180] range.');
            er=1;
          }
        }
      }
      if(latitude.trim()==""){
        document.getElementById("editdishname").setCustomValidity('Latitude is required.');
        er=1;
      }
      else {
        if(!isNumber(latitude.trim()){
          document.getElementById("editdishname").setCustomValidity('Invalid Latitude.');
          er=1;
        }
        if(Number(longtitude.trim())>180 || Number(longtitude.trim())<-180){
          document.getElementById("editdishname").setCustomValidity('Latitude must be in [-90,90] range.');
          er=1;
        }
      }
      if(size.trim()==""){
        document.getElementById("editdishname").setCustomValidity('Size is required.');
        er=1;
      }
      else{
        if(!isNumber(size.trim()) || Number(size.trim())<=0){
          document.getElementById("editdishname").setCustomValidity('Invalid Size.');
          er=1;
        }
      }
      if(gain.trim()==""){
        document.getElementById("editdishname").setCustomValidity('Gain is required.');
        er=1
      }
      else{
        if(!isNumber(Gain.trim()){
          document.getElementById("editdishname").setCustomValidity('Invalid Gain.');
          er=1;
        }
      }
      if(er!=1){
        adddishinterrain(dishid);
      }
      return;

  }
  function removedish(dishid){
    for(var i=0;i<dishlookup.length;i++){

      if (dishlookup[i].getId()==dishid) {
        dishlookup.splice(i,1);
        break;
      }
    }
    viewer.entities.removeById(dishid);
  }
   function getdishlist(){

     if(dishlookup.length==0){
       return;
     }
     else{
       document.getElementById("dishtable").style.display="table";
     }
     for (var i=0;i<dishlookup.length;i++){
       htmlstr=htmlstr+ '<tr><td>' +dishlookup[i].getName()+ '</td><td> <button type="button" class="btn btn-warning" onclick="openeditdishwindow('+dishlookup[i].getId()+');">Edit dish </button> <button type="button" class="btn btn-danger" onclick="removedish('+dishlookup[i].getId()+');  $(this).closest('+"'tr'"+').remove(); if(dishlookup.length==0){document.getElementById("dishtable").style.display="none";}">Remove dish </button></td></tr>';
     }

     return htmlstr;
   }
   function adddishinterrain(dishid){
     if(dishid===undefined){
     var id=0;
     for(var i=0;i<dishlookup.length;i++){
       var num=dishlookup[i].getId().substring(5);
       if (num>id) {
         id=num;
       }
     }
     var usage;
     var radios = document.getElementsByName('dishusageselect');
     for (var i = 0, length = radios.length; i < length; i++) {
      if (radios[i].checked) {
        usage=radios[i].value;
        break;
      }
    }
     var disho=new dish("dish_"+id,document.getElementById("adddishname"),document.getElementById("adddishlongtitude").value,document.getElementById("adddishlatitude").value,document.getElementById("adddishsize").value,document.getElementById("adddishgain").value,usage);
     dishlookup.add(disho);

      var dishobj= viewer.entities.add({
        id : 'dish_'+id.toString(),
        name : document.getElementById("adddishname").value,
        position : Cesium.Cartesian3.fromRadians(document.getElementById("adddishlongtitude").value,document.getElementById("adddishlatitude").value),
        model : {
              uri : 'Resources/dish.gltf'
        }
      });
      $("#dishtable").append('<tr><td>' +disho.getName()+ '</td><td> <button type="button" class="btn btn-warning" onclick="openeditdishwindow('+disho.getId()+');">Edit dish </button> <button type="button" class="btn btn-danger" onclick="removedish('+disho.getId()+');  $(this).closest('+"'tr'"+').remove(); if(dishlookup.length==0){document.getElementById("dishtable").style.display="none";}">Remove dish </button></td></tr>');
    }
    else{
      removedish(dishid);
      var usage;
      var radios = document.getElementsByName('dishusageselecte');
      for (var i = 0, length = radios.length; i < length; i++) {
       if (radios[i].checked) {
         usage=radios[i].value;
         break;
       }
      var disho=new dish(dishid,document.getElementById("editdishname"),document.getElementById("editdishlongtitude").value,document.getElementById("editdishlatitude").value,document.getElementById("editdishsize").value,document.getElementById("editdishgain").value,usage);
      dishlookup.add(disho);
      var dishobj= viewer.entities.add({
        id : dishid,
        name : document.getElementById("editdishname").value,
        position : Cesium.Cartesian3.fromRadians(document.getElementById("editdishlongtitude").value,document.getElementById("editdishlatitude").value),
        model : {
              uri : 'Resources/dish.gltf'
        }
      });
    }



   }
   function addUpperLeftDiv() {
    var divUL = document.getElementById('divUpperLeft');
    if (!divUL) {
        divUL = document.createElement('div');
        divUL.id = 'divUpperLeft';
        divUL.style.position = "absolute";
        divUL.style.background = "rgba(0,0,0,0)";
        divUL.style.left = "10px";
        divUL.style.top = "10px";
        divUL.innerHTML = "";
        divUL.style.zIndex = 2000;
        document.getElementById("cesiumContainer").appendChild(divUL);
    }
}
function includeBeamSelector() {
  var divContainer = document.createElement("div");
  var beamSelector = document.createElement("select");
  beamSelector.id = "beamSelector";
  beamSelector.onchange="beamSelectorChange()";
  beamSelector.disabled="true";
  var opt1= document.createElement("option");
  opt1.innerText="--Select Beam--";
  opt1.value="null";
  opt1.selected="true";
  var opt2=document.createElement("option");
  opt2.innerText="Generate Custom Targeted Spotbeam";
  opt2.value="generate";
  beamSelector.appendChild(opt1);
  beamSelector.appendChild(opt2);
  divContainer.appendChild(beamSelector);



}
function includeSatellitesButton() {

    var divContainer = document.createElement("div");

    var satellitesButton = document.createElement("input");
    satellitesButton.id = "satellitesButton";
    satellitesButton.type = "button";
    satellitesButton.value = "Satellites";
    satellitesButton.style.width = "50px";
    satellitesButton.style.marginLeft = "5px";
    var satelitesdropdown=document.createElement("div");

    satellitesButton.onclick = function() {
            document.getElementById("Dropdown1").classList.toggle("show");
    };

    divContainer.appendChild(satellitesButton);
        var divContainer1 = document.createElement("div");
        divContainer1.id="Dropdown1";
        divContainer1.className="dropdown-content";
        var a1= document.createElement("a");
        a1.setAttribute('href', 'javascript:showsatellites()');
        a1.innerText = 'Select satellite';
        a1.id="a1";
        divContainer1.appendChild(a1);
        var a2= document.createElement("a");
        a2.setAttribute('href', 'javascript:showaddsatellte()');
        a2.innerText = 'Add satellite';
        a2.id="a2";
        divContainer1.appendChild(a2);
        divContainer.appendChild(divContainer1);
    document.getElementById("divUpperLeft").appendChild(divContainer);
}
function includeProjectButton() {

    var divContainer = document.createElement("div");

    var projectButton = document.createElement("input");
    projectButton.id = "projectButton";
    projectButton.type = "button";
    projectButton.value = "Satellites";
    projectButton.style.width = "50px";
    projectButton.style.marginLeft = "5px";
    var projectdropdown=document.createElement("div");

    projectButton.onclick = function() {
            document.getElementById("Dropdown3").classList.toggle("show");
    };

    divContainer.appendChild(projectButton);
        var divContainer3 = document.createElement("div");
        divContainer3.id="Dropdown3";
        divContainer3.className="dropdown-content";
        var a5= document.createElement("a");
        a5.setAttribute('href', 'javascript:openProject()');
        a5.innerText = 'Open Project';
        a5.id="a5";
        divContainer3.appendChild(a5);
        var a6= document.createElement("a");
        a6.setAttribute('href', 'javascript:saveProject()');
        a6.innerText = 'Save Project';
        a6.id="a6";
        divContainer3.appendChild(a6);
        divContainer.appendChild(divContainer3);
    document.getElementById("divUpperLeft").appendChild(divContainer);
}
function includeCommunicationsButton() {

    var divContainer = document.createElement("div");

    var communicaionsButton = document.createElement("input");
    communicaionsButton.id = "communicaionsButton";
    communicaionsButton.type = "button";
    communicaionsButton.value = "Communications";
    communicaionsButton.style.width = "50px";
    communicaionsButton.style.marginLeft = "5px";
    var communicationsdropdown=document.createElement("div");

    communicaionsButton.onclick = function() {
            document.getElementById("Dropdown2").classList.toggle("show");
    };

    divContainer.appendChild(communicaionsButton);
        var divContainer2 = document.createElement("div");
        divContainer2.id="Dropdown2";
        divContainer2.className="dropdown-content";
        var a3= document.createElement("a");
        a3.setAttribute('href', 'showmanagedishes();');
        a3.innerText = 'Manage dishes';
        a3.id="a3";
        divContainer2.appendChild(a3);
        var a4= document.createElement("a");
        a4.setAttribute('href', '');
        a4.innerText = 'Calculate db';
        a4.id="a4";
        divContainer2.appendChild(a4);
        divContainer.appendChild(divContainer2);
    document.getElementById("divUpperLeft").appendChild(divContainer);
}
addUpperLeftDiv();
includeProjectButton();
includeSatellitesButton();
includeCommunicationsButton();

function showsatellites(){
  $('#selectsatwindow').PopupWindow({
              autoOpen    : false,
              nativeDrag: false
          });
          $("#a1").on("click", function(event){
              $("#selectsatwindow").PopupWindow("open");
          });
}
function showaddsatellte(){
  $('#basic-demo2').PopupWindow({
              autoOpen    : false,
              nativeDrag: false
          });
          $("#a2").on("click", function(event){
              $("#basic-demo2").PopupWindow("open");
          });
  }
function showmanagesatellte(){
    $('#manage-satellites').PopupWindow({
                autoOpen    : false,
                nativeDrag: false
            });
      $("#manage-satellites").PopupWindow("open");
  }
function showadddish(){
    $('#add-dish').PopupWindow({
                autoOpen    : false,
                nativeDrag: false
            });
            $("#add-dish").PopupWindow("open");

}
function showmanagedishes(){
  $('#manage-dishes').PopupWindow({
          autoOpen    : false,
          nativeDrag: false
  });
  $("#manage-dishes").PopupWindow("open");

}
function showgenbeamwindow(){
  $('#genbeamwindow').PopupWindow({
          autoOpen    : false,
          nativeDrag: false
  });
    $("#genbeamwindow").PopupWindow("open");
}
function showeditdish(dishid){
  var sdish;
      for (var i=0 i<dishlookup.length<i++){
        if (dishlookup[i].getId()==dishid){
          sdish=dishlookup[i];
          break;
        }
      }
      document.getElementById("editdishname").value=sdish.getName();
      document.getElementById("editdishlatitude").value=sdish.getLatitude();
      document.getElementById("editdishlongtitude").value=sdish.getLongtitude();
      document.getElementById("editdishsize").value=sdish.getSize();
      document.getElementById("editdishgain").value=sdish.getGain();
      var usagev=sdish.getUsage();
      radiobtn = document.getElementById("dishusageselecte");
      if(usagev==1){
        radiobtn[0].checked=true;
        radiobtn[1].checked=false;
      }
      else if(usagev==2){
        radiobtn[1].checked=true;
        radiobtn[0].checked=false;
      }
      document.getElementById("edditdishid").value=dishid;
        $('#edit-dish').PopupWindow({
                    autoOpen    : false,
                    nativeDrag: false
                });
        }
        $("#edit-dish").PopupWindow("open");

})(jQuery);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

  </script>



</body>
</html>
