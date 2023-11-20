<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Constelacion pequeña</title>
	<script src="https://aframe.io/releases/0.2.0/aframe.min.js"></script>
</head>

<body>
	<a-scene fog="type: linear; near: 10; far: 15; color: #000022;">
		<a-light type="point" color="#FFFFAA" position="0 1.8 0"></a-light>
		<a-sphere id="sol" radius="0.5" color="#FFFFAA" position="0 1.8 0" shader="flat"></a-sphere>
		<a-entity id="planeta1">
			<a-sphere radius="0.25" color="#D62D59" position="6 1.8 0"></a-sphere>
			<a-animation attribute="rotation" to="0 360 0" easing="linear" dur="3000" repeat="indefinite"></a-animation>
		</a-entity>
		<a-entity id="planeta2">
			<a-entity>
				<a-sphere radius="0.6" color="#AD9397" position="8 1.8 0"></a-sphere>
				<a-ring radius-inner="1" radius-outer="1.5" color="#AD9397" side="double" rotation="30 40 50"
					position="8 1.8 0">
					<a-animation attribute="rotation" from="30 40 50" to="30 400 50" easing="linear" dur="4000"
						repeat="indefinite"></a-animation>
				</a-ring>
			</a-entity>
			<a-animation attribute="rotation" to="0 360 0" easing="linear" dur="6000" repeat="indefinite"></a-animation>
		</a-entity>
		<a-entity id="planeta3">
			<a-sphere radius="0.5" color="#1D6B8D" position="10 1.8 0"></a-sphere>
			<a-animation attribute="rotation" to="0 360 0" easing="linear" dur="10000"
				repeat="indefinite"></a-animation>
		</a-entity>
		<a-entity id="planeta4">
			<a-sphere radius="0.8" color="#9D463C" position="12 1.8 0"></a-sphere>
			<a-animation attribute="rotation" to="0 360 0" easing="linear" dur="15000"
				repeat="indefinite"></a-animation>
		</a-entity>
		
		<a-entity id="planeta5">
			<a-cube radius="0.5" color="#B3B6B7" position="4 1.8 0"></a-cube>
				<a-animation attribute="rotation" to="0 360 0" easing="linear" dur="15000"
					repeat="indefinite"></a-animation>
		</a-entity>
		<a-sky color="black"></a-sky>

	</a-scene>

</body>

</html>