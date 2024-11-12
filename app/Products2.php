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
                    <select id="searchBy_financial_quarter" class="form-control " required="">
                        <option value="">All</option>
                        <option value="1"> Q1 - April - June </option>
                        <option value="2"> Q2 - July - September </option>
                        <option value="3"> Q3 - October - December </option>
                        <option value="4"> Q4 - January - March </option>
                    </select>
                </td>
                <td>
                    <select id='searchByfinancial_year' class="form-control ">

                        <option value="">All</option>
                        <option value="2008-2009"> 2008-2009 </option>
                        <option value="2009-2010"> 2009-2010 </option>
                        <option value="2010-2011"> 2010-2011 </option>
                        <option value="2011-2012"> 2011-2012 </option>
                        <option value="2012-2013"> 2012-2013 </option>
                        <option value="2013-2014"> 2013-2014 </option>
                        <option value="2014-2015"> 2014-2015 </option>
                        <option value="2015-2016"> 2015-2016 </option>
                       
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
                    <th>User ID</th>
                    <th>Financial Year</th>
                    <th>Financial Quarter</th>
                    <th>Product Name</th>
                    <th>Production Unit</th>
                    <th>Total Production</th>
                    <th>Uploded On</th>
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
                        
                        var searchByfinancial_year = $('#searchByfinancial_year').val();
                        var searchBy_financial_quarter = $('#searchBy_financial_quarter').val(); 
						var searchByName=$('#searchByName').val();

                       
                        data.searchByfinancial_year = searchByfinancial_year;
                        data.searchBy_financial_quarter = searchBy_financial_quarter;
						data.searchByName = searchByName;
                    }
                },
                'columns': [
                    { data: 'user_id' },
                    { data: 'financial_year' },
                    { data: 'financial_quarter' },
                    { data: 'product_name', 
                        "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                            $(nTd).html("<a href='update-risk.php?i="+oData.product_name+"'>"+oData.product_name+"</a>");
                        }
                    },
                    { data: 'production_unit' },
                    { data: 'total_production' },
                    { data: 'uploded_on' },
                ]
                
            });

           $('#searchByName').keyup(function () {
                dataTable.draw();
            }); 
            $('#searchBy_financial_quarter').change(function () {
                dataTable.draw();
            });
            $('#searchByfinancial_year').change(function () {
                dataTable.draw();
            });
        });
       
    </script>
    <p>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
    </p>
    
</body>

</html>