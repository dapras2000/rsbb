<?
	session_start();
	
	require_once ('common.php');
	require_once ('person.inc.php');
	require_once ('include/xajaxGrid.inc.php');

function createGrid($start = 0, $limit = 1, $filter = null, $content = null, $order = null, $divName = "grid", $ordering = ""){

	$_SESSION['ordering'] = $ordering;
	
	if(($filter == null) or ($content == null)){
		
		$numRows =& Person::getNumRows();
		$arreglo =& Person::getAllRecords($start,$limit,$order);
	}else{
		
		$numRows =& Person::getNumRows($filter, $content);
		$arreglo =& Person::getRecordsFiltered($start, $limit, $filter, $content, $order);	
	}

	// Editable zone

	// Databse Table: fields
	$fields = array();
	$fields[] = 'icd_code';
	$fields[] = 'jenis_penyakit';
	$fields[] = 'jenis_penyakit_local';
	$fields[] = 'dtd';
	$fields[] = 'sebabpenyakit';
	//$fields[] = 'kdpoly';

	// HTML table: Headers showed
	$headers = array();
	$headers[] = "KODE ICD";
	$headers[] = "JENIS PENYAKIT (LATIN)";
	$headers[] = "JENIS PENYAKIT (LOCAL)";
	$headers[] = "DTD";
	$headers[] = "SEBAB PENYAKIT LOCAL";
	//$headers[] = "Origin";

	// HTML table: hearders attributes
	$attribsHeader = array();
	$attribsHeader[] = 'width="10%"';
	$attribsHeader[] = 'width="40%"';
	$attribsHeader[] = 'width="20%"';
	$attribsHeader[] = 'width="10%"';	
	$attribsHeader[] = 'width="30%"';

	// HTML Table: columns attributes
	$attribsCols = array();
	$attribsCols[] = 'style="text-align: left"';
	$attribsCols[] = 'style="text-align: left"';
	$attribsCols[] = 'style="text-align: left"';
	$attribsCols[] = 'style="text-align: left"';	
	$attribsCols[] = 'nowrap style="text-align: left"';
	
	// HTML Table: If you want ascendent and descendent ordering, set the Header Events.
	$eventHeader = array();
	$eventHeader[]= 'onClick=\'xajax_showGrid(0,'.$limit.',"'.$filter.'","'.$content.'","icd_code","'.$divName.'","ORDERING");return false;\'';
	$eventHeader[]= 'onClick=\'xajax_showGrid(0,'.$limit.',"'.$filter.'","'.$content.'","jenis_penyakit","'.$divName.'","ORDERING");return false;\'';
	$eventHeader[]= 'onClick=\'xajax_showGrid(0,'.$limit.',"'.$filter.'","'.$content.'","jenis_penyakit_local","'.$divName.'","ORDERING");return false;\'';
	$eventHeader[]= 'onClick=\'xajax_showGrid(0,'.$limit.',"'.$filter.'","'.$content.'","dtd","'.$divName.'","ORDERING");return false;\'';
    $eventHeader[]= 'onClick=\'xajax_showGrid(0,'.$limit.',"'.$filter.'","'.$content.'","sebabpenyakit","'.$divName.'","ORDERING");return false;\'';
		

	// Select Box: fields table.
	$fieldsFromSearch = array();
	$fieldsFromSearch[] = 'icd_code';
	$fieldsFromSearch[] = 'jenis_penyakit';
	$fieldsFromSearch[] = 'jenis_penyakit_local';
	$fieldsFromSearch[] = 'dtd';
	$fieldsFromSearch[] = 'sebabpenyakit';

	// Selecct Box: Labels showed on search select box.
	$fieldsFromSearchShowAs = array();
	$fieldsFromSearchShowAs[] = "KODE ICD";
	$fieldsFromSearchShowAs[] = "JENIS PENYAKIT (LATIN)";
	$fieldsFromSearchShowAs[] = "JENIS PENYAKIT (LOKAL)";
	$fieldsFromSearchShowAs[] = "DTD";
    $fieldsFromSearchShowAs[] = "SEBAB PENYAKIT";
	
	// Create object whit 5 cols and all data arrays set before.
	$table = new ScrollTable(6,$start,$limit,$filter,$numRows,$content,$order);
	$table->setHeader('title',$headers,$attribsHeader,$eventHeader);
	$table->setAttribsCols($attribsCols);
	$table->addRowSearch("icd",$fieldsFromSearch,$fieldsFromSearchShowAs);
	
	while ($arreglo->fetchInto($row)) {
	// Change here by the name of fields of its database table
		$rowc = array();
		$rowc[] = $row['icd_code'];
		$rowc[] = $row['icd_code'];
		$rowc[] = $row['jenis_penyakit'];
		$rowc[] = $row['jenis_penyakit_local'];
		$rowc[] = $row['dtd'];
		$rowc[] = $row['sebabpenyakit'];
		$table->addRow("icd",$rowc,1,1,$divName,$fields);
 	}
 	
 	// End Editable Zone
 	
 	$html = $table->render();
 	
 	return $html;
}

function showGrid($start = 0, $limit = 1,$filter = null, $content = null, $order = null, $divName = "grid", $ordering = ""){
	
	$html = createGrid($start, $limit,$filter, $content, $order, $divName, $ordering);
	$objResponse = new xajaxResponse();
	$objResponse->addClear("msgZone", "innerHTML");
	$objResponse->addAssign($divName, "innerHTML", $html);
	
	return $objResponse->getXML();
}

function add($table_DB){
   // Edit zone
	$html = Table::Top("Adding Record");  // <-- Set the title for your form.
   $html .= Person::formAdd();  // <-- Change by your method
   // End edit zone
   $html .= Table::Footer();
	$objResponse = new xajaxResponse();
	$objResponse->addAssign("formDiv", "style.visibility", "visible");
	$objResponse->addAssign("formDiv", "innerHTML", $html);
	
	return $objResponse->getXML();
}

function editField($table, $field, $cell, $value, $id){
	$objResponse = new xajaxResponse();
	
	$html =' <input type="text" id="input'.$cell.'" value="'.$value.'" size="'.(strlen($value)+5).'"'
			.' onBlur="xajax_updateField(\''.$table.'\',\''.$field.'\',\''.$cell.'\',document.getElementById(\'input'.$cell.'\').value,\''.$id.'\');"'
			.' style="background-color: #CCCCCC; border: 1px solid #666666;">';
	$objResponse->addAssign($cell, "innerHTML", $html);
	$objResponse->addScript("document.getElementById('input$cell').focus();");
	return $objResponse->getXML();
}


function edit($id = null, $table_DB = null){
	// Edit zone
	$html = Table::Top("Editing Record"); 	// <-- Set the title for your form.
   $html .= Person::formEdit($id); 			// <-- Change by your method
   $html .= Table::Footer();
   	// End edit zone
	$objResponse = new xajaxResponse();
	$objResponse->addAssign("formDiv", "style.visibility", "visible");
	$objResponse->addAssign("formDiv", "innerHTML", $html);
	return $objResponse->getXML();
}

function delete($id = null, $table_DB = null){
	Person::deleteRecord($id); 				// <-- Change by your method
	$html = createGrid(0,ROWSXPAGE);
	$objResponse = new xajaxResponse();
	$objResponse->addAssign("grid", "innerHTML", $html);
	$objResponse->addAssign("msgZone", "innerHTML", "Record Deleted"); // <-- Change by your leyend
	return $objResponse->getXML();
}

function show($id = null){
	if($id != null){
	$html = Table::Top("Show Record"); 			// <-- Set the title for your form.
   $html .= Person::showRecord($id); 		// <-- Change by your method
   $html .= Table::Footer();
   $objResponse = new xajaxResponse();
   $objResponse->addAssign("formDiv", "style.visibility", "visible");
	$objResponse->addAssign("formDiv", "innerHTML", $html);	
	return $objResponse->getXML();
	}
}

function save($f){
	$objResponse = new xajaxResponse();
	$message = Person::checkAllData($f,1); // <-- Change by your method
	if(!$message){
		$respOk = Person::insertNewRecord($f); // <-- Change by your method
		if($respOk){
			$html = createGrid(0,ROWSXPAGE);
			$objResponse->addAssign("grid", "innerHTML", $html);
			$objResponse->addAssign("msgZone", "innerHTML", "A record has been added");
			$objResponse->addAssign("formDiv", "style.visibility", "hidden");
		}else{
			$objResponse->addAssign("msgZone", "innerHTML", "The record could not be added");
		}
	}else{
		$objResponse->addAlert($message);
	}
	return $objResponse->getXML();
	
}

function update($f){
	$objResponse = new xajaxResponse();
	$message = Person::checkAllData($f); // <-- Change by your method
	if(!$message){
		$respOk = Person::updateRecord($f); // <-- Change by your method
		if($respOk){
			$html = createGrid(0,ROWSXPAGE);
			$objResponse->addAssign("grid", "innerHTML", $html);
			$objResponse->addAssign("msgZone", "innerHTML", "A record has been updated");
			$objResponse->addAssign("formDiv", "style.visibility", "hidden");
		}else{
			$objResponse->addAssign("msgZone", "innerHTML", "The record could not be updated");
		}
	}else{
		$objResponse->addAlert($message);
	}
	
	return $objResponse->getXML();
}

function updateField($table, $field, $cell, $value, $id){
	$objResponse = new xajaxResponse();
	$objResponse->addAssign($cell, "innerHTML", $value);
	Person::updateField($table,$field,$value,$id);
	return $objResponse->getXML();
}


$xajax->processRequests();

?>
