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
			$sql = "select kode_lampiran,nama_gruptindakan,nama_tindakan,kelas
					from m_tarif2012  where group_jasa like '01'
					union
					select kode_lampiran,nama_gruptindakan,nama_tindakan,kelas
					from m_tarif2012  where group_jasa like '02'
					union
					select kode_lampiran,nama_gruptindakan,nama_tindakan,kelas
					from m_tarif2012  where group_jasa like '03'
					union
					select kode_lampiran,nama_gruptindakan,nama_tindakan,kelas
					from m_tarif2012  where group_jasa like '04'
					union
					select kode_lampiran,nama_gruptindakan,nama_tindakan,kelas
					from m_tarif2012  where group_jasa like '05'
					union
					select kode_lampiran,nama_gruptindakan,nama_tindakan,kelas
					from m_tarif2012  where group_jasa like '06'
					union
					select kode_lampiran,nama_gruptindakan,nama_tindakan,kelas
					from m_tarif2012  where group_jasa like '07'
					union
					select kode_lampiran,nama_gruptindakan,nama_tindakan,kelas
					from m_tarif2012  where group_jasa like '08'
					union
					select kode_lampiran,nama_gruptindakan,nama_tindakan,kelas
					from m_tarif2012  where group_jasa like '09'
					ORDER BY kode_lampiran LIMIT $start, $limit ".$_SESSION['ordering'];
		}else{
			$sql = "select kode,nama
					from m_poly ORDER BY $order ".$_SESSION['ordering']." LIMIT $start, $limit ";
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
			  $sql = "select  kode_lampiran,nama_gruptindakan,nama_tindakan,kelas
					from m_tarif2012  where ".$filter." like '%".$content."%' "
					//." ORDER BY ".$order
					." ORDER BY kode_lampiran"
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
		
		$sql = "SELECT COUNT(*) AS numRows FROM  m_tarif2012 where kode_lampiran like  '01' or kode_lampiran like  '02'  or kode_lampiran like  '03'  
or kode_lampiran like  '04'  or kode_lampiran like  '05'  or kode_lampiran like  '06'  or kode_lampiran like  '07'  
or kode_lampiran like  '08'  or kode_lampiran like  '09'  ";
		
		if(($filter != null) and ($content != null)){
			$sql = 	"select COUNT(*) AS numRows from m_tarif2012 where  ".$filter." like '%$content%'";
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
		
		$sql = "select kode_lampiran,nama_gruptindakan,nama_tindakan,kelas from m_tarif2012 where kode_tindakan = '$id'";
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
		
		$sql= "INSERT INTO m_tarif2012 SET "
				."kode_lampiran='".$f['v_kode_lampiran']."', "
				."nama_gruptindakan='".$f['v_nama_gruptindakan']."', "
				."nama_tindakan='".$f['v_nama_tindakan']."', "
				."kelas='".$f['v_kelas']."' ";
				
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
		
		 $sql= "UPDATE m_tarif2012 SET "
 		        ."kode_lampiran='".$f['v_kode_lamppiran']."', "
 		        ."nama_gruptindakan='".$f['v_nama_gruptindakan']."' ,"				
				."nama_tindakan='".$f['v_nama_tindakan']."', "
				."kelas=".$f['v_kelas']." "
				."WHERE kode_tindakan='".$f['id']."'";
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
	
		$sql = "DELETE FROM m_tarif2012 WHERE kode_tindakan = '$id'";
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
	
	/*function formAdd(){
	$html = '
			<!-- No edit the next line -->
			<form method="post" name="f" id="f">
			
			<table border="1" width="100%" class="adminlist">
			<tr>
				<td nowrap align="left">Kode Lamp *</td>
				<td align="left"><input type="text" id="v_kode" name="v_kode" size="35"></td>
			</tr>
			<tr>
				<td nowrap align="left">Group Kode *</td>
				<td align="left"><input type="text" id="v_group_jasa" name="v_group_jasa" size="35"></td>
			</tr>
			
			<tr>
				<td nowrap align="left">Nama  *</td>
				<td align="left"><input type="text" id="v_nama" name="v_nama" size="35"></td>
			</tr>
			<tr>
				<td nowrap align="left">Tarif</td>
				<td align="left"><input type="text" id="v_tarif" name="v_tarif" size="35"></td>
			</tr>
			<tr>
				<td colspan="2" align="center"><button id="submitButton" onClick=\'xajax_save(xajax.getFormValues("f"));return false;\'>Simpan</button></td>
			</tr>
			</table>
			</form>
			* Tidak boleh kosong
			';
		
		return $html;
	}	*/
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
				<input type="hidden" id="id"  name="id" value="'.$person['kode_tindakan'].'">

				<table border="0" width="100%">
				<tr>
					<td nowrap align="left">Kode Lampiran*</td>
					<td align="left"><input type="text" id="v_kode_lampiran" name="v_kode_lampiran" size="25" readonly="true" value="'.$person['kode_lampiran'].'"></td>
				</tr>
				<tr>
					<td nowrap align="left">Nama Grup Tindakan *</td>
					<td align="left"><input type="text" id="v_nama_gruptindakan" name="v_nama_gruptindakan" size="25" readonly="true" value="'.$person['nama_gruptindakan'].'"></td>
				</tr>
				<tr>
					<td nowrap align="left">Nama Tindakan*</td>
					<td align="left"><input type="text" id="v_nama_tindakan" name="v_nama_tindakan" size="25" value="'.$person['nama_tindakan'].'"></td>
				</tr>
				<tr>
					<td nowrap align="left">Kelas</td>
					<td align="left"><input type="text" id="v_kelas" name="v_kelas" size="25" value="'.$person['kelas'].'"></td>
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
		if(empty($f['v_kode_lampiran'])) return "Kode Lampiran harus diisi";
		if(empty($f['v_nama_gruptindakan'])) return "Nama Grup Tindakan harus diisi";
		if(empty($f['v_nama_tindakan'])) return "Nama Tindakan harus diisi";

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
