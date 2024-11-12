<?php
// Initialize the session
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
include 'config.php';   


?>
<!doctype html>
<html>

<head>
    <title>How to add Custom Filter and Multiple Export Options in DataTable - AJAX and PHP</title>
    <!-- Datatable CSS -->
    <link href='DataTables/datatables.min.css' rel='stylesheet' type='text/css'>
    <link rel='stylesheet' href='https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <!-- jQuery Library -->
    <script src="jquery-3.3.1.min.js"></script>

    <!-- Datatable JS -->
    <script src="DataTables/datatables.min.js"></script>
    <script src='https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js'></script>
    <script src='https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js'></script>
    <script src='https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js'></script>
    <script src='https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js'></script>
    <script src='https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js'></script>
    <script src='https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js'></script>
   
</head>

<body >

    <div class="container">
        <h4>How to add Custom Filter and Multiple Export Options in DataTable - AJAX and PHP</h4>
        <!-- Custom Filter -->
        <table Style="width:50%; padding:10px;">
            <tr> <th> Product Name</th><th>Financial Year</th><th>Financial Quarter</th></tr>
			<tr>
                <td>
                    <input type='text' id="searchByName"  class="form-control " placeholder='Enter name'></td><td>
                    <select id="searchBy_processproject" class="form-control " required="">
                        <option value="">All</option>
                        <option value="Proyecto1"> Proyecto1 </option>
                        <option value="Proyecto2"> Proyecto2 </option>
                        <option value="Proyecto3"> Proyecto3 </option>
                        <option value="Proyecto4"> Proyecto4 </option>
                    </select>
                </td>
                <td>
                    <select id='searchBy_team' class="form-control ">

                        <option value="">All</option>
                        <option value="Equipo1"> Equipo1 </option>
                        <option value="Equipo2"> Equipo2 </option>
                        <option value="Equipo3"> Equipo3 </option>
                        <option value="Equipo4"> Equipo4 </option>                       
                    </select>

                </td>
            </tr>
        </table>
		<br/>
        <div id="buttons"></div>

        <!-- Table -->
        <table id='product' class='display dataTable hoverable  table-striped'>
            <thead>
                <tr>
                    <th>ID del Riesgo</th>
                    <th>Fecha</th>
                    <th>Producto</th>
                    <th>Proceso/Proyecto</th>
                    <th>Modo de fallo</th>
                    <th>Efecto de fallo</th>
                    <th>SEV Inherente</th>
                    <th>SEV</th>
                    <th>Causas del modo de fallo</th>
                    <th>Stakeholders causantes del riesgo</th>
                    <th>OCC Inherente</th>
                    <th>OCC</th>
                    <th>Controles actuales</th>
                    <th>Control preventivo</th>
                    <th>Control detectivo</th>
                    <th>Control correctivo</th>
                    <th>DET</th>
                    <th>Bottleneck</th>
                    <th>RPN Inherente</th>
                    <th>RPN</th>
                    <th>Nivel de riesgo</th>
                    <th>Stakeholders afectados por la materialización del riesgo</th>
                    <th>¿Aceptable?</th>
                    <th>Acciones</th>
                </tr>
            </thead>

        </table>
    </div>

    <!-- Script -->
    <script>
        $(document).ready(function () {
            var dataTable = $('#product').DataTable({
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                "lengthMenu": [[10, 25, 50, 100,500,1000], [10, 25, 50,100,500,1000]],
                'dom': 'Blfrtip',
        'buttons': [

									{
										"extend": 'pdf',
										"text": 'Export PDF',
										"className": 'btn btn-primary btn-sm ml-1'
									},
									{
										"extend": 'csv',
										"text": 'Export CSV',
										"className": 'btn btn-primary btn-sm ml-1'
									},


									{
										'extend': 'excel',
										"text": 'Export  Excel',
										'className': 'btn btn-primary btn-sm ml-1'
									}, {
										'extend': 'print',
										"text": 'Print',
										'className': 'btn btn-primary btn-sm ml-1'
									}

								], "language": 
{          
"processing": "<img style='width:300px; height:200px;' src='load.gif' />",
},
                
                'ajax': {
                    'url': 'products.php',
                    'data': function (data) {
                        
                        var searchBy_team = $('#searchBy_team').val();
                        var searchBy_processproject = $('#searchBy_processproject').val();
						var searchByName=$('#searchByName').val();

                       
                        data.searchBy_team = searchBy_team;
                        data.searchBy_processproject = searchBy_processproject;
						data.searchByName = searchByName;
                    }
                },
                'columns': [
                    { data: 'risk_id',
                        "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                            $(nTd).html("<a href='edit-risk.php?i="+oData.risk_id+"'>"+oData.risk_id+"</a>");
			}
        	    },
                    { data: 'date' },
                    { data: 'product' },
                    { data: 'process_project' },
                    { data: 'failure_mode' },
                    { data: 'failure_effect' }, 
                    { data: 'SEV_inherent' },
                    { data: 'SEV' },
                    { data: 'failure_mode_cause' },
	            { data: 'stakeholders_cause' },
        	    { data: 'OCC_inherent' },
        	    { data: 'OCC' },
        	    { data: 'current_control' },
        	    { data: 'preventive_control' },
        	    { data: 'detective_control' },
        	    { data: 'corrective_control' },
        	    { data: 'DET' },
        	    { data: 'bottleneck' },
        	    { data: 'RPN_inherent' },
        	    { data: 'RPN' },
        	    { data: 'risk_level' },
        	    { data: 'stakeholders_affected' },
        	    { data: 'acceptable' },
        	    { data: 'actions' },
                ]
                
            });

           $('#searchByName').keyup(function () {
                dataTable.draw();
            }); 
            $('#searchBy_processproject').change(function () {
                dataTable.draw();
            });
            $('#searchBy_team').change(function () {
                dataTable.draw();
            });
        });
       
    </script>
    <p>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
	<a href="add-risk.php" class="btn btn-warning">Añadir riesgo nuevo</a>
    </p>
    
</body>

</html>
