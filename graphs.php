<!DOCTYPE html>
<html lang="en">
<head>
	<title>Guarderías Dabaleg</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
	<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
	<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
	<script src="https://cdn.amcharts.com/lib/5/locales/de_DE.js"></script>
	<script src="https://cdn.amcharts.com/lib/5/geodata/germanyLow.js"></script>
	<script src="https://cdn.amcharts.com/lib/5/fonts/notosans-sc.js"></script>
</head>
<body>
	<style>
		#chartdiv_ref, #chartdiv_antig {
			width: 100%;
			height: 500px;
			max-width: 100%
		}
	</style>
	<select name="selected_pivot" onchange="selected_pivot(this.value)">
		<option value="ninguno">Ninguno</option>
		<option value="antiguedad">Antigüedad</option>
		<option value="referencia">Referencia</option>
		<option value="suc_Favorita">Sucursal Favorita</option>
		<option value="frecuencia">Frecuencia</option>
		<option value="juego_favorito">Juego Favorito</option>
		<option value="satisfacción">Satisfacción</option>
		<option value="sexo">Sexo</option>
		<option value="ocupación">Ocupación</option>
	</select>



	<div id="chartdiv_ref"></div>
	<div id="chartdiv_antig"></div>

	<script type="text/javascript">
		var data;
		var root;
		var series;
		var chart;
		function selected_pivot(pivot){
			$.ajax({
				type: "GET",
				url: "Obtaingraph_referencia.php?selected_pivot="+pivot,   
				dataType: 'JSON',            
				success: function(data){
					//data = JSON.stringify(data);
					//var obj = JSON.parse(data);
					console.log(data);

					if (typeof root_ref !== 'undefined') {
						root_ref.container.children.clear();
						chart.series.removeIndex(0);
					}else {
						root_ref = am5.Root.new("chartdiv_ref");
					}



					root_ref.setThemes([
						am5themes_Animated.new(root_ref)
						]);
					chart = root_ref.container.children.push(am5xy.XYChart.new(root_ref, {
						panX: false,
						panY: false,
						wheelX: "panX",
						wheelY: "zoomX",
						layout: root_ref.verticalLayout
					}));



					var legend = chart.children.push(
						am5.Legend.new(root_ref, {
							centerX: am5.p50,
							x: am5.p50
						})
						);



					var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root_ref, {
						categoryField: "referencia",
						renderer: am5xy.AxisRendererX.new(root_ref, {
							cellStartLocation: 0.1,
							cellEndLocation: 0.9
						}),
						tooltip: am5.Tooltip.new(root_ref, {})
					}));


					xAxis.data.setAll(data);

					var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root_ref, {
						renderer: am5xy.AxisRendererY.new(root_ref, {})
					}));



					function makeSeries(name, fieldName) {
						series = chart.series.push(am5xy.ColumnSeries.new(root_ref, {
							name: name,
							xAxis: xAxis,
							yAxis: yAxis,
							valueYField: fieldName,
							categoryXField: "referencia"
						}));

						series.columns.template.setAll({
							tooltipText: "{name}, {categoryX}:{valueY}",
							width: am5.percent(90),
							tooltipY: 0
						});
						series.data.setAll(data);


						series.appear();

						series.bullets.push(function () {
							return am5.Bullet.new(root_ref, {
								locationY: 0,
								sprite: am5.Label.new(root_ref, {
									text: "{valueY}",
									fill: root_ref.interfaceColors.get("alternativeText"),
									centerY: 0,
									centerX: am5.p50,
									populateText: true
								})
							});
						});

						legend.data.push(series);
					}



					chart.appear(1000, 100);


					var cantcol=Object.keys(data[0]).length;
					console.log(pivot);
					if (pivot=="ninguno"){
						makeSeries("Cantidad_ref","Cantidad_ref");
					}else{
						for (var i=1; i<=(cantcol-2); i++ ){

							makeSeries(Object.keys(data[0])[i], Object.keys(data[0])[i]);
						}
					}
				}
			}


			)
			
			$.ajax({
				type: "GET",
				url: "Obtaingraph_antiguedad.php?selected_pivot="+pivot,   
				dataType: 'JSON',            
				success: function(data){

					//data = JSON.stringify(data);
					//var obj = JSON.parse(data);
					console.log(data);

					if (typeof root_antig !== 'undefined') {
						root_antig.container.children.clear();
						chart.series.removeIndex(0);
					}else {
						root_antig = am5.Root.new("chartdiv_antig");
					}



					root_antig.setThemes([
						am5themes_Animated.new(root_antig)
						]);
					chart = root_antig.container.children.push(am5xy.XYChart.new(root_antig, {
						panX: false,
						panY: false,
						wheelX: "panX",
						wheelY: "zoomX",
						layout: root_antig.verticalLayout
					}));



					var legend = chart.children.push(
						am5.Legend.new(root_antig, {
							centerX: am5.p50,
							x: am5.p50
						})
						);



					var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root_antig, {
						categoryField: "antiguedad",
						renderer: am5xy.AxisRendererX.new(root_antig, {
							cellStartLocation: 0.1,
							cellEndLocation: 0.9
						}),
						tooltip: am5.Tooltip.new(root_antig, {})
					}));


					xAxis.data.setAll(data);

					var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root_antig, {
						renderer: am5xy.AxisRendererY.new(root_antig, {})
					}));



					function makeSeries(name, fieldName) {
						series = chart.series.push(am5xy.ColumnSeries.new(root_antig, {
							name: name,
							xAxis: xAxis,
							yAxis: yAxis,
							valueYField: fieldName,
							categoryXField: "antiguedad"
						}));

						series.columns.template.setAll({
							tooltipText: "{name}, {categoryX}:{valueY}",
							width: am5.percent(90),
							tooltipY: 0
						});
						series.data.setAll(data);


						series.appear();

						series.bullets.push(function () {
							return am5.Bullet.new(root_antig, {
								locationY: 0,
								sprite: am5.Label.new(root_antig, {
									text: "{valueY}",
									fill: root_antig.interfaceColors.get("alternativeText"),
									centerY: 0,
									centerX: am5.p50,
									populateText: true
								})
							});
						});

						legend.data.push(series);
					}



					chart.appear(1000, 100);


					var cantcol=Object.keys(data[0]).length;
					console.log(pivot);
					if (pivot=="ninguno"){
						makeSeries("Cantidad_antig","Cantidad_antig");
					}
					else{
						for (var i=1; i<=(cantcol-2); i++ ){

							makeSeries(Object.keys(data[0])[i], Object.keys(data[0])[i]);
						}
					}
				}
			}


			)		
		}



	</script>


</body>


</html>