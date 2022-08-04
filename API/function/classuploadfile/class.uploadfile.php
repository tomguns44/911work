<?
/********************************************************/
//
//	Design By WenChi
//	WebSite: http://www.phptw.idv.tw
//	WebSite: http://blog.phptw.idv.tw
//	Email: service@phptw.idv.tw
//	
//	
/********************************************************/


if (!class_exists("ThumbHandler")) include_once(dirname(__FILE__)."/class.thumb.php");

/*
example:

$upload=new classUpload(dirname(__FILE__));
$upload->uploadFile($_FILES[file][name],$_FILES[file][type],$_FILES[file][tmp_name]);
$upload->save();
$upload->getFileArray();


$upload=new classUpload(dirname(__FILE__));
$upload->uploadFile($_FILES[file][name],$_FILES[file][type],$_FILES[file][tmp_name]);
$upload->setImageType();
$upload->save();
$upload->getFileArray();


$upload=new classUpload(dirname(__FILE__));
$upload->uploadFile($_FILES[file][name],$_FILES[file][type],$_FILES[file][tmp_name]);
$upload->setImageType(600,150);
$upload->save();
$upload->getFileArray();

*/

/**
 * php class upload file 
 *
 * @author wenchi
 * @see http://blog.phptw.idv.tw/read-98.html
 * @version 1.0
 */
class classUpload{

	/**
	 * file type
	 *
	 * @access private
	 * @var boolean|string
	 */
	var $_type=false;
	
	/**
	 * save dir 
	 *
	 * @access private
	 * @var boolean|string
	 */
	var $_saveDir=false;
	
	/**
	 * upload filename
	 *
	 * @access private
	 * @var boolean|string
	 */	
	var $_oldFileName=false;
	
	/**
	 * upload file type
	 *
	 * @access private
	 * @var boolean|string
	 */	
	var $_fileType=false;
	
	/**
	 * upload tmp file 
	 *
	 * @access private
	 * @var boolean|string
	 */	
	var $_fileTmp=false;
	
	/**
	 * file size
	 *
	 * @access private
	 * @var boolean|string
	 */	
	var $_fileSize=false;
	
	/**
	 * upload file error
	 *
	 * @access private
	 * @var boolean|ing
	 */	
	var $_fileError=false;
	
	/**
	 * upload file Extension
	 *
	 * @access private
	 * @var boolean|string
	 */	
	var $_fileExtension=false;
	
	/**
	 * save file name
	 *
	 * @access private
	 * @var boolean|string
	 */		
	var $_fileName=false;
	
	/**
	 * Allow file Extension
	 *
	 * @access private
	 * @var boolean|string
	 */		
	var $_AllowFiletype=array("doc","xls","ppt","pdf","txt","csv","jpg","jpge","gif","docx","xlsx","ppt","pptx");
	
	/**
	 * image width
	 *
	 * @access private
	 * @var boolean|string
	 */		
	var $_lwidth=false;
	
	/**
	 * image height
	 *
	 * @access private
	 * @var boolean|int
	 */			
	var $_lheight=false;
	
	/**
	 * image width
	 *
	 * @access private
	 * @var boolean|int
	 */			
	var $_swidth=false;
	
	/**
	 * image height
	 *
	 * @access private
	 * @var boolean|int
	 */			
	var $_sheight=false;
	
	/**
	 * image quality
	 *
	 * @access private
	 * @var int
	 */			
	var $_img_create_quality=100;
	
	/**
	 * construct for php5
	 *
	 * @access public
	 * @param string $saveTo
	 * @param string $type
	 * @return boolean
	 */
	function __construct($saveTo,$type="file"){
		$this->_saveDir=str_replace ("\\","/",$saveTo);
		$this->_type=$type;
		return 1;
	}
	
	/**
	 * construct for php4
	 *
	 * @access public
	 * @param string $saveTo
	 * @param string $type
	 * @return boolean
	 */
	function classUploadFile($saveTo,$type="file"){
		$this->__construct($saveTo,$type);
		return 1;
	}
	
	/**
	 * upload file 
	 *
	 * @access public
	 * @param string $filename
	 * @param string $filetype
	 * @param string $tmp
	 * @param boolean $size
	 * @param boolean $error
	 * @return boolean
	 */
	function uploadFile(&$filename,&$filetype,&$tmp,&$size=false,&$error=false){
		
		if (!is_uploaded_file($tmp)) return $this->__errorMsg(1);
		
		$this->_oldFileName=&$filename;
		$this->_fileType=&$filetype;
		$this->_fileTmp=&$tmp;
		if ($size) $this->_fileSize=&$size;
		else $this->_fileSize=filesize($tmp);
		$this->_fileError=max((int)$error,0);
		
		$aryTmp=explode(".",$filename);
		end($aryTmp);
		$this->_fileExtension=strtolower($aryTmp[key($aryTmp)]);
		return 1;
	}
	
	/**
	 * set upload image file width 
	 *
	 * @access public 
	 * @param int $lWidth
	 * @param int $sWidth
	 * @param int $lHeight
	 * @param int $sHeight
	 * @param int $quality
	 * @return boolean
	 */
	function setImageType($lWidth=640,$sWidth=200,$lHeight=0,$sHeight=0,$quality=100){
		$this->_lwidth=$lWidth;
		$this->_lheight=$lHeight;
		
		$this->_swidth=$sWidth;
		$this->_sheight=$sHeight;
		$this->_img_create_quality=$quality;
		$this->_type="image";
		return 1;
	}
	
	/**
	 * get new upload file name
	 *
	 * @access private
	 * @return boolean
	 */
	function __getNewFileName(){
		$this->_fileName=date("Ymd").substr(md5(rand(1,99)*rand(1,99)*rand(1,99)),0,8).".".$this->_fileExtension;
		return 1;
	}
	
	/**
	 * add allo file type 
	 *
	 * @access public
	 * @param string $type
	 * @return boolean
	 */
	function AddAllowFileType($type){
		$this->_AllowFiletype[]=strtolower($type);
		return 1;
	}

	/**
	 * save upload file 
	 *
	 * @access public
	 * @return boolean
	 */
	function save(){
		$this->__getNewFileName();
		
		if (!in_array($this->_fileExtension,$this->_AllowFiletype)) return $this->__errorMsg(2);

		switch ($this->_type){
			case image:
				$this->__saveImage();
				@unlink($this->_fileTmp);
				return 1;
			break;
			default:
				$this->__saveFile();
				@unlink($this->_fileTmp);
				return 1;
			break;
		}
	}
	
	/**
	 * save upload file
	 *
	 * @access private
	 * @return boolean
	 */
	function __saveFile(){
		if (move_uploaded_file($this->_fileTmp,$this->_saveDir."/".$this->_fileName)) {
			return 1;
		}
		elseif (copy($this->_fileTmp,$this->_saveDir."/".$this->_fileName)){
			return 1;
		}
		return $this->__errorMsg(3);
	}
	
	/**
	 * save upload image file
	 *
	 * @access private
	 * @return boolean
	 */	
	function __saveImage(){
		
		$tmpfile=$this->_saveDir."/tmp_".$this->_fileName;
		move_uploaded_file($this->_fileTmp,$tmpfile);
		
		$this->__doCopyImage($tmpfile,$this->_saveDir."/".$this->_fileName,$this->_lwidth,$this->_lheight);
		
		if ($this->_swidth>0) $this->__doCopyImage($tmpfile,$this->_saveDir."/s_".$this->_fileName,$this->_swidth,$this->_sheight);
		
		@unlink($tmpfile);
		
		return $this->__errorMsg(3);
	}
	
	/**
	 *  do copy image 
	 *
	 * @access private
	 * @param string $tmpfile
	 * @param string $file
	 * @param int $width
	 * @param int $height
	 * @return int
	 */
	function __doCopyImage($tmpfile,$file,$width,$height=0){
		
		static $img;
		
		include_once(dirname(__FILE__)."/class.thumb.php");
		$img=new ThumbHandler();
		
	    $img->setSrcImg($tmpfile);
    	$img->setCutType(1);
    	$img->setDstImg($file);
    	
    	if ($height==0) {
    		if ($img->src_w>$width) {
    			$size=round(($width/$img->src_w)*100);
    		}
    		elseif ($img->src_w<$width) {
    			$size=100;
    		}
    		$img->createImg($size);
    	}
    	else {
    		$img->createImg($this->_lwidth,$height);
    	}
    	return 1;
	}
	
	function __errorMsg($no){
		return 0;
	}
	
	/**
	 * get upload file array
	 *
	 * @access public
	 * @return array
	 */
	function getFileArray(){
		$aryFile[name]=$this->getFileName();
		$aryFile[size]=$this->getFileSize();
		$aryFile[oldname]=$this->getOldFileName();
		$aryFile[type]=$this->_fileExtension;
		$aryFile[filetype]=$this->_fileType;
		$aryFile[fliepath]=$this->_saveDir."/".$this->_fileName;
		$aryFile[path]=$this->_saveDir;
		return $aryFile;
	}
	
	/**
	 * get upload new filename
	 *
	 * @access public
	 * @return string
	 */
	function getFileName(){
		return $this->_fileName;
	}

	/**
	 * get upload filename
	 *
	 * @access public
	 * @return string
	 */
	function getOldFileName(){
		return $this->_oldFileName;
	}
	
	/**
	 * get upload filesize
	 *
	 * @access public
	 * @return string
	 */
	function getFileSize(){
		return $this->_fileSize;
	}
	
	/**
	 * encode upload file arrary
	 *
	 * @param boolean $base64
	 * @access public
	 * @return string
	 */
	function getEncodeString($base64=false){
		$strEncode=serialize($this->getFileArray());
		if ($base64) return base64_encode($strEncode);
		else return $strEncode;
	}
	
	/**
	 * reset upload file Allow FileType
	 *
	 * @param array $type
	 * @return boolean
	 */
	function resetAllowFileType($type=array()){
		if (count($type)==0) return 0;
		unset($this->_AllowFiletype);
		foreach ($type as $aryKey => $aryValue){
			$this->_AllowFiletype[]=$aryValue;
		}
		return 1;
	}
	
}

?>