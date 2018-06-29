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
			$sql = "select no,nama,kelas,ruang,jumlah_tt,ket_ruang,fasilitas,keterangan
					from m_ruang LIMIT $start, $limit ".$_SESSION['ordering'];
		}else{
			$sql = "select no,nama,kelas,ruang,jumlah_tt,ket_ruang,fasilitas,keterangan
					from m_ruang ORDER BY $order ".$_SESSION['ordering']." LIMIT $start, $limit ";
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
			  $sql = "select no,nama,kelas,ruang,jumlah_tt,ket_ruang,fasilitas,keterangan
					from m_ruang where ".$filter." like '%".$content."%' "
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
		
		$sql = "SELECT COUNT(*) AS numRows FROM m_ruang";
		
		if(($filter != null) and ($content != null)){
			$sql = 	"select COUNT(*) AS numRows from m_ruang where  ".$filter." like '%$content%'";
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
		
		$sql = "select no,nama,kelas,ruang,jumlah_tt,ket_ruang,fasilitas,keterangan from m_ruang where no = '$id'";
		Person::events($sql);
		$row =& $db->getRow($sql);
		return $row;
	}
	
	function &getDetailByID($id){
		global $db;
		
		$sql = "select idxruang,no_tt from m_detail_tempat_tidur where idxruang = '$id'";
		Person::events($sql);
		$row =& $db->getRow($sql);
		return $row;
	}
	
	function &getDuplicateDetail($id,$no_tt){
		global $db;
		
		$sql = "select idxruang,no_tt from m_detail_tempat_tidur where idxruang = '$id' and no_tt = '$no_tt'";
		Person::events($sql);
		$row =& $db->getRow($sql);
		return $row;
	}

	function &getFasilitasByID($id){
		global $db;

		$sql = "select distinct ket_ruang from m_ruang where fasilitas = '".$id."'";
		Person::events($sql);
		$row =& $db->getOne($sql);
		return $row;
	}

	function &getjumlah_tt(){
		global $db;
		
		$sql = "select distinct jumlah_tt,case jumlah_tt when 4 then 'RAWAT JALAN' else fasilitas end as fasilitas
from m_ruang  order by fasilitas";
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
		
		$sql= "INSERT INTO m_ruang SET "
				."nama='".$f['v_nama']."', "
				."kelas='".$f['v_kelas']."', "
				//."ruang=md5('".$f['v_ruang']."'), "
				."ruang='".$f['v_ruang']."', "
				."jumlah_tt='".$f['v_jumlah_tt']."', "
				."ket_ruang='".$f['v_ket_ruang']."', "
				."fasilitas='".$f['v_fasilitas']."', "
				."keterangan='".$f['v_keterangan']."' ";
				
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
        //$a=Person::getFasilitasByID($f['v_fasilitas']);
		
		global $db;	
        
		 $sql= "UPDATE m_ruang SET "
				."nama='".$f['v_nama']."', "
				."kelas='".$f['v_kelas']."', "
				."ruang='".$f['v_ruang']."', "
				//."ruang=md5('".$f['v_sesreg']."'), "
				."jumlah_tt='".$f['v_jumlah_tt']."', "
				."ket_ruang='".$f['v_ket_ruang']."', "
				//."ket_ruang='".$a."', "
				."fasilitas='".$f['v_fasilitas']."', "
				."keterangan='".$f['v_keterangan']."' "
				."WHERE no='".$f['id']."'";
		Person::events($sql);
		$res =& $db->query($sql);
		return $res;
	}
	
	function DetailAdd($f){
        //$a=Person::getFasilitasByID($f['v_fasilitas']);
		
		global $db;	
        
		 $sql= "INSERT INTO m_detail_tempat_tidur SET "
				."idxruang='".$f['id']."', "
				."no_tt='".$f['v_no_tt']."'; ";
		Person::events($sql);
		$res =& $db->query($sql);
		$sql= "UPDATE m_ruang SET "
				."jumlah_tt=(jumlah_tt+1) where NO= '".$f['id']."'; ";
		Person::events($sql);
		$res1 =& $db->query($sql);
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
	
		$sql = "DELETE FROM m_ruang WHERE no = '$id'";
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
				<td nowrap align="left">Nama *</td>
				<td align="left"><input type="text" id="v_nama" name="v_nama" size="35"></td>
			</tr>
			<tr>
				<td nowrap align="left">Kelas *</td>
				<td align="left"><input type="text" id="v_kelas" name="v_kelas" size="35"></td>
			</tr>
			<tr>
				<td nowrap align="left">Ruang </td>
				<td align="left"><input type="text" id="v_ruang" name="v_ruang" size="35"><!--readonly="true"--></td>
			</tr>
			<!--<tr>
				<td nowrap align="left">Jumlah Tempat Tidur *</td>-->
				<!--<td align="left"><input type="text" id="v_jumlah_tt" name="v_jumlah_tt" size="35"></td>-->
				<!--<td align="left"><select id="v_jumlah_tt" name="v_jumlah_tt" >
					<option value=17>ADMISSION</option>
					<option value=9>APOTEK</option>
					<option value=16>EKSEKUTIF</option>
					<option value=15>GIZI</option>
					<option value=7>GUDANG</option>					
					<option value=13>JAMKESMAS</option>
					<option value=19>KAMAR OPERASI</option>
					<option value=2>KASIR</option>
					<option value=27>KEPERAWATAN</option>
					<option value=5>LABORATORIUM</option>
					<option value=1>PENDAFTARAN</option>
					<option value=4>RAWAT JALAN</option>
					<option value=11>RAWAT INAP</option>
					<option value=6>RADIOLOGI</option>
					<option value=12>REKAM MEDIK</option>
				</select>
				</td>
			</tr>-->
			<tr>
				<td nowrap align="left">Keterangan Ruang *</td>
				<td align="left"><input type="text" id="v_ket_ruang" name="v_ket_ruang" size="35"></td>
			</tr>
			<tr>
				<td nowrap align="left">Fasilitas*</td>
				<td align="left"><textarea class="text" id="v_fasilitas" name="v_fasilitas" rows="5" cols="50" style="width:100%" ></textarea></td>
			</tr>
			<tr>
				<td nowrap align="left">Keterangan *</td>
				<td align="left"><textarea class="text" id="v_keterangan" name="v_keterangan" rows="5" cols="50" style="width:100%" ></textarea><!--<input type="text" id="v_keterangan" name="v_keterangan" size="35">--></td>
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
	
	function tabelDetail($id){		

		$person =&Person::getRecordByID($id);
		$detail =&Person::getDetailByID($id);
		
		$html = '
				<form method="post" name="f" id="f">
				<input type="hidden" id="id"  name="id" value="'.$person['no'].'">
				<table border="0" width="100%">
				<tr>
					<td nowrap align="left">Nama</td>
					<td align="left">'.$person['nama'].'</td>
				</tr>
				<tr>
					<td nowrap align="left">Kelas</td>
					<td align="left">'.$person['kelas'].'</td>
				</tr>
				<tr>
					<td nowrap align="left">Ruang</td>
					<td align="left">'.$person['ruang'].'</td>
				</tr>
				<tr>
					<td nowrap align="left">Keterangan Ruang</td>
					<td align="left">'.$person['ket_ruang'].'</td>
				</tr>
				<tr>
					<td nowrap align="left">Fasilitas</td>
					<td align="left">'.$person['fasilitas'].'</td>
				</tr>
				<tr>
					<td nowrap align="left">Keterangan</td>
					<td align="left">'.$person['keterangan'].'</td>
				</tr>
				<tr>
					<td nowrap align="left">No Tempat Tidur *</td>
					<td align="left"><input type="text" id="v_no_tt" name="v_no_tt" size="35"></td>
				</tr>
				<tr>
					<td colspan="2" align="center"><button id="submitButton" onClick=\'xajax_addDetail(xajax.getFormValues("f"));return false;\'>Simpan</button></td>
				</tr>
				</table>
				</form>
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
		/*$jumlah_tt = &Person::getjumlah_tt();
				$groupoptions .= '<select name="v_jumlah_tt" id="v_jumlah_tt">';
				while ($row = $jumlah_tt->fetchRow()) {
						$groupoptions .= '<option value="'.$row['jumlah_tt'].'"';
						if ($person ['jumlah_tt']  == $row['jumlah_tt'])
							$groupoptions .= ' selected';
						$groupoptions .='>'.$row['fasilitas,keterangan'].'</option>';
				}
				$groupoptions .= '</select>';

$groupoptions .= '</select>';*/
$groupoptions .= '<select name="v_jumlah_tt" id="v_jumlah_tt" >';
					$groupoptions .= '<option value=17';if ($person ['jumlah_tt']  == 17) $groupoptions .= ' selected';
					$groupoptions .= '>ADMISSION</option>';
					$groupoptions .= '<option value=9';if ($person ['jumlah_tt']  == 9) $groupoptions .= ' selected';
					$groupoptions .= '>APOTEK</option>';
					$groupoptions .= '<option value=16';if ($person ['jumlah_tt']  == 16) $groupoptions .= ' selected';
					$groupoptions .= '>EKSEKUTIF</option>';
					$groupoptions .= '<option value=15';if ($person ['jumlah_tt']  == 15) $groupoptions .= ' selected';
					$groupoptions .= '>GIZI</option>';
					$groupoptions .= '<option value=7';if ($person ['jumlah_tt']  == 7) $groupoptions .= ' selected';
					$groupoptions .= '>GUDANG</option>';					
					$groupoptions .= '<option value=13';if ($person ['jumlah_tt']  == 13) $groupoptions .= ' selected';
					$groupoptions .= '>JAMKESMAS</option>';
					$groupoptions .= '<option value=19';if ($person ['jumlah_tt']  == 19) $groupoptions .= ' selected';
					$groupoptions .= '>KAMAR OPERASI</option>';
					$groupoptions .= '<option value=2';if ($person ['jumlah_tt']  == 2) $groupoptions .= ' selected';
					$groupoptions .= '>KASIR</option>';
					$groupoptions .= '<option value=27';if ($person ['jumlah_tt']  == 27) $groupoptions .= ' selected';
					$groupoptions .= '>KEPERAWATAN</option>';					
					$groupoptions .= '<option value=5';if ($person ['jumlah_tt']  == 5) $groupoptions .= ' selected';
					$groupoptions .= '>LABORATORIUM</option>';
					$groupoptions .= '<option value=1';if ($person ['jumlah_tt']  == 1) $groupoptions .= ' selected';
					$groupoptions .= '>PENDAFTARAN</option>';
					$groupoptions .= '<option value=4';if ($person ['jumlah_tt']  == 4) $groupoptions .= ' selected';
					$groupoptions .= '>RAWAT JALAN</option>';
					$groupoptions .= '<option value=11';if ($person ['jumlah_tt']  == 11) $groupoptions .= ' selected';
					$groupoptions .= '>RAWAT INAP</option>';
					$groupoptions .= '<option value=6';if ($person ['jumlah_tt']  == 6) $groupoptions .= ' selected';
					$groupoptions .= '>RADIOLOGI</option>';
					$groupoptions .= '<option value=12';if ($person ['jumlah_tt']  == 12) $groupoptions .= ' selected';
					$groupoptions .= '>REKAM MEDIK</option>';				
				$groupoptions .= '</select>';
				
$groupoptions2 .= '<select name="v_fasilitas" id="v_fasilitas" >';
$groupoptions2 .= '<option value="ADMISSION"';if ($person ['fasilitas']  == "ADMISSION") $groupoptions2 .= ' selected';
					$groupoptions2 .= '>ADMISSION</option>';
$groupoptions2 .= '<option value="ANAK"';if ($person ['fasilitas']  == 'ANAK') $groupoptions2 .= ' selected';
					$groupoptions2 .= '>ANAK</option>';
$groupoptions2 .= '<option value="ANESTESI"';if ($person ['fasilitas']  == 'ANESTESI') $groupoptions2 .= ' selected';
					$groupoptions2 .= '>ANESTESI</option>';
$groupoptions2 .= '<option value="APOTEK"';if ($person ['fasilitas']  == 'APOTEK') $groupoptions2 .= ' selected';
					$groupoptions2 .= '>APOTEK</option>';
$groupoptions2 .= '<option value="BEDAH"';if ($person ['fasilitas']  == 'BEDAH') $groupoptions2 .= ' selected';
					$groupoptions2 .= '>BEDAH</option>';
$groupoptions2 .= '<option value="EKSEKUTIF"';if ($person ['fasilitas']  == 'EKSEKUTIF') $groupoptions2 .= ' selected';
					$groupoptions2 .= '>EKSEKUTIF</option>';
$groupoptions2 .= '<option value="GIGI"';if ($person ['fasilitas']  == 'GIGI') $groupoptions2 .= ' selected';
					$groupoptions2 .= '>GIGI</option>';
$groupoptions2 .= '<option value="GIZI"';if ($person ['fasilitas']  == 'GIZI') $groupoptions2 .= ' selected';
					$groupoptions2 .= '>GIZI</option>';
$groupoptions2 .= '<option value="GUDANG"';if ($person ['fasilitas']  == 'GUDANG') $groupoptions2 .= ' selected';
					$groupoptions2 .= '>GUDANG</option>';
$groupoptions2 .= '<option value="JAMKESMAS"';if ($person ['fasilitas']  == 'JAMKESMAS') $groupoptions2 .= ' selected';
					$groupoptions2 .= '>JAMKESMAS</option>';
$groupoptions2 .= '<option value="KAMAROPERASI"';if ($person ['fasilitas']  == 'KAMAROPERASI') $groupoptions2 .= ' selected';
					$groupoptions2 .= '>KAMAR OPERASI</option>';
$groupoptions2 .= '<option value="KEPERAWATAN"';if ($person ['fasilitas']  == 'KEPERAWATAN') $groupoptions2 .= ' selected';
					$groupoptions2 .= '>KEPERAWATAN</option>';
$groupoptions2 .= '<option value="KB DAN KD"';if ($person ['fasilitas']  == 'KB DAN KD') $groupoptions2 .= ' selected';
					$groupoptions2 .= '>KB DAN KD</option>';
$groupoptions2 .= '<option value="LABORATORIUM"';if ($person ['fasilitas']  == 'LABORATORIUM') $groupoptions2 .= ' selected';
					$groupoptions2 .= '>LABORATORIUM</option>';
$groupoptions2 .= '<option value="MATA"';if ($person ['fasilitas']  == 'MATA') $groupoptions2 .= ' selected';
					$groupoptions2 .= '>MATA</option>';
$groupoptions2 .= '<option value="NEUROLOGI"';if ($person ['fasilitas']  == 'NEUROLOGI') $groupoptions2 .= ' selected';
					$groupoptions2 .= '>NEUROLOGI</option>';
$groupoptions2 .= '<option value="PARU"';if ($person ['fasilitas']  == 'PARU') $groupoptions2 .= ' selected';
					$groupoptions2 .= '>PARU</option>';
$groupoptions2 .= '<option value="PEMBAYARAN"';if ($person ['fasilitas']  == 'PEMBAYARAN') $groupoptions2 .= ' selected';
					$groupoptions2 .= '>PEMBAYARAN</option>';
$groupoptions2 .= '<option value="PENDAFTARAN"';if ($person ['fasilitas']  == 'PENDAFTARAN') $groupoptions2 .= ' selected';
					$groupoptions2 .= '>PENDAFTARAN</option>';
$groupoptions2 .= '<option value="PENYAKIT DALAM"';if ($person ['fasilitas']  == 'PENYAKIT DALAM') $groupoptions2 .= ' selected';
					$groupoptions2 .= '>PENYAKIT DALAM</option>';
$groupoptions2 .= '<option value="PSIKIATRI"';if ($person ['fasilitas']  == 'PSIKIATRI') $groupoptions2 .= ' selected';
					$groupoptions2 .= '>PSIKIATRI</option>';
$groupoptions2 .= '<option value="RADIOLOGI"';if ($person ['fasilitas']  == 'RADIOLOGI') $groupoptions2 .= ' selected';
					$groupoptions2 .= '>RADIOLOGI</option>';
$groupoptions2 .= '<option value="RAWAT INAP"';if ($person ['fasilitas']  == 'RAWAT INAP') $groupoptions2 .= ' selected';
					$groupoptions2 .= '>RAWAT INAP</option>';
$groupoptions2 .= '<option value="REKAM MEDIK"';if ($person ['fasilitas']  == 'REKAM MEDIK') $groupoptions2 .= ' selected';
					$groupoptions2 .= '>REKAM MEDIK</option>';
$groupoptions2 .= '<option value="RUJUKAN"';if ($person ['fasilitas']  == 'RUJUKAN') $groupoptions2 .= ' selected';
					$groupoptions2 .= '>RUJUKAN</option>';
$groupoptions2 .= '<option value="THT"';if ($person ['fasilitas']  == 'THT') $groupoptions2 .= ' selected';
					$groupoptions2 .= '>THT</option>';
$groupoptions2 .= '<option value="UGD"';if ($person ['fasilitas']  == 'UGD') $groupoptions2 .= ' selected';
					$groupoptions2 .= '>UGD</option>';
$groupoptions2 .= '<option value="VK"';if ($person ['fasilitas']  == 'VK') $groupoptions2 .= ' selected';
					$groupoptions2 .= '>VK</option>';

		$html = '
				<form method="post" name="f" id="f">
				<!-- No edit the next line -->
				<input type="hidden" id="id"  name="id" value="'.$person['no'].'">

				<table border="0" width="100%">
				<tr>
					<td nowrap align="left">Nama *</td>
					<td align="left"><input type="text" id="v_nama" name="v_nama" size="25" value="'.$person['nama'].'"><!--readonly="true" --></td>
				</tr>
				<tr>
					<td nowrap align="left">Kelas *</td>
					<td align="left"><input type="text" id="v_kelas" name="v_kelas" size="25" value="'.$person['kelas'].'"></td>
				</tr>
				<tr>
					<td nowrap align="left">Ruang *</td>
					<td align="left"><input type="text" id="v_ruang" name="v_ruang" size="25" value="'.$person['ruang'].'">
					<input type="hidden" id="v_jumlah_tt" name="v_jumlah_tt" size="25" value="'.$person['jumlah_tt'].'"></td>
				</tr>
				<!--<tr>
					<td nowrap align="left">Jumlah Tempat Tidur *</td>-->
					<!--<td align="left"><input type="text" id="v_jumlah_tt" name="v_jumlah_tt" size="25" value="'.$person['jumlah_tt'].'"></td>-->
				<!--<td align="left">'.$groupoptions.'</td>
				</tr>-->
				<tr>
					<td nowrap align="left">Keterangan Ruang *</td>
					<td align="left"><input type="text" id="v_ket_ruang" name="v_ket_ruang" size="25" value="'.$person['ket_ruang'].'"></td>
				</tr>
				<tr>
					<td nowrap align="left">Fasilitas *</td>
				<!--<td align="left"><SELECT id="v_fasilitas" name="v_fasilitas" >
				<td align="left">'.$groupoptions2.'</td>-->
					<td align="left"><textarea class="text" id="v_fasilitas" name="v_fasilitas" rows="5" cols="50" style="width:100%" >'.$person['fasilitas'].'</textarea></td>
				</tr>
				<tr>
					<td nowrap align="left">Keterangan *</td>
					<td align="left"><textarea class="text" id="v_keterangan" name="v_keterangan" rows="5" cols="50" style="width:100%" >'.$person['keterangan'].'</textarea></td>
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
		if(empty($f['v_nama'])) return "Nama harus diisi";
		if(empty($f['v_kelas'])) return "Kelas harus diisi";

	 	return 0;
	}
	
	function checkDetailData($f,$new = 0){
		if(empty($f['v_no_tt'])) return "No Tempat Tidur harus diisi";

	 	return 0;
	}
	
	function checkDuplicate($f,$new = 0){
		$detail =&Person::getDuplicateDetail($f['id'],$f['v_no_tt']);
		if(!empty($detail['idxruang'])) return "No Tempat Tidur tidak boleh duplikat";

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
