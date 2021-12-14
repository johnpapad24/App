<!DOCTYPE html>

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
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<link href="popupwindow.css" rel="stylesheet">
<script src="popupwindow.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/satellite.js/4.0.0/satellite.min.js"></script>
<script src="functions.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  <script src="../Build/Cesium/Cesium.js"></script>
  <style>
      @import url(../Build/Cesium/Widgets/widgets.css);
      @import url("program.css");
      @import url(https://fonts.googleapis.com/css?family=Roboto);
      html, body, #cesiumContainer {
          width: 100%; height: 100%; margin: 0; padding: 0; overflow: hidden;
      }

      * {
          -webkit-box-sizing: border-box;
          -moz-box-sizing: border-box;
          box-sizing: border-box;
        }


  </style>
</head>
<body>




  <div id="cesiumContainer"></div>

  <ul id="rightclickaction" class='rightclickaction'>
    <li data-action="Add dish">Add dish</li>
    <li data-action="Measure distance">Measure distance</li>
    <li data-action="Get Temperature">Get Temperature</li>
  </ul>

<div class="toolbar-left">

</div>
<script>
  var viewer = new Cesium.Viewer('cesiumContainer');
  var terrainobjs=new terrainobjects();
  $(".rightclickaction li").click(function(){
       switch($(this).attr("data-action")) {
        case "Add dish": var ttext=viewer.entities.getById('locationMarker').label.text.toString(); var etext=ttext.substring(1, ttext.length-1); strarr=etext.split(","); document.getElementById("adddishlongitude").value=strarr[0]; document.getElementById("adddishlatitude").value=strarr[1]; showadddishwindow();  break;
        case "Measure distance": alert("second"); break;
        case "Get Temperature": alert("third"); break;
   }$(".rightclickaction").hide(0);});


  viewer.scene.canvas.addEventListener('contextmenu', (event) => {
    event.preventDefault();
    const mousePosition = new Cesium.Cartesian2(event.clientX, event.clientY);
    const selectedLocation = convertScreenPixelToLocation(viewer,mousePosition);
    if(selectedLocation!=null){
      setMarkerInPos(viewer, selectedLocation);
      $(".rightclickaction").hide(0);
      $(".rightclickaction").finish().toggle(50).css({
               top: event.pageY + 4 + "px",
               left: event.pageX + 4 + "px"
      });
   }
  }, false);
  viewer.scene.canvas.addEventListener('click', (event) => {
    $(".rightclickaction").hide(0);
  }, false);



</script>
<!-- windows -->
<div id="errorwindow" style="display:none;">
</div>

 <div id="logwindow" style="display:none;" >
   <div style="width:100%; height:100%;">
   <div style="display: block; margin:auto; height: 100%; width:100%;"><textarea id="logtextarea" style="height: 100%; width:100%; resize:none; min-height:150px; min-width:350px;" readonly></textarea>
   <button style="left: 50%; position: relative; -ms-transform: translate(-50%); transform: translate(-50%);">OK</button>
 </div>
</div>
</div>

<div id="selectsatellitewindow" style="display: none;">
  <div style="margin: 0;  position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);" id="selectsatelliteloading">
    <div style="font-weight:bold; font-size:x-large; margin-bottom:10px;">Loading</div>
    <div class="lds-dual-ring"></div>
  </div>
  <div id="selectsatellitemainwindow" style="display:none;">
    <div style="max-height:20%; text-align:center;">
    <input type="text" class="sinput" name="search" placeholder="Search Satellite..." onkeyup="searchSatellite_new();" id="satellitesearchInput" >
    </div>
    <div style="margin:10px 10px 10px;" id="selectsatellitewindowtablespan">
    <script>satellitelistloader("selectsatellitewindow");</script></div>
    <div style="max-height:20%;">
          <button type="button" style="float:left;" class="btn btn-danger" onclick="this._Close('addsatellitewindow')">Close</button>
          <button type="button" style="float:right;" class="btn btn-primary" onclick="addsatellitetoterrain(viewer,terrainobjs);" >Save changes</button>
    </div>
</div>
</div>

<div id="deletesatellitewindow" style="display: none;">
  <div style="margin: 0;  position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);" id="deletesatelliteloading">
    <div style="font-weight:bold; font-size:x-large; margin-bottom:10px;">Loading</div>
    <div class="lds-dual-ring"></div>
  </div>
  <div id="deletesatellitemainwindow" style="display:none;">
    <div style="max-height:20%; text-align:center;">
    <input type="text" class="sinput" name="search" placeholder="Search Satellite..." onkeyup="searchSatellite_new2();" id="satellitesearchInput2" >
    </div>
    <div style="margin:10px 10px 10px;" id="deletesatellitewindowtablespan">
    <script>satellitelistloader("deletesatellitewindow");</script></div>
    <div style="max-height:20%;">
          <button type="button" style="float:left;" class="btn btn-primary" onclick="this._Close('addsatellitewindow')">Close</button>
          <button type="button" style="float:right;" class="btn btn-danger" onclick="showdeletesatelliteconfirmdialog();" >Delete Satelite</button>
    </div>
</div>
</div>



<div id="managesatellitewindow" style="display: none;">
  <div style="margin: 0;  position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);" id="msatelliteloading">
    <div style="font-weight:bold; font-size:x-large; margin-bottom:10px;">Loading</div>
    <div class="lds-dual-ring"></div>
  </div>
  <div style="margin: 0;  position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);" id="managenoselected">
    <div style="font-weight:bold; font-size:x-large; min-width:max-content;">There are no satellites selected</div>
  </div>
  <div id="managesatellitemainwindow" style="display:none;">
   <div style="max-height:20%; text-align:center;">
     <span style="font-weight:bold; font-size:x-large;">Selected Satellites</span>
   </div>
    <div style="margin:10px 10px 10px;" id="managesatellitewindowtablespan">
    <table id="managesatellitetable" style="text-align:center; height: 270px; overflow-y: auto; display: block; overflow-x: auto;"></table>
    <div style="max-height:20%;">
          <button type="button" style="float:left;" class="btn btn-danger" onclick="this._Close('addsatellitewindow')">Close</button>
          <button type="button" style="float:right;" class="btn btn-primary" onclick="managesatelliteapplychanges(viewer,terrainobjs);" >Save changes</button>
    </div>
</div>
</div>
</div>

<div id="addsatellitewindow" style="display: none;">
  <div style="font-weight:bold; font-size:x-large; text-align:center;"> Add Satelite </div>
  <div style="text-align:center; margin-bottom:8px; margin-top:8px;">Name:  <input type="text" id="addsatellitename" placeholder="Example satellite" onclick=""> <span id="addsatellitenameerror" style="font-weight:bold; padding-left: 3px; color:#fe2f2f"></span></div>
  <div style="text-align:center; margin-bottom:8px;">TLE Line 1:  <input type="text" style="width:530px;" id="addsatellitetle1" placeholder="1 25544U 98067A   08264.51782528 -.00002182  00000-0 -11606-4 0  2927" onclick=""> <span id="addsatellitetle1error" style="font-weight:bold; padding-left: 3px; color:#fe2f2f"></span></div>
  <div style="text-align:center; margin-bottom:8px;">TLE Line 2:  <input type="text" style="width:530px;" id="addsatellitetle2" placeholder="2 25544  51.6416 247.4627 0006703 130.5360 325.0288 15.72125391563537" onclick=""> <span id="addsatellitetle2error" style="font-weight:bold; padding-left: 3px; color:#fe2f2f"></span></div>
  <div>
    <button type="button" style="float:left;" class="btn btn-danger" onclick="this._Close('addsatellitewindow')">Close</button>
    <button type="button"  style="float:right;" class="btn btn-primary" onclick="checkandaddsatellite();" >Add Satellite</button>
  </div>

</div>

<div id="adddishwindow" style="display: none;">
  <div style="font-weight:bold; font-size:x-large; text-align:center;"> Add dish </div>

 <div>
   <div style="text-align:center;   font-weight: bold; margin-top:8px; margin-bottom:8px;">Antenna Name:</div>
 <div style="text-align:center; margin-bottom:8px;">Name:  <input type="text" id="adddishname" placeholder="Example dish" onclick=""> <span id="adddishnameerror" style="font-weight:bold; padding-left: 3px; color:#fe2f2f"></span></div>
  <div style="text-align:center;   font-weight: bold; margin-bottom:8px;">Antenna Location:</div>

  <div style="text-align:center; margin-bottom:8px;"> longitude: <input type="text" id="adddishlongitude" placeholder="0.0000000">,<input type="text" id="adddishlatitude" placeholder="0.0000000"> :Latitude </div>
  <div style="text-align: center;">
    <span id="adddishlongitudeerror" style="font-weight:bold; color:#fe2f2f"></span>
  </div>
  <div style="text-align: center;">
    <span id="adddishlatitudeerror" style="font-weight:bold; color:#fe2f2f"></span>
  </div>
  <div style="text-align:center;   font-weight: bold; margin-bottom:8px;">Antenna Specifications:</div>

  <div style="text-align:center; margin-bottom:8px;">Size: <input type="text" id="adddishsize" placeholder="100"> cm   <span id="adddishsizeerror" style="font-weight:bold; padding-left: 3px; color:#fe2f2f"></span></div>
  <div style="text-align:center; margin-bottom:8px;">Gain: <input type="text" id="adddishgain" placeholder="40.0"> dB  <span id="adddishgainerror" style="font-weight:bold; padding-left: 3px; color:#fe2f2f"></span></div>
  <div style="text-align:center; font-weight: bold;">Usage:</div>
  <div style="text-align:center;">
  <label for="1" style="font-weight:normal;">Downlink:</label>
  <input type="radio" name="adddishusageselect" value="1" checked>
  <label for="2" style="font-weight:normal;">Uplink:</label>
  <input type="radio" name="adddishusageselect" value="2">
</div>
<div>
  <button type="button" style="float:left;" class="btn btn-danger" onclick="this._Close('addsatellitewindow')">Close</button>
  <button type="button"  style="float:right;" class="btn btn-primary" onclick="checkandadddishinterrain(viewer,terrainobjs);" >Add dish</button>
</div>
</div>
</div>

<div id="editdishwindow" style="display: none;">
  <span id="editdishid" style="display:none;"></span>
  <div style="font-weight:bold; font-size:x-large; text-align:center;">Edit dish</div>

 <div>
   <div style="text-align:center;   font-weight: bold; margin-top:8px; margin-bottom:8px;">Antenna Name:</div>
 <div style="text-align:center; margin-bottom:8px;">Name:  <input disabled type="text" id="editdishname" placeholder="Example dish" onclick=""> <span id="editdishnameerror" style="font-weight:bold; padding-left: 3px; color:#fe2f2f"></span></div>
  <div style="text-align:center;   font-weight: bold; margin-bottom:8px;">Antenna Location:</div>

  <div style="text-align:center; margin-bottom:8px;"> longitude: <input type="text" id="editdishlongitude" placeholder="0.0000000">,<input type="text" id="editdishlatitude" placeholder="0.0000000"> :Latitude </div>
  <div style="text-align: center;">
    <span id="editdishlongitudeerror" style="font-weight:bold; color:#fe2f2f"></span>
  </div>
  <div style="text-align: center;">
    <span id="editdishlatitudeerror" style="font-weight:bold; color:#fe2f2f"></span>
  </div>
  <div style="text-align:center;   font-weight: bold; margin-bottom:8px;">Antenna Specifications:</div>

  <div style="text-align:center; margin-bottom:8px;">Size: <input type="text" id="editdishsize" placeholder="100"> cm   <span id="editdishsizeerror" style="font-weight:bold; padding-left: 3px; color:#fe2f2f"></span></div>
  <div style="text-align:center; margin-bottom:8px;">Gain: <input type="text" id="editdishgain" placeholder="40.0"> dB  <span id="editdishgainerror" style="font-weight:bold; padding-left: 3px; color:#fe2f2f"></span></div>
  <div style="text-align:center; font-weight: bold;">Usage:</div>
  <div style="text-align:center;">
  <label for="1" style="font-weight:normal;">Downlink:</label>
  <input type="radio" id="editdishusageselectdnl" name="editdishusageselect" value="1" checked>
  <label for="2" style="font-weight:normal;">Uplink:</label>
  <input type="radio" id="editdishusageselectupl" name="editdishusageselect" value="2">
</div>
<div>
  <button type="button" style="float:left;" class="btn btn-danger" onclick="this._Close('addsatellitewindow')">Close</button>
  <button type="button" style="float:right;" class="btn btn-primary" onclick="checkandeditdishinterrain(viewer,terrainobjs);" >Edit dish</button>
</div>
</div>
</div>

<div id="managedisheswindow" style="display: none;">
  <div style="margin: 0;  position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);" id="mdishesloading">
    <div style="font-weight:bold; font-size:x-large; margin-bottom:10px;">Loading</div>
    <div class="lds-dual-ring"></div>
  </div>
  <div style="margin: 0;  position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);" id="managedishesnoselected">
    <div style="font-weight:bold; font-size:x-large; min-width:max-content;">There are no dishes in the field.</div>
  </div>
  <div id="managedishesmainwindow" style="display:none;">
   <div style="max-height:20%; text-align:center;">
     <span style="font-weight:bold; font-size:x-large;">Antennas</span>
   </div>
    <div style="margin:10px 10px 10px;" id="managedishestablespan">
    <table id="managedishestable" style="text-align:center; height: 270px; overflow-y: auto; display: block; overflow-x: auto;"></table>
    <div style="max-height:20%;">
          <button type="button" style="float:left;" class="btn btn-danger" onclick="this._Close('addsatellitewindow')">Close</button>
          <button type="button" style="float:right;" class="btn btn-primary" onclick="managedishesapplychanges(viewer,terrainobjs);" >Save changes</button>
    </div>
</div>
</div>
</div>



<div id="divUpperLeft" style="position:absolute; background:rgba(0,0,0,0); left:10px; top:5px; z-index:2000;">
  <div id="projectdropdown" class="dropdown dropdown-bubble" style="display:inline;"style="display:inline;">
    <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="height:32px;">
    <span class="projecticon"></span>
    <span style="display:inline-block; height: 32px; vertical-align: middle;">Project</span>
    </button>
    <ul id="projectdropdownmenu" class="dropdown-menu" style="margin-top: 10px;">
      <li><a href="" style="text-align:center;">Open project</a></li>
      <li><a href="" style="text-align:center;">Save project</a></li>
      </ul>
    </div>

    <div id="satellitesdropdown" class="dropdown dropdown-bubble" style="display:inline;">
      <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="height:32px;">
        <span class="satellitesicon"></span>
        <span style="display:inline-block; height: 32px; vertical-align: middle;">Satellites</span>
      </button>
      <ul id="satellitesdropdownmenu" class="dropdown-menu" style="margin-top: 10px;">
        <li><a onclick="constructmanagesatellitetable(terrainobjs); showmanagesatellitewindow();" style="text-align:center;">Manage satellites</a></li>
        <li><a onclick="showselectsatellitewindow();" style="text-align:center;">Select satellite</a></li>
        <li><a onclick="showaddsatellitewindow();" style="text-align:center;">Add Satellite</a></li>
        <li><a onclick="showdeletesatellitewindow();" style="text-align:center;">Delete Satellite</a></li>

        </ul>
      </div>

      <div id="antennasdropdown" class="dropdown dropdown-bubble" style="display:inline;">
        <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="height:32px;">
          <span class="antennasicon"></span>
          <span style="display:inline-block; height: 32px; vertical-align: middle;">Antennas</span>
        </button>
        <ul id="antennasdropdownmenu" class="dropdown-menu" style="margin-top: 10px;">
          <li><a onclick="showadddishwindow();" style="text-align:center;">Add dish</a></li>
          <li><a onclick="constructmanagedishestable(terrainobjs); showmanagedisheswindow();" style="text-align:center;">Manage dishes</a></li>

          </ul>
        </div>

      <div id="communicationsdropdown" class="dropdown dropdown-bubble" style="display:inline;">
        <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="height:32px;">
          <span class="communicationsicon"></span>
          <span style="display:inline-block; height: 32px; vertical-align: middle;">Communications</span>
        </button>
        <ul id="communicationsdropdownmenu" class="dropdown-menu" style="margin-top: 10px;">
          <li><a href="" style="text-align:center;">db fix</a></li>
          <li><a href="" style="text-align:center;">test1</a></li>
          </ul>
        </div>

      <div id="settingsdropdown" class="dropdown dropdown-bubble" style="display:inline;">
        <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width:32px; height:32px;">
        <span class="settingsicon"></span>
        </button>
      <ul id="settingsdropdownmenu" class="dropdown-menu" style="margin-top: 10px; min-width: 250px;">
        <span style="text-align:center; font-weight:bold; width: 100%; display: block; font-size:18px; ">Settings:</span>

        <p></p><div><span style="font-weight: bold; width: 100%; margin-left:7px">Unit Settings: </span></div>
          <div><span style="font-weight: normal; width: 100%; margin-left:10px">Temperature: </span>
            <div style="display:inline-block;">°C</div>
          <div style="display:inline-block; min-width:40px; text-align:left;">
          <label class="switch">
            <input type="checkbox" id="tempunitswitch" onclick="toggletempunitonclick();">
          <span class="slider round"></span>
          </label>
          </div>
          <div style="display:inline-block;">°F</div></div>
          <div><span style="font-weight: normal; width: 100%; margin-left:10px">Distance: </span>
          <div style="display:inline-block;">km</div>
          <div style="display:inline-block; min-width:40px; text-align:left;">
          <label class="switch">
            <input type="checkbox" id="lengthunitswitch" onclick="togglelengthunitonclick();">
          <span class="slider round"></span>
          </label>
          </div>
        <div style="display:inline-block;">mi</div></div>
          <div><span style="font-weight: normal; width: 100%; margin-left:10px">Earth system: </span>
          <div style="display:inline-block;">J2000</div>
          <div style="display:inline-block; min-width:40px; text-align:left;">
          <label class="switch">
            <input type="checkbox" id="eciunitswitch" onclick="toggleeciunitonclick();">
          <span class="slider round"></span>
          </label>
          </div>
          <div style="display:inline-block; ">TEME</div></div>
          <p></p>
          <div><span style="font-weight: bold; width: 100%; margin-left:7px">Viewer Settings: </span></div>
          <div><span style="font-weight: normal; width: 100%; margin-left:10px">Show axis: </span>
          <div style="font-weight: normal; width: 100%; max-width:250px; max-height:20px; margin-left:-32px;" >

            <span>Show x:</span>
            <div class="md-checkbox" style="display:inline; margin-right: 1.5em;">
              <input id="xaxischeckbox" type="checkbox" onclick="togglexaxisonclick();">
              <label for="xaxischeckbox"></label>
            </div>
            <span> Show y:</span>
            <div class="md-checkbox" style="display:inline; margin-right:1.5em;">
              <input id="yaxischeckbox" type="checkbox" onclick="toggleyaxisonclick();">
              <label for="yaxischeckbox"></label>
            </div>
            <span> Show z:</span>
            <div class="md-checkbox" style="display:inline; margin-left:0.2em">
              <input id="zaxischeckbox" type="checkbox" onclick="togglezaxisonclick();">
              <label for="zaxischeckbox"></label>
                </div>
            </div></div>

         <p></p>
         <div><span style="font-weight: bold; width: 100%; margin-left:7px">UI Settings: </span></div>
         <div style="font-weight: normal; width: 100%; margin-left: -5px;">
         <span>Dark mode: </span>
         <div class="md-checkbox" style="display:inline; margin-left:0.2em">
         <input type="checkbox" id="darkmodeswitch" onclick="toggledarkmodeonclick();">
         <label for="darkmodeswitch"></label>
         </div></div>
         <p></p>
         <div><span style="font-weight: bold; width: 100%; margin-left:7px">Miselaneous: </span></div>
        <li><a style="text-align:center;" onclick="showlogwindow();">Show log</a></li>
        </ul>
      </div>
      <script>
        $('ul.dropdown-menu').on('click', function(event){
            // The event won't be propagated up to the document NODE and
            // therefore delegated events won't be fired
            event.stopPropagation();
        });
      </script>
      <script>
      initializesettings();
      loadsettings();
      </script>
</div>




</body>
</html>
