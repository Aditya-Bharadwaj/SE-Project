<html>
 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    
 <script type="text/javascript">
 google.charts.load('current', {packages: ['corechart', 'bar']});
 google.charts.setOnLoadCallback(drawStacked);

function getData() {
	
	xhr =   new XMLHttpRequest();
	xhr.onreadystatechange = updatecontents;
	xhr.open("GET", "getcont.php" ,true);
	xhr.send();
}
 
function updatecontents(){
 
 	//alert(xhr.onreadyState  +" " + xhr.status);
 	doc=""
 	
	if(xhr.readyState == 4 && xhr.status == 200){
			
			doc = xhr.responseText;
			
			alert(doc);
		}
}

function filldata()
{	
	x=doc
	alert(x);
	lis =x.split(";");
	//alert(lis + "lis");
	arr =  [['Domain', 'Problems Solved', { role: 'style' }] ]
	
	for( i in lis){
		
		if(lis[i].length >3){
			
			tmp = lis[i].split(" ");
			tmparr = [tmp[0],parseInt(tmp[1]) ,'color: #76A7FA'];
			alert(tmparr)
			arr.push(tmparr);
			
		}
	}
	//alert(arr);
	return arr;
	
	
}


function drawStacked() {
		
		
      var data =google.visualization.arrayToDataTable(filldata());
		
      var options = {
        title: 'User stats on various domains of problems',
        isStacked: true,
        hAxis: {
          title: 'Domain',
          format: 'h:mm a',
          viewWindow: {
            min: [7, 30, 0],
            max: [17, 30, 0]
          }
        },
        vAxis: {
          title: 'Problems solved'
        }
      };

      var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
      chart.draw(data, options);
    }
 

getData();
 </script>
  
<style>
/* CSS design by @jofpin */
@import url(https://fonts.googleapis.com/css?family=Raleway|Varela+Round|Coda);
@import url(http://weloveiconfonts.com/api/?family=entypo);

[class*="entypo-"]:before {
  font-family: 'entypo', sans-serif;
}

body {
  background: #fffcdd;
  padding: 2.23em;
}

.title-pen {
  color: #333;
  font-family: "Coda", sans-serif;
  text-align: center;
}
.title-pen span {
  color: #55acee;
}

.user-profile {
  margin: auto;
	width: 25em; 
  height: 11em;
  background: #fff;
  border-radius: .3em;
}

.user-profile  .username {
  margin: auto;
  margin-top: -4.40em;
  margin-left: 5.80em;
  color: #658585;
  font-size: 1.53em;
  font-family: "Coda", sans-serif;
  font-weight: bold;
}
.user-profile  .bio {
  margin: auto;
  display: inline-block;
  margin-left: 10.43em;
  color: #e76043; 
  font-size: .87em;
  font-family: "varela round", sans-serif;
}
.user-profile > .description {
  margin: auto;
  margin-top: 1.35em;
  margin-right: 4.43em;
  width: 14em;
  color: #c0c5c5; 
  font-size: .87em;
  font-family: "varela round", sans-serif;
}
.user-profile > img.avatar {
	padding: .7em;
  margin-left: .3em;
  margin-top: .3em;
  height: 6.23em;
  width: 6.23em;
  border-radius: 18em;
}

.user-profile ul.data {
	margin: 2em auto;
	height: 3.70em;
  background: #4eb6b6;
  text-align: center;
  border-radius: 0 0 .3em .3em;
}
.user-profile li {
	margin: 0 auto;
  padding: 1.30em; 
  width: 33.33334%;
  display: table-cell;
  text-align: center;
}

.user-profile span {
	font-family: "varela round", sans-serif;
	color: #e3eeee;
  white-space: nowrap;
  font-size: 1.27em;
  font-weight: bold;
}
.user-profile span:hover {
  color: #daebea;
}

footer > h1 {
  display: block;
  text-align: center;
  clear: both;
  font-family: "Coda", sans-serif;
  color: #343f3d;
  line-height: 6;
  font-size: 1.6em;
}
footer > h1 a {
  text-decoration: none;
  color: #ea4c89;
}
</style>
<h1 class="title-pen"> User Profile </h1>
<div class="user-profile">
	<img class="avatar" src="https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcTF_erFD1SeUnxEpvFjzBCCDxLvf-wlh9ZuPMqi02qGnyyBtPWdE-3KoH3s" alt="Ash" />
    <div class="username">Will Smith</div>
  <div class="bio">
  	Programmer
  </div>
    <div class="description">
      Backend Development, Game Design and Development
  </div>
  <ul class="data">
    
    <li>
      <span class="entypo-eye"> 853</span>
    </li>
    <li>
      <span class="entypo-user"> 311</span>
    </li>
 </ul>
</div>
  <br>
  <br>
  <br>
  <h1 class="title-pen"> User Stats </h1>
  <br>
  
  <div id="chart_div"></div>

</html>
