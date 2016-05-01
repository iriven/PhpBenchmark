# IrivenPhpBenchmark

-
# Initialisation
	include '../src/IrivenPhpBenchmark.php';
	$benchmark= new IrivenPhpBenchmark();
-
# ajout d'un marquer

	$benchmark->addMarker('pointA');
	$benchmark->addMarker('pointB');
	$benchmark->addMarker('pointC');
-
#temps de chargement entre deux marqueurs

	echo $benchmark->getElapsedTime('pointA', 'pointB');
	echo $benchmark->getElapsedTime('pointB', 'pointC');
	echo $benchmark->getElapsedTime('pointA', 'pointC');
-
# temps de chargement total de la page 

	echo $benchmark->getElapsedTime();
-
# lister les differents points de marquage 

- **[HTML FORMAT] :** echo $benchmark->getMarks();
- **[ARRAY FORMAT] :** print_r($benchmark->getMarks(false));
