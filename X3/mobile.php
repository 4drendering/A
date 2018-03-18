<!DOCTYPE html>
<html lang="en">

<head>
    <title>showwoom (php)</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <link rel="stylesheet" href="resp.css">


</head>

<body>
    <script src="three/three.js"></script>
    <script src="three/Detector.js"></script>
    <script src="three/DeviceOrientationControls.js"></script>
    <script src="three/MTLLoader.js"></script>
    <script src="three/OBJLoader.js"></script>
    <script src="three/stats.min.js"></script>

    <div style="width: 100%;height: 100%;background-color:white;" id="lod">
        <div id="cen">
            <p id="textp">Please wait a moment<br> Scene is Loading ....</p>
            <div id="load">
                <div id="por"></div>
            </div>
        </div>
    </div>

    <div id="op">
        <p style="padding-top:70%;text-align:center;margin-right:13%;" id="tp">TAP ON SCREEN FOR WALK <br> START Click</p>
    </div>

    <div id="top"></div>

    <script>
        if (Detector.webgl) {
            var camera, scene, renderer, controls, x2;
            var objects = [];
            var raycaster;

            init();
            animate();
            var controlsEnabled = false;
            var moveForward = false;
            var moveBackward = false;
            var moveLeft = false;
            var moveRight = false;
            var canJump = false;
            var xx;
            var yy;
            var loads1 = false;
            var loads2 = false;
            var prevTime = performance.now();
            var velocity = new THREE.Vector3();
            var direction = new THREE.Vector3();

            function init() {
                camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 1, 1000);
                scene = new THREE.Scene();
                scene.background = new THREE.Color(0x000000);
                //scene.fog = new THREE.Fog(0xffffff, 0, 750);
                var light = new THREE.HemisphereLight(0xeeeeff, 0x777788, 0.95);
                light.position.set(0.5, 1, 0.75);
                scene.add(light);

                raycaster = new THREE.Raycaster(new THREE.Vector3(), new THREE.Vector3(0, -1, 0), 0, 10);

                window.onload = prepareButton;

                var width = window.innerWidth / 2;

                var top = document.getElementById('top');
                top.style.width = "100%";
                top.style.height = '100%';
                top.style.marginLeft = '20%';
                top.style.marginRight = '20%';
                top.style.opacity = '0';
                var tp = document.getElementById('tp');
                var op = document.getElementById('op');
                var cen = document.getElementById('cen');


                var width = window.innerWidth;
                if (width <= 1366) {
                    tp.style.paddingTop = "24%";
                    tp.style.textAlign = 'center';
                    tp.style.marginRight = '17%';
                }
                if (width <= 1024) {
                    tp.style.paddingTop = "28%";
                    tp.style.textAlign = 'center';
                    tp.style.marginRight = '17%';
                }
                if (width <= 480) {
                    tp.style.paddingTop = "40%";
                    tp.style.textAlign = 'center';
                    tp.style.marginRight = '13%';
                    op.style.height = '200%';
                }
                if (width <= 412) {
                    tp.style.paddingTop = "60%";
                    tp.style.textAlign = 'center';
                    tp.style.marginRight = '13%';
                    op.style.height = '200%';
                }
                if (width <= 360) {
                    tp.style.paddingTop = "70%";
                    tp.style.textAlign = 'center';
                    tp.style.marginRight = '13%';
                }
                if (width <= 240) {
                    tp.style.paddingTop = "70%";
                    tp.style.textAlign = 'center';
                    tp.style.marginRight = '13%';
                }

                var width = window.innerWidth;
                if (width <= 1366) {
                    cen.style.marginTop = "15%";
                }


                function prepareButton() {
                    document.getElementById('top').onclick = function() {
                        moveForward = true;
                    }
                    document.getElementById('op').onclick = function() {
                        document.getElementById('op').style.display = 'none';
                    }
                }
                //camera.position.z=-100;

                var light1 = new THREE.MeshBasicMaterial({
                    color: 0xffffff
                });

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
                        object.position.z = -600;
                        aa = scene.add(object);
                        if (aa) {
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
                        object.position.z = -594;
                        object.traverse(function(child) {

                            if (child instanceof THREE.Mesh) {

                                child.material = light1;
                                child.castShadow = true;

                            }

                        });
                        aaa = scene.add(object);
                        if (aaa) {
                            loads2 = true;
                        }
                    });
                });
                //
                pw = 1;
                setInterval(function() {
                    por = document.getElementById('por');
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

                renderer = new THREE.WebGLRenderer();
                renderer.setPixelRatio(window.devicePixelRatio);
                renderer.setSize(window.innerWidth, window.innerHeight);
                renderer.shadowMap.enabled = true;
                document.body.appendChild(renderer.domElement);
                controls = new THREE.DeviceOrientationControls(camera, true);
                camera.rotation.x = 1;
                window.addEventListener('resize', onWindowResize, false);
            }


            function onWindowResize() {
                camera.aspect = window.innerWidth / window.innerHeight;
                camera.updateProjectionMatrix();
                renderer.setSize(window.innerWidth, window.innerHeight);
            }

            function animate() {
                requestAnimationFrame(animate);
                controls.update();
                /* if (loads1) {
                     if (loads2) {
                         document.getElementById('lod').style.display = 'none';
                     }
                 }*/
                if (moveForward == true) {
                    var x = camera.rotation.x;
                    var y = camera.rotation.y;
                    if (y <= -0.10000000000000000 && y > -0.20000000000000000) {
                        camera.position.z += -20;
                        camera.position.x += 2;
                    }
                    if (y <= -0.20000000000000000 && y > -0.30000000000000000) {
                        camera.position.z += -18;
                        camera.position.x += 4;
                    }
                    if (y <= -0.30000000000000000 && y > -0.40000000000000000) {
                        camera.position.z += -16;
                        camera.position.x += 6;
                    }
                    if (y <= -0.40000000000000000 && y > -0.50000000000000000) {
                        camera.position.z += -14;
                        camera.position.x += 8;
                    }
                    if (y <= -0.50000000000000000 && y > -0.60000000000000000) {
                        camera.position.z += -12;
                        camera.position.x += 10;
                    }
                    if (y <= -0.60000000000000000 && y > -0.70000000000000000) {
                        camera.position.z += -10;
                        camera.position.x += 12;
                    }
                    if (y <= -0.70000000000000000 && y > -0.80000000000000000) {
                        camera.position.z += -8;
                        camera.position.x += 14;
                    }
                    if (y <= -0.80000000000000000 && y > -0.90000000000000000) {
                        camera.position.z += -6;
                        camera.position.x += 16;
                    }
                    if (y <= -0.90000000000000000 && y > -1.00000000000000000) {
                        camera.position.z += -4;
                        camera.position.x += 18;
                    }
                    if (y <= -1.00000000000000000 && y > -1.10000000000000000) {
                        camera.position.z += -10;
                        camera.position.x += 10;
                    }
                    if (y <= -1.10000000000000000 && y > -1.20000000000000000) {
                        camera.position.z += -8;
                        camera.position.x += 9;
                    }
                    if (y <= -1.20000000000000000 && y > -1.30000000000000000) {
                        camera.position.z += -7;
                        camera.position.x += 10;
                    }
                    if (y <= -1.30000000000000000 && y > -1.40000000000000000) {
                        camera.position.z += -5;
                        camera.position.x += 9;
                    }
                    if (y <= -1.40000000000000000 && y > -1.50000000000000000) {
                        camera.position.z += -3;
                        camera.position.x += 6;
                    }
                    if (y <= -1.50000000000000000 && y > -1.60000000000000000) {
                        camera.position.z += -1;
                        camera.position.x += 5;
                    }
                    if (y <= -1.60000000000000000 && y > -1.70000000000000000) {
                        camera.position.z += 0.5;
                        camera.position.x += 4;
                    }
                    if (y <= -1.70000000000000000 && y > -1.80000000000000000) {
                        camera.position.z += 0;
                        camera.position.x += 3;
                    }
                    if (y <= -1.80000000000000000 && y > -1.90000000000000000) {
                        camera.position.z += 1;
                        camera.position.x += 3;
                    }
                    if (y <= -1.90000000000000000 && y > -2.00000000000000000) {
                        camera.position.z += 2;
                        camera.position.x += 4;
                    }
                    if (y <= -2.00000000000000000 && y > -2.10000000000000000) {
                        camera.position.z += 4;
                        camera.position.x += 4;
                    }
                    if (y <= -2.10000000000000000 && y > -2.20000000000000000) {
                        camera.position.z += 6;
                        camera.position.x += 4;
                    }
                    if (y <= -2.20000000000000000 && y > -2.30000000000000000) {
                        camera.position.z += 8;
                        camera.position.x += 4;
                    }
                    if (y <= -2.30000000000000000 && y > -2.40000000000000000) {
                        camera.position.z += 10;
                        camera.position.x += 4;
                    }
                    if (y <= -2.40000000000000000 && y > -2.50000000000000000) {
                        camera.position.z += 12;
                        camera.position.x += 4;
                    }
                    if (y <= -2.50000000000000000 && y > -2.60000000000000000) {
                        camera.position.z += 12;
                        camera.position.x += 2;
                    }
                    if (y <= -2.60000000000000000 && y > -2.70000000000000000) {
                        camera.position.z += 12;
                        camera.position.x += 0;
                    }
                    if (y <= -2.70000000000000000 && y > -2.80000000000000000) {
                        camera.position.z += 12;
                        camera.position.x += -2;
                    }
                    if (y <= -2.80000000000000000 && y > -2.90000000000000000) {
                        camera.position.z += 12;
                        camera.position.x += -2;
                    }
                    if (y <= -2.90000000000000000 && y > -3.00000000000000000) {
                        camera.position.z += 12;
                        camera.position.x += -2;
                    }
                    if (y <= -3.00000000000000000 && y > -3.10000000000000000) {
                        camera.position.z += 12;
                        camera.position.x += -4;
                    }

                    /////////
                    ////////
                    if (y >= 0.10000000000000000 && y < 0.20000000000000000) {
                        camera.position.z += -20;
                        camera.position.x += -2;
                    }
                    if (y >= 0.20000000000000000 && y < 0.30000000000000000) {
                        camera.position.z += -18;
                        camera.position.x += -4;
                    }
                    if (y >= 0.30000000000000000 && y < 0.40000000000000000) {
                        camera.position.z += -16;
                        camera.position.x += -6;
                    }
                    if (y >= 0.40000000000000000 && y < 0.50000000000000000) {
                        camera.position.z += -14;
                        camera.position.x += -8;
                    }
                    if (y >= 0.50000000000000000 && y < 0.60000000000000000) {
                        camera.position.z += -12;
                        camera.position.x += -10;
                    }
                    if (y >= 0.60000000000000000 && y < 0.70000000000000000) {
                        camera.position.z += -10;
                        camera.position.x += -12;
                    }
                    if (y >= 0.70000000000000000 && y < 0.80000000000000000) {
                        camera.position.z += -8;
                        camera.position.x += -14;
                    }
                    if (y >= 0.80000000000000000 && y < 0.90000000000000000) {
                        camera.position.z += -6;
                        camera.position.x += -16;
                    }
                    if (y >= 0.90000000000000000 && y < 1.00000000000000000) {
                        camera.position.z += -4;
                        camera.position.x += -18;
                    }
                    if (y >= 1.00000000000000000 && y < 1.10000000000000000) {
                        camera.position.z += -10;
                        camera.position.x += -10;
                    }
                    if (y >= 1.10000000000000000 && y < 1.20000000000000000) {
                        camera.position.z += -8;
                        camera.position.x += -9;
                    }
                    if (y >= 1.20000000000000000 && y < 1.30000000000000000) {
                        camera.position.z += -7;
                        camera.position.x += -10;
                    }
                    if (y >= 1.30000000000000000 && y < 1.40000000000000000) {
                        camera.position.z += -5;
                        camera.position.x += -9;
                    }
                    if (y >= 1.40000000000000000 && y < 1.50000000000000000) {
                        camera.position.z += -3;
                        camera.position.x += -6;
                    }
                    if (y >= 1.50000000000000000 && y < 1.60000000000000000) {
                        camera.position.z += -1;
                        camera.position.x += -5;
                    }
                    if (y >= 1.60000000000000000 && y < 1.70000000000000000) {
                        camera.position.z += 0.5;
                        camera.position.x += -4;
                    }
                    if (y >= 1.70000000000000000 && y < 1.80000000000000000) {
                        camera.position.z += 0;
                        camera.position.x += -3;
                    }
                    if (y >= 1.80000000000000000 && y < 1.90000000000000000) {
                        camera.position.z += 1;
                        camera.position.x += -3;
                    }
                    if (y >= 1.90000000000000000 && y < 2.00000000000000000) {
                        camera.position.z += 2;
                        camera.position.x += -4;
                    }
                    if (y >= 2.00000000000000000 && y > 2.10000000000000000) {
                        camera.position.z += 4;
                        camera.position.x += -4;
                    }
                    if (y >= 2.10000000000000000 && y > 2.20000000000000000) {
                        camera.position.z += 6;
                        camera.position.x += -4;
                    }
                    if (y >= 2.20000000000000000 && y > 2.30000000000000000) {
                        camera.position.z += 8;
                        camera.position.x += -4;
                    }
                    if (y >= 2.30000000000000000 && y > 2.40000000000000000) {
                        camera.position.z += 10;
                        camera.position.x += -4;
                    }
                    if (y >= 2.40000000000000000 && y > 2.50000000000000000) {
                        camera.position.z += 12;
                        camera.position.x += -4;
                    }
                    if (y >= 2.50000000000000000 && y > 2.60000000000000000) {
                        camera.position.z += 12;
                        camera.position.x += -2;
                    }
                    if (y >= 2.60000000000000000 && y > 2.70000000000000000) {
                        camera.position.z += 12;
                        camera.position.x += 0;
                    }
                    if (y >= 2.70000000000000000 && y > 2.80000000000000000) {
                        camera.position.z += 12;
                        camera.position.x += 2;
                    }
                    if (y >= 2.80000000000000000 && y > 2.90000000000000000) {
                        camera.position.z += 12;
                        camera.position.x += 2;
                    }
                    if (y >= 2.90000000000000000 && y > 3.00000000000000000) {
                        camera.position.z += 12;
                        camera.position.x += 2;
                    }
                    if (y >= 3.00000000000000000 && y > 3.10000000000000000) {
                        camera.position.z += 12;
                        camera.position.x += 4;
                    }
                    moveForward = false;
                }

                if (loads1 == true) {
                    if (loads2 == true) {
                        pw = 100;
                        //por.style.width = "100%";
                        setTimeout(function() {
                            document.getElementById('lod').style.display = 'none';

                        }, 2000);
                    }
                }
                renderer.render(scene, camera);
            }
        } else {
            document.getElementById('os').style.display = 'block';

        }

    </script>
    <div id="os" style="width:100%;height:100%;display:none;">
        <p>your browser does not support please update your browser</p>
    </div>
</body>

</html>
