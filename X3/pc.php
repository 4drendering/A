<!DOCTYPE html>
<html lang="en">

<head>
    <title>showwoom (php)</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <link rel="stylesheet" href="resp.css">

    <script>
        /*setTimeout(function() {
                                    document.getElementById('lod').style.display = 'none';

                                }, 5000)*/

    </script>

</head>

<body>
    <script src="three/three.js"></script>
    <script src="three/Detector.js"></script>
    <script src="three/PointerLockControls.js"></script>
    <script src="three/MTLLoader.js"></script>
    <script src="three/OBJLoader.js"></script>
    <script src="three/stats.min.js"></script>
    <div style="width: 100%;height: 100%;background-color:white;" id="lod">
        <div id="cen1">
            <p id="textp1">Please wait a moment<br> Scene is Loading ....</p>
            <div id="load1">
                <div id="por1"></div>
            </div>
        </div>
    </div>

    <div id="blocker">
        <div id="instructions">
            <span style="font-size:40px">START</span>
            <br />
        </div>

    </div>

    <script>
        if(Detector.webgl){
        var camera, scene, renderer, controls;
        var objects = [];
        var raycaster;
        var blocker = document.getElementById('blocker');
        var instructions = document.getElementById('instructions');
        var havePointerLock = 'pointerLockElement' in document || 'mozPointerLockElement' in document || 'webkitPointerLockElement' in document;
        if (havePointerLock) {
            var element = document.body;
            var pointerlockchange = function(event) {
                if (document.pointerLockElement === element || document.mozPointerLockElement === element || document.webkitPointerLockElement === element) {
                    controlsEnabled = true;
                    controls.enabled = true;
                    blocker.style.display = 'none';
                } else {
                    controls.enabled = false;
                    blocker.style.display = 'block';
                    instructions.style.display = '';
                }
            };
            var pointerlockerror = function(event) {
                instructions.style.display = '';
            };
            // Hook pointer lock state change events
            document.addEventListener('pointerlockchange', pointerlockchange, false);
            document.addEventListener('mozpointerlockchange', pointerlockchange, false);
            document.addEventListener('webkitpointerlockchange', pointerlockchange, false);
            document.addEventListener('pointerlockerror', pointerlockerror, false);
            document.addEventListener('mozpointerlockerror', pointerlockerror, false);
            document.addEventListener('webkitpointerlockerror', pointerlockerror, false);
            instructions.addEventListener('click', function(event) {
                instructions.style.display = 'none';
                // Ask the browser to lock the pointer
                element.requestPointerLock = element.requestPointerLock || element.mozRequestPointerLock || element.webkitRequestPointerLock;
                element.requestPointerLock();
            }, false);
        } else {
            instructions.innerHTML = 'Your browser doesn\'t seem to support Pointer Lock API';
        }
        init();
        animate();
        var controlsEnabled = false;
        var moveForward = false;
        var moveBackward = false;
        var moveLeft = false;
        var moveRight = false;
        var canJump = false;
        var prevTime = performance.now();
        var velocity = new THREE.Vector3();
        var direction = new THREE.Vector3();
        var loads1 = false;
        var loads2 = false;

        function init() {
            camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 1, 1000);
            scene = new THREE.Scene();
            scene.background = new THREE.Color(0x000000);
            //scene.fog = new THREE.Fog(0xffffff, 0, 750);
            var light = new THREE.HemisphereLight(0xeeeeff, 0x777788, 0.95);
            light.position.set(0.5, 1, 0.75);
            scene.add(light);
            controls = new THREE.PointerLockControls(camera);
            scene.add(controls.getObject());
            var onKeyDown = function(event) {
                switch (event.keyCode) {
                    case 38: // up
                    case 87: // w
                        moveForward = true;
                        break;
                    case 37: // left
                    case 65: // a
                        moveLeft = true;
                        break;
                    case 40: // down
                    case 83: // s
                        moveBackward = true;
                        break;
                    case 39: // right
                    case 68: // d
                        moveRight = true;
                        break;
                    case 32: // space
                        if (canJump === true) velocity.y += 350;
                        canJump = false;
                        break;
                }
            };
            var onKeyUp = function(event) {
                switch (event.keyCode) {
                    case 38: // up
                    case 87: // w
                        moveForward = false;
                        break;
                    case 37: // left
                    case 65: // a
                        moveLeft = false;
                        break;
                    case 40: // down
                    case 83: // s
                        moveBackward = false;
                        break;
                    case 39: // right
                    case 68: // d
                        moveRight = false;
                        break;
                }
            };

            //s1,2
            var pointLight = new THREE.PointLight(0xffffff, 15, 50);
            pointLight.position.set(55, -42, -440);
            scene.add(pointLight);


            var pointLight = new THREE.PointLight(0xffffff, 15, 50);
            pointLight.position.set(55, -42, -400);
            scene.add(pointLight);

            var pointLight = new THREE.PointLight(0xffffff, 15, 50);
            pointLight.position.set(-275, -42, -440);
            scene.add(pointLight);

            var pointLight = new THREE.PointLight(0xffffff, 15, 50);
            pointLight.position.set(-275, -42, -400);
            scene.add(pointLight);

            //l1
            var pointLight = new THREE.PointLight(0xffffff, 15, 50);
            pointLight.position.set(-440, -30, -345);
            scene.add(pointLight);

            var pointLight = new THREE.PointLight(0xffffff, 15, 50);
            pointLight.position.set(-440, -40, -345);
            scene.add(pointLight);

            var pointLight = new THREE.PointLight(0xffffff, 15, 50);
            pointLight.position.set(-440, -20, -345);
            scene.add(pointLight);

            var pointLight = new THREE.PointLight(0xffffff, 15, 50);
            pointLight.position.set(-440, -10, -345);
            scene.add(pointLight);

            var pointLight = new THREE.PointLight(0xffffff, 15, 50);
            pointLight.position.set(-420, -10, -345);
            scene.add(pointLight);

            //l2
            var pointLight = new THREE.PointLight(0xffffff, 15, 50);
            pointLight.position.set(-440, -30, -230);
            scene.add(pointLight);

            var pointLight = new THREE.PointLight(0xffffff, 15, 50);
            pointLight.position.set(-440, -40, -230);
            scene.add(pointLight);

            var pointLight = new THREE.PointLight(0xffffff, 15, 50);
            pointLight.position.set(-440, -20, -230);
            scene.add(pointLight);

            var pointLight = new THREE.PointLight(0xffffff, 15, 50);
            pointLight.position.set(-440, -10, -230);
            scene.add(pointLight);

            var pointLight = new THREE.PointLight(0xffffff, 15, 50);
            pointLight.position.set(-420, -10, -230);
            scene.add(pointLight);
            //l3
            var pointLight = new THREE.PointLight(0xffffff, 15, 50);
            pointLight.position.set(-440, -10, 135);
            scene.add(pointLight);

            var pointLight = new THREE.PointLight(0xffffff, 15, 50);
            pointLight.position.set(-440, -20, 135);
            scene.add(pointLight);

            var pointLight = new THREE.PointLight(0xffffff, 15, 50);
            pointLight.position.set(-440, -30, 135);
            scene.add(pointLight);

            var pointLight = new THREE.PointLight(0xffffff, 15, 50);
            pointLight.position.set(-440, -40, 135);
            scene.add(pointLight);

            var pointLight = new THREE.PointLight(0xffffff, 15, 50);
            pointLight.position.set(-420, -10, 135);
            scene.add(pointLight);

            //RFULL
            var pointLight = new THREE.PointLight(0xffffff, 15, 180);
            pointLight.position.set(230, 17, -250);
            scene.add(pointLight);

            var pointLight = new THREE.PointLight(0xffffff, 15, 180);
            pointLight.position.set(230, 17, -230);
            scene.add(pointLight);

            var pointLight = new THREE.PointLight(0xffffff, 15, 180);
            pointLight.position.set(230, 17, -210);
            scene.add(pointLight);

            //lfull2
            var pointLight = new THREE.PointLight(0xffffff, 15, 180);
            pointLight.position.set(-440, -10, 135);
            scene.add(pointLight);

            //lfull1
            var pointLight = new THREE.PointLight(0xffffff, 15, 150);
            pointLight.position.set(-440, 1, -290);
            scene.add(pointLight);

            //LI1   
            var light1 = new THREE.MeshBasicMaterial({
                color: 0xffffff
            });

            document.addEventListener('keydown', onKeyDown, false);
            document.addEventListener('keyup', onKeyUp, false);
            raycaster = new THREE.Raycaster(new THREE.Vector3(), new THREE.Vector3(0, -1, 0), 0, 10);

            mtlLoader = new THREE.MTLLoader();
            mtlLoader.setPath('finm/');
            mtlLoader.load('OBJ 01.mtl', function(materials) {
                materials.preload();
                objLoader = new THREE.OBJLoader();
                objLoader.setMaterials(materials);
                objLoader.setPath('finm/');
                objLoader.load('OBJ 01.obj', function(object) {
                    object.position.y = -1850;
                    object.position.x = 900;
                    object.position.z = -450;
                    aa = scene.add(object);
                    if(aa){
                        loads1 = true;
                    }
                });
            });
            mtlLoader = new THREE.MTLLoader();
            mtlLoader.setPath('asl/');
            mtlLoader.load('OBJ 04obj.mtl', function(materials) {
                materials.preload();
                objLoader = new THREE.OBJLoader();
                objLoader.setMaterials(materials);
                objLoader.setPath('asl/');
                objLoader.load('OBJ 04obj.obj', function(object) {
                    object.position.y = -1850;
                    object.position.x = 900;
                    object.position.z = -444;
                    object.traverse(function(child) {

                        if (child instanceof THREE.Mesh) {

                            child.material = light1;
                            child.castShadow = true;

                        }

                    });
                    aaa = scene.add(object);
                    if(aaa){
                        loads2 = true;
                    }
                });
            });


            pw = 1;
            setInterval(function() {
                por = document.getElementById('por1');
                switch (pw) {
                    case 1:
                        por.style.width = "20%";
                        break;
                    case 2:
                        por.style.width = "25%";
                        break;
                    case 3:
                        por.style.width = "30%";
                        break;
                    case 4:
                        por.style.width = "35%";
                        break;
                    case 5:
                        por.style.width = "40%";
                        break;
                    case 6:
                        por.style.width = "45%";
                        break;
                    case 7:
                        por.style.width = "50%";
                        break;
                    case 8:
                        por.style.width = "55%";
                        break;
                    case 9:
                        por.style.width = "60%";
                        break;
                    case 10:
                        por.style.width = "65%";
                        break;
                    case 11:
                        por.style.width = "70%";
                        break;
                    case 12:
                        por.style.width = "75%";
                        break;
                    case 13:
                        por.style.width = "80%";
                        break;
                    case 14:
                        por.style.width = "85%";
                        break;
                    case 15:
                        por.style.width = "90%";
                        break;
                }
                pw++;
            }, 1500);
            //
            renderer = new THREE.WebGLRenderer();
            renderer.setPixelRatio(window.devicePixelRatio);
            renderer.setSize(window.innerWidth, window.innerHeight);
            renderer.shadowMap.enabled = true;
            document.body.appendChild(renderer.domElement);
            //
            window.addEventListener('resize', onWindowResize, false);
        }

        function onWindowResize() {
            camera.aspect = window.innerWidth / window.innerHeight;
            camera.updateProjectionMatrix();
            renderer.setSize(window.innerWidth, window.innerHeight);
        }

        function animate() {
            requestAnimationFrame(animate);

            if (controlsEnabled === true) {
                raycaster.ray.origin.copy(controls.getObject().position);
                raycaster.ray.origin.y -= 10;
                var intersections = raycaster.intersectObjects(objects);
                var onObject = intersections.length > 0;
                var time = performance.now();
                var delta = (time - prevTime) / 1000;
                velocity.x -= velocity.x * 10.0 * delta;
                velocity.z -= velocity.z * 10.0 * delta;
                velocity.y -= 9.8 * 100.0 * delta; // 100.0 = mass
                direction.z = Number(moveForward) - Number(moveBackward);
                direction.x = Number(moveLeft) - Number(moveRight);
                direction.normalize(); // this ensures consistent movements in all directions
                if (moveForward || moveBackward) velocity.z -= direction.z * 1500.0 * delta;
                if (moveLeft || moveRight) velocity.x -= direction.x * 1500.0 * delta;
                if (onObject === true) {
                    velocity.y = Math.max(0, velocity.y);
                    canJump = true;
                }
                controls.getObject().translateX(velocity.x * delta);
                controls.getObject().translateY(velocity.y * delta);
                controls.getObject().translateZ(velocity.z * delta);
                if (controls.getObject().position.y < 10) {
                    velocity.y = 0;
                    controls.getObject().position.y = 10;
                    canJump = true;
                }
                if (controls.getObject().position.x < -420) {
                    velocity.x = 0;
                    controls.getObject().position.x = -420;
                    moveLeft = false;
                }
                if (controls.getObject().position.x > 150) {
                    velocity.x = 0;
                    controls.getObject().position.x = 150;
                    moveRight = false;
                }
                if (controls.getObject().position.z < -410) {
                    velocity.z = 0;
                    controls.getObject().position.z = -410;
                    moveForward = false;
                }
                if (controls.getObject().position.z > 270) {
                    velocity.z = 0;
                    controls.getObject().position.z = 270;
                    moveBackward = false;
                }
                prevTime = time;
            }
            if (loads1 == true) {
                if (loads2 == true) {
                    pw = 100;
                    //por.style.width = "100%";
                    setTimeout(function() {
                        document.getElementById('lod').style.display = 'none';

                    },2000);
                }
            }
            renderer.render(scene, camera);
        }
        }else{
            document.getElementById('os').style.display= 'block';
        }

    </script>
    <div id="os" style="width:100%;height:100%;display:none;"><p>your browser does not support please update your browser</p></div>
</body>

</html>
