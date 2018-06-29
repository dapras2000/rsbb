<?
define("PATH_PHPMYBORDER",     "/phpMyBorder/"); // path from doc_root 
                                                // e.g if this script is accessable via 
                                                //  www.domain.com/scripts/phpMyborder.php
                                                // PATH_PHPMYBORDER = "/scripts/"
/*
  

       ___[ PhpMyBorder v0.1 beta ]____
       /                                 \
       |              Created by         |
       |           Vidar Vestnes          |
       |              (c)2005               |
       |                                 |
       \___[ Norway ]___________________/

        Licence: Freely distributed  
        
        
        Check for new version 
          
          http://www.phpmyborder.com
        


    HOW TO USE:
    
    include this file in your script
    
      include_once("phpMyBorder/phpMyBorder1.class.php");
      
    add a bordergenerator
     
      $pmb = new PhpMyBorder();
     
     
    Now you are ready to output borders.
    Use the function border_start to begin the border

      echo $pmb->border_start();       // using the defaults
      echo "Your content here..."";
      echo $pmb->border_end();

    border_start have these attributes to help you customize your border.
    
    border_start(
     $width = false,           // pixel e.g. "250px"
     $color = false,           // hex   e.g  "DDEEFF"
     $cornersize = false,      // 5-50  
     $borderthickness = false, // 1-3
     $style = false            // 1 or 2 (1=filled, 2=outline)
    )


    always remember to close your border by calling border_end()







    Example: test.php
    

    <html>
     <head>
      <title>PhpMyBorder Demo</title>
     </head>
     
     <body>
     
     <?php
     
     require_once('phpMyBorder/phpMyBorder1.class.php');
     $pmb = new PhpMyBorder();
     
     echo $pmb->border_start();
     echo "Test1 - Default border";
     echo $pmb->border_end();
     
     echo "<br>";
     
     echo $pmb->border_start("300px","FF0000",20);
     echo "Test2 - width: 300px, fillcolor: FF0000 (red), cornersize : 20px (radius);";
     echo $pmb->border_end();
     
     echo "<br>";
     
     echo $pmb->border_start("250px","FF5500",7,2,2);
     echo "Test2 - width: 250px, fillcolor: FF5500 (orange), cornersize : 7px (radius), borderthickness: 2px, style : 2 (outlined);";
     echo $pmb->border_end();
     
     ?>
     
     </body>
    </html>
    

*/ 


class PhpMyBorder{

  //part of the border to painted
  var $paint;
  
  //properies of the border
  var $property;

  //gif which is rendered, a part of the border.
  var $image;
  
  //width of the complete border
  var $width;

  // constructor of the class
  function PhpMyBorder(){

    $this->checkFunctions();

    $this->checkCacheDir();

    //creates a dummy picutre
    $this->image = imagecreatetruecolor(1, 1);
    
    //set defaults
    $this->setStyle            (1);                // 1 = FILLED, 2 = OUTLINE
    $this->setColor            ('DDEEFF');          // fill and outlined border color
    $this->setCornerSize      (5);                // integer 5-50
    $this->setBorderThickness  (2);                // integer 1-3
  }

  function checkFunctions(){
    $functions = array(
      "imagegif",
      "sscanf",
      "imagecopymerge",
      "imagerotate",
      "imagecreatetruecolor",
      "ob_start",
      "imagefill"
    );
    
    for($i=0;$i<count($functions);$i++){
      $func = $functions[$i];
      if(!function_exists($func)) {
        $msg = "
        PHP function <B>$func</B> is missing.<BR>
        <BR>
        <i>
        This function is requiered by phpMyBorder. This version of PHP does not support phpMyBorder.<BR>
        Try uppgrading you PHP installation.
        </i>
        ";
        $this->fatal_error($msg,1);
      }
    }
  }
  //sets the border color
  function setColor($color){
    $this->setProp('color', $color."000000"); 
  }

  //gets the color (HTML hex format)
  function getColor(){
    return substr($this->getProp('color'),0,6);
  }
  
  function getColorAllocate(){
    sscanf($this->getColor(), "%2x%2x%2x", $red, $green, $blue);
    return imagecolorallocate($this->image, $red, $green, $blue  );
  }

  //gets the color which to be transparent
  function getTransparentAllocate(){
    sscanf("FF0000", "%2x%2x%2x", $red, $green, $blue);
    
    $transparent = imagecolorallocate($this->image, $red, $green, $blue  );
    
    if($this->getColorAllocate() == $transparent){
      sscanf("0000FF", "%2x%2x%2x", $red, $green, $blue);
      $transparent =imagecolorallocate($this->image, $red, $green, $blue  );
    }
    return $transparent;
  }

  function checkCacheDir(){
    
    $dir_script  = dirname(__FILE__);
    $dir_cache   = $this  ->  getPathCache();
    
    $dir_abs     = $dir_script."/".$this  ->  getPathCache();

    if(is_writable($dir_abs)) return true;
  
    clearstatcache();

    if(!is_writeable($dir_script)){
      $error = "
      Directory <B>$dir_script</b> is not writable. <BR>
      <BR>
      <i>
      The directory which you have put the phpMyBorder script is not writable.<BR>
      Make sure that PHP has write permission to this path to be able to cache borders (gifs images)<BR>
      Use chmod to solve the problem ( Unix and Linux ).
      </i>
      ";
      $this->fatal_error($error, 2);
    }


    if(is_dir($dir_abs) && !is_writeable($dir_abs) ) {
      $error = "
      Directory <B>$dir_abs</b> is not writable. <BR>
      <BR>
      <i>
      The cachedir is not writable.<BR>
      Make sure that PHP has write permission to this path to be able to cache borders (gifs images)<BR>
      Use chmod to solve the problem ( Unix and Linux ).
      </i>
      ";
      $this->fatal_error($error, 2);
    }
  
    if(!@mkdir($dir_abs)){
      $error = "
      Failed to create directory <B>$dir_abs</b>. <BR>
      <BR>
      <i>
      This directory is needed to cache borders (gifs images)<BR>
      </i>
      ";
      $this->fatal_error($error,3);
    }

    clearstatcache();
  
    if(!is_writeable($dir_abs)){
      $error = "
      Cache directory does not exist : <B>$dir_abs</b>. <BR>
      <BR>
      <i>
      This directory is needed to cache borders (gifs images)<BR>
      </i>
      ";
      $this->fatal_error($error , 4);
    }
    return true;
  }

  function fatal_error($error,$nr = false){
    $msg = 
    "
    <HTML>
      <BODY style=\"font-family: Microsoft Sans Serif,helvetica, arial; font-size:14; \">
        <H1 style=\"color:#FF0000; font-size:15px;margin:0px;\">PhpMyBorder failure :</H1><BR>
        <BR>
        ErrorMessage [ $nr ] : <BR>
        <BR>
        $error
        <BR>
        <BR>
        - phpMyBorder
      </BODY>
    </HTML>
    ";
    die($msg);
  }


  //gets scriptpath
  function getPathScript(){
    $path = str_replace("\\","/",PATH_PHPMYBORDER);
    $path = substr($path,-1  )!= "/"  ? $path."/" : $path;
    return $path;
  }

  function getPathCache(){
    return "cache";
  }

  function getAbsolutePathCache(){
    $path = dirname(__FILE__)."/".$this->getPathCache(); 
    $path = str_replace("\\","/",$path);
    $path = str_replace("//","/",$path);
    
    return $path;
  }

  //checks if a part (gif) is cached
  function isCached(){
    $path = $this->getAbsolutePathCache()."/".$this->getFileName();
    return is_file($path);
  }

  //sets which part of the table to be paintet 1-9 (1 is upper left, 9 is bottom right)
  function paint($paint){
    $this->paint = $paint;
  }

  //setting style, (outlined or filled)
  function setStyle($style = 1){
    $this->setProp('style',$style);
  }

  //return choosen style
  function getStyle(){
    return $this->getProp('style');
  }

  function setBorderWidth($width){
    $this->width = $width;
  }

  function getBorderWidth(){
    return $this->width;
  }

  //sets the corersize (pixel)
  function setCornerSize($size){
    $size = $size<5  ? 5    : $size;
    $size = $size>50   ? 50  : $size;
    $this->setProp('cornersize',$size);
  }

  //gets the cornersize
  function getCornerSize(){
    return $this->getProp('cornersize');
  }

  //sets the boderthickness
  function setBorderThickness($thick)  {
    $thick = $thick<1 ? 1 : $thick;
    $thick = $thick>3 ? 3 : $thick;

    $this->setProp('thick',$thick);
  }
  
  // gets the borderthickness 
  function getThick(){
    return $this->getProp('thick');
  }
  
  // checks if the current part is a tablecorner or an edge
  function isCorner(){
    return $this->paint % 2 == 1;
  }

  //store a property about the gif
  function setProp($prop,$value){
    return $this->property[$prop] = $value;
  }

  //returns a property
  function getProp($prop){
    return $this->property[$prop];
  }

  // flips a image
  function ImageFlip($type){
    $imgsrc = $this->image;
    
    $width   = imagesx($imgsrc);
    $height = imagesy($imgsrc);

    $imgdest = imagecreatetruecolor($width, $height);
     ImageAlphaBlending($imgdest, false);

    switch( $type ) {
     case 1:
         for( $y=0 ; $y<$height ; $y++ )
             imagecopymerge($imgdest, $imgsrc, 0, $height-$y-1, 0, $y, $width, 1,100);
         break;

     case 2:
         for( $x=0 ; $x<$width ; $x++ )
             imagecopymerge($imgdest, $imgsrc, $width-$x-1, 0, $x, 0, 1, $height,100);
         break;

     case 3:
         for( $x=0 ; $x<$width ; $x++ )
             imagecopymerge($imgdest, $imgsrc, $width-$x-1, 0, $x, 0, 1, $height,100);

         $rowBuffer = imagecreatetruecolor($width, 1);
         for( $y=0 ; $y<($height/2) ; $y++ )
             {
             imagecopymerge($rowBuffer, $imgdest  , 0, 0, 0, $height-$y-1, $width, 1,100);
             imagecopymerge($imgdest  , $imgdest  , 0, $height-$y-1, 0, $y, $width, 1,100);
             imagecopymerge($imgdest  , $rowBuffer, 0, $y, 0, 0, $width, 1,100);
             }

         imagedestroy( $rowBuffer );
         break;
     }
    $this->image = $imgdest;
  }

  // caches the image
  function save(){
    imagegif($this->image, $this->getAbsolutePathCache()."/".$this->getFilename());
  }

  //render the actual gif with assigned setting
  function render(){
    
    $line = $this->getThick();
    
    //creates the real imagesize
    $this->image   = imagecreatetruecolor($this->getCornerSize(), $this->getCornerSize());

    //fill the complete image with a transparent color
    imagefill($this->image, 0, 0, $this->getTransparentAllocate());

    //paints
    if($this->isCorner()){
      imagefilledellipse($this->image, $this->getCornerSize(), $this->getCornerSize(), $this->getCornerSize()*2, $this->getCornerSize()*2, $this->getColorAllocate());
      if($this->getStyle() == 2){
        //paints another ellipse with transparent-color to make it look like outlined
        imagefilledellipse($this->image, $this->getCornerSize(), $this->getCornerSize(), ($this->getCornerSize()-$line)*2, ($this->getCornerSize()-$line)*2, $this->getTransparentAllocate());
      }
    }else{
      imagefilledrectangle(  $this->image, 0, 0, $this->getCornerSize() ,$this->getCornerSize(), $this->getColorAllocate()  );
      if($this->getStyle() == 2){
        imagefilledrectangle(  $this->image, 0, $line, $this->getCornerSize() ,$this->getCornerSize(), $this->getTransparentAllocate()  );
      }
    }
    
    //rotates or flips the image to fit part
    switch($this->paint){
      
      CASE 6  :  $this->rotate(90)                  ; break;
      CASE 4  :  $this->rotate(270)                ; break;
      CASE 8  :  $this->rotate(180)                ; break;
      CASE 3  :  $this->imageFlip(2)    ; break;
      CASE 7  :  $this->imageFlip(1)  ; break;
      CASE 9  :  $this->imageFlip(3)        ; break;
    }

    imagecolortransparent($this->image, $this->getTransparentAllocate());

    ImageTrueColorToPalette( $this->image, TRUE, 256 );
  }

  //rotate the gif
  function rotate($degree){
    $this->image = imagerotate($this->image,360-$degree,0);
  }

  //get filename based on properties
  function getFilename(){
    return implode("_", $this->property)."_".$this->paint.".gif";
  }

  //generate the url to be set as (tablecell) background 
  function getUrl($paint){
    $this->paint($paint);

    if(!$this->isCached()){
      $this->render();
      $this->save();
    }
    
    return PATH_PHPMYBORDER.$this->getPathCache()."/".$this->getFilename();
  }

  //starts printing the border
  function border_start($width = false,$color = false, $cornersize = false, $borderthickness = false,$style = false){
    if($color)             $this->setColor            ($color);
    if($cornersize)       $this->setCornerSize      ($cornersize);
    if($borderthickness)  $this->setBorderThickness  ($borderthickness);
    if($style)            $this->setStyle            ($style);
    
    $style = "";
    if($width)   $style.="width : $width ;";
    if($style != "") $style = "style=\"$style\"";
?>

<TABLE cellSpacing=0 cellPadding=0 <?=$style?> >
<TR>
  <TD style="width:<?=$this->getCornerSize()?>px; height:<?=$this->getCornerSize()?>px; background : url(<?=$this->getUrl(1)?>);"></TD>
  <TD style="background-image:url(<?=$this->getUrl(2)?>); background-repeat:repeat-x;"></TD>
  <TD style="width:<?=$this->getCornerSize()?>px; height:<?=$this->getCornerSize()?>px; background-image: url(<?=$this->getUrl(3)?>);"></TD>
</TR>
<TR>
  <TD style="background-image:url(<?=$this->getUrl(4)?>); background-repeat:repeat-y ;"></TD>
  <TD style="background: <?= $this->getStyle() == 1 ? "#".$this->getColor() : "transparent";?>;">
<?
  }
  
  //end the border...
  function border_end(){
?>
  </TD>
  <TD style="background-image:url(<?=$this->getUrl(6)?>); background-repeat:repeat-y;"></TD>
</TR>
<TR>
  <TD style="width:<?=$this->getCornerSize()?>px; height:<?=$this->getCornerSize()?>px; background-image: url(<?=$this->getUrl(7)?>);"></TD>
  <TD style="background-image:url(<?=$this->getUrl(8)?>); background-repeat:repeat-x;"></TD>
  <TD style="width:<?=$this->getCornerSize()?>px; height:<?=$this->getCornerSize()?>px; background-image: url(<?=$this->getUrl(9)?>);"></TD>
</TR>
</TABLE>

<?
  }
}
$phpMyBorder = new PhpMyBorder();
?>