<html>
	<head>
		<?php include('header.php');?>
	</head>
	<body>
	<?php 
		echo '<p>Galerie</p>';
	?>
	<?php include('footer.php');?>

<style>
	#container {
		margin: 0px auto;
		width: 500px;
		height: 375px;
		border: 10px #333 solid;
	}
	#videoElement {
		width: 500px;
		height: 375px;
		background-color: #666;
	}
</style>

<div id="container">
    <video autoplay="true" id="videoElement">
    </video>
</div>

<div id="videoElement">

	<canvas hidden="true" id="drawCanvas"> </canvas>

	<img id="picture"/>

	<button onclick="savePicture()">Click me</button>

</div>

<script>

	// Video taking

	var video = document.querySelector("#videoElement");

	navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia || navigator.oGetUserMedia;

	if (navigator.getUserMedia) {       
		navigator.getUserMedia({video: true}, handleVideo, videoError);
	}

	function handleVideo(stream) {
		video.src = window.URL.createObjectURL(stream);
	}

	function videoError(e) {
		// do something
	}

	// Picture taking

	// function savePicture() {
	// 	takePicture();

	// }

// function callAjax(url, callback){
//     var xmlhttp;
//     // compatible with IE7+, Firefox, Chrome, Opera, Safari
//     xmlhttp = new XMLHttpRequest();
//     xmlhttp.onreadystatechange = function(){
//         if (xmlhttp.readyState == 4 && xmlhttp.status == 200){
//             // callback(xmlhttp.responseText);
//         }
//     }
//     xmlhttp.open("GET", url, true);
//     xmlhttp.send();
// }

function getXMLHttpRequest() {
    var xhr = null;
    
    if (window.XMLHttpRequest || window.ActiveXObject) {
        if (window.ActiveXObject) {
            try {
                xhr = new ActiveXObject("Msxml2.XMLHTTP");
            } catch(e) {
                xhr = new ActiveXObject("Microsoft.XMLHTTP");
            }
        } else {
            xhr = new XMLHttpRequest(); 
        }
    } else {
        alert("Votre navigateur ne supporte pas l'objet XMLHTTPRequest...");
        return null;
    }
    
    return xhr;
}

// function Base64EncodeUrl(str){
//     return str.replace(/\+/g, '-').replace(/\//g, '_').replace(/\=+$/, '');
// }

	function savePicture() {
		var video = document.getElementById('videoElement');
		var drawCanvas = document.getElementById('drawCanvas');
		var img = document.getElementById('picture');

		draw(video, drawCanvas, img);


		var base64 = drawCanvas.toDataURL();

		var xhr = getXMLHttpRequest();
		xhr.open("POST", "takePicture.php", true);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.send("img="+encodeURIComponent(base64));

		// xhr.setRequestHeader('Content-Type', 'application/json');
		// xhr.send(JSON.stringify({"img": 'base64'}));

		// console.log("img="+base64);

		// callAjax("takePicture.php", null);

		// var xmlhttp;
		// // compatible with IE7+, Firefox, Chrome, Opera, Safari
		// xmlhttp = new XMLHttpRequest();
		// xmlhttp.onreadystatechange = function(){
		// 	if (xmlhttp.readyState == 4 && xmlhttp.status == 200){
		// 	// callback(xmlhttp.responseText);
		// 	}
		// }
		// xmlhttp.open("GET", "takePicture.php", true);
		// xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		// xmlhttp.send("img=lol");

		// xmlhttp.setRequestHeader('Content-Type', 'application/json');
		// xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		// base64 = base64.replace("img=", "");
		// xmlhttp.send(JSON.stringify({img: 'base64'}));
		// base64 = base64.replace("img=", "");
		// console.log(base64);

		// base64 = 'img='+base64;
		// console.log('in');
		// console.log(base64);
		// console.log('out');

		// xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		// xmlhttp.setRequestHeader("Content-length", base64.length);
		// xmlhttp.setRequestHeader("Connection", "close");
		// xmlhttp.send(base64);


		// $.ajax({
		// 	type: "POST",
		// 	url: "takePicture.php",
		// 	data: { 
		// 		imgBase64: base64
		// 	}
		// }).done(function(o) {
		// 	console.log('saved'); 
		// 	// If you want the file to be visible in the browser 
		// 	// - please modify the callback in javascript. All you
		// 	// need is to return the url to the file, you just saved 
		// 	// and than put the image in your browser.
		// });

	}

	function draw(video, drawCanvas, img){

		// get the canvas context for drawing
		var context = drawCanvas.getContext('2d');

		// draw the video contents into the canvas x, y, width, height
		context.drawImage( video, 0, 0, drawCanvas.width, drawCanvas.height);

		// get the image data from the canvas object
		var dataURL = drawCanvas.toDataURL();

		// set the source of the img tag
		img.setAttribute('src', dataURL);

	}

</script>

	</body>
</html>