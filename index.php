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

		<script src="js/Detector.js"></script>
		<script src="js/libs/stats.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script type="text/javascript">
			var previous = null;
		    var current = null;
		    setInterval(function() {
		        $.getJSON("results.json", function(json) {
		            current = JSON.stringify(json);            
		            if (previous && current && previous !== current) {
		                console.log('refresh');
		                location.reload();
		            }
		            previous = current;
		        });                       
		    }, 2000);   
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

				camera = new THREE.PerspectiveCamera( 35, window.innerWidth / window.innerHeight, 1, 15 );
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

				/*
				loader.load( 'models/stl/ascii/slotted_disk.stl', function ( geometry ) {

					var material = new THREE.MeshPhongMaterial( { color: 0xff5533, specular: 0x111111, shininess: 200 } );
					var mesh = new THREE.Mesh( geometry, material );

					mesh.position.set( 0, - 0.25, 0.6 );
					mesh.rotation.set( 0, - Math.PI / 2, 0 );
					mesh.scale.set( 0.5, 0.5, 0.5 );

					mesh.castShadow = true;
					mesh.receiveShadow = true;

					scene.add( mesh );

				} );
				*/

				// Binary files

				var material = new THREE.MeshPhongMaterial( { color: 0xAAAAAA, specular: 0x111111, shininess: 200 } );

				/*
				loader.load( 'models/stl/binary/pr2_head_pan.stl', function ( geometry ) {

					var mesh = new THREE.Mesh( geometry, material );

					mesh.position.set( 0, - 0.37, - 0.6 );
					mesh.rotation.set( - Math.PI / 2, 0, 0 );
					mesh.scale.set( 2, 2, 2 );

					mesh.castShadow = true;
					mesh.receiveShadow = true;

					scene.add( mesh );

				} );
				

				loader.load( 'models/stl/binary/pr2_head_tilt.stl', function ( geometry ) {

					var meshMaterial = material;
					//if (geometry.hasColors) {
					meshMaterial = new THREE.MeshPhongMaterial({ color: 0x00A2E9});
					//}

					var mesh = new THREE.Mesh( geometry, meshMaterial );

					mesh.position.set( 0.136, - 0.37, - 0.6 );
					mesh.rotation.set( - Math.PI / 2, 0.3, 0 );
					mesh.scale.set( 2, 2, 2 );

					mesh.castShadow = true;
					mesh.receiveShadow = true;

					scene.add( mesh );

				} );
				*/

				loader.load( 'models/stl/binary/circle.stl', function ( geometry ) {


					var meshMaterial = material;

					var request = new XMLHttpRequest();
				    request.open("GET", "results.json", false);
				    request.send(null)
				    var msgjson = JSON.parse(request.responseText);

					// var msgjson = JSON.parse('{"method":"setLightingStat","params":{"pin":26,"enabled":true}}');
					
					if (msgjson.params['enabled'] == true) {
					meshMaterial = new THREE.MeshPhongMaterial({ color: 0xFFFFFF});
					}else{
					meshMaterial = new THREE.MeshPhongMaterial({ color: 0x333333});
					}

					var mesh = new THREE.Mesh( geometry, meshMaterial );

					mesh.position.set( -1.1, - 0.6, 1.2 );
					mesh.rotation.set( -Math.PI / 2, 0, 0 );
					mesh.scale.set( 0.02, 0.02, 0.02 );

					//mesh.castShadow = true;
					mesh.receiveShadow = true;

					scene.add( mesh );

				} );

				loader.load( 'models/stl/binary/pillars.stl', function ( geometry ) {

					var meshMaterial = material;
					//if (geometry.hasColors) {
					meshMaterial = new THREE.MeshPhongMaterial({ color: 0x333333});
					//}

					var mesh = new THREE.Mesh( geometry, meshMaterial );

					mesh.position.set( -1.1, - 0.6, 1.2 );
					mesh.rotation.set( -Math.PI / 2, 0, 0 );
					mesh.scale.set( 0.02, 0.02, 0.02 );

					mesh.castShadow = true;
					mesh.receiveShadow = true;

					scene.add( mesh );

				} );

				loader.load( 'models/stl/binary/stairs.stl', function ( geometry ) {

					var meshMaterial = material;
					//if (geometry.hasColors) {
					meshMaterial = new THREE.MeshPhongMaterial({ color: 0xF4D942});
					//}

					var mesh = new THREE.Mesh( geometry, meshMaterial );

					mesh.position.set( -1.1, - 0.6, 1.2 );
					mesh.rotation.set( -Math.PI / 2, 0, 0 );
					mesh.scale.set( 0.02, 0.02, 0.02 );

					mesh.castShadow = true;
					mesh.receiveShadow = true;

					scene.add( mesh );

				} );

				loader.load( 'models/stl/binary/walls.stl', function ( geometry ) {

					var meshMaterial = material;
					//if (geometry.hasColors) {
					meshMaterial = new THREE.MeshPhongMaterial({ color: 0xFFFFFF});
					//}

					var mesh = new THREE.Mesh( geometry, meshMaterial );

					mesh.position.set( -1.1, - 0.6, 1.2 );
					mesh.rotation.set( -Math.PI / 2, 0, 0 );
					mesh.scale.set( 0.02, 0.02, 0.02 );

					mesh.castShadow = true;
					mesh.receiveShadow = true;

					scene.add( mesh );

				} );

				// Colored binary STL
				/*
				loader.load( 'models/stl/binary/colored.stl', function ( geometry ) {

					var meshMaterial = material;
					if (geometry.hasColors) {
						meshMaterial = new THREE.MeshPhongMaterial({ opacity: geometry.alpha, vertexColors: THREE.VertexColors });
					}

					var mesh = new THREE.Mesh( geometry, meshMaterial );

					mesh.position.set( 0.5, 0.2, 0 );
					mesh.rotation.set( - Math.PI / 2, Math.PI / 2, 0 );
					mesh.scale.set( 0.3, 0.3, 0.3 );

					mesh.castShadow = true;
					mesh.receiveShadow = true;

					scene.add( mesh );

				} );
				*/


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

				window.addEventListener( 'resize', onWindowResize, false );

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

				var timer = Date.now() * 0.0005;

				//camera.position.x = -Math.cos( timer ) * 2;
				//camera.position.z = Math.sin( timer ) * 2;
				camera.position.x = 1.5;
				camera.position.z = 2.5;				
				camera.position.y = 1;
				//camera.rotation.set( 0, 0, 0 );

				//camera.position.x = 1.5;
				//camera.position.z = 3;

				camera.lookAt( cameraTarget );

				renderer.render( scene, camera );

			}

		</script>
	</body>
</html>
