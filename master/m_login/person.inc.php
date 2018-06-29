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
			$sql = "select nip,pwd,ses_reg,roles,kdunit,departemen
					from m_login LIMIT $start, $limit ".$_SESSION['ordering'];
		}else{
			$sql = "select nip,pwd,ses_reg,roles,kdunit,departemen
					from m_login ORDER BY $order ".$_SESSION['ordering']." LIMIT $start, $limit ";
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
			  $sql = "select nip,pwd,ses_reg,roles,kdunit,departemen
					from m_login where ".$filter." like '%".$content."%' "
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
		
		$sql = "SELECT COUNT(*) AS numRows FROM m_login";
		
		if(($filter != null) and ($content != null)){
			$sql = 	"select COUNT(*) AS numRows from m_login where  ".$filter." like '%$content%'";
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
		
		$sql = "select nip,pwd,ses_reg,roles,kdunit,departemen from m_login where nip = '$id'";
		Person::events($sql);
		$row =& $db->getRow($sql);
		return $row;
	}

	function &getDepartemenByID($id){
		global $db;

		$sql = "select distinct kode_unit from m_unit where nama_unit = '".$id."'";
		Person::events($sql);
		$row =& $db->getOne($sql);
		return $row;
	}

	function &getRoles(){
		global $db;
		
		$sql = "select distinct roles,case roles when 4 then 'RAWAT JALAN' else departemen end as departemen from m_login  order by departemen";
		Person::events($sql);
		$res =& $db->query($sql);
		return $res;
	}
	
	function &getUnit(){
		global $db;
		
		$sql = "select nama_unit from m_unit order by kode_unit";
		Person::events($sql);
		$res =& $db->query($sql);
		return $res;
	}
	
		
	/**
	*  Inserta un nuevo registro en la tabla.
	*
	*	@param $f	(array)		Arreglo que contiene los datos del formulario pasado.
	*	@return $res	(object) 	Devuelve el objeto con la respuesta de la sentencia SQL ejecutada del INSERT.
	*/
	
	function insertNewRecord($f){
		global $db;
		$a=Person::getDepartemenByID($f['v_departemen']);
		$sql= "INSERT INTO m_login SET "
				."nip='".$f['v_nip']."', "
				."pwd='".$f['v_pwd']."', "
				."ses_reg=md5('".$f['v_pwd']."'), "
				."roles='".$f['v_roles']."', "
				."kdunit='".$a."', "
				."departemen='".$f['v_departemen']."' ";
				
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
        $a=Person::getDepartemenByID($f['v_departemen']);
		
		$sql= "UPDATE m_login SET "
				."pwd='".$f['v_pwd']."', "
				."ses_reg=md5('".$f['v_ses_reg']."'), "
				."roles='".$f['v_roles']."', "
				//."kdunit='".$f['v_kdunit']."', "
				."kdunit='".$a."', "
				."departemen='".$f['v_departemen']."' "				
				."WHERE nip='".$f['id']."'";
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
	
		$sql = "DELETE FROM m_login WHERE nip = '$id'";
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
	$roles = &Person::getUnit();
				while ($row = $roles->fetchRow()) {
						$groupoptions .= '<option value="'.$row['nama_unit'].'">'.$row['nama_unit'].'</option>';
				}
	$html = '
			<!-- No edit the next line -->
			<form method="post" name="f" id="f">
			
			<table border="1" width="100%" class="adminlist">
			<tr>
				<td nowrap align="left">NIP *</td>
				<td align="left"><input type="text" id="v_nip" name="v_nip" size="35"></td>
			</tr>
			<tr>
				<td nowrap align="left">Password *</td>
				<td align="left"><input type="text" id="v_pwd" name="v_pwd" size="35"></td>
			</tr>
			<tr>
				<td nowrap align="left">SES_REG </td>
				<td align="left"><input type="text" id="v_ses_reg" name="v_ses_reg" readonly="true" size="35"></td>
			</tr>
			<tr>
				<td nowrap align="left">ROLES *</td>
				<!--<td align="left"><input type="text" id="v_roles" name="v_roles" size="35"></td>-->
				<td align="left"><select id="v_roles" name="v_roles" >
					<option value=17>ADMISSION</option>
					<option value=9>APOTEK</option>
					<option value=16>EKSEKUTIF</option>
					<option value=15>GIZI</option>
					<option value=7>GUDANG</option>
					<option value=8>LOGISTIK</option>
					<option value=13>JAMKESMAS</option>
					<option value=18>ICD</option>
					<option value=19>KAMAR OPERASI</option>
					<option value=22>ASKES</option>
					<option value=23>KEUANGAN</option>
					<option value=24>JASPEL</option>
					<option value=2>KASIR</option>
					<option value=26>ADMIN RAJAL</option>
					<option value=27>KEPERAWATAN</option>
					<option value=5>LABORATORIUM</option>
					<option value=1>PENDAFTARAN</option>
					<option value=4>RAWAT JALAN</option>
					<option value=11>RAWAT INAP</option>
					<option value=6>RADIOLOGI</option>
					<option value=12>REKAM MEDIK</option>
					<option value=99>SUPERVISOR</option>
					<option value=1017>ADMIN</option>
				</select>
				</td>				

			</tr>
			<!--<tr>
				<td nowrap align="left">Kode Unit *</td>
				<td align="left"><input type="text" id="v_kdunit" name="v_kdunit" size="35"></td>
			</tr>-->
			<tr>
				<td nowrap align="left">Departemen*</td>
				<td align="left"><SELECT id="v_departemen" name="v_departemen" >
				'.$groupoptions.'
				<option value="ADMISSION">ADMISSION</option>
				<option value="EKSEKUTIF">EKSEKUTIF</option>
				<option value="JAMKESMAS">JAMKESMAS</option>
				<option value="KEPERAWATAN">KEPERAWATAN</option>
				<option value="PEMBAYARAN">PEMBAYARAN</option>
				<option value="PENDAFTARAN">PENDAFTARAN</option>
				<option value="REKAM MEDIK">REKAM MEDIK</option>
				<option value="ADMIN">ADMIN</option>
				<option value="ICD">ICD</option>
				</SELECT></td>
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
$groupoptions .= '<select name="v_roles" id="v_roles" >';
					$groupoptions .= '<option value=17';if ($person ['roles']  == 17) $groupoptions .= ' selected';
					$groupoptions .= '>ADMISSION</option>';
					$groupoptions .= '<option value=9';if ($person ['roles']  == 9) $groupoptions .= ' selected';
					$groupoptions .= '>APOTEK</option>';
					$groupoptions .= '<option value=16';if ($person ['roles']  == 16) $groupoptions .= ' selected';
					$groupoptions .= '>EKSEKUTIF</option>';
					$groupoptions .= '<option value=15';if ($person ['roles']  == 15) $groupoptions .= ' selected';
					$groupoptions .= '>GIZI</option>';
					$groupoptions .= '<option value=7';if ($person ['roles']  == 7) $groupoptions .= ' selected';
					$groupoptions .= '>GUDANG</option>';
					$groupoptions .= '<option value=8';if ($person ['roles']  == 8) $groupoptions .= ' selected';
					$groupoptions .= '>LOGISTIK</option>';
					$groupoptions .= '<option value=13';if ($person ['roles']  == 13) $groupoptions .= ' selected';
					$groupoptions .= '>JAMKESMAS</option>';
					$groupoptions .= '<option value=18';if ($person ['roles']  == 18) $groupoptions .= ' selected';
					$groupoptions .= '>ICD</option>';
					$groupoptions .= '<option value=19';if ($person ['roles']  == 19) $groupoptions .= ' selected';
					$groupoptions .= '>KAMAR OPERASI</option>';
					$groupoptions .= '<option value=22';if ($person ['roles']  == 22) $groupoptions .= ' selected';
					$groupoptions .= '>ASKES</option>';
					$groupoptions .= '<option value=23';if ($person ['roles']  == 23) $groupoptions .= ' selected';
					$groupoptions .= '>KEUANGAN</option>';
					$groupoptions .= '<option value=24';if ($person ['roles']  == 24) $groupoptions .= ' selected';
					$groupoptions .= '>JASPEL</option>';
					$groupoptions .= '<option value=2';if ($person ['roles']  == 2) $groupoptions .= ' selected';
					$groupoptions .= '>KASIR</option>';
					$groupoptions .= '<option value=26';if ($person ['roles']  == 26) $groupoptions .= ' selected';
					$groupoptions .= '>ADMIN RAJAL</option>';
					$groupoptions .= '<option value=27';if ($person ['roles']  == 27) $groupoptions .= ' selected';
					$groupoptions .= '>KEPERAWATAN</option>';
					$groupoptions .= '<option value=5';if ($person ['roles']  == 5) $groupoptions .= ' selected';
					$groupoptions .= '>LABORATORIUM</option>';
					$groupoptions .= '<option value=1';if ($person ['roles']  == 1) $groupoptions .= ' selected';
					$groupoptions .= '>PENDAFTARAN</option>';
					$groupoptions .= '<option value=4';if ($person ['roles']  == 4) $groupoptions .= ' selected';
					$groupoptions .= '>RAWAT JALAN</option>';
					$groupoptions .= '<option value=11';if ($person ['roles']  == 11) $groupoptions .= ' selected';
					$groupoptions .= '>RAWAT INAP</option>';
					$groupoptions .= '<option value=6';if ($person ['roles']  == 6) $groupoptions .= ' selected';
					$groupoptions .= '>RADIOLOGI</option>';
					$groupoptions .= '<option value=12';if ($person ['roles']  == 12) $groupoptions .= ' selected';
					$groupoptions .= '>REKAM MEDIK</option>';				
					$groupoptions .= '<option value=99';if ($person ['roles']  == 99) $groupoptions .= ' selected';
					$groupoptions .= '>SUPERVISOR</option>';				
					$groupoptions .= '<option value=1017';if ($person ['roles']  == 1017) $groupoptions .= ' selected';
					$groupoptions .= '>ADMIN</option>';
				$groupoptions .= '</select>';
				
$groupoptions2 .= '<select name="v_departemen" id="v_departemen" >';
$roles = &Person::getUnit();
				while ($row = $roles->fetchRow()) {
						$groupoptions2 .= '<option value="'.$row['nama_unit'].'"';
						if ($person['departemen'] == $row['nama_unit'])
							$groupoptions2 .= ' selected';
						$groupoptions2 .= '>'.$row['nama_unit'].'</option>';
				}
$groupoptions2 .= '<option value="ADMISSION"';if ($person ['departemen']  == "ADMISSION") $groupoptions2 .= ' selected';
					$groupoptions2 .= '>ADMISSION</option>';
$groupoptions2 .= '<option value="EKSEKUTIF"';if ($person ['departemen']  == 'EKSEKUTIF') $groupoptions2 .= ' selected';
					$groupoptions2 .= '>EKSEKUTIF</option>';
$groupoptions2 .= '<option value="JAMKESMAS"';if ($person ['departemen']  == 'JAMKESMAS') $groupoptions2 .= ' selected';
					$groupoptions2 .= '>JAMKESMAS</option>';
$groupoptions2 .= '<option value="KEPERAWATAN"';if ($person ['departemen']  == 'KEPERAWATAN') $groupoptions2 .= ' selected';
					$groupoptions2 .= '>KEPERAWATAN</option>';
$groupoptions2 .= '<option value="PEMBAYARAN"';if ($person ['departemen']  == 'PEMBAYARAN') $groupoptions2 .= ' selected';
					$groupoptions2 .= '>PEMBAYARAN</option>';
$groupoptions2 .= '<option value="PENDAFTARAN"';if ($person ['departemen']  == 'PENDAFTARAN') $groupoptions2 .= ' selected';
					$groupoptions2 .= '>PENDAFTARAN</option>';
$groupoptions2 .= '<option value="REKAM MEDIK"';if ($person ['departemen']  == 'REKAM MEDIK') $groupoptions2 .= ' selected';
					$groupoptions2 .= '>REKAM MEDIK</option>';
$groupoptions2 .= '<option value="ADMIN"';if ($person ['departemen']  == 'ADMIN') $groupoptions2 .= ' selected';
					$groupoptions2 .= '>ADMIN</option>';
$groupoptions2 .= '<option value="ICD"';if ($person ['departemen']  == 'ICD') $groupoptions2 .= ' selected';
					$groupoptions2 .= '>ICD</option>';

		$html = '
				<form method="post" name="f" id="f">
				<!-- No edit the next line -->
				<input type="hidden" id="id"  name="id" value="'.$person['nip'].'">

				<table border="0" width="100%">
				<tr>
					<td nowrap align="left">Nip *</td>
					<td align="left"><input type="text" id="v_nip" name="v_nip" size="25" readonly="true" value="'.$person['nip'].'"></td>
				</tr>
				<tr>
					<td nowrap align="left">Password *</td>
					<td align="left"><input type="text" id="v_pwd" name="v_pwd" size="25" value="'.$person['pwd'].'"></td>
				</tr>
				<tr>
					<td nowrap align="left">SES_REG *</td>
					<td align="left"><input type="text" id="v_ses_reg" name="v_ses_reg" size="25" value="'.$person['ses_reg'].'"></td>
				</tr>
				<tr>
					<td nowrap align="left">ROLES *</td>
					<!--<td align="left"><input type="text" id="v_roles" name="v_roles" size="25" value="'.$person['roles'].'"></td>-->
				<td align="left">'.$groupoptions.'</td>				
					
				</tr>
				<!--<tr>
					<td nowrap align="left">KOde Unit *</td>
					<td align="left"><input type="text" id="v_kdunit" name="v_kdunit" size="25" value="'.$person['kdunit'].'"></td>
				</tr>-->
				<tr>
					<td nowrap align="left">Departemen *</td>
				<!--<td align="left"><SELECT id="v_departemen" name="v_departemen" >-->
				<td align="left">'.$groupoptions2.'</td>								
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
		if(empty($f['v_nip'])) return "Kode harus diisi";
		if(empty($f['v_pwd'])) return "Password harus diisi";

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
