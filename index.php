<!DOCTYPE html>
<html lang="en">
	<head>
		<title>D20 Building</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
		<style>
			body {
				font-family: Monospace;
				background-color: #000000;
				margin: 0px;
				overflow: hidden;
			}

			#info {
				color: #fff;
				position: absolute;
				top: 10px;
				width: 100%;
				text-align: center;
				z-index: 100;
				display:block;

			}

			a { color: skyblue }
			.button { background:#999; color:#eee; padding:0.2em 0.5em; cursor:pointer }
			.highlight { background:orange; color:#fff; }

			span {
				display: inline-block;
				width: 60px;
				float: left;
				text-align: center;
			}

		</style>
	</head>
	<body>
<!-- 		<div id="info">
			<a href="http://threejs.org" target="_blank" rel="noopener">three.js</a> -
			STL loader test by <a href="https://github.com/aleeper">aleeper</a>. PR2 head from <a href="http://www.ros.org/wiki/pr2_description">www.ros.org</a>
		</div> -->

		<script src="build/three.js"></script>
		<script src="js/loaders/STLLoader.js"></script>
		 <script src="js/OrbitControls.js"></script>

		<script src="js/Detector.js"></script>
		<script src="js/libs/stats.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script type="text/javascript">
			var previous = null;
		    var current = null;
		    setInterval(function() {
		        $.getJSON("results_json/results.json", function(json) {
		            current = JSON.stringify(json);            
		            if (previous && current && previous !== current) {
		                console.log('refresh');
		                location.reload();
		            }
		            previous = current;
		        });                       
		    }, 1000);   

		    var previous2 = null;
		    var current2 = null;
		    setInterval(function() {
		        $.getJSON("results_json/results2.json", function(json2) {
		            current2 = JSON.stringify(json2);            
		            if (previous2 && current2 && previous2 !== current2) {
		                console.log('refresh');
		                location.reload();
		            }
		            previous2 = current2;
		        });                       
		    }, 1000); 

		    var previous3 = null;
		    var current3 = null;
		    setInterval(function() {
		        $.getJSON("results_json/results3.json", function(json3) {
		            current3 = JSON.stringify(json3);            
		            if (previous3 && current3 && previous3 !== current3) {
		                console.log('refresh');
		                location.reload();
		            }
		            previous3 = current3;
		        });                       
		    }, 1000); 

		    var previous4 = null;
		    var current4 = null;
		    setInterval(function() {
		        $.getJSON("results_json/results4.json", function(json4) {
		            current4 = JSON.stringify(json4);            
		            if (previous4 && current4 && previous4 !== current4) {
		                console.log('refresh');
		                location.reload();
		            }
		            previous4 = current4;
		        });                       
		    }, 1000); 

		    var previous5 = null;
		    var current5 = null;
		    setInterval(function() {
		        $.getJSON("results_json/results5.json", function(json5) {
		            current5 = JSON.stringify(json5);            
		            if (previous5 && current5 && previous5 !== current5) {
		                console.log('refresh');
		                location.reload();
		            }
		            previous5 = current5;
		        });                       
		    }, 1000); 

		    var previous6 = null;
		    var current6 = null;
		    setInterval(function() {
		        $.getJSON("results_json/results6.json", function(json6) {
		            current6 = JSON.stringify(json6);            
		            if (previous6 && current6 && previous6 !== current6) {
		                console.log('refresh');
		                location.reload();
		            }
		            previous6 = current6;
		        });                       
		    }, 1000); 

		    var previous7 = null;
		    var current7 = null;
		    setInterval(function() {
		        $.getJSON("results_json/results7.json", function(json7) {
		            current7 = JSON.stringify(json7);            
		            if (previous7 && current7 && previous7 !== current7) {
		                console.log('refresh');
		                location.reload();
		            }
		            previous7 = current7;
		        });                       
		    }, 1000); 
		</script>
		<script>

			if ( ! Detector.webgl ) Detector.addGetWebGLMessage();

			var container, stats;
			//var mqtt = require('mqtt')
			var camera, cameraTarget, scene, renderer;
			/*
			var client  = mqtt.connect('mqtt://35.202.49.101',{
			    username: process.env.TOKEN
			})		
			*/	
			init();
			animate();

			/*
			client.on('connect', function () {
			    console.log('connected')
			    client.subscribe('v1/devices/me/rpc/request/+')
			    //client.publish('v1/devices/me/attributes', '{"10":"MANTAP1", "11":"MANTAP2", "12":"MANTAP3"}')
			})

			client.on('message', function (topic, message) {
			    console.log('response.topic: ' + topic)
			    console.log('response.body: ' + message.toString())
			    client.end()
			})
			*/


			function init() {

				container = document.createElement( 'div' );
				document.body.appendChild( container );

				camera = new THREE.PerspectiveCamera( 20, window.innerWidth / window.innerHeight, 1, 15 );
				camera.position.set( 3, 0.15, 3 );

				cameraTarget = new THREE.Vector3( 0, -0.7, 0 );

				scene = new THREE.Scene();
				//scene.background = new THREE.Color( 0x72645b );
				scene.background = new THREE.Color( 0x72645b );
				scene.fog = new THREE.Fog( 0x72645b, 2, 15 );


				// Ground

				var plane = new THREE.Mesh(
					new THREE.PlaneBufferGeometry( 80, 80 ),
					new THREE.MeshPhongMaterial( { color: 0x999999, specular: 0x101010 } )
				);
				plane.rotation.x = -Math.PI/2;
				plane.position.y = -0.5;
				scene.add( plane );

				plane.receiveShadow = true;


				// ASCII file

				var loader = new THREE.STLLoader();

				// Binary files

				var material = new THREE.MeshPhongMaterial( { color: 0xAAAAAA, specular: 0x111111, shininess: 200 } );


				loader.load( 'models/stl/binary/L1_circle.stl', function ( geometry ) {


					var meshMaterial = material;

					// var request = new XMLHttpRequest();
				 //    request.open("GET", "results.json", false);
				 //    request.send(null)
				 //    var msgjson = JSON.parse(request.responseText);

					// var msgjson = JSON.parse('{"method":"setLightingStat","params":{"pin":26,"enabled":true}}');
					
					// if (msgjson.params['enabled'] == true) {
					meshMaterial = new THREE.MeshPhongMaterial({ color: 0xFFFFFF});
					// }else{
					// meshMaterial = new THREE.MeshPhongMaterial({ color: 0x333333});
					// }

					var mesh = new THREE.Mesh( geometry, meshMaterial );

					mesh.position.set( -0.6,-0.551,0.5 );
					mesh.rotation.set( -Math.PI / 2, 0, 0 );
					mesh.scale.set( 0.02, 0.02, 0.02 );

					//mesh.castShadow = true;
					mesh.receiveShadow = true;

					scene.add( mesh );

				} );

				loader.load( 'models/stl/binary/L1_pillars.stl', function ( geometry ) {

					var meshMaterial = material;
					//if (geometry.hasColors) {
					meshMaterial = new THREE.MeshPhongMaterial({ color: 0x333333});
					//}

					var mesh = new THREE.Mesh( geometry, meshMaterial );

					mesh.position.set( -0.6,-0.551,0.5 );
					mesh.rotation.set( -Math.PI / 2, 0, 0 );
					mesh.scale.set( 0.02, 0.02, 0.02 );

					mesh.castShadow = true;
					mesh.receiveShadow = true;

					scene.add( mesh );

				} );

				loader.load( 'models/stl/binary/L1_stairs.stl', function ( geometry ) {

					var meshMaterial = material;
					//if (geometry.hasColors) {
					meshMaterial = new THREE.MeshPhongMaterial({ color: 0xF4D942});
					//}

					var mesh = new THREE.Mesh( geometry, meshMaterial );

					mesh.position.set( -0.6,-0.551,0.5 );
					mesh.rotation.set( -Math.PI / 2, 0, 0 );
					mesh.scale.set( 0.02, 0.02, 0.02 );

					mesh.castShadow = true;
					mesh.receiveShadow = true;

					scene.add( mesh );

				} );

				loader.load( 'models/stl/binary/L1_walls.stl', function ( geometry ) {

					var meshMaterial = material;
					//if (geometry.hasColors) {
					meshMaterial = new THREE.MeshPhongMaterial({ color: 0xFFFFFF});
					//}

					var mesh = new THREE.Mesh( geometry, meshMaterial );

					mesh.position.set( -0.6,-0.551,0.5 );
					mesh.rotation.set( -Math.PI / 2, 0, 0 );
					mesh.scale.set( 0.02, 0.02, 0.02 );

					mesh.castShadow = true;
					mesh.receiveShadow = true;

					scene.add( mesh );

				} );

				loader.load( './models/stl/binary/light1.stl', function ( geometry ) {

					var meshMaterial = material;
					//if (geometry.hasColors) {
					// meshMaterial = new THREE.MeshPhongMaterial({emissive: 0xffffff,
					// emissiveIntensity: 10, color: 0xFFFFFF});
					//}

					var request = new XMLHttpRequest();
				    request.open("GET", "results_json/results.json", false);
				    request.send(null)
				    var msgjson = JSON.parse(request.responseText);

					// var msgjson = JSON.parse('{"method":"setLightingStat","params":{"pin":26,"enabled":true}}');
					
					if (msgjson.params['enabled'] == false) {
					meshMaterial = new THREE.MeshPhongMaterial({ color: 0x000000, emissive: 0x000000});
					}else{
					meshMaterial = new THREE.MeshPhongMaterial({ color: 0xffffff, emissive: 0xffffff});
					}

					var mesh = new THREE.Mesh( geometry, meshMaterial );

					mesh.position.set( -0.6,-0.551,0.5 );
					mesh.rotation.set( -Math.PI / 2, 0, 0 );
					//mesh.rotation.set( -Math.PI / 2, 0, 0 );
					mesh.scale.set( 0.02, 0.02, 0.02 );

					mesh.castShadow = true;
					mesh.receiveShadow = true;

					scene.add( mesh );

				} );

				loader.load( './models/stl/binary/light2.stl', function ( geometry ) {

					var meshMaterial = material;
					//if (geometry.hasColors) {
					var request2 = new XMLHttpRequest();
				    request2.open("GET", "results_json/results2.json", false);
				    request2.send(null)
				    var msgjson2 = JSON.parse(request2.responseText);

					// var msgjson = JSON.parse('{"method":"setLightingStat","params":{"pin":26,"enabled":true}}');
					
					if (msgjson2.params['enabled'] == false) {
					meshMaterial = new THREE.MeshPhongMaterial({ color: 0x000000});
					}else{
					meshMaterial = new THREE.MeshPhongMaterial({ color: 0xffffff});
					}
					//}

					var mesh = new THREE.Mesh( geometry, meshMaterial );

					mesh.position.set( -0.6,-0.551,0.5 );
					mesh.rotation.set( -Math.PI / 2, 0, 0 );
					//mesh.rotation.set( -Math.PI / 2, 0, 0 );
					mesh.scale.set( 0.02, 0.02, 0.02 );

					mesh.castShadow = true;
					mesh.receiveShadow = true;

					scene.add( mesh );

				} );


				loader.load( './models/stl/binary/light3.stl', function ( geometry ) {

					var meshMaterial = material;
					//if (geometry.hasColors) {
					var request3 = new XMLHttpRequest();
				    request3.open("GET", "results_json/results3.json", false);
				    request3.send(null)
				    var msgjson3 = JSON.parse(request3.responseText);

					// var msgjson = JSON.parse('{"method":"setLightingStat","params":{"pin":26,"enabled":true}}');
					
					if (msgjson3.params['enabled'] == false) {
					meshMaterial = new THREE.MeshPhongMaterial({ color: 0x000000});
					}else{
					meshMaterial = new THREE.MeshPhongMaterial({ color: 0xffffff});
					}
					//}

					var mesh = new THREE.Mesh( geometry, meshMaterial );

					mesh.position.set( -0.6,-0.551,0.5 );
					mesh.rotation.set( -Math.PI / 2, 0, 0 );
					//mesh.rotation.set( -Math.PI / 2, 0, 0 );
					mesh.scale.set( 0.02, 0.02, 0.02 );

					mesh.castShadow = true;
					mesh.receiveShadow = true;

					scene.add( mesh );

				} );

				loader.load( './models/stl/binary/light4.stl', function ( geometry ) {

					var meshMaterial = material;
					//if (geometry.hasColors) {
					var request4 = new XMLHttpRequest();
				    request4.open("GET", "results_json/results4.json", false);
				    request4.send(null)
				    var msgjson4= JSON.parse(request4.responseText);

					// var msgjson = JSON.parse('{"method":"setLightingStat","params":{"pin":26,"enabled":true}}');
					
					if (msgjson4.params['enabled'] == false) {
					meshMaterial = new THREE.MeshPhongMaterial({ color: 0x000000});
					}else{
					meshMaterial = new THREE.MeshPhongMaterial({ color: 0xffffff});
					}
					//}

					var mesh = new THREE.Mesh( geometry, meshMaterial );

					mesh.position.set( -0.6,-0.551,0.5 );
					mesh.rotation.set( -Math.PI / 2, 0, 0 );
					//mesh.rotation.set( -Math.PI / 2, 0, 0 );
					mesh.scale.set( 0.02, 0.02, 0.02 );

					mesh.castShadow = true;
					mesh.receiveShadow = true;

					scene.add( mesh );

				} );

				loader.load( './models/stl/binary/light5.stl', function ( geometry ) {

					var meshMaterial = material;
					//if (geometry.hasColors) {
					var request5 = new XMLHttpRequest();
				    request5.open("GET", "results_json/results5.json", false);
				    request5.send(null)
				    var msgjson5= JSON.parse(request5.responseText);

					// var msgjson = JSON.parse('{"method":"setLightingStat","params":{"pin":26,"enabled":true}}');
					
					if (msgjson5.params['enabled'] == false) {
					meshMaterial = new THREE.MeshPhongMaterial({ color: 0x000000});
					}else{
					meshMaterial = new THREE.MeshPhongMaterial({ color: 0xffffff});
					}
					//}

					var mesh = new THREE.Mesh( geometry, meshMaterial );

					mesh.position.set( -0.6,-0.551,0.5 );
					mesh.rotation.set( -Math.PI / 2, 0, 0 );
					//mesh.rotation.set( -Math.PI / 2, 0, 0 );
					mesh.scale.set( 0.02, 0.02, 0.02 );

					mesh.castShadow = true;
					mesh.receiveShadow = true;

					scene.add( mesh );

				} );

				loader.load( './models/stl/binary/light6.stl', function ( geometry ) {

					var meshMaterial = material;
					//if (geometry.hasColors) {
					var request6 = new XMLHttpRequest();
				    request6.open("GET", "results_json/results6.json", false);
				    request6.send(null)
				    var msgjson6= JSON.parse(request6.responseText);

					// var msgjson = JSON.parse('{"method":"setLightingStat","params":{"pin":26,"enabled":true}}');
					
					if (msgjson6.params['enabled'] == false) {
					meshMaterial = new THREE.MeshPhongMaterial({ color: 0x000000});
					}else{
					meshMaterial = new THREE.MeshPhongMaterial({ color: 0xffffff});
					}
					//}

					var mesh = new THREE.Mesh( geometry, meshMaterial );

					mesh.position.set( -0.6,-0.551,0.5 );
					mesh.rotation.set( -Math.PI / 2, 0, 0 );
					//mesh.rotation.set( -Math.PI / 2, 0, 0 );
					mesh.scale.set( 0.02, 0.02, 0.02 );

					mesh.castShadow = true;
					mesh.receiveShadow = true;

					scene.add( mesh );

				} );	
				
				loader.load( './models/stl/binary/light7.stl', function ( geometry ) {

					var meshMaterial = material;
					//if (geometry.hasColors) {
					var request7 = new XMLHttpRequest();
				    request7.open("GET", "results_json/results7.json", false);
				    request7.send(null)
				    var msgjson7= JSON.parse(request7.responseText);

					// var msgjson = JSON.parse('{"method":"setLightingStat","params":{"pin":26,"enabled":true}}');
					
					if (msgjson7.params['enabled'] == false) {
					meshMaterial = new THREE.MeshPhongMaterial({ color: 0x000000});
					}else{
					meshMaterial = new THREE.MeshPhongMaterial({ color: 0xffffff});
					}
					//}

					var mesh = new THREE.Mesh( geometry, meshMaterial );

					mesh.position.set( -0.6,-0.551,0.5 );
					mesh.rotation.set( -Math.PI / 2, 0, 0 );
					//mesh.rotation.set( -Math.PI / 2, 0, 0 );
					mesh.scale.set( 0.02, 0.02, 0.02 );

					mesh.castShadow = true;
					mesh.receiveShadow = true;

					scene.add( mesh );

				} );							

				// Lights

				scene.add( new THREE.HemisphereLight( 0x443333, 0x111122 ) );

				addShadowedLight( 1, 1, 1, 0xffffff, 1.0 );
				//addShadowedLight( 0.5, 1, -1, 0xffaa00, 1 );

				// Renderer

				renderer = new THREE.WebGLRenderer( { antialias: true } );
				renderer.setPixelRatio( window.devicePixelRatio );
				renderer.setSize( window.innerWidth, window.innerHeight );

				renderer.gammaInput = true;
				renderer.gammaOutput = true;

				renderer.shadowMap.enabled = true;

				container.appendChild( renderer.domElement );

				// stats

				stats = new Stats();
				container.appendChild( stats.dom );

				//

				window.addEventListener('resize', onWindowResize, false);
				controls = new THREE.OrbitControls(camera, renderer.domElement);
	            controls.enableDamping = true;
	            controls.dampingFactor = 0.25;
	            controls.enableZoom = true;


			}

			function addShadowedLight( x, y, z, color, intensity ) {

				var directionalLight = new THREE.DirectionalLight( color, intensity );
				directionalLight.position.set( x, y, z );
				scene.add( directionalLight );

				directionalLight.castShadow = true;

				var d = 1;
				directionalLight.shadow.camera.left = -d;
				directionalLight.shadow.camera.right = d;
				directionalLight.shadow.camera.top = d;
				directionalLight.shadow.camera.bottom = -d;

				directionalLight.shadow.camera.near = 1;
				directionalLight.shadow.camera.far = 4;

				directionalLight.shadow.mapSize.width = 1024;
				directionalLight.shadow.mapSize.height = 1024;

				directionalLight.shadow.bias = -0.002;

			}

			function onWindowResize() {

				camera.aspect = window.innerWidth / window.innerHeight;
				camera.updateProjectionMatrix();

				renderer.setSize( window.innerWidth, window.innerHeight );

			}

			function animate() {

				requestAnimationFrame( animate );

				render();
				stats.update();

			}

			function render() {

				// var timer = Date.now() * 0.0005;

				// camera.position.x = -Math.cos( timer ) * 2;
				// camera.position.z = Math.sin( timer ) * 2;
				// //camera.position.x = 1.5;
				// //camera.position.z = 2.5;				
				// camera.position.y = 1;
				// //camera.rotation.set( 0, 0, 0 );

				// //camera.position.x = 1.5;
				// //camera.position.z = 3;

				camera.lookAt( cameraTarget );

				renderer.render( scene, camera );

			}

		</script>
	</body>
</html>
