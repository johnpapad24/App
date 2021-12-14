//classes
class terrainobjects{

  constructor() {
    this.satellites=[];
    this.dishes=[];
  }
  get getSatellitesInTerrain(){
    return this.satellites;
  }
  get getDishesInTerrain(){
    return this.dishes;
  }
}
class t_satellite{
  constructor(id, name, color, czml){
    this.id=id;
    this.name=name;
    this.color=color;
    this.czml=czml;
  }
  get getId(){
    return this.id;
  }
  get getName(){
    return this.name;
  }
  get getColor(){
    return this.color;
  }
  get getCzml(){
    return this.czml;
  }
}
class dish {
  constructor(id, name, longitude, latitude, size, gain, usage){
      this.id=id;
      this.name=name;
      this.longitude=longitude;
      this.latitude=latitude;
      this.size=size;
      this.gain=gain;
      this.usage=usage;

  }
  get getId(){
    return this.id;
  }
  get getName(){
    return this.name;
  }
  get getLongtitude(){
    return this.longitude;
  }

  get getLatitude(){
    return this.latitude;
  }
  get getSize(){
    return this.size;
  }
  get getSizeString(){
    return this.size + " cm";
  }
  get getGain(){
      return this.gain;
  }
  get getGainString(){
    return this.gain + " dB";
  }
  get getUsage(){
    return this.usage;
  }

}

//functions

function toggledarkmode(){
    dmswitch=document.getElementById("darkmodeswitch");
    if(dmswitch.checked== true){
      activatedarkmode();
    }
    else{
      deactivatedarkmode();
    }
}
function toggledarkmodeonclick(){
    toggledarkmode();
    settingssaver('darkmodeswitch',document.getElementById("darkmodeswitch").checked);
}

function togglelengthunit(){
  //tbi
}
function togglelengthunitonclick(){
  togglelengthunit();
  settingssaver('lengthunitswitch',document.getElementById("lengthunitswitch").checked);

}

function toggleeciunit(){
  //tbi
}
function toggleeciunitonclick(){
  toggleeciunit();
  settingssaver('eciunitswitch',document.getElementById("eciunitswitch").checked);

}
function toggletempunit(){
  //tbi
}
function toggletempunitonclick(){
  toggletempunit();
  settingssaver('tempunitswitch',document.getElementById("tempunitswitch").checked);

}

function togglexaxis(){
  //tbi
}
function togglexaxisonclick(){
  togglexaxis();
  settingssaver('xaxischeckbox',document.getElementById("xaxischeckbox").checked);

}

function toggleyaxis(){
  //tbi
}
function toggleyaxisonclick(){
  toggleyaxis();
  settingssaver('yaxischeckbox',document.getElementById("yaxischeckbox").checked);

}

function togglezaxis(){
  //tbi
}
function togglezaxisonclick(){
  togglezaxis();
  settingssaver('zaxischeckbox',document.getElementById("zaxischeckbox").checked);

}
function writetolog(message,status){
  var x=null;
  var x=$.ajax({
             url: '/Apps/Logwriter.php',
             type: 'POST',
             data: {message: message, status: status
             },
             success: function(data) {
             },
             fail: function(data){
               document.getElementById('errorwindow').innerHTML='<div style="display: block; margin: auto; text-align:center;">  <img style="vertical-align:middle;" src="Resources/error-icon.png" width="48" height="48">  <span style="color: red; font-size: 18px; font-weight: bold;">Cannot write to logfile.</span> </div>   <div style="text-align:center;"> <button onclick="showlogwindow();" style="margin:auto; text-align:center;">Show Log</button> </div>';
               showerrorwindow();
             }
         });

}

function satellitelistloader(windowname){
  $.ajax({
             url: '/Apps/Satellitelistgetter.php',
             type: 'POST',
              error:function (xhr, ajaxOptions, thrownError){
                  if(xhr.status!=200) {
                    document.getElementById('errorwindow').innerHTML='<div style="display: block; margin: auto; text-align:center;">  <img style="vertical-align:middle;" src="Resources/error-icon.png" width="48" height="48">  <span style="color: red; font-size: 18px; font-weight: bold;">Cannot load satellite list.</span> </div>   <div style="text-align:center;"> <button onclick="showlogwindow();" style="margin:auto; text-align:center;">Show Log</button> </div>';
                    showerrorwindow();
                  }
              },
              success: function(data) {
               if(windowname=="selectsatellitewindow"){
                  document.getElementById('selectsatelliteloading').style.display="none";
                  document.getElementById('selectsatellitemainwindow').style.display="block";
                  document.getElementById('selectsatellitewindowtablespan').innerHTML=data;
                }
                else if(windowname=="deletesatellitewindow"){
                   document.getElementById('deletesatelliteloading').style.display="none";
                   document.getElementById('deletesatellitemainwindow').style.display="block";
                   document.getElementById('deletesatellitewindowtablespan').innerHTML=data;
                }
                return data;
             }
         });
}

function settingssaver(setting,value){
  $.ajax({
             url: '/Apps/Settingssaver.php',
             type: 'POST',
             data:{
                setting: setting, value: value
              },
              error:function (xhr, ajaxOptions, thrownError){
                  if(xhr.status!=200) {
                    document.getElementById('errorwindow').innerHTML='<div style="display: block; margin: auto; text-align:center;">  <img style="vertical-align:middle;" src="Resources/error-icon.png" width="48" height="48">  <span style="color: red; font-size: 18px; font-weight: bold;">Request failed</span> </div>   <div style="text-align:center;"> <button onclick="showlogwindow();" style="margin:auto; text-align:center;">Show Log</button> </div>';
                    showerrorwindow();
                  }
              },
              success: function(data) {
             }
         });
}

function loadsettings(){
  $.getScript('user_settings.js')
    .done(function( script, textStatus ) {
      writetolog("Loading settings file...","OK");
    })
    .fail(function( jqxhr, settings, exception ) {
      writetolog("Loading settings file...","FAILED");
      document.getElementById('errorwindow').innerHTML='<div style="display: block; margin: auto; text-align:center;">  <img style="vertical-align:middle;" src="Resources/error-icon.png" width="48" height="48">  <span style="color: red; font-size: 18px; font-weight: bold;">Cannot load settings file.</span> </div>   <div style="text-align:center;"> <button onclick="showlogwindow();" style="margin:auto; text-align:center;">Show Log</button> </div>';
      showerrorwindow();

  });
}

function loadsetting(setting,value){
  document.getElementById(setting).checked=value;
  switch (setting) {
    case 'tempunitswitch':
      toggletempunit();
    break;
    case 'lengthunitswitch':
      togglelengthunit();
    break;
    case 'eciunitswitch':
      toggleeciunit();
    break;
    case 'xaxischeckbox':
      togglexaxis();
    break;
    case 'yaxischeckbox':
      toggleyaxis();
    break;
    case 'zaxischeckbox':
      togglezaxis();
    break;
    case 'darkmodeswitch':
      toggledarkmode();
    break;
  }
}

function initializesettings(){
    document.getElementById("tempunitswitch").checked = false;
    document.getElementById("lengthunitswitch").checked = false;
    document.getElementById("eciunitswitch").checked = false;
    document.getElementById("xaxischeckbox").checked = false;
    document.getElementById("yaxischeckbox").checked = false;
    document.getElementById("zaxischeckbox").checked = false;
    document.getElementById("darkmodeswitch").checked = false;
    toggletempunit();
    togglelengthunit();
    toggleeciunit();
    togglexaxis();
    toggleyaxis();
    togglezaxis();
    toggledarkmode();
}

function activatedarkmode(){
  document.getElementById("projectdropdown").className="dropdown dropdown-bubble dropdown-bubble-dark";
  document.getElementById("projectdropdownmenu").className="dropdown-menu dropdown-menu-dark";
  document.getElementById("satellitesdropdown").className="dropdown dropdown-bubble dropdown-bubble-dark";
  document.getElementById("satellitesdropdownmenu").className="dropdown-menu dropdown-menu-dark";
  document.getElementById("antennasdropdown").className="dropdown dropdown-bubble dropdown-bubble-dark";
  document.getElementById("antennasdropdownmenu").className="dropdown-menu dropdown-menu-dark";
  document.getElementById("communicationsdropdown").className="dropdown dropdown-bubble dropdown-bubble-dark";
  document.getElementById("communicationsdropdownmenu").className="dropdown-menu dropdown-menu-dark";
  document.getElementById("rightclickaction").className="rightclickaction rightclickaction-dark";

  if(document.getElementById("settingsdropdown").className.includes("open")){
    document.getElementById("settingsdropdown").className="dropdown dropdown-bubble dropdown-bubble-dark open";
    document.getElementById("settingsdropdownmenu").className="dropdown-menu dropdown-menu-dark";
    return;
  }
  else{
  document.getElementById("settingsdropdown").className="dropdown dropdown-bubble dropdown-bubble-dark";
  document.getElementById("settingsdropdownmenu").className="dropdown-menu dropdown-menu-dark";
  }

}
function deactivatedarkmode(){
  document.getElementById("projectdropdown").className="dropdown dropdown-bubble";
  document.getElementById("projectdropdownmenu").className="dropdown-menu";
  document.getElementById("satellitesdropdown").className="dropdown dropdown-bubble";
  document.getElementById("satellitesdropdownmenu").className="dropdown-menu";
  document.getElementById("antennasdropdown").className="dropdown dropdown-bubble";
  document.getElementById("antennasdropdownmenu").className="dropdown-menu";
  document.getElementById("communicationsdropdown").className="dropdown dropdown-bubble";
  document.getElementById("communicationsdropdownmenu").className="dropdown-menu";
  document.getElementById("rightclickaction").className="rightclickaction";

  if(document.getElementById("settingsdropdown").className.includes("open")){
    document.getElementById("settingsdropdown").className="dropdown dropdown-bubble dropdown-bubble open";
    document.getElementById("settingsdropdownmenu").className="dropdown-menu dropdown-menu";
  }
  else{
  document.getElementById("settingsdropdown").className="dropdown dropdown-bubble";
  document.getElementById("settingsdropdownmenu").className="dropdown-menu";
  }
}

function testPos(positionCartographic){
 try{
   var test=Cesium.Cartesian3.fromRadians(positionCartographic.longitude, positionCartographic.latitude, 10);
   return 0;
 }
 catch (Err){
   return 1;
 }
}


function setMarkerInPos(viewer,position){

viewer.entities.removeById("locationMarker");
viewer.pickTranslucentDepth = true;
var locationMarker = viewer.entities.add({
  id : 'locationMarker',
  name : 'location',
  position : Cesium.Cartesian3.fromDegrees(position.lng, position.lat, 0),
  point : {
    pixelSize : 5,
    color : Cesium.Color.RED,
    outlineColor : Cesium.Color.WHITE,
    outlineWidth : 2,
    heightReference: Cesium.HeightReference.RELATIVE_TO_GROUND

  },
  label : {
    text : "("+position.lng+","+position.lat+")",
    font : '14pt monospace',
    style: Cesium.LabelStyle.FILL_AND_OUTLINE,
    outlineWidth : 2,
    verticalOrigin : Cesium.VerticalOrigin.BOTTOM,
    pixelOffset : new Cesium.Cartesian2(0, -9),
    heightReference: Cesium.HeightReference.RELATIVE_TO_GROUND

  }
});
}

function convertScreenPixelToLocation(viewer,mousePosition) {
  const ellipsoid = viewer.scene.globe.ellipsoid;
  const cartesian = viewer.camera.pickEllipsoid(mousePosition, ellipsoid);
  if (cartesian) {
    const cartographic = ellipsoid.cartesianToCartographic(cartesian);
    const longitudeString = Cesium.Math.toDegrees(cartographic.longitude).toFixed(15);
    const latitudeString = Cesium.Math.toDegrees(cartographic.latitude).toFixed(15);
    return {lat: Number(latitudeString),lng: Number(longitudeString)};
  }
  else {
    return null;
  }
}

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

function searchSatellite_new() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("satellitesearchInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("sateliteselect");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

function searchSatellite_new2() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("satellitesearchInput2");
  filter = input.value.toUpperCase();
  table = document.getElementById("sateliteselect");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

function highlight(tableid){
var hilite;
var table = document.getElementById(tableid);
for (var i=0;i < table.rows.length;i++){
table.rows[i].onclick= function () {

 if(!this.hilite){
  unhighlight(tableid);
  this.className="selectedtr";
  this.hilite = true;
 }
 else{
  this.className="";
  this.hilite = false;
 }
  }
}
}

function unhighlight(tableid){
var hilite;
var table = document.getElementById(tableid);
for (var i=0;i < table.rows.length;i++){
 var row = table.rows[i];
 row.className="";
 row.hilite = false;
}
}

function addsatellitetoterrain(viewer,terrainobjects){
  var table=document.getElementById('sateliteselect');
  var row=table.getElementsByClassName("selectedtr")[0];
  if(row==null){return;}
  var satname=row.cells[0].innerText;
  for (var i = 0; i<terrainobjects.getSatellitesInTerrain.length;i++){
    if(terrainobjects.getSatellitesInTerrain[i].getName==satname){
      return;
    }
  }
  var tle=gettle(satname);
  alert(tle);
  const satrec = satellite.twoline2satrec(
  tle.split('\n')[0].trim(),
  tle.split('\n')[1].trim()
  );
  const date = new Date();
  const positionAndVelocity = satellite.propagate(satrec, date);
  const gmst = satellite.gstime(date);
  const position = satellite.eciToGeodetic(positionAndVelocity.position, gmst);
  const start = Cesium.JulianDate.fromDate(new Date());
  var colorarr=colorrand();
  alert(colorarr);
  const positionsOverTime = new Cesium.SampledPositionProperty();
  for (var i = 0; i < 60*60*6; i+= 6) {
          const time = Cesium.JulianDate.addSeconds(start, i, new Cesium.JulianDate());
          const jsDate = Cesium.JulianDate.toDate(time);

          const positionAndVelocity = satellite.propagate(satrec, jsDate);
          const gmst = satellite.gstime(jsDate);
          const p   = satellite.eciToGeodetic(positionAndVelocity.position, gmst);

          const position = Cesium.Cartesian3.fromRadians(p.longitude, p.latitude, p.height * 1000);
          positionsOverTime.addSample(time, position);
  }
  const satellitemodel = viewer.entities.add({
  id: "satellite_"+satname,
  name: satname,
  description: "Orbit of Satellite: "+satname,
  point: { pixelSize: 5, color: Cesium.Color.RED },

  "path" : {
    "material" : {
        "solidColor" : {
            "color" : {
                "rgba" : [255, 255, 0, 255]
            }
        }
    },
    "width" : 5.0,
    "show" : true
},
  position: positionsOverTime,
  "outlineColor": {"rgba": [0, 0, 0, 255]}, "outlineWidth": 2

  });
  var satelliteobj=new t_satellite("satellite_"+satname,satname,colorarr[0],satellitemodel);
  terrainobjects.getSatellitesInTerrain.push(satelliteobj);

  //more later


  constructmanagesatellitetable(terrainobjects);
}


function colorrand(){
  var rand=Math.floor(Math.random() * (7 + 0 ) + 1);
  var arr;
  if(rand==1){
    arr=["Violet", '{"solidColor": {"color": {"rgba": ["139", "0", "255", 255]}}},'];
  }
  else if(rand==2){
    arr=["Blue", '{"solidColor": {"color": {"rgba": ["0", "0", "255", 255]}}},'];
  }
  else if(rand==3){
    arr=["Aqua", '{"solidColor": {"color": {"rgba": ["0", "255", "255", 255]}}},'];
  }
  else if(rand==4){
    arr=["Green", '{"solidColor": {"color": {"rgba": ["0", "255", "0", 255]}}},'];
  }
  else if(rand==5){
    arr=["Yellow", '{"solidColor": {"color": {"rgba": ["255", "255", "0", 255]}}},'];
  }
  else if(rand==6){
    arr=["Orange", '{"solidColor": {"color": {"rgba": ["255", "127", "0", 255]}}},'];
  }
  else if(rand==7){
    arr=["Red", '{"solidColor": {"color": {"rgba": ["255", "0", "0", 255]}}},'];

  }
  return arr;
}
function addsatellitetodb(satname,tle1,tle2){
  $.ajax({
               url: '/Apps/Gettle.php',
               type: 'POST',
               data:{
                  satname: satname,
                  tle1:tle1,
                  tle2:tle2
                },
                error:function (xhr, ajaxOptions, thrownError){
                    if(xhr.status!=200) {
                      document.getElementById('errorwindow').innerHTML='<div style="display: block; margin: auto; text-align:center;">  <img style="vertical-align:middle;" src="Resources/error-icon.png" width="48" height="48">  <span style="color: red; font-size: 18px; font-weight: bold;">Cannot add Satellite.</span> </div>   <div style="text-align:center;"> <button onclick="showlogwindow();" style="margin:auto; text-align:center;">Show Log</button> </div>';
                      showerrorwindow();
                    }
                },
                success: function(data) {
               }
           });
           return x;
}
function gettle(satname){
var x;
$.ajax({
             url: '/Apps/Gettle.php',
             type: 'POST',
             async: false,
             data:{
                satellite: satname
              },
              error:function (xhr, ajaxOptions, thrownError){
                  if(xhr.status!=200) {
                    document.getElementById('errorwindow').innerHTML='<div style="display: block; margin: auto; text-align:center;">  <img style="vertical-align:middle;" src="Resources/error-icon.png" width="48" height="48">  <span style="color: red; font-size: 18px; font-weight: bold;">Cannot get TLE.</span> </div>   <div style="text-align:center;"> <button onclick="showlogwindow();" style="margin:auto; text-align:center;">Show Log</button> </div>';
                    showerrorwindow();
                    return null;
                  }
              },
              success: function(data) {
                x=data;
             }
         });
         return x;
}

function constructmanagedishestable(terrainobjects){
  document.getElementById("mdishesloading").style.display="block";
  document.getElementById("managedishesnoselected").style.display="none";
  document.getElementById("managedishesmainwindow").style.display="none";

  if(terrainobjects.getDishesInTerrain.length==0){
    document.getElementById("mdishesloading").style.display="none";
    document.getElementById("managedishesnoselected").style.display="block";
    document.getElementById("managedishesmainwindow").style.display="none";
    return;
  }
  var table=document.getElementById("managedishestable");
  table.innerHTML = "";
  for(var i=0; i<terrainobjects.getDishesInTerrain.length;i++){
    var row = table.insertRow(i);
    var cell0 = row.insertCell(0);
    var cell1 = row.insertCell(1);
    var cell2 = row.insertCell(2);
    var cell3 = row.insertCell(3);
    cell0.innerHTML=(i+1)+")";
    cell1.innerHTML='<img src="data:image/png;base64, iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABx0lEQVQ4y5WRP0hbURTGfzd5L7bVaKgl+KeoSLuVcEEEMxSxldIxQjeXLjqIiATFSnGogx3E4FB1kFIQoQop3apDoGlVKkppKEVQBxcVWn3+QU0b85LbJeojxqjfeM+5v++c7wgukSeoAHQg/vOZOFe3XQYAKoBpYNgTVF5PUNmvC9gGxoEd4C3wyhNUjusASgE/8BToA54Az1OrpQECxg0Cho+AoVleVwAv0A/0AkNAG+AC0NLcGoERd6426JtR3Ss9dRpv6tyAL3nr9vxe84cpTO4DcaAY2NMs7g6gSbcJvaYst+Pb59CDO0q9U0LkAI9t0Z33mHxMfUwChwDCAnABS3fz9eISp4OFjahy7q+NyrmXIbv572Y4HB7LFJA1AxOIFeXpLP35CyhxUFDRPNswWa2ESF6UsBVwJIQIxxJJjuJn/Spmdn6vHXhIwLBnB/gLVWWoa/73lqFUWtNhfnkT8DoT5BQgpcS5sVjl+vSCnINNBSROhgCOU+GlX+0sRCmlDnwFahKOvOi619+6W157D9gFvgA/8BeaGQFSSjfQArQDBSnXYWAiEonMkkUnI7mAemDZUqsGfgFXAqwCj6wrWU6bVf8BVq+PaiEcjLUAAAAASUVORK5CYII=">'+ terrainobjects.getDishesInTerrain[i].name;
    cell2.innerHTML='<div> <button onclick="loadeditdishwindow(terrainobjs,'+"'"+terrainobjects.getDishesInTerrain[i].id+"'"+'); showeditdishwindow();" class="btn btn-info" style="transition: all .3s ease;">Edit Dish</button>'
    cell3.innerHTML='<div> Action: <button id='+'"bid_'+terrainobjects.getDishesInTerrain[i].id+'"'+'onclick="changekeepremovebutton('+"'bid_"+terrainobjects.getDishesInTerrain[i].id+"'"+');" class="btn btn-info" style="transition: all .3s ease;">Keep</button></td>';
  }
  document.getElementById("mdishesloading").style.display="none";
  document.getElementById("managedishesnoselected").style.display="none";
  document.getElementById("managedishesmainwindow").style.display="block";
  return;

}
function constructmanagesatellitetable(terrainobjects){
  document.getElementById("msatelliteloading").style.display="block";
  document.getElementById("managenoselected").style.display="none";
  document.getElementById("managesatellitemainwindow").style.display="none";

  if(terrainobjects.getSatellitesInTerrain.length==0){
    document.getElementById("msatelliteloading").style.display="none";
    document.getElementById("managenoselected").style.display="block";
    document.getElementById("managesatellitemainwindow").style.display="none";
    return;
  }
  var table=document.getElementById("managesatellitetable");
  table.innerHTML = "";
  for(var i=0; i<terrainobjects.getSatellitesInTerrain.length;i++){
    var row = table.insertRow(i);
    var cell0 = row.insertCell(0);
    var cell1 = row.insertCell(1);
    var cell2 = row.insertCell(2);
    var cell3 = row.insertCell(3);
    cell0.innerHTML=(i+1)+")";
    cell1.innerHTML='<img src="data:image/png;base64, iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAADJSURBVDhPnZHRDcMgEEMZjVEYpaNklIzSEfLfD4qNnXAJSFWfhO7w2Zc0Tf9QG2rXrEzSUeZLOGm47WoH95x3Hl3jEgilvDgsOQUTqsNl68ezEwn1vae6lceSEEYvvWNT/Rxc4CXQNGadho1NXoJ+9iaqc2xi2xbt23PJCDIB6TQjOC6Bho/sDy3fBQT8PrVhibU7yBFcEPaRxOoeTwbwByCOYf9VGp1BYI1BA+EeHhmfzKbBoJEQwn1yzUZtyspIQUha85MpkNIXB7GizqDEECsAAAAASUVORK5CYII=">'+ terrainobjects.getSatellitesInTerrain[i].name;
    cell2.innerHTML='  <div id="colordropdown" class="dropdown dropdown-bubble" style="display:inline;"> <button class="btn btn-light" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="height:32px;">  <span style="display:inline-block; height: 32px; vertical-align: top;">Color:</span>  <span class="dot" style="background-color:#8b00ff; margin-top:-4px; margin-left:3px;"></span>  </button> <ul id="colordropdownmenu" class="dropdown-menu" style="margin-top: 10px;"> <li><a href="" style="text-align:center;">Violet<span class="dot" style="background-color:#8b00ff; margin-top:0px; margin-left:8px;"></span></a> <li><a href="" style="text-align:center;">Blue<span class="dot" style="background-color:#0000ff; margin-top:0px; margin-left:8px;"></span></a> <li><a href="" style="text-align:center;">Aqua<span class="dot" style="background-color:#00ffff; margin-top:0px; margin-left:8px;"></span></a>   <li><a href="" style="text-align:center;">Green<span class="dot" style="background-color:#00ff00; margin-top:0px; margin-left:8px;"></span></a> <li><a href="" style="text-align:center;">Yellow<span class="dot" style="background-color:#ffff00; margin-top:0px; margin-left:8px;"></span></a>  <li><a href="" style="text-align:center;">Orange<span class="dot" style="background-color:#ff7f00; margin-top:0px; margin-left:8px;"></span></a> <li><a href="" style="text-align:center;">Red<span class="dot" style="background-color:#ff0000; margin-top:0px; margin-left:8px;"></span></a>  </ul>  </div>';
    cell3.innerHTML='<div> Action: <button id='+'"bid_'+terrainobjects.getSatellitesInTerrain[i].id+'"'+'onclick="changekeepremovebutton('+"'bid_"+terrainobjects.getSatellitesInTerrain[i].id+"'"+');" class="btn btn-info" style="transition: all .3s ease;">Keep</button></td>';
  }
  document.getElementById("msatelliteloading").style.display="none";
  document.getElementById("managenoselected").style.display="none";
  document.getElementById("managesatellitemainwindow").style.display="block";
  return;

}
function loadeditdishwindow(terrainobjects,dishid){
  document.getElementById("editdishname").setCustomValidity('');
  document.getElementById("editdishlongitude").setCustomValidity('');
  document.getElementById("editdishlatitude").setCustomValidity('');
  document.getElementById("editdishsize").setCustomValidity('');
  document.getElementById("editdishgain").setCustomValidity('');
  document.getElementById("editdishnameerror").innerHTML='';
  document.getElementById("editdishlongitudeerror").innerHTML='';
  document.getElementById("editdishlatitudeerror").innerHTML='';
  document.getElementById("editdishsizeerror").innerHTML='';
  document.getElementById("editdishgainerror").innerHTML='';
  for(var i=0; i<terrainobjects.getDishesInTerrain.length;i++){
    if(terrainobjects.getDishesInTerrain[i].id==dishid){
      document.getElementById("editdishname").value=terrainobjects.getDishesInTerrain[i].name;
      document.getElementById("editdishlongitude").value=terrainobjects.getDishesInTerrain[i].longitude;
      document.getElementById("editdishlatitude").value=terrainobjects.getDishesInTerrain[i].latitude;
      document.getElementById("editdishsize").value=terrainobjects.getDishesInTerrain[i].size;
      document.getElementById("editdishgain").value=terrainobjects.getDishesInTerrain[i].gain;
      if(terrainobjects.getDishesInTerrain[i].usage=="Uplink"){
          document.getElementById("editdishusageselectdnl").checked=false;
          document.getElementById("editdishusageselectupl").checked=true;
      }
      else if(terrainobjects.getDishesInTerrain[i].usage=="Downlink"){
          document.getElementById("editdishusageselectdnl").checked=true;
          document.getElementById("editdishusageselectupl").checked=false;
    }
      document.getElementById("editdishid").innerHTML=terrainobjects.getDishesInTerrain[i].id;
  }
}
}
function changekeepremovebutton(keepremovebuttonid){
  var button=document.getElementById(keepremovebuttonid);
  if(button.innerHTML=="Keep"){
    button.className="btn btn-danger";
    button.innerHTML="Remove";
  }
  else{
    button.className="btn btn-info";
    button.innerHTML="Keep";
  }
}

function managesatelliteapplychanges(viewer,terrainobjects){
  var table=document.getElementById("managesatellitetable");
  for(var i=0, row; row=table.rows[i];i++){
    var rmd=false;
    var colorcol=row.cells[2];
    var removecol=row.cells[3];
    var removebtn=removecol.getElementsByTagName('button')[0];
    alert(removebtn.innerHTML);
    if(removebtn.innerHTML=="Remove"){
      viewer.entities.removeById(terrainobjects.getSatellitesInTerrain[i].id);
      terrainobjects.getSatellitesInTerrain.splice(i,1);
      rmd=true;
    }
    //also for color
  }
  constructmanagesatellitetable(terrainobjects);
}
function managedishesapplychanges(viewer,terrainobjects){
  var table=document.getElementById("managedishestable");
  for(var i=0, row; row=table.rows[i];i++){
    var rmd=false;
    var removecol=row.cells[3];
    var removebtn=removecol.getElementsByTagName('button')[0];
    alert(removebtn.innerHTML);
    if(removebtn.innerHTML=="Remove"){
      viewer.entities.removeById(terrainobjects.getDishesInTerrain[i].id);
      terrainobjects.getDishesInTerrain.splice(i,1);
      rmd=true;
    }
  }
  constructmanagedishestable(terrainobjects);
}

function isNumber(n){
  return n!=null && !isNaN(n) && isFinite(n);
}
function checkandadddishinterrain(viewer,terrainobjects){
  document.getElementById("adddishname").setCustomValidity('');
  document.getElementById("adddishlongitude").setCustomValidity('');
  document.getElementById("adddishlatitude").setCustomValidity('');
  document.getElementById("adddishsize").setCustomValidity('');
  document.getElementById("adddishgain").setCustomValidity('');
  document.getElementById("adddishnameerror").innerHTML='';
  document.getElementById("adddishlongitudeerror").innerHTML='';
  document.getElementById("adddishlatitudeerror").innerHTML='';
  document.getElementById("adddishsizeerror").innerHTML='';
  document.getElementById("adddishgainerror").innerHTML='';



      var namestr=document.getElementById("adddishname").value;
      var longitude=document.getElementById("adddishlongitude").value;
      var latitude=document.getElementById("adddishlatitude").value;
      var size=document.getElementById("adddishsize").value;
      var gain=document.getElementById("adddishgain").value;
      var er=0;

      if(namestr.trim()==""){
        document.getElementById("adddishname").setCustomValidity('Name is required.');
        document.getElementById("adddishnameerror").innerHTML='Name is required.';
        er=1;
      }
      for (var i = 0; i<terrainobjects.getDishesInTerrain.length;i++){
        if(terrainobjects.getDishesInTerrain[i].getName==namestr.trim()){
          document.getElementById("adddishname").setCustomValidity('A dish with this name already exists.');
          document.getElementById("adddishnameerror").innerHTML='A dish with this name already exists.';
          er=1;
        }
      }
      if(longitude.trim()==""){
        document.getElementById("adddishlongitude").setCustomValidity('Longitude is required.');
        document.getElementById("adddishlongitudeerror").innerHTML='Longitude is required.';
        er=1;
      }
      else{
        if(!isNumber(longitude.trim())){
          document.getElementById("adddishlongitude").setCustomValidity('Invalid Longitude.');
          document.getElementById("adddishlongitudeerror").innerHTML='Invalid Longitude.';
          er=1;
        }
        else{
          if(Number(longitude.trim())>180 || Number(longitude.trim())<-180){
            document.getElementById("adddishlongitude").setCustomValidity('Longitude must be in [-180,180] range.');
            document.getElementById("adddishlongitudeerror").innerHTML='Longitude must be in [-180,180] range.';
            er=1;
          }
        }
      }
      if(latitude.trim()==""){
        document.getElementById("adddishlatitude").setCustomValidity('Latitude is required.');
        document.getElementById("adddishlatitudeerror").innerHTML='Latitude is required.'
        er=1;
      }
      else {
        if(!isNumber(latitude.trim())){
          document.getElementById("adddishlatitude").setCustomValidity('Invalid Latitude.');
          document.getElementById("adddishlatitudeerror").innerHTML='Invalid Latitude.';
          er=1;
        }
        if(Number(latitude.trim())>90 || Number(latitude.trim())<-90){
          document.getElementById("adddishlatitude").setCustomValidity('Latitude must be in [-90,90] range.');
          document.getElementById("adddishlatitudeerror").innerHTML='Latitude must be in [-90,90] range.';
          er=1;
        }
      }
      if(size.trim()==""){
        document.getElementById("adddishsize").setCustomValidity('Size is required.');
        document.getElementById("adddishsizeerror").innerHTML='Size is required.';
        er=1;
      }
      else{
        if(!isNumber(size.trim()) || Number(size.trim())<=0){
          document.getElementById("adddishsize").setCustomValidity('Invalid Size.');
          document.getElementById("adddishsizeerror").innerHTML='Invalid Size.';
          er=1;
        }
      }
      if(gain.trim()==""){
        document.getElementById("adddishgain").setCustomValidity('Gain is required.');
        document.getElementById("adddishgainerror").innerHTML='Gain is required.';

        er=1
      }
      else{
        if(!isNumber(gain.trim())){
          document.getElementById("adddishgain").setCustomValidity('Invalid Gain.');
          document.getElementById("adddishgainerror").innerHTML='Invalid Gain.';
          er=1;
        }
      }
      if(er==0){
        var usage;
        var val;
        var radios = document.getElementsByName("adddishusageselect");
        for( i = 0; i < radios.length; i++ ) {
          if( radios[i].checked ) {
             val=radios[i].value;
           }
         }
         if(val==1){
           usage="Downlink";
         }
         else if(val==2){
           usage="Uplink";
         }

         adddishinterrain(viewer,terrainobjects,namestr,longitude,latitude,size,gain,usage,0);
         constructmanagedishestable(terrainobjects);

      }

}
function checkandeditdishinterrain(viewer,terrainobjects){
  document.getElementById("editdishname").setCustomValidity('');
  document.getElementById("editdishlongitude").setCustomValidity('');
  document.getElementById("editdishlatitude").setCustomValidity('');
  document.getElementById("editdishsize").setCustomValidity('');
  document.getElementById("editdishgain").setCustomValidity('');
  document.getElementById("editdishnameerror").innerHTML='';
  document.getElementById("editdishlongitudeerror").innerHTML='';
  document.getElementById("editdishlatitudeerror").innerHTML='';
  document.getElementById("editdishsizeerror").innerHTML='';
  document.getElementById("editdishgainerror").innerHTML='';



      var namestr=document.getElementById("editdishname").value;
      var longitude=document.getElementById("editdishlongitude").value;
      var latitude=document.getElementById("editdishlatitude").value;
      var size=document.getElementById("editdishsize").value;
      var gain=document.getElementById("editdishgain").value;
      var er=0;

      if(namestr.trim()==""){
        document.getElementById("editdishname").setCustomValidity('Name is required.');
        document.getElementById("editdishnameerror").innerHTML='Name is required.';
        er=1;
      }

      if(longitude.trim()==""){
        document.getElementById("editdishlongitude").setCustomValidity('Longitude is required.');
        document.getElementById("editdishlongitudeerror").innerHTML='Longitude is required.';
        er=1;
      }
      else{
        if(!isNumber(longitude.trim())){
          document.getElementById("editdishlongitude").setCustomValidity('Invalid Longitude.');
          document.getElementById("editdishlongitudeerror").innerHTML='Invalid Longitude.';
          er=1;
        }
        else{
          if(Number(longitude.trim())>180 || Number(longitude.trim())<-180){
            document.getElementById("editdishlongitude").setCustomValidity('Longitude must be in [-180,180] range.');
            document.getElementById("editdishlongitudeerror").innerHTML='Longitude must be in [-180,180] range.';
            er=1;
          }
        }
      }
      if(latitude.trim()==""){
        document.getElementById("editdishlatitude").setCustomValidity('Latitude is required.');
        document.getElementById("editdishlatitudeerror").innerHTML='Latitude is required.'
        er=1;
      }
      else {
        if(!isNumber(latitude.trim())){
          document.getElementById("editdishlatitude").setCustomValidity('Invalid Latitude.');
          document.getElementById("editdishlatitudeerror").innerHTML='Invalid Latitude.';
          er=1;
        }
        if(Number(latitude.trim())>90 || Number(latitude.trim())<-90){
          document.getElementById("editdishlatitude").setCustomValidity('Latitude must be in [-90,90] range.');
          document.getElementById("editdishlatitudeerror").innerHTML='Latitude must be in [-90,90] range.';
          er=1;
        }
      }
      if(size.trim()==""){
        document.getElementById("editdishsize").setCustomValidity('Size is required.');
        document.getElementById("editdishsizeerror").innerHTML='Size is required.';
        er=1;
      }
      else{
        if(!isNumber(size.trim()) || Number(size.trim())<=0){
          document.getElementById("editdishsize").setCustomValidity('Invalid Size.');
          document.getElementById("editdishsizeerror").innerHTML='Invalid Size.';
          er=1;
        }
      }
      if(gain.trim()==""){
        document.getElementById("editdishgain").setCustomValidity('Gain is required.');
        document.getElementById("editdishgainerror").innerHTML='Gain is required.';

        er=1
      }
      else{
        if(!isNumber(gain.trim())){
          document.getElementById("editdishgain").setCustomValidity('Invalid Gain.');
          document.getElementById("editdishgainerror").innerHTML='Invalid Gain.';
          er=1;
        }
      }
      if(er==0){
        var usage;
        var val;
        var radios = document.getElementsByName("editdishusageselect");
        for( i = 0; i < radios.length; i++ ) {
          if( radios[i].checked ) {
             val=radios[i].value;
           }
         }
         if(val==1){
           usage="Downlink";
         }
         else if(val==2){
           usage="Uplink";
         }
         var dishid=document.getElementById("editdishid").innerHTML;
         viewer.entities.removeById(dishid);
         var oldpos=0;
         for(var i=0; i<terrainobjects.getDishesInTerrain.length;i++){
            if(terrainobjects.getDishesInTerrain.id=dishid){
              oldpos=i;
            }
         }
         terrainobjects.getDishesInTerrain.splice(oldpos,1);
         adddishinterrain(viewer,terrainobjects,namestr,longitude,latitude,size,gain,usage,oldpos);
        constructmanagedishestable(terrainobjects);

      }
}
function adddishinterrain(viewer,terrainobjects,namestr,longitude,latitude,size,gain,usage,pos){
  const dishmodel = viewer.entities.add({
  id: "dish_"+namestr.trim(),
  name: namestr.trim(),
  description: "Dish Antenna: "+namestr.trim()+"\n"+"Specifications:\n"+"Position: "+longitude.trim()+","+latitude.trim()+"\n"+"Size: "+size.trim()+"\n"+"Gain: "+gain.trim()+"\n"+"Usage: "+usage,
    position: Cesium.Cartesian3.fromDegrees(longitude.trim(), latitude.trim()),
    model:{
        uri : 'Resources/dish.gltf'
    }

  });
  var dishobj=new dish("dish_"+namestr.trim(),namestr.trim(),longitude.trim(),latitude.trim(),size.trim(),gain.trim(),usage);
  if(pos==0){
    terrainobjects.getDishesInTerrain.push(dishobj);
  }
  else{
    terrainobjects.getDishesInTerrain.splice(pos,0,dishobj);
  }
  viewer.zoomTo(dishmodel);
}
function checkaddsatellite(){
  document.getElementById("addsatellitename").setCustomValidity('');
  document.getElementById("addsatellitetle1").setCustomValidity('');
  document.getElementById("addsatellitetle2").setCustomValidity('');
  document.getElementById("addsatellitenameerror").innerHTML='';
  document.getElementById("addsatellitetle1error").innerHTML='';
  document.getElementById("addsatellitetle2error").innerHTML='';
  var namestr=document.getElementById("addsatellitename").value;
  var tle1str=document.getElementById("addsatellitetle1").value;
  var tle2str=document.getElementById("addsatellitetle2").value;
  var er=0;
  if(namestr.trim()==""){
    document.getElementById("addsatellitename").setCustomValidity('Name is required.');
    document.getElementById("addsatellitenameerror").innerHTML='Name is required.';
    er=1;
  }

  if(tle1str.trim()==""){
    document.getElementById("addsatellitetle1").setCustomValidity('TLE line 1 is required.');
    document.getElementById("addsatellitetle1error").innerHTML='TLE line 1 is required.';
    er=1;
  }
  if(tle2str.trim()==""){
    document.getElementById("addsatellitetle2").setCustomValidity('TLE line 2 is required.');
    document.getElementById("addsatellitetle2error").innerHTML='TLE line 2 is required.';
    er=1;
  }
 //more checks later
  if(er==0){
    addsatellitetodb(namestr,tle1str,tle2str);
      document.getElementById("deletesatellitewindowtablespan").style.display="none";
      document.getElementById("selectsatellitewindowtablespan").style.display="none";
      document.getElementById("deletesatelliteloading").style.display="block";
      document.getElementById("selectsatelliteloading").style.display="block";
      document.getElementById("deletesatellitewindowtablespan").innerHTML="";
      document.getElementById("selectsatellitewindowtablespan").innerHTML="";
      document.getElementById("deletesatellitewindowtablespan").innerHTML=satellitelistloader("deletesatellitewindow");;
      document.getElementById("selectsatellitewindowtablespan").innerHTML=satellitelistloader("selectsatellitewindow");;
      document.getElementById("deletesatellitewindowtablespan").style.display="block";
      document.getElementById("selectsatellitewindowtablespan").style.display="block";
      document.getElementById("deletesatelliteloading").style.display="none";
      document.getElementById("selectsatelliteloading").style.display="none";

  }
}

//show windows

function showlogwindow(){

  $.ajax({
             url: '/Apps/loggetter.php',
             type: 'GET',
             success: function(data) {
               document.getElementById("logtextarea").value=data;
             },
         });

  $('#logwindow').PopupWindow({
          title: "Log Window",
          autoOpen: false,
          nativeDrag: false,
  	      height              : 300,
  	      width               : 400,
  	      maxHeight           : undefined,
  	      maxWidth            : undefined,
  	      minHeight           : 300,
  	      minWidth            : 400,
  	      collapsedWidth      : undefined,
  });
    $("#logwindow").PopupWindow("open");

}

function showerrorwindow(){
  $('#errorwindow').PopupWindow({
          title: "Error Window",
          autoOpen: false,
          nativeDrag: false,
  	      height              : 200,
  	      width               : 400,
  	      maxHeight           : undefined,
  	      maxWidth            : undefined,
  	      minHeight           : 200,
  	      minWidth            : 400,
  	      collapsedWidth      : undefined,
  });
    $("#errorwindow").PopupWindow("open");
}

function showselectsatellitewindow(){
  $('#selectsatellitewindow').PopupWindow({
          title: "Select Satellite Window",
          autoOpen: false,
          nativeDrag: false,
  	      height              : 450,
  	      width               : 500,
  	      maxHeight           : undefined,
  	      maxWidth            : undefined,
  	      minHeight           : 450,
  	      minWidth            : 500,
  	      collapsedWidth      : undefined,
  });
    $("#selectsatellitewindow").PopupWindow("open");
}

function showdeletesatellitewindow(){
  $('#deletesatellitewindow').PopupWindow({
          title: "Delete Satellite Window",
          autoOpen: false,
          nativeDrag: false,
  	      height              : 450,
  	      width               : 500,
  	      maxHeight           : undefined,
  	      maxWidth            : undefined,
  	      minHeight           : 450,
  	      minWidth            : 500,
  	      collapsedWidth      : undefined,
  });
    $("#deletesatellitewindow").PopupWindow("open");
}

function showmanagesatellitewindow(){
  $('#managesatellitewindow').PopupWindow({
          title: "Manage Satellite Window",
          autoOpen: false,
          nativeDrag: false,
  	      height              : 450,
  	      width               : 500,
  	      maxHeight           : undefined,
  	      maxWidth            : undefined,
  	      minHeight           : 450,
  	      minWidth            : 500,
  	      collapsedWidth      : undefined,
  });
    $("#managesatellitewindow").PopupWindow("open");
}

function showmanagedisheswindow(){
  $('#managedisheswindow').PopupWindow({
          title: "Manage Dishes Window",
          autoOpen: false,
          nativeDrag: false,
  	      height              : 450,
  	      width               : 500,
  	      maxHeight           : undefined,
  	      maxWidth            : undefined,
  	      minHeight           : 450,
  	      minWidth            : 500,
  	      collapsedWidth      : undefined,
  });
    $("#managedisheswindow").PopupWindow("open");
}

function showadddishwindow(){
  $('#adddishwindow').PopupWindow({
          title: "Add Dish Window",
          autoOpen: false,
          nativeDrag: false,
  	      height              : 450,
  	      width               : 640,
  	      maxHeight           : undefined,
  	      maxWidth            : undefined,
  	      minHeight           : 450,
  	      minWidth            : 640,
  	      collapsedWidth      : undefined,
  });
    $("#adddishwindow").PopupWindow("open");
}

function showeditdishwindow(){
  $('#editdishwindow').PopupWindow({
          title: "Edit Dish Window",
          autoOpen: false,
          nativeDrag: false,
  	      height              : 450,
  	      width               : 640,
  	      maxHeight           : undefined,
  	      maxWidth            : undefined,
  	      minHeight           : 450,
  	      minWidth            : 640,
  	      collapsedWidth      : undefined,
  });
    $("#editdishwindow").PopupWindow("open");
}

function showaddsatellitewindow(){
$('#addsatellitewindow').PopupWindow({
        title: "Add Satellite Window",
        autoOpen: false,
        nativeDrag: false,
        height              : 270,
        width               : 750,
        maxHeight           : undefined,
        maxWidth            : undefined,
        minHeight           : 270,
        minWidth            : 750,
        collapsedWidth      : undefined,
});
  $("#addsatellitewindow").PopupWindow("open");
}
