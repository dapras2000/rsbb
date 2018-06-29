<?
/* NOTE: For this example, the package PEAR is required, you can see http://pear.php.net for more information 
	In addition, in my example  the "include_pah" is modify including the PEAR full path.
	You can to modify the class methods, as you wish you.
	
	But anyway, the full package contain the DB.php and PEAR.php files obtained from PEAR package.
*/

// If you have the PEAR PHP package, you can comment the next line.
ini_set('include_path',dirname($_SERVER["SCRIPT_FILENAME"])."/include");

require_once 'common.php';
require_once 'DB.php';
require_once 'PEAR.php';
require_once "../../include/connect.php";

// Change for your DB parameters
define('SQLC', "mysql://".$username."@".$hostname."/".$database);

$GLOBALS['db'] =& DB::connect(SQLC);
$GLOBALS['db']->setFetchMode(DB_FETCHMODE_ASSOC);

/** \brief Person Class
*
* En esta clase se definen los metodos para el manejo de los datos de la base de datos concernientes a
* los personas.
*

*
* @author	Jesus Velazquez <jjvema@yahoo.com>
* @version	2.0
* @date		11 de Septiembre de 2006
*/

class Person extends PEAR
{
	
	/**
	*  Obtiene todos los registros de la tabla paginados.
	*
	*  	@param $start	(int)	Inicio del rango de la p&aacute;gina de datos en la consulta SQL.
	*	@param $limit	(int)	L&iacute;mite del rango de la p&aacute;gina de datos en la consultal SQL.
	*	@param $order 	(string) Campo por el cual se aplicar&aacute; el orden en la consulta SQL.
	*	@return $res 	(object) Objeto que contiene el arreglo del resultado de la consulta SQL.
	*/
	function &getAllRecords($start, $limit, $order = null){
		global $db;
	
		if($order == null){
			$sql = "select icd_code,jenis_penyakit,jenis_penyakit_local,dtd,sebabpenyakit
					from icd LIMIT $start, $limit ".$_SESSION['ordering'];
		}else{
			$sql = "select icd_code,jenis_penyakit,jenis_penyakit_local,dtd,sebabpenyakit
					from icd ORDER BY $order ".$_SESSION['ordering']." LIMIT $start, $limit ";
		}
		Person::events($sql);
		$res =& $db->query($sql);
		return $res;
	}
	
	/**
	*  Obtiene todos registros de la tabla paginados y aplicando un filtro
	*
	*  @param $start		(int) 		Es el inicio de la p&aacute;gina de datos en la consulta SQL
	*	@param $limit		(int) 		Es el limite de los datos p&aacute;ginados en la consultal SQL.
	*	@param $filter		(string)	Nombre del campo para aplicar el filtro en la consulta SQL
	*	@param $content 	(string)	Contenido a filtrar en la conslta SQL.
	*	@param $order		(string) 	Campo por el cual se aplicar&aacute; el orden en la consulta SQL.
	*	@return $res		(object)	Objeto que contiene el arreglo del resultado de la consulta SQL.
	*/

	function &getRecordsFiltered($start, $limit, $filter = null, $content = null, $order = null, $ordering = ""){
		global $db;
		
		if(($filter != null) and ($content != null)){
			  $sql = "select icd_code,jenis_penyakit,jenis_penyakit_local,dtd,sebabpenyakit
					from icd where ".$filter." like '%".$content."%' "
					." ORDER BY ".$order
					." ".$_SESSION['ordering']
					." LIMIT $start, $limit $ordering";			
		}

		Person::events($sql);
		$res =& $db->query($sql);
		return $res;
	}
	
	/**
	*  Devuelte el numero de registros de acuerdo a los par&aacute;metros del filtro
	*
	*	@param $filter	(string)	Nombre del campo para aplicar el filtro en la consulta SQL
	*	@param $order	(string)	Campo por el cual se aplicar&aacute; el orden en la consulta SQL.
	*	@return $row['numrows']	(int) 	N&uacute;mero de registros (l&iacute;neas)
	*/
	
	function &getNumRows($filter = null, $content = null){
		global $db;
		
		$sql = "SELECT COUNT(*) AS numRows FROM icd";
		
		if(($filter != null) and ($content != null)){
			$sql = 	"select COUNT(*) AS numRows from icd where  ".$filter." like '%$content%'";
		}
		Person::events($sql);
		$res =& $db->getOne($sql);
		return $res;		
	}
	
	/**
	*  Devuelte el registro de acuerdo al $id pasado.
	*
	*	@param $id	(int)	Identificador del registro para hacer la b&uacute;squeda en la consulta SQL.
	*	@return $row	(array)	Arreglo que contiene los datos del registro resultante de la consulta SQL.
	*/
	
	function &getRecordByID($id){
		global $db;
		
		$sql = "select icd_code,jenis_penyakit,jenis_penyakit_local,dtd,sebabpenyakit	from icd where icd_code = '$id'";
		Person::events($sql);
		$row =& $db->getRow($sql);
		return $row;
	}
	
	/**
	*  Inserta un nuevo registro en la tabla.
	*
	*	@param $f	(array)		Arreglo que contiene los datos del formulario pasado.
	*	@return $res	(object) 	Devuelve el objeto con la respuesta de la sentencia SQL ejecutada del INSERT.
	*/
	
	function insertNewRecord($f){
		global $db;
		
		$sql= "INSERT INTO icd SET "
				."icd_code='".$f['v_icd_code']."', "
				."jenis_penyakit='".$f['v_jenis_penyakit']."', "
				."jenis_penyakit_local='".$f['v_jenis_penyakit_local']."', "
				."dtd='".$f['v_dtd']."', "
				."sebabpenyakit='".$f['v_sebabpenyakit']."' "
				;
				
		Person::events($sql);
		$res =& $db->query($sql);
		return $res;
	}
	
	/**
	*  Actualiza un registro de la tabla.
	*
	*	@param $f	(array)		Arreglo que contiene los datos del formulario pasado.
	*	@return $res	(object)	Devuelve el objeto con la respuesta de la sentencia SQL ejecutada del UPDATE.
	*/
	
	function updateRecord($f){
		global $db;
		
		 $sql= "UPDATE icd SET "
				."jenis_penyakit='".$f['v_jenis_penyakit']."', "
				."jenis_penyakit_local='".$f['v_jenis_penyakit_local']."', "
				."dtd='".$f['v_dtd']."', "				
				."sebabpenyakit='".$f['v_sebabpenyakit']."' "
				."WHERE icd_code='".$f['id']."'";
		Person::events($sql);
		$res =& $db->query($sql);
		return $res;
	}
	
	/**
	*  Borra un registro de la tabla.
	*
	*	@param $id		(int)	Identificador del registro a ser borrado.
	*	@return $res	(object) Devuelve el objeto con la respuesta de la sentencia SQL ejecutada del DELETE.
	*/
	
	function deleteRecord($id){
		global $db;
	
		$sql = "DELETE FROM icd WHERE icd_code = '$id'";
		Person::events($sql);
		$res =& $db->query($sql);
		return $res;
	}

	function updateField($table,$field,$value,$id){

		global $db;
	
		$sql = "UPDATE $table SET $field='$value' WHERE id='$id'";
		Person::events($sql);
		$res =& $db->query($sql);
		return $res;
		
	}

	
	/**
	*  Imprime la forma para agregar un nuevo registro sobre el DIV identificado por "formDiv".
	*
	*	@param ninguno
	*	@return $html	(string) Devuelve una cadena de caracteres que contiene la forma para insertar 
	*							un nuevo registro.
	*/
	
	function formAdd(){
	$html = '
			<!-- No edit the next line -->
			<form method="post" name="f" id="f">
			
			<table border="1" width="100%" class="adminlist">
			<tr>
				<td nowrap align="left">Kode ICD*</td>
				<td align="left"><input type="text" id="v_icd_code" name="v_icd_code" size="35"></td>
			</tr>
			<tr>
				<td nowrap align="left">Jenis Penyakit (Latin)*</td>
				<td align="left"><input type="text" id="v_jenis_penyakit" name="v_jenis_penyakit" size="35"></td>
			</tr>
			<tr>
				<td nowrap align="left">Jenis Penyakit (Lokal)</td>
				<td align="left"><input type="text" id="v_jenis_penyakit_local" name="v_jenis_penyakit_local" size="35"></td>
			</tr>
			<tr>
				<td nowrap align="left">DTD</td>
				<td align="left"><input type="text" id="v_dtd" name="v_dtd" size="35"></td>
			</tr>
			<tr>
				<td nowrap align="left">Sebab Penyakit</td>
				<td align="left"><input type="text" id="v_sebabpenyakit" name="v_sebabpenyakit" size="35"></td>
			</tr>
			
			<tr>
				<td colspan="2" align="center"><button id="submitButton" onClick=\'xajax_save(xajax.getFormValues("f"));return false;\'>Simpan</button></td>
			</tr>
			</table>
			</form>
			* Tidak boleh kosong
			';
		
		return $html;
	}	
	/**
	*  Imprime la forma para editar un nuevo registro sobre el DIV identificado por "formDiv".
	*
	*	@param $id		(int)		Identificador del registro a ser editado.
	*	@return $html	(string) Devuelve una cadena de caracteres que contiene la forma con los datos 
	*									a extraidos de la base de datos para ser editados 
	*/
	
	function formEdit($id){		

		$person =&Person::getRecordByID($id);
		
		$html = '
				<form method="post" name="f" id="f">

				<!-- No edit the next line -->
				<input type="hidden" id="id"  name="id" value="'.$person['icd_code'].'">

				<table border="0" width="100%">
				<tr>
					<td nowrap align="left">Kode ICD*</td>
					<td align="left"><input type="text" id="v_icd_code" name="v_icd_code" size="25" value="'.$person['icd_code'].'"></td>
				</tr>
				<tr>
					<td nowrap align="left">Jenis Penyakit (Latin)*</td>
					<td align="left"><input type="text" id="v_jenis_penyakit" name="v_jenis_penyakit" size="25" value="'.$person['jenis_penyakit'].'"></td>
				</tr>
				<tr>
					<td nowrap align="left">Jenis Penyakit (Lokal)</td>
					<td align="left"><input type="text" id="v_jenis_penyakit_local" name="v_jenis_penyakit_local" size="25" value="'.$person['jenis_penyakit_local'].'"></td>
				</tr>
				<tr>
					<td nowrap align="left">DTD</td>
					<td align="left"><input type="text" id="v_dtd" name="v_dtd" size="25" value="'.$person['dtd'].'"></td>
				</tr>
				<tr>
					<td nowrap align="left">Sebab Penyakit</td>
					<td align="left"><input type="text" id="v_sebabpenyakit" name="v_sebabpenyakit" size="25" value="'.$person['sebabpenyakit'].'"></td>
				</tr>												
				<tr>
					<td colspan="2" align="center"><button id="submitButton" onClick=\'xajax_update(xajax.getFormValues("f"));return false;\'>Continue</button></td>
				</tr>
				</table>
				</form>
				* Tidak boleh kosong
				';
		
		return $html;
	}
	
	/**
	*  Muestra todos los datos de un registro sobre el DIV identificado por "formDiv".
	*
	*	@param $id		(int)		Identificador del registro a ser mostrado.
	*	@return $html	(string) Devuelve una cadena de caracteres que contiene una tabla con los datos 
	*									a extraidos de la base de datos para ser mostrados 
	*/
	function showRecord($id){
			$person =& person::getRecordByID($id);
		$html = '
				<table border="0" width="100%" cellpading="1">
				<tr>
					<td nowrap align="left" width="10%">Last Name:</td>
					<td align="left">'.$person['lastname'].'</td>
				</tr>
				<tr>
					<td nowrap align="left">First Name:</td>
					<td align="left">'.$person['firstname'].'</td>
				</tr>
				<tr>
					<td nowrap align="left">E-Mail:</td>
					<td align="left">'.$person['email'].'</td>
				</tr>
				<tr>
					<td nowrap align="left">Origin:</td>
					<td align="left">'.$person['origin'].'</td>
				</tr>
				</table>';

		return $html;

	}
	
	/**
	*  Verifica si los datos de la forma enviados son correctos de acuerdo a cada validaci&oacute;n en particular.
	*
	*  En este metodo es necesario que sea revisado para hacer las validaciones correspondientes a cada una de las
	*  entradas del formulario.
	*
	*	@param $f	(array)		Arreglo que contiene los datos del formularios procesado.
	*	@param $new	(boolean)	Si recibe el valor de 1 significa que la acci&oacute;n es insertar un nuevo registro,
	* 									de lo	contrario significa que esta editando el registro, por tanto no revisa si la
	*									clave es	repetida.
	*	@return $msg	(string)	Devuelve 0 si todos los datos estan correctos, de lo contrario devuelve el mensaje
	*									correspondiente a la validaci&oacute;n.
	*/
	function checkAllData($f,$new = 0){
		if(empty($f['v_icd_code'])) return "Kode ICD harus diisi";
		if(empty($f['v_jenis_penyakit'])) return "Jenis Penyakit (Latin) harus diisi";

	 	return 0;
	}


	function events($event = null){
		//global $db;
		global $login;
		
		if(LOG_ENABLED){
			$now = date("Y-M-d H:i:s");
   		
			$fd = fopen (FILE_LOG,'a');
			$log = $now." ".$_SERVER["REMOTE_ADDR"] ." - $event \n";
   		fwrite($fd,$log);
   		fclose($fd);
		}
	}
}
?>
