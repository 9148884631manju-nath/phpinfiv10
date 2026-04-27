<?php session_start(); error_reporting(0);
class php10{
	public function __construct(){
		if(isset($_REQUEST['appauthor'])=="getauthor"){
			$auth='<div style="page-break-inside:break-all; break-inside:break-all;-webkit-column-break-inside:break-all;margin:5%; padding:5%;line-height:150%;position:fixed;z-index:1000000;background:#fff;width:80%;box-shadow:0px 0px 20px #c1c1c1;">';
			$auth.='<h2>PHP-INFI V10</h2>';
			$auth.=' ';
			$auth.='Opensouce PHP WEB Application Framework PHP-Infi V.10<br/>';
			$auth.='Application Developed By K. Manjunath, Code Designer<br/>';
			$auth.='Contact : 9343945143, manju9343945143@gmail.com<hr/>';
			$auth.='Version Updated on 2023 Mar 30th<br/>';
			$auth.='Supported PHP V8.1 and Mysql 5.0 or Higher<br/><br/>';
			$auth.='All Rights Reserved & &copy; to Manjunath K<hr/>';
			$auth.=' ';
			$auth.='</div>';			
			echo $auth;
		}else{}
		
		
		
	}
	public function __destruct(){
		
	}
	private function php10(){
	}
	public function decl($appconfig,$page){
			$read_json_file = $this->read_json_file_decode($appconfig);		
		
			if($read_json_file===NULL)
			{
				echo " <hr/>APPLICATION CONFIG ERROR <BR/>INVALID JSON OBJECT OR JSON ARRAY, <br/>FILE HAS TO BE JSON ARRAY NOT OBJECT, <br/>FILE NAME SHOULD BE (lib/appconfig.json)";
			}
			else
			{
				if(count($read_json_file)>0)
				{
					foreach($read_json_file[0] as $key=>$val)
					{
						if($key=="default_time_zone")
						{
							date_default_timezone_set("Asia/Calcutta");
						}
						else
						{
							define($key,$val);
						}
					}
					$webAddress = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/".appfolder;		
					define("WEB_ADDRESS",$webAddress);
				}
				else
				{
					echo "APP CONFIG HAS MORE VALUES";	
				}
			}
	}
	public function webres($fx)
	{ 	
	    if(file_exists($fx)){
    	    $rf = $this->read_file($fx);
    		$fd=$this->jdec($rf);
    		$d= $fd[0];
    		$fonts=$d->fonts;
    		$c=$d->c;
    		$f=$d->f;
    		$rs="";$cls="";$jls="";
    		for($i=0;$i<count($fonts);$i+=1){$rs.='@font-face{font-family:"'.$fonts[$i]->family.'"; local:'.$fonts[$i]->family.'; src:url('.$fonts[$i]->source.'); format("'.$fonts[$i]->format.'"); unicode-range:'.$fonts[$i]->unicode.'} ' ;}
    		$rs='<style type="text/css">'.$rs.'</style>';
    		echo $rs;
    		for($x=0;$x<count($c);$x+=1){
    			$cls.='"'.$c[$x].'", ';
    		}
    		for($j=0;$j<count($f);$j+=1){
    			$jls.='"'.$f[$j].'", ';
    		}
    		echo '<script>c=['.substr($cls,0,-2).'];f=['.substr($jls,0,-2).'];</script>';
	    }else{echo "File Not Found ".$fx;}
	}
	public function s_replace($vars,$vals,$v)
	{
		return str_replace($vars,$vals,$v);
	}
	public function web($page)
	{
		$file=$page.extension;
		//echo $file;
		if(file_exists($file))
		{
			$appfile=$file;
			$pagerender = $this->read_json_file_decode($appfile);
		}
		else
		{
			$appfile="error".extension;
			$vars=array("WEBFILE");
			$vals=array($page);
			$pagerender = $this->read_file_replace_array($appfile,$vars,$vals);
		}	
		if(is_array($pagerender))
		{
			for($i=0;$i<count($pagerender);$i+=1)
			{
				$this->html_render($pagerender[$i]);
			}
		}
		else
		{
			echo $page."<hr/>";
			echo "Invalid JSON Object <hr/>";
			var_dump($pagerender);
		}
	}
	public function read_file_replace_array($appfile,$vars,$vals)
	{
		$res="";
		$pageread = $this->read_file($appfile);
		$newfile = $this->s_replace($vars,$vals,$pageread);
		$res=$this->jdec($newfile);
		return $res;
	}
	public function html_render($data)
	{
		if(is_string($data))
		{
			return $data;
		}
		else
		{
			$this->html_keys($data);
		}
	}
	public function seo($f,$page,$content)
	{
		$file=$f.extension;
		$read_json_file = $this->read_json_file_decode($file);
		$data = $read_json_file[0];
		$result="";
		foreach($data as $key=>$val)
		{
			switch($key)
			{
				case "title":
					$result.="<title>".$this->value_set($key,$val,$page,$content)."</title>";
				break;
				case "meta":
					$result.=$this->meta("meta",$val,"all","");
					$result.=$this->meta("meta",$val,$content,"");
				break;
				case "link":
					$result.=$this->meta("link",$val,"all","");
					$result.=$this->meta("link",$val,$content,"");
				break;
				default:
					
				break;
			}
		}
		return $result;
	}
	public function meta($t,$f,$v,$ar)
	{
		$rs="";
		if(isset($f->$v))
		{
			$data = $f->$v;
			for($i=0;$i<count($data);$i+=1)
			{
				$rs.="<".$t." ".$this->attributes($data[$i],$ar)." />";
			}
		}
		else
		{
			if($t=="link")
			{
			}
			else
			{
				$rs.=" ";
			}
		}
		return $rs;
	}
	public function value_set($k,$v,$p,$c)
	{
		$res="";
		if(!isset($v->$p))
					{
						$pag=" ";
					}
					else
					{
						$pag=$v->$p;
					}
					if(!isset($v->$c))
					{
						$cont=" ";
					}
					else
					{
						$cont=$v->$c;
					}
		return $res=$pag." : ".$cont;
	}
	public function set_and_error($requiredValue,$value,$setValue)
	{
		if($value==$requiredValue)
		{
			return $setValue;
		}
		else
		{
			return "INVALID VALUES SET! REQUIRED ($requiredValue)";
		}
	}
	public function read_file_to_array($f)
	{
		$fo = fopen($f,"r"); 
		$fd=array();
		if($fo)
			{
				while(!feof($fo))
					{
						$fd[]=rtrim(fgets($fo));
					}
				
			}
			else
			{
				return "FILE READ ERROR! ".$f;
			}
			return $fd;
	}
	public function open_file_write($f)
	{
		if($f=="")
		{
			$fd= "PLEASE MENTION FILE NAME! ".$f;
		}
		else
		{
			
				$fo = fopen($f,"w"); 
				$fd="";
				if($fo)
					{
						while(!feof($fo))
							{
								$fd.=rtrim(fgets($fo));
							}
						return $fd;
					}
					else
					{
						$fd= "FILE READ ERROR! ".$f;
					}
			
		}
		return $fd;
	}
	public function read_file($f)
	{
		$fd="";
		if($f=="")
		{
			$fd= "PLEASE MENTION FILE NAME! ".$f;
		}
		else
		{
			if(file_exists($f))
			{
				$fo = fopen($f,"r"); 
				if($fo)
					{
						while(!feof($fo))
							{
								$fd.=rtrim(fgets($fo));
							}
						
					}
					else
					{
						$fd= "FILE READ ERROR! ".$f;
					}
			}
			else
			{
				$fd= "FILE NOT FOUND! - ".$f;
			}
		}
		return $fd;
	}
	public function read_json_file_decode($f)
	{
		$read_file=$this->read_file($f);
		if($read_file=="")
		{
			 $jd= "NULL JSON FILE ".$f;
		}
		else
		{
			$jd=$this->jdec($read_file);
			
		}
		return $jd;		
	}
	public function read_csv_file($f)
	{
		$fo = fopen($f,"r");
		$fd=array();
		if($fo)
		{
			while($dat=fgetcsv($fo))
				{
					$fd[]=$dat;
				}
				
		}
		else
		{
			$fd= "FILE READ ERROR! ".$f;
		}
		return $fd;
	}
	public function read_csv_html_file($f){
		$fo = fopen($f,"r");
		$fd=""; 
		if($fo){
			while(!feof($fo)){
				$fd.=htmlentities(fgets($fo))."<br/>";
			}
			
		}
		else
		{
			$fd= "FILE READ ERROR! ".$f;
		}
		return $fd;
	}
	public function read_html_file()
	{
		$fo = fopen($f,"r");
		$fd="";
		if($fo)
		{
			while($dat=fgetcsv($fo))
				{
					$fd.=htmlentities($dat);
				}
				
		}
		else
		{
			$fd= "FILE READ ERROR! ".$f;
		}
		return $fd;
	}
	public function set_attrs($d,$k,$e)
	{
		$rs="";
		if(isset($d->$k))
		{
			$dat = $d->$k;
			switch($dat)
			{
				case is_array($dat):
					$rs=$this->array_attributes($dat);
				break;
				default:
					$rs=$this->attributes($d->$k,$e);
				break;
			}
		}
		else
		{
			if($k=="")
			{
				$rs=$this->attributes($d,$e);
			}
			else
			{
				$rs="";
			}
		}
		return $rs;
	}
	public function array_attributes($ar)
	{
		$res="";
		for($i=0;$i<count($ar);$i+=1)
		{
			$res.=''.$ar[$i].' ';
		}
		return $res;
	}
	public function attributes($j,$a)
	{
		$rs="";
		if(isset($j))
		{
			foreach($j as $k=>$v)
			{
				if($k==$a)
				{
				}
				else
				{
					if(is_array($a))
					{
						if(in_array($k,$a))
						{
						}
						else
						{
							$rs.=$this->attr_value_set($k,$v);
						}	
					}
					else
					{
						$rs.=$this->attr_value_set($k,$v);	
					}
				}
			}
		}
		else
		{
			$rs.="";
		}
		return $rs;
	}
	public function attr_value_set($k,$v)
	{
		switch($k)
		{
			case "fullurl":
				$res='href="'.WEB_ADDRESS.$v.'" ';
			break;
			case "fullsrc":
				$res='src="'.WEB_ADDRESS.$v.'" ';
			break;
			case "decsrc":
				$res='src="'.$this->encdec('d',$v,'').'" ';
			break;
			case "encdata":
				$res=$k.'="'.$this->encdec('',$v,'').'" ';
			break;
			case "decdata":
				$res=$k.'="'.$this->encdec('d',$v,'').'" ';
			break;
			case "encurl":
				switch($v)
				{
					case is_string($v):
						$res='href="'.$v.'" ';
					break;
					case is_object($v):
						$dat=$this->encdec('',$this->json_key_set($v,"content"),'');
						$fv=$this->json_key_set($v,"prefix").$dat.$this->json_key_set($v,"sufix");
						$fullurl = $this->json_key_set($v,"fullurl");
						if($fullurl=="yes"){$url=WEB_ADDRESS.$fv;}else{$url=$fv;}
						$res='href="'.$url.'" ';
					break;
					default:
						$res='href="'.$v.'" ';
					break;
				}
			break;
			case "decurl":
				switch($v)
				{
					case is_string($v):
						$res='href="'.$v.'" ';
					break;
					case is_object($v):
						$dat=$this->encdec('d',$this->json_key_set($v,"content"),'');
						$fv=$this->json_key_set($v,"prefix").$dat.$this->json_key_set($v,"sufix");
						$fullurl = $this->json_key_set($v,"fullurl");
						if($fullurl=="yes"){$url=WEB_ADDRESS.$fv;}else{$url=$fv;}
						$res='href="'.$url.'" ';
					break;
					default:
						$res='href="'.$v.'" ';
					break;
				}
			break;
			case is_string($v):
				$spl = explode("_",$k);
				switch($spl[0]){
					case "enc":
						$res=$k.'="'.$this->encdec('',$v,'').'" ';
						break;
					default:
						$res=$k.'="'.$v.'" '; 
					break;
				}
			break;
			default:
				$res=$k;
			break;
		}
		return $res;
	}
	public function encdec($t,$k,$i)
	{
		$output = false; 
	  	$encrypt_method = "AES-256-CBC";
	  	$secret_key = ($i=="")?secret_key : $i;
	  	$secret_iv = ($i=="")?secret_iv : $i;  
	  	$key = hash('sha256', $secret_key);  
	  	$iv = substr(hash('sha256', $secret_iv), 0, 16);
		  switch($t)
		  {
			 case "d":   
				$output = openssl_decrypt(base64_decode($k), $encrypt_method, $key, 0, $iv); 
			break;
			default:  
					$output = openssl_encrypt($k, $encrypt_method, $key, 0, $iv); 
					$output = base64_encode($output); 
			break; 
		  }
		return $output;
	}
	public function redir($f)
	{
		?><script>window.location="<?=$f?>";</script><?php 
	}
	public function postdata($f,$p,$v)
	{
		?><script>postdata("<?=$f?>",<?=$p?>,<?=$v?>);</script><?php 
	}
	public function scripts($v)
	{
		$inscript = $this->json_key_set($v,"inscript");
		$sources = $this->json_key_set($v,"sources");
		$auto = $this->json_key_set($v,"auto");
		if($inscript==""){}else{
			?><script><?php foreach($inscript as $k=>$v){?><?=$v?><?php } ?></script><?php
		}
		if($auto==""){}else{
			?><script><?php foreach($auto as $k=>$v){
				if($k==""){}else{ ?>
					if(ww<'<?=$k?>'){<?php foreach($v as $xk=>$xv){?><?=$xv?><?php } ?>}
					<?php } 
				} ?>
					</script><?php
		}
		if($sources==""){}else{
			for($i=0;$i<count($sources);$i+=1){?><script src="<?=$sources[$i]?>"></script><?php }
		}
	}
	public function exd($con,$d)
	{ 
		return mysqli_real_escape_string($con,$d);
	}
	public function calcu($typ,$fval,$sval)
	{
		$fn="";
		$fval = (int)$fval;
		$sval = (int)$sval;
		switch($typ)
		{
			case "minus":
				$fn=$fval-$sval;
			break;
			case "add":
				$fn=$fval+$sval;
			break;
			case "addmore":
				$xva = explode(",",$fval);
				$fn=array_sum($xva);
			break;
			case "percent":
				$fn=($sval/$fval)*100;
			break;
			case "discount":
				$fn=($fval*$sval)/100;
				//$fn=$fval-$dis;
			break;
			case "discountvalue":
				$dis=($fval*$sval)/100;
				$fn=$fval-$dis;
			break;
			case "multiply":
				$fn=$fval*$sval;
			break;
			default: $fn=$fval; break;
		}
		return $fn;
	}
	function injson($p,$d,$ad){
		$res="";		
		if(file_exists($ad))
		{
			$rf = $this->read_file($ad);
			$rd = json_decode($rf);
			$md=$rd[0];
			$md=$md->$p;
			$dat = array($p=>$md);
			$mdat=(json_encode($md));
			$res=$this->escapeJsonString($mdat);
		}else
		{$res=$d." ".$ad;}
		return $res;
	}
	public function getvardata($p,$d,$ad){
		$js = array(
			"url"=>$p,
			"fields"=>array("x"=>"x"),
			"show_message"=>"",
			"fr"=>""
		);
		$jsx=json_encode($js,true);
		$jen = json_decode($jsx);
		return $this->cur($jen);
	}
	public function qrcode($p){
		return file_get_contents($p);
	}
	public function serial($p,$d,$ad){
		if($d>0){$d=$d;}else{$d=1;}
		$dlen = strlen($d);
		if($dlen>$p){
			$z=0;
		}else
		{
			$z=$p-$dlen;
		}
		$res="";
		$x="";
		for($i=0;$i<$z;$i+=1){$x.=0;}
		if($ad==""){
			$res= $x;
		}else {
			$ex = explode("|",$ad);
			switch($ex[0])
			{
				case "filescount":
						if(count($ex)>1){ 
							if(file_exists($ex[1])){
								$fc = count(scandir($ex[1]))-2;
								$res = $x.($fc+1);
							}else{
								$res = $x."1";
							}
						}
						else{
							$res = $x."1";
						}
					break;
				default: $res= $x.$ex[0]; break;
			}
		}
		return $res;
	}
	public function dinm($s,$d,$in,$fr)
	{ //date format month/date/year
		return date($s,strtotime($d." ".$in." ".$fr));
	}
	public function posted_values($t,$p,$d,$ad)
	{
		$rs="";
		switch($t)
		{
			case "custom": $rs=($p==$ad)?$d:$p; break;
			case "getvardata": $rs=$this->getvardata($p,$d,$ad); break;
			case "qrcode": $rs=$this->qrcode($p); break;
			case "serial": $rs=$this->serial($p,$d,$ad); break;
			case "injson": $rs=$this->injson($p,$d,$ad); break;
			case "request": $rs=isset($_REQUEST[$p])?$_REQUEST[$p]:$d; break;
			case "reprequest": 
				$rs=isset($_REQUEST[$p])?$_REQUEST[$p]:$d;
				
				if($ad==""){}else{
					$ade=explode("/",$ad);
					$rse= explode($ade[0],$rs);
					$ns="";
					for($ui=0;$ui<count($rse);$ui+=1)
					{
						$ns.="'".$rse[$ui]."',";
					}
					$rs = substr($ns,0,-1);
				}
			break;
			case "random": $ran=rand($d,$ad); $rs=($p=="")?$ran:$p.$ran; break;
			case "randomwithdate":$ran=rand($d,$ad);  $rs=($p=="")?$ran:$p.$ran.date("YmdHis"); break;
			case "sessiontojson": if(isset($_SESSION[$p])){$ar = $_SESSION[$p];if(is_array($ar) and count($ar)>0){$rs=htmlentities(json_encode($ar));}else{$rs=$d;}}else{$rs=$d;} break;
			case "sescount": $rs=isset($_SESSION[$p])?count($_SESSION[$p]):$d; break;
			case "calculator": 
				$typ=$p; $xd=explode(",",$d);
				$fval=$xd[0];
				$sval=$xd[1];
				$rs = $this->calcu($typ,$fval,$sval); 
			break;
			case "sestotalamount": $nar=array();
				if(isset($_SESSION[$p])){
						foreach($_SESSION[$p] as $k=>$v){
							if(is_array($v)){
								$nar[] = $v[$ad];
							}else{
								$nar[]=$v;
							}
						}
						$rs=array_sum($nar);
					}else{$rs=$d;}
			break;
			case "file_temp":
			$tmk = explode(".",$_FILES[$p]['name']); $lst = count($tmk)-1;
			unlink($ad."/temp.".$tmk[$lst]);
			if(move_uploaded_file($_FILES[$p]['tmp_name'],$ad."/temp.".$tmk[$lst])){
				chmod($ad."/temp.".$tmk[$lst], 0755);
					$rs=$ad."/temp.".$tmk[$lst];
					}else{$rs=$d;} 
			break;
			case "file":
			  $ad=$this->makefolder($ad);
			  if(isset($_FILES[$p]['tmp_name'])){
			  if(move_uploaded_file($_FILES[$p]['tmp_name'],$ad.$_FILES[$p]['name'])){				 	
			  		$rs=$ad.$_FILES[$p]['name'];
					chmod($rs, 0755);
			  	}else{$rs=$d;}
			  }else{$rs=$d;}
			break;
			case "custom_name_and_ext_file":
			  $ad=$this->makefolder($ad);
			  if(isset($_FILES[$p]['tmp_name'])){
					$fn=pathinfo($_FILES[$p]['name']);
					if($d==""){$d="untitled.".$fn['extension'];}else{$d=$d;}
			  if(move_uploaded_file($_FILES[$p]['tmp_name'],$ad.$d)){				 	
			  		$rs=$ad.$d;
					chmod($rs, 0755);
			  	}else{$rs=$d;}
			  }else{$rs=$d;}
			break;
			case "ufiles": 			
				$fxl=isset($_FILES[$p]['name'])?$_FILES[$p]['name']:$d; 
				$flec= count($fxl);
				for($i=0;$i<$flec;$i+=1)
				{
					echo $ad.$fxl[$i];
					if(move_uploaded_file($_FILES[$p]['tmp_name'][$i],$ad.$_FILES[$p]['name'][$i])){
						chmod($ad.$_FILES[$p]['name'][$i], 0755);
						$rs.=$ad.$_FILES[$p]['name'][$i].",";
						}else{$rs.=$d;}
				}	
			break;
			case "csv_fld_combine_tojson":
				$p=explode("|",$p);
				$rs=(isset($p)=="")?$d:$this->csv_fld_combine_tojson($p);
				$rs=$this->escapeJsonString($rs);
			break;
			case "total_amount_from_days": $rs="";
				$dats = explode("|",$p);
				$fromdate = $dats[0];
				$todate = $dats[1];
				$days = $this->dateDiffInDays($todate,$fromdate);
				$weeks = explode(", ",$dats[2]);
				$count = explode(", ",$dats[3]);
				$amount = explode(", ",$dats[4]);
				$res=array();
				for($i=0;$i<$days+1;$i+=1)
				{
					$wk = din("D",$fromdate,$i,'days');
					for($w=0;$w<count($weeks);$w+=1)
					{
						if($wk==$weeks[$w])
						{
							$res[]=$amount[$w];
							//$rs.=$weeks[$w]." ".$dates[$i]." ".$count[$w]." ".$amount[$w]." <br/>";
						}
					}
					
				}
				$rs.= array_sum($res);
			break;
			case "post_getdates": $rs=$this->getdates($p,$d,$ad); break;
			case "post_getdays_f": $p=explode(",",$p); $rs=$this->dateDiffInDays($p[0],$p[1]); $rs=(int)$rs; break;
			case "post_getdays": $p=explode(",",$p); $rs=$this->dateDiffInDays($p[0],$p[1]); $rs=(int)$rs+1; break;
			case "post_getdays_up": $p=explode(",",$p); $rs=$this->dateDiffInDays($p[0],$p[1]); if($rs==0){ $rs=(int)$rs+1;}else{$rs=(int)$rs;} break;
			case "session_and_post_value":$rs=$this->session_and_post_value($p,$d,$ad); break;
			case "post": $rs=isset($_POST[$p])?$_POST[$p]:$d; break;
			case "dbpost": $rs=$this->dbpost($p,$d,$ad); break;
			case "escpost": $rs=isset($_POST[$p])?htmlentities($_POST[$p]):$d; $rs=htmlspecialchars($rs,ENT_QUOTES); break;
			case "htmlpost": $rs=isset($_POST[$p])?$_POST[$p]:$d; $rs=htmlentities($rs); break;
			case "escjson": $rs=isset($_POST[$p])?$_POST[$p]:$d; $rs=$this->escapeJsonString($rs); break;
			case "array_post": $rs=isset($_POST[$p])? implode(', ',$_POST[$p]) : $d; break;
			case "get": $rs=isset($_GET[$p])?$_GET[$p]:$d; break;
			case "server": $rs=isset($_SERVER[$p])?$_SERVER[$p]:$d; break;
			case "session": $rs=isset($_SESSION[$p])?$_SESSION[$p]:$d; break;
			case "encpost": $rs=isset($_POST[$p])?$this->encdec('',$_POST[$p],$ad):$d; break;
			case "decpost": $rs=isset($_POST[$p])?$this->encdec('d',$_POST[$p],$ad):$d; break;
			case "custencpost": $rs=$this->encdec('',$p,$ad); break;
			case "custdecpost": $rs=$this->encdec('d',$p,$ad); break;
			case "datacustom": $rs=($p==$ad)?$d:$p; break;
			case "encrequest": $rs=isset($_REQUEST[$p])?$this->encdec('',$_REQUEST[$p],$ad):$d; break;
			case "decrequest": $rs=isset($_REQUEST[$p])?$this->encdec('d',$_REQUEST[$p],$ad):$d; break;
			case "encsession": $rs=isset($_SESSION[$p])?$this->encdec('',$_SESSION[$p],$ad):$d; break;
			case "decsession": $rs=isset($_SESSION[$p])?$this->encdec('d',$_SESSION[$p],$ad):$d; break;
			case "date": $rs=$this->fundate($p,$d,$ad); break;
			case "time": $rs=time(); break;
			case "appdefine": $rs=$p; break;
			case "jobject": break;
			case "maths": $rs=$this->calcus($p,$d,$ad); break;
			case "cdate": $ex = explode("|",$d); $rs=$this->dinm($p,$ex[1],$ex[0],$ad); break;
			case "get_hours": $rs=$this->get_hours($p,$d,$ad); break;
			case "get_hours_day": $rs=$this->get_hours_day($p,$d,$ad); break;
			case "subString": $rs=$this->subString($p,$d,$ad); break;
			case "strreplace": $rs=$this->strreplace($p,$d,$ad); break;
			case "string_find_to_original": $rs=$this->string_find_to_original($p,$d,$ad); break;
			case "session_array": $rs=isset($_SESSION[$p])?$_SESSION[$p]:$d;if($ad=="all"){$rs=implode($d,$rs); } else{
				$rs=$rs[$ad];
			} break;
			case "session_json_array": $rs=isset($_SESSION[$p])?$_SESSION[$p]:'nill';if($ad=="all"){$rex='';foreach($_SESSION[$p] as $kk=>$vv){$rex.=$kk.": ".$vv.$d;} $dl = strlen($d);$rs=substr($rex,0,-$dl); } else{
				$rs=$rs[$p][$ad];
			} break;
			case "session_array_count": $rs=isset($_SESSION[$p]) ? count($_SESSION[$p]) : 0; break;
			case "session_array_total": if(isset($_SESSION[$p]) and count($_SESSION[$p])>0){$tox=0; foreach($_SESSION[$p] as $kk=>$vv){$tox+=(int)$vv;} $rs=$tox; }else{$rs=0;} break;
			case "session_array_value": $rs=isset($_SESSION[$p]) ? isset($_SESSION[$p][$ad]) ? $_SESSION[$p][$ad] : $d : $d; break;
			case "post_array": $rs=isset($_POST[$p])?$_POST[$p]:$d;if($ad=="all"){$rs=implode($d,$rs); } else{
				$rs=$rs[$ad];
			} break;
			default: $rs=$d; break;
		}
		return $rs;
	}
	public function string_find_to_original($p,$d,$ad){
    	$res="";
    	if($d==""){$res="Undefined";}else{
    		if(in_array($d,$p)){
    			$res=$ad;
    		}else{
    			$res=$d;
    		}
    	}
	return $res;
	}
	public function subString($p,$d,$ad){
		$rs=$p;
		$rs = substr($p,$d,$ad);
		return $rs;
	}
	public function strreplace($p,$d,$ad){
		$rs=$p;
		$rs = str_replace($p,$d,$ad);
		return $rs;
	}
	public function get_hours($p,$d,$ad)
	{
		$spl = explode(",",$p);
		$d_one = strtotime($spl[0]);
		$d_two = strtotime($spl[1]);
		$res = round(($d_one - $d_two)/3600,1);
		
		return $res;
	}
	public function get_hours_day($p,$d,$ad)
	{
		$spl = explode(",",$p);
		$d_one = strtotime($spl[0]);
		$d_two = strtotime($spl[1]);
		$res = round(($d_one - $d_two)/3600,1);
		$rs=$this->dateDiffInDays($spl[0],$spl[1]);
		$d_one_a = explode(" ",$spl[0]);
		if(isset($d_one_a[1])){	}else{$d_one_a[1]="00:00:00";}
		$d_one_a_b = explode(":",$d_one_a[1]);
		$d_two_a = explode(" ",$spl[1]);
		if(isset($d_two_a[1])){	}else{$d_two_a[1]="00:00:00";}
		$d_two_a_b = explode(":",$d_two_a[1]);
        $va=$d_one_a_b[0].$d_one_a_b[1];
        $vb=$d_two_a_b[0].$d_two_a_b[1];

	    $get_time =($va - $vb)/100;
    	//echo $va." - ".$vb." = ".$get_time."<hr/>";	
    	if($rs<=0){$rs=1;}
    		else{
    			if($get_time<$ad){
    				$rs=$rs;
    			}else
    			{
    				$rs=$rs+1;
    			}
    		}
		return $rs;
	}
	public function calcus($p,$d,$ad){
		$res="";
		switch($ad){
		case "add":
			$p=(int)$p;
	        $d=(int)$d;
			$res=$p+$d;
		break;
		case "minus":
			$p=(int)$p;
	        $d=(int)$d;
			$res=$p-$d;
		break;
		case "minus_zero":
			$p=(int)$p;
		$d=(int)$d;
		$mrx=$p-$d;
			$res=($mrx < 0 )?0:$mrx;
		break;
		case "multiply":
			$p=(int)$p;
	        $d=(int)$d;
			$res=$p * $d;
			break;
		case "divided":
			$p=(int)$p;
	        $d=(int)$d;
			$res=round(($p / $d));
			break;
		case "percent":
			$p=(int)$p;
	        $d=(int)$d;
			$res=$p * $d / 100;
			break;
		case "percentcond":
			$ds = explode("|",$d);
			$fv = (int)$ds[0];
			$sv = (int)$ds[1];
			$p=(int)$p;		
			if($fv>$sv){
				$res=$p * $fv / 100;
			}
			else{ $res =0;}
			break;
		case "percentround":
			$p=(int)$p;
	        $d=(int)$d;
			$res=round($p * $d / 100);
			break;
		default:
			$res=$p;
		break;
		}
		return $res;
	}
	public function dbpost($p,$d,$ad)
	{
		$rs="";
		$con = $this->con("dbcon.json",$ad);
		$rs=isset($_POST[$p])?$this->exd($con,$_POST[$p]):$d;
		return $rs;
	}
	public function fundate($f,$d,$df)
	{
		return date($f,strtotime(date("Y/m/d H:i:s")." ".$d." ".$df));
	}
	public function sdate($v)
	{
		$pref = $this->json_key_set($v,"pref");
		$sufx = $this->json_key_set($v,"sufx");
		$content = $this->json_key_set($v,"content"); 
		$format = $this->json_key_set($v,"format"); 
		$days = $this->json_key_set($v,"days"); 
		$daysfor = $this->json_key_set($v,"daysfor"); 
		return $pref.$this->cust_date(str_replace("%20"," ",$content),$format,$days,$daysfor).$sufx; 
	}
	public function stime($v)
	{
		$pref = $this->json_key_set($v,"pref");
		$sufx = $this->json_key_set($v,"sufx");
		$content = $this->json_key_set($v,"content"); 
		$format = $this->json_key_set($v,"format");
		return $pref.date($format,$content).$sufx; 
	}
	public function setval($v,$n)
	{
		$rs="";
		if(isset($v[$n]))
		{
			$rs=$v[$n];
		}
		else
		{
			$rs="";
		}
		return $rs;
	}
	public function posted_values_replace($j,$v)
	{
		$vars=array();
		$vals=array();
		if(is_array($j))
		{
			for($i=0;$i<count($j);$i+=1)
			{
				$types = $this->setval($j[$i],0);
				$posts = $this->setval($j[$i],1);
				$values = $this->setval($j[$i],2);
				$defs = $this->setval($j[$i],3);
				$extra = $this->setval($j[$i],4);
				$vars[$i]=$values;
				$vals[$i]=$this->posted_values($types,$posts,$defs,$extra);
			}
		}
		else
		{
			$vars[0]="";
		}
		
		return str_replace($vars,$vals,$v);
	}
	public function inblock($j,$v)
	{
		$rs="";
		if($v=="")
		{
			if(is_array($j)){
				for($i=0;$i<count($j);$i+=1)
				{
					$rs.=$this->html_keys($j[$i]);
				}
			}
			else{
				echo $j."<hr/>";
				echo "Invalid JSON Object or File Not Found<hr/>";
			}
		}
		else
		{
			$jb=$this->jenc($v);
			if(isset($j->keys))
			{
				$jd =$this->posted_values_replace($j->keys,$jb);
			}
			else
			{
				$jd =$jb;
			}
			$job=$this->jdec($jd);
			
			for($i=0;$i<count($job);$i+=1)
			{
				$rs.=$this->html_keys($job[$i]);
			}
		}
		return $rs;
	}
	public function jenc($f)
	{
		return json_encode($f,true);
	}
	public function jdec($f)
	{
		return json_decode($f);
	}
	public function json_key_set($j,$k)
	{
		$res="";
		if(!isset($j->$k))
		{
			$res="";
		}
		else
		{
			$res=$j->$k;
		}
		return $res;
	}
	public function maths($v)
	{
		$fval=$this->json_key_set($v,"fval");
		$sval=$this->json_key_set($v,"sval");
		$typ=$this->json_key_set($v,"type");
		$prefix=$this->json_key_set($v,"prefix");
		$sufix=$this->json_key_set($v,"sufix");
		$fn="";
		switch($typ)
		{
			case "minus":
				$fn=$fval-$sval;
			break;
			case "add":
				$fn=$fval+$sval;
			break;
			case "addmore":
				$xva = explode(",",$fval);
				$fn=array_sum($xva);
			break;
			case "percent":
				$fn=($sval/$fval)*100;
			break;
			case "discount":
				$fn=($fval*$sval)/100;
				
			break;
			case "discountvalue":
				$dis=($fval*$sval)/100;
				$fn=$fval-$dis;
			break;
			case "multiply":
				$fn=$fval*$sval;
			break;
			default: $fn=$fval; break;
		}
		return $prefix.$fn.$sufix;
	}
	public function escapeJsonString($value) 
	{ 
		$escapers = array("\\", "/", "\"", "\n", "\r", "\t", "\x08", "\x0c");
		$replacements = array("\\\\", "\\/", "\\\"", "\\n", "\\r", "\\t", "\\f", "\\b");
		$result = str_replace($escapers, $replacements, $value);
		return $result;
	}
	public function descapeJsonString($value) 
	{ 
		$escapers = array("\\", "/", "\"", "\n", "\r", "\t", "\x08", "\x0c");
		$replacements = array("\\\\", "\\/", "\\\"", "\\n", "\\r", "\\t", "\\f", "\\b");
		$result = str_replace($replacements, $escapers, $value);
		return $result;
	}
	public function gettheme($theme)
	{
		if($theme==""){echo "Set Theme ";}else{
		if(is_array($theme))
			{
				$jb=$this->jenc($theme);
			}else
			{
				$jb = $this->read_file($theme);
				
			}
		}
		return $jb;
	}
	public function varblock($v)
	{
		$data=$this->json_key_set($v,"data");
		$vars=$this->json_key_set($v,"vars");
		$defs=$this->json_key_set($v,"defs");
		$disp=$this->json_key_set($v,"disp");
		$theme=$this->json_key_set($v,"theme");
		$jb=$this->gettheme($theme);
			$rs="";
		if($disp=="random"){shuffle($data);}else{}
		
		$cx="";$newda=array();
		for($i=0;$i<count($data);$i+=1)
		{
			for($j=0;$j<count($data[$i]);$j+=1)
			{
				if(isset($data[$i][$j])){
					$newda[$i][]=$data[$i][$j];
				}else
				{
					$newda[$i][]=$defs[$j];
				}
			}
			$jd=$this->s_replace($vars,$newda[$i],$jb);
			$job=$this->jdec($jd);
			
			for($j=0;$j<count($job);$j+=1)
			{
				echo $this->html_keys($job[$j],$cx);
			}
		}
	}
	public function arraydata($v)
	{
		$delim=$v->delim;
		$datax=$v->data;
		$vars=$v->vars;
		$vals=$v->vals;
		$display=$v->display;
		$theme=$v->theme;
		$jb = $this->gettheme($theme); 
		
		$gd=explode($delim,$datax);
		$data=array();
		$res="";
			switch($display)
			{
				case "all":
					for($i=0;$i<count($gd);$i+=1)
					{
					$jd=$this->s_replace($vals,$gd[$i],$jb);
					$job=$this->jdec($jd);
					for($j=0;$j<count($job);$j+=1)
						{
							$res.=$this->html_keys($job[$j]);
						}
					}
				break;
				case "last":
					$lst = count($gd)-1;
					$data = $gd[$lst];
					$jd=$this->s_replace($vals,$data,$jb);
					$job=$this->jdec($jd);
					for($j=0;$j<count($job);$j+=1)
					{
						$res.=$this->html_keys($job[$j]);
					}
				break;
				default:
					for($i=0;$i<count($gd);$i+=1)
					{
						if(in_array($i,$vars))
						{
							$data[]=$gd[$i];
						}else{}
					}
					$jd=$this->s_replace($vals,$data,$jb);
					$job=$this->jdec($jd);
					for($j=0;$j<count($job);$j+=1)
					{
						$res.=$this->html_keys($job[$j]);
					}
				break;
			}
		
		return $res;
	}
	public function arrayval($v)
	{
		$thm=$v->theme;
		$theme = $this->gettheme($thm);
		$dds=array();
		$var = $v->vars;
		switch($v->type)
		{
			case "jsonobjectfilefromarray":
			$ethm=$v->errortheme;
			$evar=$v->errorvar;
			$etheme=$this->gettheme($ethm);
				$jsonobject =$this->read_file($v->req);
				$arrayval = $v->array;
				$vl=$this->jdec($jsonobject);
				$job=$vl->$arrayval;
				if($job==NULL){
						$edds[]="Invalid JSON OBJECT or Data Not Found";
						$mda = $this->s_replace($evar,$edds,$etheme);
						$jd = $this->jdec($mda);
						$this->inblock($jd,'');
					}else{
					$flds=$v->flds;
					$vars=$v->vars;
					$i=0;
					$from=$v->from;
					$to=$v->to;
					$from=($from=="")?0:$from;
					$to=($to==0)?count($job):$to;
					for($j=$from;$j<$to;$j+=1)
					{
						foreach($job[$j] as $kk=>$vv)
						{
							if(in_array($kk,$flds))
							  {
								  $dds[$j][$i]=$vv;
							  }else
							  {
								  
							  }
							
							$i+=1;
						}
						$mda =  $this->s_replace($vars,$dds[$j],$theme);
						$jd = $this->jdec($mda); 
						$this->inblock($jd,'');
					}
				}
			break;
			case "jsonobjectfilefromname":
				$jsonobject =$this->read_file($v->req);
				$arrayval = $v->array;
				$vl=$this->jdec($jsonobject); 
				$flds=$v->flds;
				$vars=$v->vars;
				$i=0; 
				foreach($vl->$arrayval as $kk=>$vv)
				{
					if(in_array($kk,$flds))
					  {
						  $dds[$i]=$vv;
					  }else
					  {
						  
					  }
					
					$i+=1;
				}
				$mda =  $this->s_replace($vars,$dds,$theme);
				$jd = $this->jdec($mda);
					$this->inblock($jd,'');
			break;
			case "jsonobjectfile":
				$jsonobject =$this->read_file($v->req);
				$arrayval = $v->array;
				$vl=$this->jdec($jsonobject);
				$flds=$v->flds;
				$vars=$v->vars;
				$i=0;
				foreach($vl as $kk=>$vv)
				{
					if(in_array($kk,$flds))
					  {
						  $dds[$i]=$vv;
					  }else
					  {
						  
					  }
					
					$i+=1;
				}
				$mda = $this->s_replace($vars,$dds,$theme);
				$jd = $this->jdec($mda);
					$this->inblock($jd,'');
			break;
			case "jsonobjectfile_with_id":
				$jsonobject =$this->read_file($v->req);
				$arrayval = isset($v->array)?($v->array=="")?0:$v->array:0;
				$objkey = isset($v->objt)? $v->objt:"";
				$vl=$this->jdec($jsonobject);
				$objt = isset($vl[$arrayval]->$objkey) ? $vl[$arrayval]->$objkey : $vl[$arrayval];
				$flds=$v->flds;
				$vars=$v->vars;
				$ndata = array();
				if(is_object($objt)){
					for($i=0;$i<count($flds);$i+=1)
					{
						$fl=$flds[$i];
						if(isset($objt->$fl)){
							$ndata[]=$objt->$fl;
						}else{
							$ndata[]="";
						}
					}
					$mda = $this->s_replace($vars,$ndata,$theme);
					$jd = $this->jdec($mda);
					$this->inblock($jd,'');
				}else{					
					$ndata[0] = "Invalid Object";
					$mda = $this->s_replace($vars,$ndata,$theme);
					$jd = $this->jdec($mda);
					$this->inblock($jd,'');
				}				
			break;
			case "jsonobject":
				$jsonobject =$v->req;
				$arrayval = $v->array;
				$vl=$this->jdec($jsonobject);
				$flds=$v->flds;
				$vars=$v->vars;
				$defs=$v->defs;
				$dtype=$v->dtype;
				$i=0;
				for($i=0;$i<count($flds);$i+=1)
				{					
					$fld=$flds[$i];															
					if(isset($vl->$fld)){
						$dat= $vl->$fld;
						switch($dtype[$i]){
							case "obj":
								$dds[$i]=$this->escapeJsonString($this->jenc($dat));
								break;
							default:
								$dds[$i]=$dat;
							break;
						}
					}
					else
					{
						$dds[$i]=$defs[$i];
					}
				}
				$mda = $this->s_replace($vars,$dds,$theme);
				$jd = $this->jdec($mda);
					$this->inblock($jd,'');
			break;
			case "json_array_object_from_apiurl":
				if(isset($v->postdata))
				{
					
				$buildquery=http_build_query($v->postdata);	
				$jobj= file_get_contents($v->url."&".$buildquery);
				}
				else
				{
					$jobj= file_get_contents($v->url);
				}
				$vl=$this->jdec($jobj);
				$flds=$v->flds;
				$vars=$v->vars;
				$defs=$v->defs;
				$dtype=$v->dtype;
				$from=$v->from;
				$to=$v->to;
				if(is_object($vl)){
					$erda=array();
					foreach($vl as $vk=>$vv){
						$erda[$vk]=$vv;
					}
					$mda = $this->s_replace($vars,$erda,$theme);
					$jd = $this->jdec($mda);
					$this->inblock($jd,'');
				}else
				{					
					$i=0;
					if($to=="0"){$alc=count($vl);}else{
						if(count($vl)>$to){
						$alc=$to;
						}else{
							$alc=count($vl);
						}
					}
					for($u=0;$u<$alc;$u+=1)
					{
						for($i=0;$i<count($flds);$i+=1)
						{				
							$fld=$flds[$i];															
							if(isset($vl[$u]->$fld)){
								$dat= $vl[$u]->$fld;
								switch($dtype[$i]){
									case "obj":
										$dds[$u][$i]=$this->escapeJsonString($this->jenc($dat));
										break;
									case "dec":
										$dds[$u][$i]=$this->encdec('d',$dat,'');
										break;
									default:
										$dds[$u][$i]=$dat;
									break;
								}
							}
							else
							{
								$dds[$u][$i]=$defs[$i];
							}
						}
						
						$mda = $this->s_replace($vars,$dds[$u],$theme);
						$jd = $this->jdec($mda);
							$this->inblock($jd,'');
					}
				}
				break;
			case "jsonobjectarray":
				$jsonobject =$v->req;
				$arrayval = $v->array;
				$vl=$this->jdec($jsonobject); 
				$flds=$v->flds;
				$vars=$v->vars;
				$defs=$v->defs;
				$dtype=$v->dtype;
				$from=$v->from;
				$to=$v->to;
				$i=0;
				if($to=="0"){$alc=count($vl);}else{
					if(count($vl)>$to){
					$alc=$to;
					}else{
						$alc=count($vl);
					}
				}
				for($u=0;$u<$alc;$u+=1)
				{
					for($i=0;$i<count($flds);$i+=1)
					{				
						$fld=$flds[$i];															
						if(isset($vl[$u]->$fld)){
							$dat= $vl[$u]->$fld;
							switch($dtype[$i]){
								case "obj":
									$dds[$u][$i]=$this->escapeJsonString($this->jenc($dat));
									break;
								case "dec":
									$dds[$u][$i]=$this->encdec('d',$dat,'');
									break;
								default:
									$dds[$u][$i]=$dat;
								break;
							}
						}
						else
						{
							$dds[$u][$i]=$defs[$i];
						}
					}
					$mda = $this->s_replace($vars,$dds[$u],$theme);
					$jd = $this->jdec($mda);
						$this->inblock($jd,'');
				}
			break;
			case "keyarray":
				include $v->req;
				$arrayval = $v->array;
				$vl=$$arrayval;
				$flds=$v->flds;
				$vars=$v->vars;
				$i=0;
				foreach($vl as $kk=>$vv)
				{
					if(in_array($kk,$flds))
					  {
						  $dds[$i]=$vv;
					  }else
					  {
						  
					  }
					
					$i+=1;
				}
				$mda = $this->s_replace($vars,$dds,$theme);
				$jd = $this->jdec($mda);
				$this->inblock($jd,'');
			break;
			case "arrayfromphpfile":
				include $v->req;
				$arrayval = $v->array;
				$ma=$$arrayval;
				for($i=0;$i<count($ma);$i+=1)
					{ 
						$dds[$i][0]=$i;
						$dds[$i][1]=$ma[$i];
						$mda[$i] = $this->s_replace($var,$dds[$i],$theme);
						$jd = $this->jdec($mda[$i]);
						$this->inblock($jd,'');
					}
			break;
			case "inarray":
				$ma=$v->req;
				for($i=0;$i<count($ma);$i+=1)
				  { 
					  $dds[$i][0]=$i;
					  $dds[$i][1]=$ma[$i];
					  $mda[$i] = $this->s_replace($var,$dds[$i],$theme);
					  $jd = $this->jdec($mda[$i]);
					  $this->inblock($jd,'');
				  }
			break;
			default:
				
			break;
		}	
		
	}
	public function add_count_insession($v)
	{
		$skey=$this->json_key_set($v,"skey");
		$sid=$this->json_key_set($v,"sid");
		$samn=$this->json_key_set($v,"samn");
		$sqty=$this->json_key_set($v,"sqty");
		$sadto=$this->json_key_set($v,"sadto");
		$sact=$this->json_key_set($v,"sact");
		if($sact=="yes"){
			if($samn==""){
				$_SESSION[$skey][$sid][$sadto]=$sqty;
			}else{
			$addmn = $_SESSION[$skey][$sid][$samn] * $sqty;
			unset($_SESSION[$skey][$sid][$sadto]);
			$_SESSION[$skey][$sid][$sadto]=$addmn;
			}
		}else{}
	}
	public function percent($v)
	{
		$perc= $this->json_key_set($v,"percent");
		$limit= $this->json_key_set($v,"limit");
		$content= $this->json_key_set($v,"content");
		if($content>$limit)
		{
			return $content*$perc/100;
		}
		else
		{
			return "0";
		}
	}
	public function addamount($vx)
	{ 
		$nm=array();$nn="";
		foreach($vx as $k=>$v)
			{
				switch($k)
				{
					case "number":$nn=$v; break;
					case "percentage":$nn= $this->percent($v); break;				
					default: $nn=0; break;
				}
				$nm[]=$nn;
			}
		return array_sum($nm);
	}
	public function bulkimages($v)
	{
		$type=$v->type;
		$content=$v->content;
		$divs = $this->json_key_set($v,"divider");
		$divider = ($divs=="")?",":$divs;
		$vars=$v->vars;	
		$vals=$v->vals;	
		$limit=$v->limit;
		$jb=$v->theme;
		$theme=$this->gettheme($jb);
		$k="{}";
		switch($type)
		{
			case "phpfile":
				$cspl = $$content; 
			break;
			default:
				$cspl = explode($divider,$content); 
			break;
		}
		$tot = ($limit=="")?count($cspl):$limit;
		
		for($i=0;$i<$tot;$i+=1)
			{
				if($cspl[$i]==""){}else{
				$iis=trim($cspl[$i]);
				$img = pathinfo($iis);
				for($j=0;$j<count($vars);$j+=1)
				{ 
					$dat[$j]=$img[$vars[$j]];
				}
				$d = $this->s_replace($vals,$dat,$theme);
				$jd = $this->jdec($d);
				$this->inblock($jd,"");
				}
			}
	}
	public function din($s,$d,$in,$fr)
	{ 
		return date($s,strtotime($d." + ".$in." ".$fr));
	}
	public function dateDiffInDays($date1, $date2)  
	{   $diff = strtotime($date2) - strtotime($date1);
		if($date2>$date1){
			return "-".abs(round($diff / 86400));
		}else{
		return abs(round($diff / 86400));
		} 
	}
	public function diff_months($y2,$y1,$m2,$m1)
	{
		return (($y2 - $y1) * 12) + ($m2 - $m1);
	}
	public function getDaysFromMonth($m,$y)
	{
		return cal_days_in_month(CAL_GREGORIAN, $m, $y);
	}
	public function cust_date($ds,$f,$d,$fr)
	{ $rs="";
		if($ds==""){$dds=date("Ymd H:i:s");}else{$dds=$ds;}
		return date($f,strtotime($dds." ".$d." ".$fr));
	}
	public function chkmobeml($mob)
	{$ar=array();
		$mobile=trim($mob);
		$ar['alphanumeric'] = preg_match('/^[-a-zA-Z0-9 . ,]+$/', $mobile);
		$ar['alpha'] = preg_match('/^[-a-zA-Z . ,]+$/', $mobile);
		$ar['strlen'] = strlen($mobile);
		$ar['isnumber'] = is_numeric($mobile);
		$ar['atpos']=strpos($mobile,"@");
		$ar['dotpos']=strpos($mobile,".");
		$ar['dotexp'] = explode(".",$mobile);
		$ar['atexp'] = explode("@",$mobile);
		$ar['ppos'] = strpos($mobile,"+");
		$ar['value'] = $mobile;
		return $ar;
	}
	public function con($f,$fr){
		$file = $this->read_file($f);
		$rf=$this->jdec($file);
		if(isset($rf[0]->$fr)){
			$db=$rf[0]->$fr;
			$server = $this->json_key_set($db,"server");
			$username = $this->json_key_set($db,"username");
			$password = $this->json_key_set($db,"password");
			$database = $this->json_key_set($db,"database");
			if(mysqli_connect($server,$username,$password))
			{
				$con = mysqli_connect($server,$username,$password);
				try
				{
					$con=mysqli_connect($server,$username,$password,$database);
					return $con;
				}
				catch(Exception $e)
				{
					echo $e;exit();
				}
			}else
			{
				echo "Server not Conneted"; exit();
			}
		}
		else
		{
			echo "Set the Database String for ".$fr;
		}
	}
	public function qry($con,$qryx,$fr,$suc,$err)
	{ switch($fr){ 
	
			case "tablenames":
			  $query=mysqli_query($con,"SHOW COLUMNS from ".$qryx."");
			  if(!$query)
			  {
				  echo "Failed to Query " . mysqli_error($con);
			  }
			  else
			  {
				  while($data=mysqli_fetch_object($query))
					  {
						  $myda[]=$data;
					  }
				  foreach($myda as $k=>$v)
					  {
						  
						  $mydat[]=$v->Field; 					
					  }
					  return $mydat;
			  mysqli_close($con);
			  }
			  
		  break;
		  case "tables":
			  $query=mysqli_query($con,"SHOW TABLES from ".$qryx."");
			  
			  if(!$query)
			  {
				  echo "Failed to Query SHOW TABLES from " . mysqli_error($con);
			  }
			  else
			  { 	$myda=array();$mydat=array();
				  while($data=mysqli_fetch_array($query))
					  {
						  $myda[]=$data[0];
					  }
				  
					  return $myda;
			  mysqli_close($con);
			  }
			  
		  break;
			case "data":
				$qr=mysqli_query($con,$qryx);
				if($qr){
					if(mysqli_num_rows($qr)>0){
					$ar=array();
					while($dbd=mysqli_fetch_array($qr))
					{$ar[]=$dbd;} return $ar;
					}else
					{return $err;}
				}else{
					return "Query Error ".mysqli_error($con);
				}
				
			break;
			case "run":
				try{
					$qr=mysqli_query($con,$qryx);
					if(!$qr){
						return $err." ".mysqli_error($con);
					}else{
						return $suc;
					}
				}
				catch(Exception $ex){
					$qr=mysqli_error($con);
					return $qr;
				}
				
			break;
			case "chk":
				$qr=mysqli_query($con,$qryx);
				if(!$qr){
					return mysqli_error($con);
				}else{
					if(mysqli_num_rows($qr)>0)
					{
						return $suc;
					}
					else
					{
						return $err;
					}
				}
			break;
			default: return "None"; break;
		}
	}
	public function calendar($v)
	{
		$vtype=$this->json_key_set($v,"type");
		$vstartdate=$this->json_key_set($v,"startdate");
		$vdaystype=$this->json_key_set($v,"daystype");
		$vjsonfile=$this->json_key_set($v,"jsonfile");
		$vlimit=$this->json_key_set($v,"limit");
		$vdrange=$this->json_key_set($v,"drange");
		$vblockdates=$this->json_key_set($v,"blockdates");
		$venddate=$this->json_key_set($v,"enddate");
		
		$startdate=($vstartdate=="today")?date("Y-m-d"):$vstartdate;
		$daystype=($vdaystype=="") ? 'days' : $vdaystype;
		switch($vtype)
			{
				case "fromdbrowsarray":
					require $vjsonfile;
					$con = $this->con("dbcon.json",$db);
					$re=$this->qry($con,$qry,$for,$err,$suc);
					$nn=array();
					for($i=0;$i<count($re);$i+=1)
						{
							$nn[$re[$i][$flds[0]]]=$re[$i][$flds[1]];
						}					
						$limit=($vlimit=="") ? 0 : $nn[$vlimit];
						$range=($vdrange=="") ? 30 :  $nn[$vdrange];					
						if($vblockdates==""){$blockdates="";}else{
							$blockdates=($vblockdates=="") ? $vblockdates : $nn[$vblockdates];						
						}
						$blockdates_array=explode(",",$blockdates);
				break;
				default:				
					$limit=($vlimit=="") ? 0 : $vlimit;
					if($venddate==""){
						$range=($vdrange=="") ? 30 : $vdrange;
						}else{
						$range=$this->dateDiffInDays($venddate, $startdate);
						}
					$blockdates=$vblockdates;
					$blockdates_array=explode(",",$blockdates);				
				break;
			}
		
		$flds=$this->json_key_set($v,"flds");
		$vals=$this->json_key_set($v,"vals");
		$theme=$this->json_key_set($v,"theme");
		$display=$this->json_key_set($v,"display");
		$tjb = $this->gettheme($theme);
		
		$md=array();$mh=array();
		$ndate = $this->din("Y-m-d",$startdate,$limit,'days');
		$ndatex = $this->din("Y-m",$startdate,$limit,'days');
		$fy = $this->din("Y",$ndate,0,'days');	
		$fd = $this->din("d",$ndate,0,'days');
		$fm = $this->din("m",$ndate,0,'days');
		$ly = $this->din("Y",$ndate,$range,'days');
		$ld = $this->din("d",$ndate,$range,'days');
		$lm = $this->din("m",$ndate,$range,'days');
		$diffmonts = $this->diff_months($ly,$fy,$lm,$fm);
		$xn=0;$yy=0;$alld="";
		$totmonths = $diffmonts+1;
		for($k=0;$k<$totmonths;$k+=1)
		{
			$md[$k]="";
			$m = $this->din("m",$ndatex,$k,'months');
			$M = $this->din("M",$ndatex,$k,'months');
			$y = $this->din("Y",$ndatex,$k,'months');
			$dayss = $this->getDaysFromMonth($m,$y);
			for($x=0;$x<count($flds);$x+=1){
					if($flds[$x]=="DAYS"){
						for($i=1;$i<=$dayss;$i+=1)
						{
							$ny = $this->din("Y",$y."-".$m."-".$i,0,'days');
							$nm = $this->din("m",$y."-".$m."-".$i,0,'days');
							$nd = $this->din("d",$y."-".$m."-".$i,0,'days');				
							if($nd<$fd and $nm==$fm and $ny==$fy or $nd>$ld and $nm==$lm and $ny==$ly){ }
							else{
								$tod=$this->din("Y-m-d",$y."-".$m."-".$i,0,$daystype);
								if(in_array($tod,$blockdates_array)){}else{
									$md[$k].=$this->cust_date($y."-".$m."-".$i,'d',0,$daystype).",";
								}
							}
						}
						$mh[$k][$x]=substr($md[$k],0,-1);
					}else{
						$mh[$k][$x]=$this->cust_date($y."-".$m."-1",$flds[$x],0,$daystype);
					}
			}
			
			$this->dtoHml($vals,$mh[$k],$tjb,"");
		}
	}
	public function csvdata($j)
	{
		$view=$this->json_key_set($j,"view");
		$from=$this->json_key_set($j,"from");
		$to=$this->json_key_set($j,"to");
		$dir=$this->json_key_set($j,"upload");
		$post = $this->json_key_set($j,"post");
		$data=$this->json_key_set($j,"data");
		switch($view)
		{
			case "upload_and_get":
				$csv = $data;
			break;
			default:
				$csv = $data;
			break;
		}	
		$flds = $this->json_key_set($j,"flds");
		$vals = $this->json_key_set($j,"vals");
		$type = $this->json_key_set($j,"types");
		$err = $this->json_key_set($j,"err");
		$theme = $this->json_key_set($j,"theme");
		$errortheme = $this->json_key_set($j,"errortheme");
		$jb=$this->gettheme($theme);
		
		$res = $this->read_csv_file($csv); 
		if(is_array($res))
		{ $data = array();

			$from=($from=="")?1:$from;
			$to=($to=="")?count($res):$to;

			for($i=$from;$i<$to;$i+=1)
			{
				for($x=0;$x<count($flds);$x+=1)
				{	
					$data[$i][]=str_replace("'","",htmlentities($res[$i][$flds[$x]]));
				}
				$job[$i]= $this->s_replace($vals,$data[$i],$jb);
				$jxd=$this->jdec($job[$i]);
				$this->inblock($jxd,"");
			}
		}else
		{
			echo $err." ".$res;
			 $errt = gettheme($errortheme);
			 $this->inblock($errt,$k);
		}
	}
	public function csvdatareport($j)
	{
		$data=$this->json_key_set($j,"data");
		$csv = $data;
		$firstrowvars = $this->json_key_set($j,"firstrowvars");
		$firstrowtheme = $this->json_key_set($j,"firstrowtheme");
		$frtheme = $this->gettheme($firstrowtheme);
		$theme = $this->json_key_set($j,"theme");
		$errortheme = $this->json_key_set($j,"errortheme");
		$jb=$this->gettheme($theme);
		
		$res = $this->read_csv_file($csv); 
		if(is_array($res))
		{ 
			$data = array();
			$firstRow=$res[0];
			$frarray=array();
			for($fi=0;$fi<count($firstRow);$fi+=1){
				$frhtml= $this->s_replace($firstrowvars,$firstRow[$fi],$frtheme);
				$jxd=$this->jdec($frhtml);
				$this->inblock($jxd,"");
			}
			
			
		}else
		{
			 echo $err." ".$res;
		}
	}
	public function combineArray($v){
		$type=$this->json_key_set($v,"delimiter");
		$ar = $this->json_key_set($v,"arrays");
		$vals = $this->json_key_set($v,"vals");
		$vars = $this->json_key_set($v,"vars");
		$cont=$this->json_key_set($v,"cont");
		$resx="";
		for($i=0;$i<count($ar);$i+=1)
		{
			switch($type[$i])
			{
				case "array":
				$ex[] = $ar[$i];
				break;
				default:				
					$ex[] = explode($type[$i],$ar[$i]);
				break;
			}
		}
		
		$armix = $this->json_key_set($v,"arraymix");
		$mm=array();
		for($l=0;$l<count($vals);$l+=1)
		{
			$res[] = $this->comb($ex,$armix[$l],$cont);
		}
		
		for($j=0;$j<count($res[0]);$j+=1)
		{
			for($k=0;$k<count($vals);$k+=1)
			{	
				if($res[$k][$j]==""){
					
				}else{$mm[$j][$vals[$k]]=$res[$k][$j];}
				
			}
		}
		$theme=$this->json_key_set($v,"theme");
		$jb=$this->gettheme($theme);
		
		for($vi=0;$vi<count($mm);$vi+=1)
		{
			for($vj=0;$vj<count($vals);$vj+=1)
			{
				foreach($mm[$vi] as $jk=>$jv)
				{
					if($jk==$vals[$vj]){									
					$myda[$vi][]=htmlentities($jv);	
					}else{}
				}
			}
			$job[$vi]= $this->s_replace($vars,$myda[$vi],$jb);
			$jxd=$this->jdec($job[$vi]);
			$resx.=$this->inblock($jxd,"");
		}
		return $resx;
	}
	public function comb($ex,$xx,$sep)
	{ 
		$jh=array();$vv=array();
		for($l=0;$l<count($ex[0]);$l+=1)
			{
				$vv[$l]='';
				$sp = explode(",",$xx); 
				for($k=0;$k<count($sp);$k+=1)
				{
					$vv[$l].=$ex[$sp[$k]][$l].$sep;
				}
				$jh[$l]=$vv[$l];
			}
		return $jh;
	}
	function currencyformat($v)
	{
		$prefix=$this->json_key_set($v,"prefix");
		$content=$this->json_key_set($v,"content");
		$sufix=$this->json_key_set($v,"sufix");
		return $prefix.preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $content).$sufix;
	}
	public function days_from_number($v)
	{
		$limit = $this->json_key_set($v,"limit");
		$date = $this->json_key_set($v,"date");
		$days = $this->json_key_set($v,"days");
		$flds = $this->json_key_set($v,"flds");
		$vals = $this->json_key_set($v,"vals");
		$theme = $this->json_key_set($v,"theme");
		$theme = $this->gettheme($theme);
		
		$da=array();
		$dat=array();
		for($i=0;$i<=$limit;$i+=1)
		{	
			$dat[$i][]='';
			for($j=0;$j<count($flds);$j+=1)
			{
				$dat[$i][]=$this->cust_date($date,$flds[$j],$i,$days);
			}	
			$job= $this->s_replace($vals,$dat[$i],$theme);	
			$jxd=$this->jdec($job);
			$this->inblock($jxd,'');
		}
	}
	public function numbers($v)
	{
		$from = $this->json_key_set($v,"from");
		$to = $this->json_key_set($v,"to");
		$addzero = $this->json_key_set($v,"addzero");
		$jump = $this->json_key_set($v,"jump");
		$flds = $this->json_key_set($v,"flds");
		$vals = $this->json_key_set($v,"vals");
		$theme = $this->json_key_set($v,"theme");
		$theme = $this->gettheme($theme);
		$dat=array();
		for($i=$from;$i<=$to;$i+=$jump)
		{
			if($addzero==""){
				if(strlen($i)<2){$i="0".$i;}
			}else{}
			$job= $this->s_replace($vals,$i,$theme);	
			$jxd=$this->jdec($job);
			$this->inblock($jxd,'');
		}
		
	}
	public function numbertodate($v)
	{
		$vnumbers = $this->json_key_set($v,"numbers");
		$numbers=explode(",",$vnumbers);
		$theme=$this->json_key_set($v,"theme");
		$flds=$this->json_key_set($v,"flds");
		$ndate=$this->json_key_set($v,"ndate");
		$vals=$this->json_key_set($v,"vals");
		$tjb = $this->gettheme($theme); 
		$dat=array();
		for($i=0;$i<count($numbers);$i+=1)
		{ 
			
			for($x=0;$x<count($flds);$x+=1){ 
				$dat[$i][$x]=$this->cust_date($ndate,$flds[$x],$numbers[$i]-1,'days');	
			}
			$this->dtoHml($vals,$dat[$i],$tjb,"");
		}
	}
	public function content_limit($v){
		$prefix = $this->json_key_set($v,"prefix");
		$content = $this->json_key_set($v,"content");
		$sufix = $this->json_key_set($v,"sufix");
		$from = $this->json_key_set($v,"from");
		$to = $this->json_key_set($v,"to");
		return $prefix.substr($content,$from,$to).$sufix;
	}
	public function dtoHml($vals,$data,$jb)
	{
		$res="";
		$jd=$this->s_replace($vals,$data,$jb);
		$job=$this->jdec($jd);
		for($j=0;$j<count($job);$j+=1)
			{
				$res.=$this->html_keys($job[$j]);
			}
		return $res;
	}
	public function aplc($rs,$c){$bre = explode(' ',$rs[1]); 
		$clp =  explode("/",$bre[2]);
		if(count($clp)>1){ $col=$clp[0].$clp[1]; }else{if($bre[2]=='transparent') {$col=$bre[2];}else{$col=$c[$bre[2]];}}
		return $bre[0]." ".$bre[1]." ".$col; 
	}
	public function apld($rs,$c){$bre = explode(' ',$rs[1]); 
		$clp =  explode("/",$bre[3]);
		if(count($clp)>1){$col=$clp[0].$clp[1];}else{ $col=$c[$bre[3]];}
		return $bre[0]." ".$bre[1]." ".$bre[2]." ".$col; 
	}
	public function apldl($rs,$c){$bre = explode(' ',$rs[1]);
		$al = count($bre)-1;
		$clp =  explode("/",$bre[$al]);
		if(count($clp)>1){$col=$clp[0].$clp[1];}else{$col=$c[$bre[$al]];}
		$cs="";for($i=0;$i<$al;$i+=1){$cs.=$bre[$i]." ";}
		return $cs." ".$col; 
	}
	public function aplda($rs,$c){$bre = explode(' ',$rs[1]); 
		$clp =  explode("/",$bre[4]);
		if(count($clp)>1){$col=$clp[0].$clp[1];}else{$col=$c[$bre[4]];}
		return $bre[0]." ".$bre[1]." ".$bre[2]." ".$bre[3]." ".$col; 
	}
	public function mccs($fx,$v)
	{ 
		$rf = $this->read_file($fx);
		$fd=$this->jdec($rf);
		$dx= $fd[0];
		$c=$dx->c;
		$f=$dx->f;
		$r="";$split=explode(",",$v); foreach($split as $k=>$x){ $rs=explode(":",$x);
		switch($rs[0]){
			case "lgrad": $cls="";
				$spl=explode("|",$rs[1]); 
				$sp=explode("/",$spl[1]); 
				for($j=0;$j<count($sp);$j+=1)
				{
					if($sp[$j]=="transparent"){$col='transparent';}else{$col=$c[$sp[$j]];}
					$cls.=$col.",";
				} 
			$r.='background:linear-gradient('.$spl[0].', '.substr($cls,0,-1).');';
			break;
			case "rand_bg": $cls="";
				$spl=explode("/",$rs[1]);
				$ranc=rand(0,count($spl));
				$r.='background:'.$c[$spl[$ranc]].';';
			break;
		case "varlgrad": $cls="";
			$spl=explode("|",$rs[1]); 
			$sp=explode("/",$spl[1]); 
			for($j=0;$j<count($sp);$j+=1)
			{
				if($sp[$j]=="transparent"){$col='transparent';}else{$col=$sp[$j];}
				$cls.=$col.",";
			} 
		$r.='background:linear-gradient('.$spl[0].', '.substr($cls,0,-1).');'; break;
		case "varrgrad": 
			$sp=explode("/",$rs[1]);  $cls="";
			for($j=0;$j<count($sp);$j+=1)
			{
				if($sp[$j]=="transparent"){$col='transparent';}else{$col=$sp[$j];}
				$cls.=$col.",";
			} 
		$r.='background:radial-gradient('.substr($cls,0,-1).');'; break;
		case "rgrad": 
			$sp=explode("/",$rs[1]);  $cls="";
			for($j=0;$j<count($sp);$j+=1)
			{
				if($sp[$j]=="transparent"){$col='transparent';}else{$col=$c[$sp[$j]];}
				$cls.=$col.",";
			} 
		$r.='background:radial-gradient('.substr($cls,0,-1).');'; break;
		case "congrad":
		    $cls="";
			$sp=explode("/",$rs[1]); 
			for($j=0;$j<count($sp);$j+=1)
			{
				$spl = explode(" ",$sp[$j]);
				if($spl[0]=="transparent"){$col='transparent '.$spl[1];}else{$col=$c[$spl[0]]." ".$spl[1];}
				$cls.=$col.",";
			} 
			$r.='background:conic-gradient('.substr($cls,0,-1).');'; break;
		case "varbg": $r.='background:'.$rs[1].';'; break; case "varcol": $r.='color:'.$rs[1].';'; break; case "0":$r.='background:'.$c[$rs[1]]."; "; break;case "1":$r.='color:'.$c[$rs[1]]."; "; break;case "2": $r.='border:'.$this->aplc($rs,$c)."; "; break;case "3":$r.='padding:'.$rs[1]."; "; break;case "4":$r.='margin:'.$rs[1]."; "; break;case "5":$r.='position:'.$rs[1]."; "; break;case "6":$r.='left:'.$rs[1]."; "; break;case "7":$r.='top:'.$rs[1]."; "; break;case "8":$r.='bottom:'.$rs[1]."; "; break;case "9":$r.='right:'.$rs[1]."; "; break;case "10":$r.='border-radius:'.$rs[1]."; "; break; case "varfon": $r.='font-family:'.$rs[1].';'; break; case "11":$r.='font-family:"'.$f[$rs[1]].'"; '; break;case "12":$r.='font-size:'.$rs[1]."; "; break;case "13":$r.='text-align:'.$rs[1]."; "; break;case "14":$r.='letter-spacing:'.$rs[1]."; "; break;case "15":$r.='overflow-y:'.$rs[1]."; "; break;case "16":$r.='overflow:'.$rs[1]."; "; break;case "17":$r.='width:'.$rs[1]."; "; break;case "18":$r.='height:'.$rs[1]."; "; break;case "19":$r.='border-bottom:'.$this->aplc($rs,$c)."; "; break;case "20":$r.='border-top:'.$this->aplc($rs,$c)."; "; break;case "21":$r.='border-left:'.$this->aplc($rs,$c)."; "; break;case "22":$r.='border-right:'.$this->aplc($rs,$c)."; "; break;case "23":$r.='float:'.$rs[1]."; "; break;case "24":$r.='display:'.$rs[1]."; "; break;case "25":$r.='visibility:'.$rs[1]."; "; break;case "26":$r.='clear:'.$rs[1]."; "; break;case "27":$r.='cursor:'.$rs[1]."; "; break;case "28i":$r.='box-shadow:'.$this->aplda($rs,$c)."; "; break;case "28":$r.='box-shadow:'.$this->apldl($rs,$c)."; "; break;case "29":$bre = str_replace("/",",",$rs[1]); $r.='transform:'.$bre."; "; break;case "30":$r.='text-decoration:'.$rs[1]."; "; break;case "31":$r.='transition-property:'.$rs[1]."; "; break;case "32":$r.='transition-duration:'.$rs[1]."; "; break;case "33":$r.='tables:'.$rs[1]."; "; break;case "34":$r.='transition:'.$rs[1]."; "; break;case "35":$r.='transition-timing-function:'.$rs[1]."; "; break;case "36":$r.='list-style:'.$rs[1]."; "; break;case "37":$r.='list-style-type:'.$rs[1]."; "; break;case "38":$r.='backgroundImage:'.$rs[1]."; "; break;case "39":$r.='stroke-dasharray:'.$rs[1]."; "; break;case "40":$r.='stroke-dashoffset:'.$rs[1]."; "; break;case "41":$r.='animation:'.$rs[1]."; "; break;case "42":$r.='font-weight:'.$rs[1]."; "; break;case "43":$r.='opacity:'.$rs[1]."; "; break;case "44":$r.='background-size:'.$rs[1]."; "; break;case "45":$r.='filter:'.$rs[1]."; "; break;case "46":$r.='overflow-x:'.$rs[1]."; "; break;case "47":$r.='z-index:'.$rs[1]."; "; break;case "48":$r.='stroke:'.$c[$rs[1]]."; "; break;case "49":$r.='stroke-width:'.$rs[1]."; "; break; case "50":$r.='fill:'.$c[$rs[1]]."; "; break; case "50url":$r.='fill:'.$rs[1]."; "; break; case "51":$r.='line-height:'.$rs[1]."; "; break;case "52":$r.='list-style-position:'.$rs[1]."; "; break;case "53":$r.='text-shadow:'.$this->apldl($rs,$c)."; "; break;case "54":$r.='column-count:'.$rs[1]."; "; break;case "55":$r.='object-fit:'.$rs[1]."; "; break;case "56":$r.='text-transform:'.$rs[1]."; "; break;case "57":$r.='flex-wrap:'.$rs[1]."; "; break;case "58":$r.='flex:'.$rs[1]."; "; break;case "59":$r.='grid-template-columns:'.$rs[1]."; "; break;case "60":$r.='list-style-position:'.$rs[1]."; "; break;case "61":$r.='min-height:'.$rs[1]."; "; break;case "62":$r.='font-style:'.$rs[1]."; "; break;case "63":$r.='outline:'.$rs[1]."; "; break;case "64":$r.='clip:'.$rs[1]."; "; break;case "65":$r.='min-width:'.$rs[1]."; "; break;case "66":$r.='padding-top:'.$rs[1]."; "; break;case "67":$r.='padding-bottom:'.$rs[1]."; "; break;case "68":$r.='padding-left:'.$rs[1]."; "; break;case "69":$r.='padding-right:'.$rs[1]."; "; break;case "70":$r.='border-bottom-left-radius:'.$rs[1]."; "; break;case "71":$r.='border-bottom-right-radius:'.$rs[1]."; "; break;case "72":$r.='border-top-left-radius:'.$rs[1]."; "; break;case "73":$r.='border-top-right-radius:'.$rs[1]."; "; break;case "74":$r.='animation-name:'.$rs[1]."; "; break;case "75":$r.='animation-duration:'.$rs[1]."; "; break;case "76":$r.='animation-iteration-count:'.$rs[1]."; "; break;case "77":$r.='transition-timing-function:'.$rs[1]."; "; break;case "78":$r.='-webkit-background-clip:'.$rs[1]."; "; break;case "79":$r.='-webkit-text-fill-color:'.$rs[1]."; "; break; case "80":$r.='word-wrap:'.$rs[1]."; "; break;case "81":$r.='flex-basis:'.$rs[1]."; ";  break;case "82":$r.='align-items:'.$rs[1]."; ";break;case "83":$r.='column-gap:'.$rs[1]."; ";break;case "84":$r.='row-gap:'.$rs[1]."; ";break;case "85":$r.='flex-direction:'.$rs[1]."; ";break;case "86":$r.='align-self:'.$rs[1]."; ";break;case "87":$r.='justify-content:'.$rs[1]."; ";break; case "88":$r.='flex-flow:'.$rs[1]."; ";break; case "89":$r.='flex-grow:'.$rs[1]."; ";break;case "90":$r.='grid-gap:'.$rs[1]."; ";break;case "91":$r.='grid-row-gap:'.$rs[1]."; ";break;case "92":$r.='grid-column-gap:'.$rs[1]."; ";break; case "93": $r.='flex-shrink:'.$rs[1]."; "; break; case "94": $r.='word-break:'.$rs[1]."; ";break; case "95": $r.='white-space:'.$rs[1].'; white-space-moz-'.$rs[1].'; white-space-o-'.$rs[1].'; white-space:-'.$rs[1].';'; break; case "96": $r.='-webkit-column-break-inside:'.$rs[1].';  page-break-inside:'.$rs[1].'; break-inside:'.$rs[1].'; ';break; 
		case "97":$r.='perspective:'.$rs[1]."; "; break;
	case "98":$r.='perspective-origin:'.$rs[1]."; "; break;
	case "99":$r.='place-content:'.$rs[1]."; "; break;
	case "100":$r.='place-items:'.$rs[1]."; "; break;
	case "101":$r.='animation-fill-mode:'.$rs[1]."; "; break;
	case "102":$r.='animation-delay:'.$rs[1]."; "; break;
	case "103":$r.='-webkit-appearance:'.$rs[1].'; appearance:'.$rs[1].';'; break;
	case "104":$r.='transform-style:'.$rs[1].';'; break;
	default:$r.=""; break;}} 
		return $r;
	}
	public function css($x)
	{ 
		$file = $this->json_key_set($x,"file");
		if(file_exists($file)){
    		$rf = $this->read_file($file);
    		$fd=$this->jdec($rf);
    		$dx= $fd[0];
    		$c=$dx->c;
    		$f=$dx->f;
    		$root = $this->json_key_set($x,"root");
    		$rootcol = $this->json_key_set($x,"rootcol");
    		$rootfon = $this->json_key_set($x,"rootfon");
    		$auto = $this->json_key_set($x,"auto");
    		$animation = $this->json_key_set($x,"animation");
    		$default = $this->json_key_set($x,"default");
    		
    		?><style type="text/css"><?php 
    		$mr="";
    		if($root==""){}else{
    			foreach($root as $k=>$v){
    				$mr.=$k.":".$v."; ";
    			}
    		}
    		
    		if($rootcol==""){}else{
    			foreach($rootcol as $k=>$v){
    				$mr.=$k.":".$c[$v]."; ";
    			}
    		}
    		
    		if($rootfon==""){}else{
    			foreach($rootfon as $k=>$v){
    				$mr.=$k.":".$f[$v]."; ";
    			}			
    		}
    		echo ":root{".$mr."} ";
    		foreach($default as $k=>$v){echo $k."{".$this->mccs($file,$v)."}";}
    		
    		if($auto==""){}else{
    			foreach($auto as $ck=>$cv){
    				echo "@media screen and (max-width:".$ck."){";
    					foreach($auto->$ck as $vk=>$vv){echo $vk."{".$this->mccs($file,$vv)."} ";}
    				echo "}";
    			}
    		}
    		if($animation)
    		{
    			$anim="";			
    			foreach($animation as $ck=>$cv)
    				{
    					echo " @keyframes ". $ck."{";
    						foreach($cv as $k=>$xc){ echo $k." {".$this->mccs($file,$xc)."} ";}
    					echo "}";				
    				}				
    		}
    		?></style><?php
		}else{echo "File Not Found ".$file;}
	}
	public function exportcsv($fname,$inf,$nws)
	{
	    if(file_exists($fname)){unlink($fname);}else{}
		$file=$fname;
		$f=fopen($file,"w");
		foreach($nws as $dd)
			{
			  fputcsv($f,$dd);
			}
		fclose($f);
		?><div class="data_download"><a href="<?=$file?>" target="_blank"><?=$inf?></a></div><?php
	}
	public function writefile($fname,$inf,$nws)
	{
		$file=$fname;
		$f=fopen($file,"w");
		fwrite($f,$nws);
		fclose($f);
		?><a href="<?=$file?>" target="_blank"><?=$inf?></a><?php
	}
	public function save_to_file($v){
		$source = $this->json_key_set($v,"source");
		$folder = $this->json_key_set($v,"folder");
		$file = $this->json_key_set($v,"file");
		$for = $this->json_key_set($v,"for");
		$text = $this->json_key_set($v,"text");
		
		if(file_exists($source.$folder)){

		}else{mkdir($source.$folder,0777);}

		switch($for){
			case "append": 
				$f=fopen($source.$folder."/".$file,"a");
				fwrite($f, $text."\n");
				fclose($f);
				break;
			default:
				
				if(file_exists($source.$folder."/".$file)){}else{
					$f=fopen($source.$folder."/".$file,"w");
					fwrite($f, $text."\n");
					fclose($f);
				}
			break;
		}
		
	}
	public function disq($chk_dis_qry,$fcq)
	{
		if($chk_dis_qry=="yes")
		{
			return $fcq."<hr />";
		}else{} 
	}
	public function dbdata_from_db($v)
	{
		$qryfile = $this->json_key_set($v,"queryfile");
		$db=$this->json_key_set($v,"data");
		$rq=$this->read_file_to_array($qryfile);
		$dfor=$this->json_key_set($v,"dfor");
		$pfor=$this->json_key_set($v,"pfor");
		$phpcode=$this->json_key_set($v,"phpcode");
		$phpvar=$this->json_key_set($v,"phpvar");
		$fldsnvals=$this->json_key_set($v,"fldsnvals");
		if($fldsnvals==","){
			$flds=explode(",",$this->json_key_set($v,"flds"));
			$vals=explode(",",$this->json_key_set($v,"vals"));
		}else{
			$flds=$this->json_key_set($v,"flds");
			$vals=$this->json_key_set($v,"vals");
		}
		$defs=$this->json_key_set($v,"defs");
		$dtype=$this->json_key_set($v,"dtype");
		$suc=$this->json_key_set($v,"suc");
		$err=$this->json_key_set($v,"err");
		$type=$this->json_key_set($v,"type");
		$runcode=$this->json_key_set($v,"runcode");
		$checker = $this->json_key_set($v,"checker");
		$chk_suc=$this->json_key_set($v,"chk_suc");
		$chk_err=$this->json_key_set($v,"chk_err");
		$chk_dis_qry=$this->json_key_set($v,"chk_dis_qry");
		$dis_qry=$this->json_key_set($v,"dis_qry");
		$theme=$this->json_key_set($v,"theme");
		$errortheme=$this->json_key_set($v,"errortheme");
		$errval=$this->json_key_set($v,"errval");
		$sqlerr=$this->json_key_set($v,"sqlerr");
		$sucval=$this->json_key_set($v,"sucval");
		$dis_data=$this->json_key_set($v,"dis_data");
		$reqd =$this->json_key_set($v,"reqd");
		$reqv = $this->json_key_set($v,"reqv");
		$data_display = $this->json_key_set($v,"data_display");
		$paging=$this->json_key_set($v,"pagging");
		$export=$this->json_key_set($v,"export");
		
		$oq= $rq[$dfor];
		if($pfor==""){}else{
		$pq= $rq[$pfor];}
		$con = $this->con("dbcon.json",$db);		
		if($phpcode==""){}else{
		include ($phpcode);
		$mc = $phpvar;
		}
		switch($type)
		{
			case "check_n_insert":				
				$cq = $rq[$checker];
				$con = $this->con("dbcon.json",$db);
				$fldx=array();
				for($i=0;$i<count($flds);$i+=1){$fldx[]=$this->exd($con,$flds[$i]);}
				$fcq = $this->s_replace($vals,$fldx,$cq);
				$fq = $this->s_replace($vals,$fldx,$oq);				
				$jb = $this->gettheme($theme);
				$jeb = $this->gettheme($errortheme);				
				echo $this->disq($chk_dis_qry,$fcq);
				echo $this->disq($dis_qry,$fq);
				if($runcode=="yes"){
				$chk = $this->qry($con,$fcq,"chk",$chk_suc,$chk_err);
				if($chk==$chk_err)
				{
					$ins = $this->qry($con,$fq,"run",$suc[0],$err[0]);
					if($ins==$suc[0])
					{
						$jxb= $this->s_replace($sucval,$ins,$jb);
						$jxd=$this->jdec($jxb);
						$this->inblock($jxd,'');
					}
					else
					{
						$jxb= $this->s_replace($errval,$ins,$jeb);
						$jxd=$this->jdec($jxb);
						$this->inblock($jxd,'');
					}
				}else
				{
					if($chk==$chk_suc)
					{
						echo $chk_suc;
					}else{echo $chk;}
				}
				}else{echo "Function set to stop for some reason";}
			break;
			case "run":
				$dis_qry=$this->json_key_set($v,"dis_qry");
				$fq = $this->s_replace($vals,$flds,$oq);	
				$con = $this->con("dbcon.json",$db);
				$jb = $this->gettheme($theme);
				$jeb = $this->gettheme($errortheme);
				echo $this->disq($dis_qry,$fq);
				if($runcode=="yes"){		
				$ins = $this->qry($con,$fq,"run",$suc[0],$err[0]);
					if($ins==$suc[0])
					{
						$jxb= $this->s_replace($sucval,$ins,$jb);
						$jxd=$this->jdec($jxb);
						$this->inblock($jxd,"");
					}
					else
					{
						$jxb= $this->s_replace($errval,$ins,$jeb);
						$jxd=$this->jdec($jxb);
						$this->inblock($jxd,"");
					}
				}else{echo "Function set to stop for some reason";}
			break;
			case "data":
				
				$fq = $this->s_replace($reqv,$reqd,$oq);	
				$fpq = $this->s_replace($reqv,$reqd,$pq);
				echo $this->disq($dis_qry,$fq);
				echo $this->disq($dis_qry,$fpq);
				$jb = $this->gettheme($theme);
				$jeb = $this->gettheme($errortheme);
				
				if($runcode=="yes"){							
				$res = $this->qry($con,$fq,"data",$suc,$err);
				$pres = $this->qry($con,$fpq,"data",$suc,$err);
				$data=array();$job=array();
				switch($data_display)
				{
					case "html_xml":
						if(is_array($res)){
						$xml='<?xml version="1.0" encoding="UTF-8"?>';
						$xml.='<data>';					
							for($i=0;$i<count($res);$i+=1)
								{
									$xml.='<row>';
									for($x=0;$x<count($flds);$x+=1)
									{ $sln= $i+1;
										switch($flds[$x])
										{
											case "SLN":											
												$xml.='<SLN>'.$sln.'</SLN>';
											break;
											default:
												if(isset($res[$i][$flds[$x]])){
													$xml.='<'.$flds[$x].'>'.$res[$i][$flds[$x]].'</'.$flds[$x].'>';
												}else
												{
													$xml.='<'.$flds[$x].'> </'.$flds[$x].'>';
												}
												
											break;
										}
									}
									$xml.='</row>';
								}
							$xml.='</data>';
							if($export=="yes"){
								echo $this->writefile(date("YmdH").'_data.xml','Download XML File Here',$xml)."<hr/>";
							}
							
							echo htmlentities($xml);
						}else
						{}
					break;
					case "xml":
						if(is_array($res)){
						$xml='<?xml version="1.0" encoding="UTF-8"?>';
						$xml.='<data>';					
							for($i=0;$i<count($res);$i+=1)
								{
									$xml.='<row>';
									for($x=0;$x<count($flds);$x+=1)
									{ $sln= $i+1;
										switch($flds[$x])
										{
											case "SLN":											
												$xml.='<SLN>'.$sln.'</SLN>';
											break;
											default:
												if(isset($res[$i][$flds[$x]])){
													$xml.='<'.$flds[$x].'>'.$res[$i][$flds[$x]].'</'.$flds[$x].'>';
												}else
												{
													$xml.='<'.$flds[$x].'> </'.$flds[$x].'>';
												}
												
											break;
										}
									}
									$xml.='</row>';
								}
							$xml.='</data>';
							if($export=="yes"){
								echo $this->writefile(date("YmdH").'_data.xml','Download XML File Here',$xml)."<hr/>";
							}
							echo $xml;
						}else
						{}
					break;
					case "csv":
						if(is_array($res)){
								for($y=0;$y<count($flds);$y+=1)
									{
										$data[0][]=$flds[$y];
									}
							for($i=0;$i<count($res);$i+=1)
								{
									for($x=0;$x<count($flds);$x+=1)
									{
										switch($flds[$x])
										{
											case "SLN":
												$data[$i+1][]=$i+1;
											break;
											default: 
												if(isset($res[$i][$flds[$x]])){
													$data[$i+1][]=$res[$i][$flds[$x]];
												}else
												{
													$data[$i+1][]=" ";
												}
											break;
										}
									}
								}
							$this->exportcsv('csvdata.csv','',$data);
							echo $this->read_file('csvdata.csv');				
						}else
						{}					
					break;
					case "html_csv":
						if(is_array($res)){
								for($y=0;$y<count($flds);$y+=1)
									{
										$data[0][]=$flds[$y];
									}
							for($i=0;$i<count($res);$i+=1)
								{
									for($x=0;$x<count($flds);$x+=1)
									{
										switch($flds[$x])
										{
											case "SLN":
												$data[$i+1][]=$i+1;
											break;
											default: 
												if(isset($res[$i][$flds[$x]])){
													$data[$i+1][]=$res[$i][$flds[$x]];
												}else
												{
													$data[$i+1][]=" ";
												}
											break;
										}
									}
								}
							$this->exportcsv('csvdata.csv','',$data);
							echo $this->read_csv_html_file('csvdata.csv');					
						}else
						{}					
					break;
					case "table_data":
						if(is_array($res)){ for($x=0;$x<count($flds);$x+=1){$data[0][$x]=$flds[$x];}
						?><table cellpadding="5" cellspacing="0" width="100%" class="datatable" border="1" bordercolor="#CCCCCC"><?php
							?><tr class="row 0"><?php
									for($x=0;$x<count($flds);$x+=1)
									{
										?><td class="col <?=$x+1?>"><?php
										echo $flds[$x];	
										?></td><?php
									}
									?></tr><?php
							for($i=0;$i<count($res);$i+=1)
								{
									?><tr class="row <?=$i+1?>"><?php
									for($x=0;$x<count($flds);$x+=1)
									{
										?><td class="col <?=$x+1?>"><?php
										switch($flds[$x])
										{
											case "SLN":
												echo $i+1;
												$data[$i+1][]=$i+1;
											break;
											default:
												if(isset($res[$i][$flds[$x]])){
													echo $res[$i][$flds[$x]];
													$data[$i+1][]=$res[$i][$flds[$x]];
												}else
												{
													echo " ";
													$data[$i+1][]=" ";
												}
											break;
										}
										?></td><?php
									}
									?></tr><?php
								}
							?></table><?php
							if($export=="yes"){
								echo $this->exportcsv(date("YmdH").'_data.csv','Download Table Data ',$data)."<hr/>";
							}
						}else
						{}
					break;
					case "json":
						if(is_array($res)){
							for($i=0;$i<count($res);$i+=1)
								{
									for($x=0;$x<count($flds);$x+=1)
									{
										switch($flds[$x])
										{
											case "SLN":
												$data[$i][$flds[$x]]=$i+1;
											break;
											default:
												if(isset($res[$i][$flds[$x]])){
													$data[$i][$flds[$x]]=$res[$i][$flds[$x]];
												}else
												{
													$data[$i][$flds[$x]]=' ';
												}
													
											break;
										}
									}
								}
							$data =  json_encode($data);
							echo $data;
							if($export=="yes"){
								echo $this->writefile(date("YmdH").'_data.json','Download JSON ',$data)."<hr/>";
							}
						}else
						{}
					break;
					case "php_array":
						if(is_array($res)){
							for($i=0;$i<count($res);$i+=1)
								{
									for($x=0;$x<count($flds);$x+=1)
									{
										switch($flds[$x])
										{
											case "SLN":
												$data[$i][]=$i+1;
											break;
											default: 
												if(isset($res[$i][$flds[$x]])){
													$data[$i][]=$res[$i][$flds[$x]];
												}else
												{
													$data[$i][]=" ";
												}
													
											break;
										}
									}
								}
							
							var_dump($data);
							if($export=="yes"){
								echo $this->writefile(date("YmdH").'_data.php','Download PHP ARRAY ',json_encode($data))."<hr/>";
							}
						}else
						{}
					break;
					case "html":
						if(is_array($res)){ for($x=0;$x<count($flds);$x+=1){$cdata[0][$x]=$flds[$x];}
							if($dis_data=="yes")
							{
								for($i=0;$i<count($res);$i+=1)
								{
									$data[$i]=array();
									for($x=0;$x<count($flds);$x+=1)
									{
										switch($flds[$x])
											{
												case "SLN":
													$data[$i][$x]=$i+1;
													$cdata[$i+1][$x]=$i+1;
												break;
												default:
													if(is_array($dtype))
													{
														switch($dtype[$x]){
															case "dec":
																$data[$i][$x]=$this->encdec('d',$res[$i][$flds[$x]],'');
																$cdata[$i+1][$x]=$this->encdec('d',$res[$i][$flds[$x]],'');
															break;
															case "json":
																$data[$i][$x]="";
																$cdata[$i+1][$x]="";
															break;
															default:
																$data[$i][$x]=$res[$i][$flds[$x]];
																$cdata[$i+1][$x]=$res[$i][$flds[$x]];
															break;
														}
													}else{
														if(isset($res[$i][$flds[$x]])){
															$data[$i][$x]=$res[$i][$flds[$x]];
															$cdata[$i+1][$x]=$res[$i][$flds[$x]];
														}
														else
														{															
															if(is_array($defs)){
																if(isset($defs[$x])){
																	$data[$i][$x]=$defs[$x];
																	$cdata[$i+1][$x]=$defs[$x];
																}else{
																	$data[$i][$x]="";
																	$cdata[$i+1][$x]="";
																}
															}else{
																$data[$i][$x]=" ";
																$cdata[$i+1][$x]=" ";
															}
														}
													}
												break;
											}
									}
									$job[$i]= $this->s_replace($vals,$data[$i],$jb);
									$jxd=$this->jdec($job[$i]);
									$this->inblock($jxd,"");									
								}
							}else{}
							
							if($export=="yes"){
								
								echo $this->exportcsv(date("YmdH").'_csvdata.csv','Download CSV ',$cdata)."<hr/>";
							}
							if($paging==""){}else
								{
									if(is_array($pres)){
											$frm=$paging->from;
											$to=$paging->to;
											$rtot=count($pres); 
											$ram=$rtot/$to; 
											if(is_float($ram)== true){$rnd=$ram+1;}else{$rnd=$ram;}
											$pthm=$paging->theme;
											$phm=gettheme($pthm);
											$pgn=$paging->pagenumber;
											$np=0;
											if($rtot>$to)
											{
												$pgna=$rnd+$to; 
												$pxgn=($pgna % 2 == 0)?$pgna-1:$pgna+1;
												$pxgn=$rnd+$to; 
							
												?><div class="pagging"><?php
												for($o=0;$o<$rtot;$o+=$to)
												{
													$vp=$vp+=1;
													$sp=array($vp,$np,$to,$pres);
													$jcxb= sre($pgn,$sp,$phm);
													$jcxd=jd($jcxb);
													inblock($jcxd,$k);
													$np+=$to;
												}
												?></div><?php
											}else{}
									}else{
												$jxb= sre($errval,$pres,$jeb);
												$jxd=jd($jxb);
												inblock($jxd,$k);
										}
									
								}
						}else{
							$jxb= $this->s_replace($errval,$res,$jeb);
							$jxd=$this->jdec($jxb);
							$this->inblock($jxd,'');
						}
					break;
					default:
						echo "Set Display Type";
					break;
				}
				
				}else{echo "Function set to stop for some reason";}
			break;
			default:
				echo "Invalid Option";
			break;
		}		
	}	
	public function viewfiles($f)
	{
		$fold = $this->json_key_set($f,"fold");
		$error=$this->json_key_set($f,"error");
		if(file_exists($fold))
		{
			$sd=scandir($fold); 
			$jb=$this->json_key_set($f,"theme");
			$theme=$this->gettheme($jb);
			$attrs=$this->json_key_set($f,"attrs");
			$vars=$this->json_key_set($f,"vars");
			$limit=$this->json_key_set($f,"limit");
			$filter=$this->json_key_set($f,"filter");
			$sort=$this->json_key_set($f,"sort");
			$filtercount=$this->json_key_set($f,"filtercount");
			$vvl=array();$x=0;
			if($limit==""){$slim=count($sd);}else{
				$slim=$limit+2;
				if($slim>count($sd)){
					$slim=count($sd);
				}else{
					$slim=$slim;
				}
			}
			$sorting=array();			
			for($i=2;$i<$slim;$i+=1)
			{
				$pi= pathinfo($sd[$i]);
				for($k=0;$k<count($attrs);$k+=1)
				{
					if($attrs[$k]=="SLN"){
						$mdx=$i-1;
					}else{
						if(isset($pi[$attrs[$k]])){
							$mdx=$pi[$attrs[$k]];
						}else
						{
							if($attrs[$k]=="dir_count")
							{
								if(is_dir($fold."/".$sd[$i]))
								{
									$sdc = scandir($fold."/".$sd[$i]);
									$mdx=count($sdc)-2;
									$sorting[$i]=$mdx;
								}else{
									$mdx="undefined ";
								}
							}else
							{
								$mdx="dir";
							}
						}
					}
					$vvl[$i][]=$mdx;
				}
			}
			if($filter==""){
			    switch($sort)
				{
					case "1to9": ksort($vvl); break;
					case "9to1": krsort($vvl); break;
					case "atoz": asort($vvl); break;
					case "ztoa": arsort($vvl); break;
					default: arsort($vvl); break;
				}
				foreach($vvl as $kk=>$vv)
				{
					$d= $this->s_replace($vars,$vv,$theme);				
					$jxd=$this->jdec($d);
					$this->inblock($jxd,"");
				}
			}else{
				switch($sort)
				{
					case "1to9": ksort($sorting); break;
					case "9to1": krsort($sorting); break;
					case "atoz": asort($sorting); break;
					case "ztoa": arsort($sorting); break;
					default: arsort($sorting); break;
				}
				$fk=0;
				foreach($sorting as $ss=>$sv){
					if($fk>$filtercount){}else{
						$vv=$vvl[$ss];
						$d= $this->s_replace($vars,$vv,$theme);				
						$jxd=$this->jdec($d);
						$this->inblock($jxd,"");
					}
					$fk+=1;
				}
			}
			
		}else{
			if($error==""){
				echo "File or Data Not Found : ".$fold;
			}else{
				echo $error;
			}	
		}
	}
	public function filetags($f)
	{
		$fol=$this->json_key_set($f,"folder");
		$delim=$this->json_key_set($f,"delim");
		$theme=$this->json_key_set($f,"theme");
		$jb=$this->gettheme($theme);
		$rf=scandir($fol);
		$fp=array();$mxix=array(); $mix=array();$ss=array();$c=0;
		$extns = array("txt","png","jpg","jpeg","bmp","ttf","pdf","doc","xls","docx","xlsx","ppt");
		for($i=2;$i<count($rf);$i+=1)
		{ 
			if(is_file($fol.$rf[$i]))
			{
				$fs[$i]=explode($delim,$rf[$i]);
				$mxix['categories'][$fs[$i][0]]=$fs[$i][0];
				for($t=0;$t<count($fs[$i])-1;$t+=1){
						$itm=$fs[$i][$t+1];
						$ss[$itm]=$itm;
						$mix[$fs[$i][$t]][]=$itm;
					}
			}else{ }
		}	
			$xx=array();$rt=0;
			foreach($mix as $kk=>$vv)
			{
				for($i=0;$i<count($vv);$i+=1)
				{
					$xx[$rt][$vv[$i]]=$vv[$i];
				}
				foreach($xx[$rt] as $ll=>$mm)
				{
					$ck = explode(".",$ll);
					$ext = $ck[count($ck)-1];
					if(in_array($ext,$extns)){
						$mxix[$kk][]['file']=$ll;
						}else{
							$mxix[$kk][]['name']=$ll;
							}
					
				}
				$rt+=1;
			}
		foreach($mxix['categories'] as $k=>$v){
				$mxix['maincats'][]["name"]=$v;
			}
		unset($mxix['categories']);
		$display=$this->json_key_set($f,"display");
		switch($display){
			case "html":
				$data=$mxix[$this->json_key_set($f,"data")];
				$vars=$this->json_key_set($f,"vars");
				$vals=$this->json_key_set($f,"vals");
				$theme=$this->json_key_set($f,"theme");
				$jb=$this->gettheme($theme);
				if(count($data)==0){
					echo "No Data or check data to be maincats not '".$data."'";
				}else
				{
					$mdata=array();
					for($i=0;$i<count($data);$i+=1)
					{
						for($j=0;$j<count($vars);$j+=1)
						{
							if($vars[$j]=="SLN"){
							  $mdata[$i][]=$i+1;
							  }else{
								  if(isset($data[$i][$vars[$j]])){
							  		$mdata[$i][]=$data[$i][$vars[$j]];
								  }else{
									  $mdata[$i][]="";
									  }
							  }
						}
						$mda = $this->s_replace($vals,$mdata[$i],$jb);
						$jd = $this->jdec($mda); 
						$this->inblock($jd,"");
					}
				}
			break;
			default:
				$json = $this->jenc($mxix);
				return $json;
			break;
		}
	}
	public function encdec_content($v){
		$res="";
		$type=$this->json_key_set($v,"type");
		$content=$this->json_key_set($v,"content");
		$ekey=$this->json_key_set($v,"ekey");
		$pref = $this->json_key_set($v,"prefix");
		$sufi = $this->json_key_set($v,"sufix");
		return $pref.$this->encdec($type,$content,$ekey).$sufi;
	}
	public function encdec_content_html($v){
		$res="";
		$type=$this->json_key_set($v,"type");
		$content=$this->json_key_set($v,"content");
		$ekey=$this->json_key_set($v,"ekey");
		$pref = $this->json_key_set($v,"prefix");
		$sufi = $this->json_key_set($v,"sufix");
		$htmlc=html_entity_decode($this->encdec($type,$content,$ekey));
		return $pref.$htmlc.$sufi;
	}
	public function fieldset($v){
		$res=array();
		$ar=array("");
		$label = $this->json_key_set($v,"label");
		$attr = $this->set_attrs($v,"attr",$ar);
		$xtheme=$this->json_key_set($v,"theme");
		$res[0]=$attr;
		$res[1]=$label;
		$res[2]=$xtheme;
		return $res;
	}
	public function option($v,$opt){
		$rs="";
		$opt = $this->json_key_set($v,$opt);
		if($opt==""){}else
		{
		foreach($opt as $k=>$v){
					$rs.='<option value="'.$k.'">'.$v.'</option>';
				}
		}
		
		return $rs;
	}
	public function remove_array_session($v)
	{
		$skey=$this->json_key_set($v,"skey");
		$vl=$this->json_key_set($v,"val");
		
		$ses=$_SESSION[$skey];
		$nses=array();
		for($i=0;$i<count($ses);$i+=1){
			if($vl==$ses[$i]){}
			else{
				$nses[]=$ses[$i];
				}
		}
		for($x=0;$x<count($nses);$x+=1){$_SESSION[$skey][$x]=$nses[$x];}
	}
	public function removesessionarray($v){
		$skey=$this->json_key_set($v,"skey");
		$sid=$this->json_key_set($v,"sid");
		unset($_SESSION[$v->skey][$sid]);
	}
	public function remove_session($v)
	{
		$skey=$this->json_key_set($v,"skey");
		unset($_SESSION[$skey]);
	}
	public function session_to_json($v)
	{
		$res=array();
		$skey=$this->json_key_set($v,"skey");
		if(!isset($_SESSION[$skey]))
		{
			$res=json_encode($res);
		}
		else
		{
			$res=json_encode($_SESSION[$skey]);
		}
		return $res;
	}
	public function sessionarraydata($v){
		$data=$this->json_key_set($v,"data");
		$vars=$this->json_key_set($v,"vars");
		$vals=$this->json_key_set($v,"vals");
		$display=$this->json_key_set($v,"display");
		$theme=$this->json_key_set($v,"theme");
		
		if(isset($_SESSION[$data])){
			$datax=$_SESSION[$data];	
			$jb = $this->gettheme($theme);
			$data=array();$xc=0;$sln=0;
			foreach($datax as $k=>$x)
			{
				$sln+=1;
				$data[$xc]=array();
				for($a=0;$a<count($vars);$a+=1)
				{
					if($vars[$a]=="SLN"){
					$data[$xc][]=$sln;
					}else{
					$data[$xc][]=$x[$vars[$a]];
					}
				}
				$jd=$this->s_replace($vals,$data[$xc],$jb);
				$job=$this->jdec($jd);
				
				$this->inblock($job,"");
				$xc+=1;
			}
		}
	}
	public function setsession($v)
	{
		$sty = $this->json_key_set($v,"sty");
		$ses = $this->json_key_set($v,"ses");
		$sva = $this->json_key_set($v,"sva");
		for($i=0;$i<count($sty);$i+=1)
		{
			switch($sty[$i]){
				case "set": $_SESSION[$ses[$i]]=$sva[$i]; break;
				default: unset($_SESSION[$ses[$i]]); break;
			}
		}
	}
	public function setsessionarray($v)
	{
		$skey = $this->json_key_set($v,"skey");
		$sid = $this->json_key_set($v,"sid");
		$sfld = $this->json_key_set($v,"sfld");
		$sval = $this->json_key_set($v,"sval");
		$sact = $this->json_key_set($v,"sact");
		if($sact=="yes"){
			for($i=0;$i<count($sfld);$i+=1)
			{
				$_SESSION[$skey][$sid][$sfld[$i]]=$sval[$i];
			}
		}else{}
	}
	public function setsessiontoarray($v)
	{
		$sid = $this->json_key_set($v,"sid");
		$sfld = $this->json_key_set($v,"sfld");
		$sval = $this->json_key_set($v,"sval");
		$sact = $this->json_key_set($v,"sact");
		if($sact=="yes"){
			for($i=0;$i<count($sfld);$i+=1)
			{
				$_SESSION[$sid][$sfld[$i]]=$sval[$i];
			}
		}else{
			for($i=0;$i<count($sfld);$i+=1)
			{
				unset($_SESSION[$sid][$sfld[$i]]);
			}
		}
	}
	public function get_value_from_array_session_new($v)
	{
		$delim = $this->json_key_set($v,"delim");
		$content = $this->json_key_set($v,"content");
		$sufix = $this->json_key_set($v,"sufix");
		$prefix = $this->json_key_set($v,"prefix");		
		$vi = explode($delim,$content);
		$vlt = count($vi)-1;
		$ses=$_SESSION;
		switch($vlt)
		{
			case "1":
			$res = $ses[$vi[0]][$vi[1]];
			break;
			case "2":
			$res = $ses[$vi[0]][$vi[1]][$vi[2]];
			break;
			case "3":
			$res = $ses[$vi[0]][$vi[1]][$vi[2]][$vi[3]];
			break;
			case "4":
			$res = $ses[$vi[0]][$vi[1]][$vi[2]][$vi[3]][$vi[4]];
			break;
			default:
			$res = $ses[$vi[0]];
			break;
		}
		return $sufix.$res.$prefix;
	}
	public function getstring($f)
	{
		$str = $this->json_key_set($f,"content");
		$exp = $this->json_key_set($f,"sep");
		$num = $this->json_key_set($f,"num");
		$con = explode($exp,$str);
		$res="";
		$las=count($con);
		switch($num)
		{
			case "first": $res=$con[0]; break;
			case "last": $res=$con[$las-1]; break;
			default: $res=$con[$num]; break;
		}
		echo $res;
	}
	public function htmlraw($v){
		$res="";
		if(file_exists($v))
		{
			$res=htmlentities($this->read_file($v));
		}
		else
		{
			$res = "File You Mentioned not Found, please place the file and try ".$v;
		}
		return $res;
	}
	public function ifelse($v)
	{
		$res="";
		$type=$this->json_key_set($v,"type");
		$val=$this->json_key_set($v,"val");
		$yes=$this->json_key_set($v,"yes");
		$no=$this->json_key_set($v,"no");
		$ary=$this->json_key_set($v,"array");
		$myval=$this->json_key_set($v,"myval");
		$redir=$this->json_key_set($v,"redir");
		
		switch($type)
		{
		    case "string_in_content":
				if(is_array($myval)){
					for($i=0;$i<count($myval);$i+=1)
					{
						$pos = strpos($val,$myval[$i]);
						if($pos){$posx=$pos;}else{}
					}
				}else{
					$posx = strpos($val,$myval);
				}
				
				if($posx){
					$thm=$yes;
				}else{ $thm=$no;}
				$hml=$this->gettheme($thm);
				$jd=$this->s_replace($vals,$data,$hml); 
				$hml=$this->jdec($jd);
				$this->inblock($hml,"");
			break;
		    case "number_greater_or_less":
				$array = $this->json_key_set($v,"array");
				$val = (int)$val;
				if(count($array)>0){
					for($i=0;$i<count($array);$i+=1){
						$spl = explode("|",$array[$i]);
						$sple = explode("to",$spl[1]);
						$min = (int)$sple[0];
						$max = (int)$sple[1];
						if($val>=$min and $val<=$max){
							$tx=$this->json_key_set($v,$spl[0]);
							$thm=$tx;
						}
					}
				}else{
					$thm=$no;
				}
				$hml=$this->gettheme($thm);
				$jd=$this->s_replace($vals,$data,$hml); 
				$hml=$this->jdec($jd);
				$this->inblock($hml,"");
			break;
		    case "ismobileoremail":
				$val = $this->json_key_set($v,"val");
				$vals = $this->json_key_set($v,"vals");
				$data=$this->chkemailmobile($val); 
				if(is_array($data) or $data!="no")
				{
					$thm=$yes;
				}else{
					$thm=$no;
				}
				$hml=$this->gettheme($thm);
				$jd=$this->s_replace($vals,$data,$hml); 
				$hml=$this->jdec($jd);
				$this->inblock($hml,"");
				break;
		    case "isgreater_value_from_class":
				$fval = $this->json_key_set($v,"fvalue");
				$fval = file_get_contents($fval);
				$sval = $this->json_key_set($v,"svalue");
				$sval = file_get_contents($sval);
				$vals = $this->json_key_set($v,"vals");
				$data=array($fval,$sval,$sval-$fval);
				if($sval>$fval)
				{
					$thm=$yes;
				}else{
					
					$thm=$no;
				}
				$hml=$this->gettheme($thm);
				$jd=$this->s_replace($vals,$data,$hml);
				$hml=$this->jdec($jd);				
				$this->inblock($hml,"");
			break;
			case "isgreater":
				$fval = $this->json_key_set($v,"fval");
				$sval = $this->json_key_set($v,"sval");
				if($fval>$sval)
				{
					$thm=$yes;
				}else{
					
					$thm=$no;
				}
				$hml=$this->gettheme($thm);
				$hml=$this->jdec($hml);
				$this->inblock($hml,"");
			break;
			case "isless":
				$fval = $this->json_key_set($v,"fval");
				$sval = $this->json_key_set($v,"sval");
				if($fval<$sval)
				{
					$thm=$yes;
				}else{
					
					$thm=$no;
				}
				$hml=$this->gettheme($thm);
				$hml=$this->jdec($hml);
				$this->inblock($hml,"");
			break;
			case "fromtodate_display":
				$today = date("Y-m-d");
				if($today<$val)
				{
					$thm=$yes;
				}else{
					
					$thm=$no;
				}
				$hml=$this->gettheme($thm);
				$hml=$this->jdec($hml);
				$this->inblock($hml,"");
			break;
			case "inarray":
				if(in_array($val,$ary))
				{
					$thm=$yes;
				}else
				{
					$thm=$no;
				}
				$hml=$this->gettheme($thm);
				$hml=$this->jdec($hml);
				$this->inblock($hml,"");
			break;
			case "inblock_display":
				if($val==$myval)
				{
					$thm=$yes;
				}
				else
				{
					$thm=$no;
				}
				$hml=$this->gettheme($thm);
				$hml=$this->jdec($hml);
				$this->inblock($hml,"");
			break;
			case "file_exists":
				if(file_exists($val))
				{
					$thm=$yes;
				}
				else
				{
					$thm=$no;
				}
				$hml=$this->gettheme($thm);
				$hml=$this->jdec($hml);
				$this->inblock($hml,"");
			break;
			case "betweendates":
				$dto=$this->json_key_set($v,"dateto");
				$dfr=$this->json_key_set($v,"datefrom");
				$tot= $this->dateDiffInDays($dto,$dfr);
				$dateblks=array();
				for($cv=0;$cv<=$tot;$cv+=1)
				  {
					  $dateblks[]=$this->din("Y-m-d",$dfr,$cv,"days");
				  }
				if(in_array($myval,$dateblks))
				{
					$thm=$yes;
				}
				else
				{
					$thm=$no;
				}
				$hml=$this->gettheme($thm);
				$hml=$this->jdec($hml);
				$this->inblock($hml,""); 
			break;
			case "session_val_array": 
				$sid=$this->json_key_set($v,"sid");
				if(isset($_SESSION[$val])){$sesd=$_SESSION[$val];}else{$_SESSION[$val]=array();$sesd=$_SESSION[$val];}
				if(in_array($myval,$sesd))
				{
					$thm=$yes;
				}
				else
				{
					$thm=$no;
				}
				$hml=$this->gettheme($thm);
				$hml=$this->jdec($hml);
				$this->inblock($hml,"");
			break;
			case "insessionarray":
				if(isset($_SESSION[$val])){$sesd=$_SESSION[$val];}else{$_SESSION[$val]=array();$sesd=$_SESSION[$val];}
				$sid=$this->json_key_set($v,"sid");
				$cav=array();
				for($i=0;$i<count($sesd);$i+=1){$cav[]=$sesd[$i][$sid];}
				if(in_array($myval,$cav))
				{
					$thm=$yes;
				}
				else
				{
					$thm=$no;
				}
				$hml=$this->gettheme($thm);
				$hml=$this->jdec($hml);
				$this->inblock($hml,""); 
			break;
			case "value_check":
				$valchk=$this->json_key_set($v,"valchk");
				$class = $this->json_key_set($v,"class");
				$valid_number = $this->json_key_set($v,"valid_number");
				$valid_type = $this->json_key_set($v,"valid_type");
				$valid_length = $this->json_key_set($v,"valid_length");
				$ercol = $this->json_key_set($v,"ercol");
				$nocol = $this->json_key_set($v,"nocol");
				$res=$this->checkvalid($valchk,$class,$valid_number,$valid_type,$valid_length,$ercol,$nocol);
				if($res=="ok"){
					$res="";
					$ys = $this->gettheme($yes);
					$ys=$this->jdec($ys);
					$this->inblock($ys,"");
				}else{
					
				if($no==""){}else{
							$ys = $this->gettheme($no);
						$ys=$this->jdec($ys);
						$this->inblock($ys,"");
					}				
				}
			break;
			case "value_check_new":
				$valchk=$this->json_key_set($v,"valchk");
				$class = $this->json_key_set($v,"class");
				$valid_number = $this->json_key_set($v,"valid_number");
				$valid_type = $this->json_key_set($v,"valid_type");
				$valid_length = $this->json_key_set($v,"valid_length");
				$ercol = $this->json_key_set($v,"ercol");
				$nocol = $this->json_key_set($v,"nocol");
				$rces=$this->checkvalidnew($valchk,$class,$valid_number,$valid_type,$valid_length,$ercol,$nocol);
				if($rces[0]=="ok"){
					$ys = $this->gettheme($yes);
					$ys=$this->jdec($ys);
					$this->inblock($ys,"");
				}else{
					if($no==""){}else{
							$myres = $this->json_key_set($v,"myres");
							$ys = $this->gettheme($no);
							$mda = $this->s_replace($myres,$rces,$ys);
						$ys=$this->jdec($mda);
						$this->inblock($ys,"");
					}					
				}
			break;
			case "str_replace":
					$prefix = $this->json_key_set($v,"prefix");
					$sufix = $this->json_key_set($v,"sufix");
					$min = $this->json_key_set($v,"min");
					$ary = $this->json_key_set($v,"ary");
					$max = $this->json_key_set($v,"max");$ml=array();
					for($i=$min;$i<$max;$i+=1){ 
						$ml[$i]=$i;
					}
					$jxb= $this->s_replace($ml," ",$val);
					$jxb= $this->s_replace($ary," ",$val);
					echo $prefix.$jxb.$sufix;
				break;
			case "isset_none":
					$cnt=count($myval);
					for($i=0;$i<count($myval);$i+=1){
							if($myval[$i]==$val[$i]) {
								$x+=1;
							}else{		
									$x+=0;} 
					}
					if($x==$cnt)
					{
						$thm=$yes;
					}
					else
					{
						$thm=$no;
					}
					$hml=$this->gettheme($thm);
					$hml=$this->jdec($hml);
					$this->inblock($hml,"");
				break;
			case "folder_search_string":
				$val=$this->json_key_set($v,"val");
				$myval=$this->json_key_set($v,"myval");
				$folder=$this->json_key_set($v,"folder");
				$yesvals=$this->json_key_set($v,"yesvals");
				$yes_child_vals=$this->json_key_set($v,"yes_child_vals");
				$check_childs=$this->json_key_set($v,"check_childs");
				$filter_childs_ext=$this->json_key_set($v,"filter_childs_ext");				
				$data = $this->getserdet($folder,$filter_childs_ext);
				$hml=$this->gettheme($yes);$chk=0;
				foreach ($data as $url) {
					$pos = strpos($url,$myval);
					if ($pos>0) {
						$jxb= $this->s_replace($yesvals,$url,$hml);
						$jxd=$this->jdec($jxb);
						$this->inblock($jxd,'');
						$chk+=1;
					}			
				}
				if($chk==0){
					$hml=$this->gettheme($no);
					$hml=$this->jdec($hml);
					$this->inblock($hml,"");
					}
				if($check_childs=="yes")
				{
					$child_theme=$this->json_key_set($v,"child_theme");
					$hml=$this->gettheme($child_theme);$xchk=0;
					for($i=0;$i<count($data);$i+=1)
					{
						$child_data[$i]=array();
						$data_c = $this->getserdet($folder.$data[$i],$filter_childs_ext);
						//var_dump($data_c);
						foreach($data_c as $flx){
							
							$child_data[$i] = array($data[$i],$flx);
							$posx = strpos($flx,$myval);
							if ($posx>0) {
								$jxb= $this->s_replace($yes_child_vals,$child_data[$i],$hml);
								$jxd=$this->jdec($jxb);
								$this->inblock($jxd,'');
								$xchk+=1;
							}
						}
					}
				}
								 
			break;			
			default: $res=""; break;
		}
		return $res;
	}
	public function getserdet($folder,$filter_childs_ext){
		
		$scdir = scandir($folder); $data=array();
		for($i=2;$i<count($scdir);$i+=1)
				{
					$pat = pathinfo($scdir[$i]);
					if(array_key_exists("extension",$pat))
					{
						if(is_array($filter_childs_ext)){
							if(in_array($pat["extension"],$filter_childs_ext)){
								$data[] = $pat['filename'];
							}
						}
						else
						{
							if($pat["extension"]==$filter_childs_ext){
								$data[] = $pat['filename'];
							}
						}
					}else{
						$data[] = $pat['filename'];
					}
				}
		return $data;
	}
	public function chkcountrycode($v)
	{
		$cc = "lib/countrycodes.json";
		$nar=array();
		if(file_exists($cc)){
			$rf=$this->read_file($cc);
			$rf=json_decode($rf);
			for($i=0;$i<count($rf);$i+=1)
			{
				//echo strpos($v,$rf[$i]->dial_code).", ";
				if(strpos($v,$rf[$i]->dial_code)>-1){
					$mob=str_replace($rf[$i]->dial_code,"",$v);
					$nar['country']=$rf[$i]->name;
					$nar['dailcode']=$rf[$i]->dial_code;
					$nar['mobile']=$mob;
				}
			}
			
		}else{
			$nar['country']="";
			$nar['dailcode']="";
			$nar['mobile']=$v;
		}
		return $nar;
	}
	public function chkemailmobile($v)
	{
		$chkc = $this->chkcountrycode($v); 
		$res="no";
		if($v[0]=="0" or $v[0]=="+"){$v= substr($v,1);}else{$v=$v;}
		$res = $this->chkmobeml($v); 
		if($res['isnumber']==false){
			$res = $this->chkmobeml($v);
			if($res['atpos']==false or $res['dotpos']==false){
				$res="no";
			}
			else
			{
				if(count($chkc)>0){
					$res=$chkc;
				}else{
					$res=$v;
				}
				
			}
		}
		else
		{
			if($res['strlen']>9)
			{
				if(count($chkc)>0){
					$res=$chkc;
				}else{
					$res=$v;
				}
			}else
			{
				$res="no";
			}
		}
		
		return $res;
	}
	public function checkvalidnew($valchk,$class,$valid_number,$valid_type,$valid_length,$ercol,$nocol){
		$err=array();	
				$mm="";	$yy="";
		foreach($valchk as $k=>$v){
		if($v==""){ 
			$nn[]=''; $err[0].=" ".$k." field required, ";$err[1].=".".$k.","; 
			}
			else
			{			
				for($x=0;$x<count($valid_number);$x+=1)
				{
					if($k==$valid_number[$x]){
						switch($valid_type[$x])
						{
							case "alphanumeric": 
								$res = $this->chkmobeml($v); 
								if($res['alphanumeric']==false){
								$nn[]=''; 
									$mm.=" Invalid language (".$valid_number[$x]."), ";
									$yy.=".".$valid_number[$x].", ";
								}else{ $nn[]=$res['value']; $mm.=""; }	
							break;
							case "number": 
								$res = $this->chkmobeml($v);
								if($res['isnumber']==false){
								$nn[]=''; $mm.=" Invalid (".$valid_number[$x]."), "; 
									$yy.=".".$valid_number[$x].", ";
								}else{ $nn[]=$res['value']; $mm.=""; }	
							break;
							case "numberlength": 
								$res = $this->chkmobeml($v);
								if($res['isnumber']==false or $res['strlen']!=$valid_length[$x]){
								$nn[]=''; $mm.=" Invalid (".$valid_number[$x].") Min length $valid_length[$x] Char, ";
									$yy.=".".$valid_number[$x].", ";
								}else{ $nn[]=$res['value']; $mm.=""; }	
							break;
							case "email": 
								$res = $this->chkmobeml($v);
								if($res['atpos']==false or $res['dotpos']==false){
								$nn[]=''; $mm.=" Invalid (".$valid_number[$x]."), "; 
									$yy.=".".$valid_number[$x].", ";
								}else{ $nn[]=$res['value']; $mm.=""; }	
							break;
							default: break;
						}
					}
				}
				$err[0]=$mm;
				$err[1]=$yy;
			}
		}
		$or=count($nn);
		$chk = array_filter($nn, 'strlen');
		$fl=count($chk);
		if($or==$fl){
		$fres[0] = "ok";		
		}else{$fres = $err;}		
		return $fres; 
	}
	public function checkvalid($valchk,$class,$valid_number,$valid_type,$valid_length,$ercol,$nocol){
		$err="";	
		foreach($valchk as $k=>$v){
		if($v==""){ 
			$nn[]=''; $err.=" ".$k.", ";
			?><script> vf(".<?=$k?>, .<?=$k?>xx",{2:'1px solid '+c[<?=$ercol?>]}); vf("<?=$class?>",{1:c[30],56:'uppercase',14:1});</script><?php 
			}
			else
			{
				$nn[]=$v; ?><script> vf(".<?=$k?>, .<?=$k?>xx",{2:'1px solid '+c[<?=$nocol?>]});  </script> <?php 
				$mm="";
				
				for($x=0;$x<count($valid_number);$x+=1)
				{
					if($k==$valid_number[$x]){
						switch($valid_type[$x])
						{
						    	case "alphanumeric": 
								$res = $this->chkmobeml($v); 
								if($res['alphanumeric']==false){
								$nn[]=''; $mm.=" Invalid language in ".$valid_number[$x]." Field, ";
								?><script> vf(".<?=$valid_number[$x]?>",{2:'1px solid '+c[<?=$ercol?>]}); vf("<?=$class?>",{1:c[<?=$ercol?>],56:'uppercase',14:1});  </script> <?php 
								}else{ $nn[]=$res['value']; $mm.=""; ?><script> vf(".<?=$valid_number[$x]?>",{2:'1px solid '+c[<?=$nocol?>]});  </script> <?php   }	
							break;
							case "alpha": 
								$res = $this->chkmobeml($v); 
								if($res['alpha']==false){
								$nn[]=''; $mm.=" Invalid ".$valid_number[$x].", ";
								?><script> vf(".<?=$valid_number[$x]?>",{2:'1px solid '+c[<?=$ercol?>]}); vf("<?=$class?>",{1:c[<?=$ercol?>],56:'uppercase',14:1});  </script> <?php 
								}else{ $nn[]=$res['value']; $mm.=""; ?><script> vf(".<?=$valid_number[$x]?>",{2:'1px solid '+c[<?=$nocol?>]});  </script> <?php   }	
							break;
							case "number": 
								$res = $this->chkmobeml($v);
								if($res['isnumber']==false){
								$nn[]=''; $mm.=" Invalid number in ".$valid_number[$x]." field, ";
								?><script> vf(".<?=$valid_number[$x]?>",{2:'1px solid '+c[<?=$ercol?>]}); vf("<?=$class?>",{1:c[<?=$ercol?>],56:'uppercase',14:1});  </script> <?php 
								}else{ $nn[]=$res['value']; $mm.=""; ?><script> vf(".<?=$valid_number[$x]?>",{2:'1px solid '+c[<?=$nocol?>]});  </script> <?php   }	
							break;
							case "numberlength": 
								$res = $this->chkmobeml($v);
								if($res['isnumber']==false or $res['strlen']!=$valid_length[$x]){
								$nn[]=''; $mm.=" Invalid number ".$valid_number[$x]." Min length $valid_length[$x] Char, ";
								?><script> vf(".<?=$valid_number[$x]?>",{2:'1px solid '+c[<?=$ercol?>]}); vf("<?=$class?>",{1:c[<?=$ercol?>],56:'uppercase',14:1});  </script> <?php 
								}else{ $nn[]=$res['value']; $mm.=""; ?><script> vf(".<?=$valid_number[$x]?>",{2:'1px solid '+c[<?=$nocol?>]});  </script> <?php   }	
							break;
							case "email": 
								$res = $this->chkmobeml($v);
								if($res['atpos']==false or $res['dotpos']==false){
								$nn[]=''; $mm.=" Invalid email in ".$valid_number[$x]." field, ";
								?><script> vf(".<?=$valid_number[$x]?>",{2:'1px solid '+c[<?=$ercol?>]}); vf("<?=$class?>",{1:c[<?=$ercol?>],56:'uppercase',14:1});  </script> <?php 
								}else{ $nn[]=$res['value']; $mm.=""; ?><script> vf(".<?=$valid_number[$x]?>",{2:'1px solid '+c[<?=$nocol?>]});  </script> <?php   }	
							break;
							default: break;
						}
					}
				}
				$err.=$mm;
			}
		}
		$or=count($nn);
		$chk = array_filter($nn, 'strlen');
		$fl=count($chk);
		if($or==$fl){
		?><script>vf("<?=$class?>",{1:c[<?=$ercol?>]});</script> <?php
		$insinp="";$fld="";
		
		$fres = "ok";
		
		
		}else{$fres = "Fields required&nbsp;&nbsp; <i>".$err."</i>";}
		
		return $fres; 
	}
	public function para($a) {   $rf = $this->read_file_to_array($a); $dat=""; 
	if(file_exists($a)){
	for($r=0;$r<count($rf);$r+=1) {  $val = strspn($rf[$r]," "); if($val==""){echo "";}else{} switch($val) { case 1: echo "<h1>".$rf[$r]."</h1>"; break; case 2: echo "<h2>".$rf[$r]."</h2>"; break; case 3: echo "<ul>"; echo "<li>".$rf[$r]."</li>"; echo "</ul>"; break; case 4: echo "<ol>"; echo "<li>".$rf[$r]."</li>"; echo "</ol>"; break; case 5: echo "<br/><h3>".$rf[$r]."</h3>"; break; case 6: echo "<h4>".$rf[$r]."</h4>"; break; case 7: echo "<h5>".$rf[$r]."</h5>"; break; case 8: echo "<b>".$rf[$r]."</b>"; break; case 9: $pst=explode("|",ltrim($rf[$r])); echo "<img class='pimg' src='".$pst[0]."' alt='".$pst[1]."' longdesc='".$pst[2]."' width='".$pst[3]."' height='".$pst[4]."' />"; break; case 10: $pst=explode("|",ltrim($rf[$r])); echo "<img class='pimg' src='".$pst[0]."' align='left' alt='".$pst[1]."' longdesc='".$pst[2]."' width='".$pst[3]."' height='".$pst[4]."' />"; break; case 11: $pst=explode("|",ltrim($rf[$r])); echo "<img class='pimg' src='".$pst[0]."' align='right' alt='".$pst[1]."' longdesc='".$pst[2]."' width='".$pst[3]."' height='".$pst[4]."' />"; break; case 13: $ula=explode('|',$rf[$r]); echo $ula[0]."<a class='".$ula[4]."' href='".$ula[2]."' target='".$ula[3]."'>".$ula[1]."</a>".$ula[5]; break; case 14: $ifr=explode('|',$rf[$r]); ?><iframe src="<?= $ifr[0] ?>" frameborder="0" width="<?= $ifr[1] ?>" height="<?= $ifr[2] ?>"></iframe><?php break; 
case 16: $aimg = explode("|",$rf[$r]); ?><a href='<?=ltrim($aimg[0])?>' class="<?=rtrim($aimg[7])?>" target='<?=$aimg[1]?>'><img src="<?=ltrim($aimg[0])?>" alt="<?=$aimg[2]?>" longdesc="<?=$aimg[3]?>" width="<?=$aimg[4]?>" height="<?=$aimg[5]?>" align="<?=$aimg[6]?>" /></a><?php break;  default: echo "<p>".$rf[$r]."</p>"; break; } } ?><?php 
	}else{}
	}
	public function svg($f)
	{
		$ar=array();
		foreach($f as $k=>$v){
			for($i=0;$i<count($v);$i+=1)
			{
				echo "<".$k." ".$this->set_attrs($v[$i],"",$ar)." />";
			}		
		}
	}
	public function svgcss($xf)
	{ 	$rf = $this->read_file("webres.json");
		$fd=$this->jdec($rf);
		$d= $fd[0];
		$c=$d->c;
		$f=$d->f;
		$ar=array();
		echo "<defs>"; foreach($xf as $k=>$v){
			echo '<'.$k.' '.$this->set_attrs($v,"attr",$ar).'>'; $stop = $this->json_key_set($v,"css"); foreach($stop as $sk=>$sv){ echo '<stop offset="'.$sk.'" stop-color="'.$c[$sv].'" />'; } echo '</'.$k.'>'; } echo "</defs>";
	}
	public function swichcase($v)
	{
		$key=$this->json_key_set($v,"val");
		$nil=$this->json_key_set($v,"nil");
		if($key=="")
		{
			$this->inblock($nil,"");
		}
		else
		{
			if(!isset($v->$key))
			{
				$nky=$nil;
				//echo "<b>< $key ></b> Switch Not Find in the page, Please check the Source Code<hr/>";
			}
			else
			{
				$nky=$v->$key;
			}
			$this->inblock($nky,"");
		}
		
	}
	public function totalcount($v)
	{
		$type = $this->json_key_set($v,"type");
		$vals = $this->json_key_set($v,"vals");
		$pref=$this->json_key_set($v,"prefix");
		$sufi=$this->json_key_set($v,"sufix");
		$nar=array();
		for($i=0;$i<count($vals);$i+=1)
		{ 	$ex = explode("|",$vals[$i]);
			switch($type[$i])
			{
				case "percent":
					$nar[]=$ex[0]*$ex[1]/100;
				break;
				case "multiply":
					$nar[]=$ex[0]*$ex[1];
				break;
				case "multi_percent":
					$add=$ex[0]*$ex[1];
					$nar[]=$add*$ex[2]/100;
				break;
				case "multi_percent_limit":
					if($ex[0]>$ex[3]){
						$add=$ex[0]*$ex[1];
						$nar[]=$add*$ex[2]/100;
					}
					else
					{
						$nar[]=0;
					}
				break;
				default: $nar[]=$ex[0]; break;
			}
		}
		echo $pref.array_sum($nar).$sufi;
	}
	public function viewbyarray($v)
	{
		$data=$this->json_key_set($v,"data");
		$vars=$this->json_key_set($v,"vars");
		$defs=$this->json_key_set($v,"defs");
		$type=$this->json_key_set($v,"type");
		$theme=$this->json_key_set($v,"theme");
		$jb = $this->gettheme($theme);
		$cx="";$ndat = array();
		for($i=0;$i<count($vars);$i+=1)
		{
			if($data[$i]==""){$ndat[$i]=$defs[$i];}else{
				switch($type[$i])
				{
					case "enc":
						$ndat[$i]=$this->encdec('',$data[$i],'');
					break;
					case "dec":
						$ndat[$i]=$this->encdec('d',$data[$i],'');
					break;
					default:
						$ndat[$i]=$data[$i];					
					break;
				}
			}	
		}
		$jd=$this->s_replace($vars,$ndat,$jb);
		$job=$this->jdec($jd);
		$this->inblock($job,"");
	}
	public function renamefile($v)
	{
		$ext = $this->json_key_set($v,"extensions");
		$oldname = $this->json_key_set($v,"oldname");
		$newname = $this->json_key_set($v,"newname");
		if(is_array($ext) or count($ext)>0)
		{
			for($i=0;$i<count($ext);$i+=1)
			{				
				if(file_exists($oldname.".".$ext[$i]))
				{
					if(rename($oldname.".".$ext[$i],$newname.".".$ext[$i])){
						echo "Rename Done ";
					}else
					{
						echo "<hr/>".$oldname.".".$ext[$i].", ".$newname.".".$ext[$i]." false";
					}
				}
				else
				{
					echo "File Not Found [".$oldname.".".$ext[$i]."], please Check";
				}
			}
		}else
		{
			if($ext=="" or count($ext)<0)
			{
				echo "Please mention the extension of the file in array format ['','']";
			}else
			{
				
			}
		}
	}
	public function delfile($v)
	{
		$ext = $this->json_key_set($v,"extensions");
		$filename = $this->json_key_set($v,"filename");
		if(is_array($ext) or count($ext)>0)
		{
			for($i=0;$i<count($ext);$i+=1)
			{
				if(file_exists($filename.".".$ext[$i]))
				{
					if(unlink($filename.".".$ext[$i]))
					{
						echo "Deleted ";
					}else
					{
						echo "Not Deleted ".$filename.".".$ext[$i].", ";
					}
				}
				else
				{
					echo "File Already Deleted ".$filename.".".$ext[$i];
				}
			}
		}
		else
		{
			echo "File extensions not defined";
		}
	}
	public function appdefine($v)
	{
		foreach($v as $k=>$v)
		{
			define($k,$v);
		}
	}
	public function writetxtfile_two($v)
	{
		$folder  = $v->folder;
		if(file_exists($folder)){}else{mkdir($folder);}
		$myfile  = $v->myfile;
		$ndata = $v->data;
		$datatype = isset($v->datatype)?$v->datatype:"";
		switch($datatype){
			case "data_to_html":
				$ndata = htmlspecialchars_decode(html_entity_decode($ndata),ENT_NOQUOTES);	
				break;
				case "data_to_json":
				$ndata = json_encode($ndata);	
				break;
			default:
			$ndata = $ndata;
			break;
		}
		$fo = fopen($folder."/".$myfile,"w");
			if($fo){
			fwrite($fo,$ndata);
			fclose($fo);
			}else
			{
				echo "File not opening ".$folder."/".$myfile;
			}
	}
	public function writetxtfile($v)
	{
		$myfile  = $v->myfile;
		$ndata = $v->data;
		$fo = fopen($myfile,"w");
			if($fo){
			fwrite($fo,$ndata);
			fclose($fo);
			}else
			{
				echo "File not opening";
			}
	}
	public function writecsv($v){
		$csvfile = $this->json_key_set($v,"csvfile");
		$ndata = array();
		if(file_exists($csvfile))
		{
			$data = $this->read_csv_file($csvfile);
			$tot=count($data);
			$data[$tot]=$this->json_key_set($v,"data");
			$fo = fopen($csvfile,"w");
			foreach($data as $dd)
			{
				fputcsv($fo,$dd);
			}
		}else
		{
			$ndata = $this->json_key_set($v,"data");
			$fo = fopen($csvfile,"w");
			if($fo){
			fputcsv($fo,$ndata);
			fclose($fo);
			}else
			{
				echo "File not opening";
			}
		}
		
	}
	public function calwidget($v)
	{
		$dfrom=$this->json_key_set($v,"dfrom");
		$dto=$this->json_key_set($v,"dto");
		$vars=$this->json_key_set($v,"vars");
		$vals=$this->json_key_set($v,"vals");
		$theme=$this->json_key_set($v,"theme");
		$jb = $this->gettheme($theme);
		$xn=array();
		$dys = $this->dateDiffInDays($dto, $dfrom); 
		for($i=0;$i<$dys;$i+=1)
		{
			$dmx = $this->din("m",$dfrom,$i,'days');
			$ddx = $this->din("d",$dfrom,$i,'days');
			$dyx = $this->din("Y",$dfrom,$i,'days');
			$xn[$dyx."-".$dmx][]=$ddx;
		}
		$mn=array();
		$z=0; $vx="1";
		foreach($xn as $kk=>$vv)
		{
			for($j=0;$j<count($vars);$j+=1)
			{
				switch($vars[$j])
				{
					case "DAYS": $mn[$z][$j]=implode(",",$vv); break;
					case "SLN": $mn[$z][$j]= $vx; break;
					default: $mn[$z][$j]=$this->din($vars[$j],$kk,0,'months'); break;
				}			
			}
			$jd=$this->s_replace($vals,$mn[$z],$jb);
			$job=$this->jdec($jd);
			$this->inblock($job,"");
			$z+=1;$vx+=1;
		}
	}
	public function csv_fld_combine($v)
	{
		$csvflds = $this->json_key_set($v,"csvflds");
		$vars=$this->json_key_set($v,"vars");
		$thm = $this->json_key_set($v,"theme");
		$theme=$this->gettheme($thm);
		$dat=array();
		
		for($i=0;$i<count($vars);$i+=1)
		{
			$spl = explode(",",$csvflds[$i]);
			for($x=0;$x<count($spl);$x+=1)
			{
				$dat[$x][$i]=$spl[$x];
			}
		}
		for($g=0;$g<count($dat);$g+=1)
		{
			$jd=$this->s_replace($vars,$dat[$g],$theme);
			$job=$this->jdec($jd);
			$this->inblock($job,"");
		}
	}
	public function csv_fld_combine_tojson($v)
	{
		$dat=array();
		$spl = explode(",",$v[0]);
		$spv = explode(",",$v[1]);
		for($i=0;$i<count($spl);$i+=1)
		{
			$fg=trim($spv[$i]);
			if($fg=="0" or $fg==""){}else{
			$dat[$spl[$i]]=$fg;
			}
		}
		return json_encode($dat,true);
	}
	public function session_and_post_value($p,$d,$ad)
	{
		$spl = explode(",",$p);
		$fd = isset($_SESSION[$spl[0]])?$_SESSION[$spl[0]]:0;
		$sd = isset($_POST[$spl[1]])?$_POST[$spl[1]]:0;
		$fres=0;
		switch($ad)
		{
			case "add": $fres=$fd+$sd; break;
			case "minus": $fres=$fd-$sd; break;
			default: $fres=0; break;
		}
		return $fres;
	}
	public function resize_image($v) 
	{
		$file=$this->json_key_set($v,"file");
		$w=$this->json_key_set($v,"width");
		$h=$this->json_key_set($v,"height");
		$crop=FALSE;
		
		list($width, $height) = getimagesize($file);
		$r = $width / $height;
		if ($crop) {
			if ($width > $height) {
				$width = ceil($width-($width*abs($r-$w/$h)));
			} else {
				$height = ceil($height-($height*abs($r-$w/$h)));
			}
			$newwidth = $w;
			$newheight = $h;
		} else {
			if ($w/$h > $r) {
				$newwidth = $h*$r;
				$newheight = $h;
			} else {
				$newheight = $w/$r;
				$newwidth = $w;
			}
		}
		$src = imagecreatefrompng($file);
		$dst = imagecreatetruecolor($newwidth, $newheight);
		imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
	
		return $dst;
	}
	public function cropimg($v)
	{
		$image=$this->json_key_set($v,"image");
		$to_width=$this->json_key_set($v,"to_width");
		$to_height=$this->json_key_set($v,"to_height");
		$rename_image=$this->json_key_set($v,"rename_image");
		$frmx=$this->json_key_set($v,"frmx");
		$frmy=$this->json_key_set($v,"frmy");
		
		$original = imagecreatefromjpeg($image); // ORIGINAL 600 X 324 px
		 list($imgWidth, $imgHeight) = getimagesize($image);
		$resized = imagecreatetruecolor($to_width, $to_height); // SMALLER BY 50%
		imagecopyresampled($resized, $original, 0, 0, $frmx, $frmy, $to_width, $to_height, $imgWidth, $imgHeight);
		imagejpeg($resized, $rename_image);
		imagedestroy($original);
		imagedestroy($resized);
		return $rename_image;
	}
	public function cur($v)
	{
		$url=$this->json_key_set($v,"url");
		$fields=$this->json_key_set($v,"fields");
		$fr=$this->json_key_set($v,"fr");
		$show_message=$this->json_key_set($v,"show_message");
		
		$fields_string="";$myres="";
		foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
		rtrim($fields_string, '&');
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POST,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$fields_string);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
		curl_setopt($ch, CURLOPT_HEADER      ,0);  // DO NOT RETURN HTTP HEADERS
		curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
		$response=curl_exec($ch);
		switch($fr)
		{
			case "json":				
				if($show_message==""){
					$myres = $response;
				}else{
					$myres=json_decode($response);
					$myres = $myres->$show_message;
				}
			break;
			default:
				$myres=$response;
			break;
		}	
		return $myres;
		curl_close($ch);
	}
	public function data_content($v)
	{ 	$res="";
		$content=$this->json_key_set($v,"content");
		$def=$this->json_key_set($v,"def");
		$content=$this->json_key_set($v,"content");
		if($content==""){$res=$def;}else{$res=$content;}
		return $res;
	}
	public function days_from_dates($v)
	{
		$date_one = $this->json_key_set($v,"date_one");
		$date_one_content = $this->json_key_set($date_one,"content");
		$date_one_format = $this->json_key_set($date_one,"format");
		$date_one_days = $this->json_key_set($date_one,"days");
		$date_one_daysfor = $this->json_key_set($date_one,"daysfor");
		
		$date_two = $this->json_key_set($v,"date_two");
		$date_two_content = $this->json_key_set($date_two,"content");
		$date_two_format = $this->json_key_set($date_two,"format");
		$date_two_days = $this->json_key_set($date_two,"days");
		$date_two_daysfor = $this->json_key_set($date_two,"daysfor");
		
		$date_one_date=$this->cust_date(str_replace("%20"," ",$date_one_content),$date_one_format,$date_one_days,$date_one_daysfor);
		$date_two_date=$this->cust_date(str_replace("%20"," ",$date_two_content),$date_two_format,$date_two_days,$date_two_daysfor);
		$pref = $this->json_key_set($v,"prefx");
		$sufx = $this->json_key_set($v,"suffx");
		$diffdays = $this->dateDiffInDays($date_one_date,$date_two_date);
		return $pref.$diffdays.$sufx;
	}
	public function webtheme($v)
	{
		$file=$v->webres;
		if(file_exists($file)){
    		$rf = $this->read_file($file);
    		$fd=$this->jdec($rf);
    		$d= $fd[0];
    		$c=$d->c;
    		$f=$d->f;
    		$root = $v->root;
    		if(file_exists($root)){
    			$r_rf = $this->read_file($root);
    			$r_fd=$this->jdec($r_rf);
    			if(isset($r_fd[0]->css)){
    				$css = $r_fd[0]->css;
    				if(isset($css->rootcol)){
    					foreach($css->rootcol as $ck=>$cv){ echo '<div style="background:'.$c[$cv].';" class="col">'.$ck.' '.$c[$cv].'</div>'; }
    					echo "<hr/>";
    				}else{}
    				if(isset($css->rootfon)){
    					foreach($css->rootfon as $ck=>$cv){ echo '<div style="font-family:'.$f[$cv].';" class="col">'.$ck.' '.$f[$cv].'</div>'; }
    				}else{}
    			}else{}
    		}else{}
    		echo "<hr/>";
    		for($i=0;$i<count($c);$i+=1)
    		{
    			echo '<div style="background:'.$c[$i].';"  class="col">'.$i.' '.$c[$i].'</div>';
    		}
    		for($i=0;$i<count($f);$i+=1)
    		{
    			echo '<div style="padding:5px;font-family:'.$f[$i].';"  class="col">'.$i.' '.$f[$i].'</div>';
    		}
		}else{
			echo "File Not Found ".$file;
		}
	}
	public function datentime($v)
	{
		$dblock=$this->json_key_set($v,"dblock");
		$block=$this->json_key_set($v,"block");
		$duration=$this->json_key_set($v,"duration");
		?><script>setInterval(function(){$('<?=$dblock?>').load('code.php?page=<?=$block?>');},'<?=$duration?>')</script><?php
	}
	public function makefolder($ad){
		$fln="";
		$sp = explode("/",$ad);   $cnt=count($sp);
		switch($cnt)
		{
			
			case 1:
				if(file_exists($sp[0])){$fln=$sp[0];}else{mkdir($sp[0],0777);$fln=$sp[0];}
				$ad=$fln."/";
			break;
			case 2:
				if(file_exists($sp[0])){$fln=$sp[0];}else{mkdir($sp[0],0777);$fln=$sp[0];}
				if(file_exists($sp[0]."/".$sp[1])){$fln=$sp[0]."/".$sp[1];}else{mkdir($sp[0]."/".$sp[1],0777);$fln=$sp[0]."/".$sp[1];}
				$ad=$fln."/";
			break;
			case 3:
				if(file_exists($sp[0])){$fln=$sp[0];}else{mkdir($sp[0],0777);$fln=$sp[0];}
				if(file_exists($sp[0]."/".$sp[1])){$fln=$sp[0]."/".$sp[1];}else{mkdir($sp[0]."/".$sp[1],0777);$fln=$sp[0]."/".$sp[1];}
				if(file_exists($sp[0]."/".$sp[1]."/".$sp[2])){$fln=$sp[0]."/".$sp[1]."/".$sp[2];}else{mkdir($sp[0]."/".$sp[1]."/".$sp[2],0777); $fln=$sp[0]."/".$sp[1]."/".$sp[2];}
				$ad=$fln."/";
			break;
			case 4:
					if(file_exists($sp[0])){$fln=$sp[0];}else{mkdir($sp[0],0777);$fln=$sp[0];}
				if(file_exists($sp[0]."/".$sp[1])){$fln=$sp[0]."/".$sp[1];}else{mkdir($sp[0]."/".$sp[1],0777);$fln=$sp[0]."/".$sp[1];}
				if(file_exists($sp[0]."/".$sp[1]."/".$sp[2])){$fln=$sp[0]."/".$sp[1]."/".$sp[2];}else{mkdir($sp[0]."/".$sp[1]."/".$sp[2],0777); $fln=$sp[0]."/".$sp[1]."/".$sp[2];}
				if(file_exists($sp[0]."/".$sp[1]."/".$sp[2]."/".$sp[3])){$fln=$sp[0]."/".$sp[1]."/".$sp[2]."/".$sp[3];}else{mkdir($sp[0]."/".$sp[1]."/".$sp[2]."/".$sp[3],0777); $fln=$sp[0]."/".$sp[1]."/".$sp[2]."/".$sp[3];}
				
				
				$ad=$fln."/";
			break;
			case "5":
				if(file_exists($sp[0])){$fln=$sp[0];}else{mkdir($sp[0],0777);$fln=$sp[0];}
				if(file_exists($sp[0]."/".$sp[1])){$fln=$sp[0]."/".$sp[1];}else{mkdir($sp[0]."/".$sp[1],0777);$fln=$sp[0]."/".$sp[1];}
				if(file_exists($sp[0]."/".$sp[1]."/".$sp[2])){$fln=$sp[0]."/".$sp[1]."/".$sp[2];}else{mkdir($sp[0]."/".$sp[1]."/".$sp[2],0777); $fln=$sp[0]."/".$sp[1]."/".$sp[2];}
				if(file_exists($sp[0]."/".$sp[1]."/".$sp[2]."/".$sp[3])){$fln=$sp[0]."/".$sp[1]."/".$sp[2]."/".$sp[3];}else{mkdir($sp[0]."/".$sp[1]."/".$sp[2]."/".$sp[3],0777); $fln=$sp[0]."/".$sp[1]."/".$sp[2]."/".$sp[3];}
				if(file_exists($sp[0]."/".$sp[1]."/".$sp[2]."/".$sp[3]."/".$sp[4])){$fln=$sp[0]."/".$sp[1]."/".$sp[2]."/".$sp[3]."/".$sp[4];}else{mkdir($sp[0]."/".$sp[1]."/".$sp[2]."/".$sp[3]."/".$sp[4],0777); $fln=$sp[0]."/".$sp[1]."/".$sp[2]."/".$sp[3]."/".$sp[4];}
				
				$ad=$fln."/";
			break;
			case "6":
				if(file_exists($sp[0])){$fln=$sp[0];}else{mkdir($sp[0],0777);$fln=$sp[0];}
				if(file_exists($sp[0]."/".$sp[1])){$fln=$sp[0]."/".$sp[1];}else{mkdir($sp[0]."/".$sp[1],0777);$fln=$sp[0]."/".$sp[1];}
				if(file_exists($sp[0]."/".$sp[1]."/".$sp[2])){$fln=$sp[0]."/".$sp[1]."/".$sp[2];}else{mkdir($sp[0]."/".$sp[1]."/".$sp[2],0777); $fln=$sp[0]."/".$sp[1]."/".$sp[2];}
				if(file_exists($sp[0]."/".$sp[1]."/".$sp[2]."/".$sp[3])){$fln=$sp[0]."/".$sp[1]."/".$sp[2]."/".$sp[3];}else{mkdir($sp[0]."/".$sp[1]."/".$sp[2]."/".$sp[3],0777); $fln=$sp[0]."/".$sp[1]."/".$sp[2]."/".$sp[3];}
				if(file_exists($sp[0]."/".$sp[1]."/".$sp[2]."/".$sp[3]."/".$sp[4])){$fln=$sp[0]."/".$sp[1]."/".$sp[2]."/".$sp[3]."/".$sp[4];}else{mkdir($sp[0]."/".$sp[1]."/".$sp[2]."/".$sp[3]."/".$sp[4],0777); $fln=$sp[0]."/".$sp[1]."/".$sp[2]."/".$sp[3]."/".$sp[4];}
				if(file_exists($sp[0]."/".$sp[1]."/".$sp[2]."/".$sp[3]."/".$sp[4]."/".$sp[5])){$fln=$sp[0]."/".$sp[1]."/".$sp[2]."/".$sp[3]."/".$sp[4]."/".$sp[5];}else{mkdir($sp[0]."/".$sp[1]."/".$sp[2]."/".$sp[3]."/".$sp[4]."/".$sp[5],0777); $fln=$sp[0]."/".$sp[1]."/".$sp[2]."/".$sp[3]."/".$sp[4]."/".$sp[5];}
				$ad=$fln."/";
			break;
			default:
				if(file_exists($sp[0])){}else{mkdir($sp[0],0777);}
				$ad=$sp[0]."/";
			break;
		}
		return $ad;
	}
	public function backupdata($ofle){
		$dat = $this->read_file($ofle);
		$fo = fopen($ofle."_bak","w");
		fwrite($fo,$dat);
		fclose($fo);
	}
	public function json_record_files_curd($v){
		$fold = $this->json_key_set($v,"folder");
		$uid = $this->json_key_set($v,"uid");
		$data = $this->json_key_set($v,"data");
		$redir = $this->json_key_set($v,"redir");
		$error = $this->json_key_set($v,"error");
		$type = $this->json_key_set($v,"type");
		$display = $this->json_key_set($v,"display");
		$message = $this->json_key_set($v,"message");
		$run=$this->json_key_set($v,"run");
		if(file_exists($fold)){}else{$this->makefolder($fold);}
		$ofle=$fold."/".$uid.".json";
			switch($type)
			{
				case "update":
					if(file_exists($ofle)){
						
						$this->backupdata($ofle);

						$cont=$data;
						
						if(file_exists($ofle)){
							$dat = $this->read_file($ofle);
							$old_data = json_decode($dat);
						}
						$newd=array();
						foreach($old_data as $kk=>$vv)
						{
							if(isset($data->$kk)){
								$newd[$kk]=$data->$kk;
							}else{
								$newd[$kk]=$vv;
							}
							foreach($data as $nk=>$nv)
								{
									if($kk==$nk){
										$newd[$kk]=$nv;
									}else{
										$newd[$nk]=$nv;
									}
								}
						}
						
						$xcont = json_encode($newd,true);

						if($display=="yes"){
							echo $dat."<hr/>".$xcont;
						}
						if($run=="yes"){
							$fo = fopen($ofle,"w");
							fwrite($fo,$xcont);
							fclose($fo);
							if($redir==""){echo $message;}else{
								$this->redir($redir);}
						}
					}else{
						echo $error;			
					}
				break;
				case "del":
					if(file_exists($ofle)){
						if(unlink($ofle))
						{
							if($redir==""){echo $message;}else{
									$this->redir($redir);}	
						}
						else
						{
							echo $error;
						}
					}else
					{
						echo $error;
					}
				break;
				case "add":
					if(file_exists($ofle)){
						echo $error;
					}else{
						$cont=$data;
						$xcont = json_encode($cont,true);
						if($display=="yes"){
							echo $xcont;
						}
						if($run=="yes"){
							if(file_exists($ofle)){}else{$fo = fopen($ofle, "w");}
							$fo = fopen($ofle,"w");
							fwrite($fo,$xcont);
							fclose($fo);
							if($redir==""){echo $message;}else{
								$this->redir($redir);
							}
						}
					}
				break;
				default:
					echo $error;
				break;
			}
	}
	public function json_record_curd($v){
	
		$fold =  $this->json_key_set($v->keys,"folder");
		$file = $this->json_key_set($v->keys,"file");
		$recordtype = $this->json_key_set($v->keys,"type");
		$redir = $this->json_key_set($v->keys,"redir");
		$run = $this->json_key_set($v->keys,"run");
		$display = $this->json_key_set($v->keys,"display");
		$displayfulldata = $this->json_key_set($v->keys,"displayfulldata");
		$message = $this->json_key_set($v->keys,"message");
		$ofle=$fold."/".$file.".json";
		$data = $v->data;
		switch($recordtype)
		{
			case "updaterecord":
				if(file_exists($ofle)){
				$dat = $this->read_file($ofle);
				$old_data = json_decode($dat); 
				
				$this->backupdata($ofle);

				$wheredata = $v->wheredata;
				$aid= $wheredata->arrayid;
				$olddata = $old_data[$aid];
				$newd=array();
						foreach($olddata as $kk=>$vv)
						{
							if(isset($data->$kk)){
								$newd[$aid][$kk]=$data->$kk;
							}else{
								$newd[$aid][$kk]=$vv;
							}
							foreach($data as $nk=>$nv)
								{
									if($kk==$nk){
										$newd[$aid][$kk]=$nv;
									}else{
									}
								}
						}
						$myd=array();
					$x=0;
					foreach($old_data as $kk=>$vv){
						if($aid==$x){
							$myd[]=$newd[$aid];
						}else{
							$myd[]=$vv;
						}
						$x+=1;
					}
				if($display=="yes")
					{
						echo json_encode($data)."<hr/>";
						echo json_encode($olddata)."<hr/>";
						if($displayfulldata=="yes"){
							echo json_encode($myd);
						}
					}
				if($run=="yes")
					{
						$replacedata = $myd;
						$contj= json_encode($replacedata);
						
						$fo = fopen($ofle,"w");
						fwrite($fo,$contj);
						fclose($fo);
						if($redir==""){echo $message;}else{
						$this->redir($redir);
						}
					}
				}else{echo "Parent Data Not Found";}
			break;
			case "delrecord":
				if(file_exists($ofle)){
				$dat = $this->read_file($ofle);
				
						$this->backupdata($ofle);

				$old_data = json_decode($dat);
				$aid= $data->arrayid;
					if($display=="yes")
					{
						echo json_encode($old_data[$aid]);
					}
					if($run=="yes")
					{
						unset($old_data[$aid]); $myd=array();
						foreach($old_data as $kk=>$vv){$myd[]=$vv;}
						$contj = json_encode($myd,true);
						$fo = fopen($ofle,"w");
						fwrite($fo,$contj);
						fclose($fo);
						if($redir==""){echo $message;}else{
						$this->redir($redir);
						}
					}			
				}else{echo "Parent Data Not Found";}
			break;
			case "addrecord":
				if(file_exists($fold)){}else{mkdir($fold);}
				if(file_exists($ofle)){
					$dat = $this->read_file($ofle);
					
						$this->backupdata($ofle);

					$old_data = json_decode($dat);
					$check = $this->json_key_set($v,"check");
					$checkmsg = $this->json_key_set($v,"checkmsg");
					$errormessage = $this->json_key_set($v,"errormessage");
						if($check==""){}else{
							if(is_object($check)){
								$cks="";
								if($checkmsg==""){echo "please mention checkmsg value";}else{									
								}
								if(is_array($old_data))
								{
									for($i=0;$i<count($old_data);$i+=1)
									{
										foreach($old_data[$i] as $mk=>$mv)
										{
											foreach($check as $ck=>$cv){
												if($data->$ck == $mv){$cks.="yes";}
											}
										}
									}
									$rece="";
									if($cks==$checkmsg){
										$rece="exists";
									}else{
										$rece="";
									}
								}
								else
								{

								}
							}else{
								echo "Please set Valid Check Array";
							}
						}

					if($display=="yes")
					{
						echo json_encode($data,true);
					}
					if($run=="yes")
					{
						if($rece=="exists"){
							if($errormessage==""){
								echo "Duplicate Record, Please Try";
							}else{
								echo $errormessage;
							}
						}else{
							if(is_array($old_data))
							{
								$dc=count($old_data);
								$nrec =  $dc+1;
							}else{
									$nrec=0;
								}
							
							$old_data[]=$data;
							$contj = json_encode($old_data,true); 
							$fo = fopen($ofle,"w");
							fwrite($fo,$contj);
							fclose($fo);
							if($redir==""){echo $message;}else{
							$this->redir($redir);
							}
						}
					}
				}else
				{
				  $fo = fopen($ofle,"w");
				  $cont=array(); 	  
				  $cont[]=$data;
				  $contj = json_encode($cont,true);
				  if($display=="yes")
					{
						echo $contj;
					} 
				  if($run=="yes")
					{
					  fwrite($fo,$contj);
					  fclose($fo);
					  if($redir==""){echo $message;}else{
						$this->redir($redir);
						}
					}
				}
			break;
			default: echo "Set Record Action Type"; break;
		}
	}
	public function check_files_id($v,$s){
		$cnt = count($v);
		$ser = (int)$s;
		if($cnt>$ser and is_numeric($s)){return true;}else{return false;}
	}
	public function strtoarray($d,$v){
		$res=array();
		if(is_string($v)){$res=explode($d,$v);}else{$res=$v;}
		return $res;
	}
	public function json_record($v)
	{
		$sort = $this->json_key_set($v,"sorting");
		$flds = $this->json_key_set($v,"flds");
		$vals = $this->json_key_set($v,"vals");
		$defs = $this->json_key_set($v,"defs");
		$type = $this->json_key_set($v,"type");
		$theme = $this->json_key_set($v,"theme");
		$record = $this->json_key_set($v,"record");
		$viewrec = $this->json_key_set($v,"viewrecord");
		$search = $this->json_key_set($v,"search");
		$variable = $this->json_key_set($v,"variable");
		$pagebreak = $this->json_key_set($v,"pagebreak");
		$export = $this->json_key_set($v,"export");
		$jb = $this->gettheme($theme); 
		//echo $v->data;
		switch($v->data){
			case "from_url":
				if(isset($v->url)){
					$jsfile=file_get_contents($v->url);
					}
				else{
					$jsfile = array("status"=>"error","message"=>"URL Not found");
					$jsfile = json_encode($jsfile,true);
				}
				break;
			default:
				$jsfile=$this->read_file($v->data);
			break;
		}
		//echo $jsfile;
		if(isset($v->displayurl) and $v->displayurl=="yes"){echo $v->url;}else{}
		if(isset($v->showdata) and $v->showdata=="yes"){echo $jsfile;}else{}
		
		$exp = explode(" ",$jsfile);
		if($exp[0]=="FILE"){
			echo $jsfile;
		}else{
			$jsdeco = $this->jdec($jsfile);
			if($variable==""){$jsdeco=$jsdeco;}else{$jsdeco=$jsdeco->$variable;}
			
			if(is_array($jsdeco)){
				switch($record)
				{
					case "jsonfile":
						$this->jsdata($flds,$vals,$jsdeco,$jb,0,$viewrec,$search,$type,$defs);
					break;
					case "single":
						$chk = $this->check_files_id($jsdeco,$viewrec);
						if($chk){
							$this->jsdata($flds,$vals,$jsdeco[$viewrec],$jb,0,$viewrec,$search,$type,$defs);
						}else{
							echo "Please Set Record ID or Invalid ID";
						}
					break;
					case "json":
						$i=0;
						foreach($jsdeco->$variable as $kk=>$vv)
						{
							$this->jsdata($flds,$vals,$vv,$jb,$i,$kk,$search,$type,$defs);
								$i+=1;
						}
					break;
					default:
						switch($sort){
							case "1to9": ksort($jsdeco); break;
							case "9to1": krsort($jsdeco); break;
							case "atoz": asort($jsdeco); break;
							case "ztoa": arsort($jsdeco); break;
							default:
							break;
						}
						$newar = array();
						$newar = $jsdeco;
						if(is_array($newar))
						{
							$i=0;
							foreach($newar as $kk=>$vv)
							{
								$this->jsdata($flds,$vals,$vv,$jb,$i,$kk,$search,$type,$defs);
								$i+=1;
							}
						}
						elseif(is_object($newar)){
							if($viewrec==""){
							$newar=$newar;
							}else{$newar=$newar->$viewrec;}
							$i=0;
							foreach($newar as $kk=>$vv){
								$this->jsdata($flds,$vals,$kk,$jb,$i,$i,$search,$type,$defs);
								$i+=1;
							}
						}
						else{
							$this->jsdata($flds,$vals,$newar,$jb,0,0,$search,$type,$defs);
						}	
					break;
				}
			}
			else
			{
				if(is_object($jsdeco))
				{
					$this->jsdata($flds,$vals,$jsdeco,$jb,0,0,$search,$type,$defs);
				}else
				{
					$nerrval = array();
					$errval = $this->json_key_set($v,"errval");
					$errvars = $this->json_key_set($v,"errvars");
					for($e=0;$e<count($errvars);$e+=1)
					{
						$tit = $errval[$e];
						if(isset($jsdeco->$tit)){
							$nerrval[$e] = $jsdeco->$tit;
						}else{
							$nerrval[$e] = "Null";
						}
					}
					$errtheme =  $this->json_key_set($v,"errtheme");
					$jeb = $this->gettheme($errtheme); 
					$job= $this->s_replace($errvars,$nerrval,$jeb);
					$jxd=$this->jdec($job);
					$this->inblock($jxd,"");
				}
			}
		}
	}
	public function jsdata($flds,$vals,$jsdeco,$jb,$i,$s,$search,$type,$defs)
	{
		$myda=array();$nvals=array();				
			for($j=0;$j<count($flds);$j+=1)
			{
				switch($flds[$j])
				{
					case "SLN":
						$myda[]=$i;
						$nvals[]=$vals[$j];
					break;
					case "ASR":
						$myda[]=$s;
						$nvals[]=$vals[$j];
					break;
					case "0":
						$nvals[$i]=$vals[$j];
						$myda[$i]=$jsdeco;
					break;
					default:
						foreach($jsdeco as $jk=>$jv)
						{
							if($jk==$flds[$j]){
								switch($type[$j])
								{
									case "htmldecode":
										$myda[]=$jv;
									break;
									case "htmlcontent":
										$myda[]=htmlentities($jv);
									break;
									case "escapejson":
										$myda[]=$this->escapeJsonString($jv);
									break;
									case "jobject":
										$myda[]=$this->escapeJsonString($this->jenc($jv));
									break;
									default:											
										$myda[]=$jv;
									break;
								}
								$nvals[]=$vals[$j];
							}else{
							}
						}
					break;
				}
				
			}
				if(isset($search)==""){
				$stype = $this->json_key_set($search,"type");
				$key = $this->json_key_set($search,"key");
				$val = $this->json_key_set($search,"val");				
				$key=$key[0];
				$val = $val[0];
				switch($stype)
				{
					case "display":
						if(in_array($jsdeco->$key,$val)){
							$job= $this->s_replace($nvals,$myda,$jb);
							$jxd=$this->jdec($job);
							$this->inblock($jxd,"");
						}else{}
					break;
					case "hide":
						if(in_array($jsdeco->$key,$val)){}else{
							$job= $this->s_replace($nvals,$myda,$jb);
							$jxd=$this->jdec($job);
							$this->inblock($jxd,"");
						}
					break;
					default:
						$job= $this->s_replace($nvals,$myda,$jb);
						$jxd=$this->jdec($job);
						$this->inblock($jxd,"");
					break;
				}
				}else{
						$job= $this->s_replace($nvals,$myda,$jb);
						$jxd=$this->jdec($job);
						$this->inblock($jxd,"");
					}
			
	}
	public function isarray($v,$pt,$t)
	{
		$rs="";
		if(is_array($v))
		{
			$rs.='<'.$pt.'>';
			foreach($v as $p=>$pv)
			{
				$rs.=$this->isarray($pv,$pt,$t);
			}
			$rs.="</".$pt.">";
		}else{$rs.="<".$t.">".$v."</".$t.">";}
		return $rs;
		
	}
	public function paracontent($j){
		$rs="";
		foreach($j as $k=>$v)
		{
			switch($k){
				case 'mainhead';
					$rs.= "<h1>".$v."</h1>";
				break;
				case 'subhead';
					$rs.= "<h2>".$v."</h2>";
				break;
				case 'note';
					$rs.= "<i>".$v."</i>";
				break;
				case 'specialtext';
					$rs.= "<h3>".$v."</h3>";
				break;
				case "paras":
					$rs.=$this->isarray($v,"div","p");
				break;
				case "points":
					$rs.=$this->isarray($v,"ul","li");
				break;
				case "image":
					$ar=array();
					$rs.='<img '.$this->set_attrs($v,"",$ar).' />';
				break;
				case "a":
					$ar=array("content");
					$rs.='<a '.$this->set_attrs($v,"",$ar).' >'.$v->content.'</a>';
				break;
				default:
					
				break;
			}
		}
		echo $rs;
	}
	public function scatter($v){
		$type=$this->json_key_set($v,"type");
		$count = $this->json_key_set($v,"count");
		$thm = $v->theme;
		$theme=$this->gettheme($thm);
		$vars=array();
		$data=array();
		for($i=0;$i<$count;$i+=1){
			$jd=$this->s_replace($vars,$data,$theme);
			$job=$this->jdec($jd);
			$this->inblock($job,"");
		}
	}
	public function apicall($v){
		$url = $this->json_key_set($v,"url");
		$jd=$v->jd;
		$get=$v->get;
		include $url;
	}
	public function json_data_to_database($v){
		$data = $this->json_key_set($v,'data');
		$url = $this->json_key_set($v,'url');
		$db = $this->json_key_set($v,'db');
		$flds = $this->json_key_set($v,'flds');
		$vals = $this->json_key_set($v,'vals');
		$check_query = $this->json_key_set($v,'check_query');
		$insert_query = $this->json_key_set($v,'insert_query');
		$update_query = $this->json_key_set($v,'update_query');
		$ins_view = $this->json_key_set($v,'ins_view');
		$chk_view = $this->json_key_set($v,'chk_view');
		$upd_view = $this->json_key_set($v,'upd_view');
		$sync_type = $this->json_key_set($v,'sync_type');
		$err_theme = $this->gettheme($v->errortheme);
		$theme = $this->gettheme($v->theme);
		switch($data){
			case "from_url":
				if(isset($v->url)){
					$jsfile=file_get_contents($v->url);
					}
				else{
					$jsfile = array("status"=>"error","message"=>"URL Not found");
					$jsfile = json_encode($jsfile,true);
				}
				break;
			default:
				$jsfile = $this->read_file($data);
			break;
		}
		$nflds = explode(",",$flds);
		$nvals = explode(",",$vals);
		$nquery = "";
		switch($sync_type)
		{
			case "check_insert_update":				
					$jsdata = json_decode($jsfile);
					$ddata=array();
					$chk_nqry=array();$ins_nqry=array();$upd_nqry=array();
					$con = $this->con("dbcon.json",$db);
					switch($jsdata)
					{
						case is_array($jsdata):
							$count = count($jsdata);
							for($i=0;$i<$count;$i+=1)
							{
								for($x=0;$x<count($nflds);$x+=1)
								{
									$fld = $nflds[$x];
									if(isset($jsdata[$i]->$fld)){
										$ddata[$i][$x]=$jsdata[$i]->$fld;
									}
									else{
										$ddata[$i][$x]=Null;
									}
								}
								
								$chk_nqry[$i]= $this->s_replace($nvals,$ddata[$i],$check_query);
								$ins_nqry[$i]= $this->s_replace($nvals,$ddata[$i],$insert_query); 
								$upd_nqry[$i]= $this->s_replace($nvals,$ddata[$i],$update_query); 
							}
							$theme_vals = explode(",",$this->json_key_set($v,'theme_vals'));
							for($y=0;$y<count($chk_nqry);$y+=1){
								
								$chkq[$y] = $this->qry($con,$chk_nqry[$y],"chk","suc","err");
								if($chkq[$y]=="suc")
								{
									$chkq[$y] = $this->qry($con,$upd_nqry[$y],"run","updsuc","upderr");									
								}
								else{
									if($chkq[$y]=="err"){
										$chkq[$y] = $this->qry($con,$ins_nqry[$y],"run","insuc","inserr");
									}else
									{
										$chkq[$y]=$chkq[$y]." ".$ins_nqry[$y];
									}
								}
								
								$errth[$y] = $this->s_replace($theme_vals,$chkq[$y],$theme);
								$jd[$y]=$this->s_replace($nvals,$ddata[$y],$errth[$y]);
								$job[$y]=$this->jdec($jd[$y]);
								$this->inblock($job[$y],"");
							}
							
							break;
						default:
							$ndata = array();
							$error_vals = explode(",",$this->json_key_set($v,'error_vals'));
							foreach($jsdata as $kk=>$vv)
							{
								$ndata[]=$vv;
							}
							$jd=$this->s_replace($error_vals,$ndata,$err_theme);
							$job=$this->jdec($jd);
							$this->inblock($job,"");
						break;
					}					
				break;
			default:
				$nquery = "";
			break;
		}

	}
	public function read_txt_file($v){
		$rf = $this->read_file($v->myfile);
		echo $rf;
	}
	public function read_array_file($v){
		$folder = $this->json_key_set($v,"folder");
		$file = $this->json_key_set($v,"file");
		$type = $this->json_key_set($v,"type");
		$theme = $this->json_key_set($v,"theme");
		$vals = $this->json_key_set($v,"vals");
		$flds = $this->json_key_set($v,"flds");
		
		
		switch($type){
			case "max_num_to_low":
					$nar =array();$narx =array();$dax =array();
					$string_delim = $this->json_key_set($v,"string_delim");
					$filter_string = $this->json_key_set($v,"filter_string");
					$scd = scandir($folder);
					$ndr=array();$dtx=array();
					for($j=2;$j<count($scd);$j+=1)
					{
						$file= $scd[$j];
						$readfile = $this->read_file_to_array($folder.$file);
						for($i=1;$i<count($readfile)-1;$i+=1)
						{
							if($string_delim==""){
								$ndr[$readfile[$i]][]=$readfile[$i];
								$dtx[$readfile[$i]] = count($ndr[$readfile[$i]]);
							}else
							{
								$vex = explode($string_delim,$readfile[$i]);
								$vvx = $vex[$filter_string];
								$narx[$vvx][]=$vvx;
								$nar[$vvx]=$vex;
								$dtx[$vvx] = count($narx[$vvx]);
							}
							
						}
					}
					arsort($dtx);
					$pres = array();
					$pres = $dtx;
					$jeb = $this->gettheme($theme); 
					foreach($pres as $ok=>$ov)
					{
						$job= $this->s_replace($vals,$nar[$ok],$jeb);
						$jxd=$this->jdec($job);
						$this->inblock($jxd,"");
					}
					//var_dump($dtx);
				break;
			default:
				$readfile = $this->read_file_to_array($folder.$file);
				$string_delim = $this->json_key_set($v,"string_delim");
				$filter_string = $this->json_key_set($v,"filter_string");
				$cong=array();$nda=array();$bjp=array();
				for($i=1;$i<count($readfile)-1;$i+=1)
				{
					if($string_delim==""){}else{
						$vex = explode($string_delim,$readfile[$i]);
						$vel = $vex[$filter_string];
						$cong[$vel][]=$vel;
						$bjp[$vel]=$vel;
						$nda[$vel] = count($cong[$vel]);
					}
				}
				$nor=array();
				arsort($nda);
				$nor=$nda;
				$jeb = $this->gettheme($theme); 
					foreach($bjp as $ok=>$ov)
					{
						$job= $this->s_replace($vals,$bjp[$ok],$jeb);
						$jxd=$this->jdec($job);
						$this->inblock($jxd,"");
					}
			break;
		}
	}
	public function send_results_new($v)
	{
		$xres="";
		$sms=$this->json_key_set($v,"sms");
		$email=$this->json_key_set($v,"email");
		$watsapp=$this->json_key_set($v,"watsapp");
		$view_arrays=$this->json_key_set($v,"view_arrays");
		$run_email=$this->json_key_set($v,"run_email");
		$run_watsapp=$this->json_key_set($v,"run_watsapp");
		$show_email=$this->json_key_set($v,"show_email");
		$show_watsapp=$this->json_key_set($v,"show_watsapp");
		$run_sms=$this->json_key_set($v,"run_sms");
		$sms_prefix=$this->json_key_set($v,"sms_prefix");
		$email_prefix=$this->json_key_set($v,"email_prefix");
		$watsapp_prefix=$this->json_key_set($v,"watsapp_prefix");
		$sms_sufix=$this->json_key_set($v,"sms_sufix");
		$email_sufix=$this->json_key_set($v,"email_sufix");
		$watsapp_sufix=$this->json_key_set($v,"watsapp_sufix");
		
		if($run_sms=="yes"){
			$xres.=$sms_prefix.$this->cur($sms).$sms_sufix;
		}else{}

		if($show_email=="yes"){
			$xres.=$email_prefix;
			foreach($email as $kk=>$vv)
			{
				if(is_string($vv)){
					$xres.=$kk.": <br/>".$vv;
				}
				if(is_object($vv)){
					$xres.=$kk.": <br/>";
					foreach($vv as $kkk=>$vvv)
					{
						$xres.=$kkk."<br/>".$vvv."<br/><br/>";
					}
				}
			}
			$xres.=$email_sufix;
		}else{}
		
		if($run_email=="yes"){
			$xres.=$email_prefix.$this->cur($email).$email_sufix;
		}else{}

		
		if($run_watsapp=="yes"){
			$xres.=$watsapp_prefix.$this->cur($watsapp).$watsapp_sufix;
		}else{}

		if($show_watsapp=="yes"){			
			$xres.= $watsapp_prefix;
			foreach($watsapp as $kk=>$vv)
			{
				if(is_string($vv)){
					$xres.=$kk.": <br/>".$vv;
				}
				if(is_object($vv)){
					$xres.=$kk.": <br/>";
					foreach($vv as $kkk=>$vvv)
					{
						$xres.=$kkk."<br/>".$vvv."<br/><br/>";
					}
				}
			}
			$xres.=$watsapp_sufix;
		}else{}

		if($view_arrays=="yes"){
			$xres.= "<hr/>SMS<br/>".json_encode($sms);
			$xres.= "<hr/>EMAIL<br/>".json_encode($email);
			$xres.= "<hr/>WATSAPP<br/>".json_encode($watsapp);
		}
		
		$theme = $this->json_key_set($v,"theme");
		$vals = $this->json_key_set($v,"vals");
		$jeb = $this->gettheme($theme);$myda=array(); $myda[0]=$xres;
		$job= $this->s_replace($vals,$myda,$jeb);
		$jxd=$this->jdec($job);
		$this->inblock($jxd,"");
	}
	public function send_results($v)
	{
		$sms=$this->json_key_set($v,"sms");
		$email=$this->json_key_set($v,"email");
		$watsapp=$this->json_key_set($v,"watsapp");
		$view_arrays=$this->json_key_set($v,"view_arrays");
		$run_email=$this->json_key_set($v,"run_email");
		$run_watsapp=$this->json_key_set($v,"run_watsapp");
		$show_email=$this->json_key_set($v,"show_email");
		$show_watsapp=$this->json_key_set($v,"show_watsapp");
		$run_sms=$this->json_key_set($v,"run_sms");
		$sms_prefix=$this->json_key_set($v,"sms_prefix");
		$email_prefix=$this->json_key_set($v,"email_prefix");
		$watsapp_prefix=$this->json_key_set($v,"watsapp_prefix");
		$sms_sufix=$this->json_key_set($v,"sms_sufix");
		$email_sufix=$this->json_key_set($v,"email_sufix");
		$watsapp_sufix=$this->json_key_set($v,"watsapp_sufix");
		
		if($run_sms=="yes"){
			echo $sms_prefix.$this->cur($sms).$sms_sufix;
		}else{}

		if($show_email=="yes"){
			
			echo $email_prefix;
			foreach($email as $kk=>$vv)
			{
				if(is_string($vv)){
					echo $kk.": <br/>".$vv;
				}
				if(is_object($vv)){
					echo $kk.": <br/>";
					foreach($vv as $kkk=>$vvv)
					{
						echo $kkk."<br/>".$vvv."<br/><br/>";
					}
				}
			}
			echo $email_sufix;
		}else{}
		
		if($run_email=="yes"){
			echo $email_prefix.$this->cur($email).$email_sufix;
		}else{}

		
		if($run_watsapp=="yes"){
			echo $watsapp_prefix.$this->cur($watsapp).$watsapp_sufix;
		}else{}

		if($show_watsapp=="yes"){
			
			echo $watsapp_prefix;
			foreach($watsapp as $kk=>$vv)
			{
				if(is_string($vv)){
					echo $kk.": <br/>".$vv;
				}
				if(is_object($vv)){
					echo $kk.": <br/>";
					foreach($vv as $kkk=>$vvv)
					{
						echo $kkk."<br/>".$vvv."<br/><br/>";
					}
				}
			}
			echo $watsapp_sufix;
		}else{}
		
		if($view_arrays=="yes"){
			echo "<hr/>SMS<br/>";
			var_dump($sms);
			echo "<hr/>EMAIL<br/>";
			var_dump($email);
			echo "<hr/>WATSAPP<br/>";
			var_dump($watsapp);
		}
	}
	public function css_style($v)
	{
		?><style type="text/css"><?php require_once $v;?></style><?php
	}
	public function filter_folder($v){
		
		$folder=$this->json_key_set($v,"folder");
		$file_delim=$this->json_key_set($v,"file_delim");
		$file_string=$this->json_key_set($v,"file_string");
		$flds=$this->json_key_set($v,"flds");
		$filter_childs_ext=$this->json_key_set($v,"filter_childs_ext");
		$chkfor=$this->json_key_set($v,"chkfor");
		$filterby=$this->json_key_set($v,"filterby");
		$theme=$this->json_key_set($v,"theme");
		$from=$this->json_key_set($v,"from");
		$to=$this->json_key_set($v,"to");
		$data = $this->getserdet($folder,"");
		$par=array();$nar=array();$xnar=array();
		foreach($data as $h){
			foreach($this->getserdet($folder.$h,$filter_childs_ext) as $hj)
			{
				$par[]=$h."|".$hj;
				$fe = explode($file_delim,$hj);				
				if(isset($fe[$file_string])){
					if($fe[$file_string]==" "){}else{
						$nar[$fe[$file_string]]=$hj;
					}
				}
			}
		}
		foreach($nar as $nk=>$nv)
		{
			$xnar[]=$nk;
		}
		$fres=array();
		switch($chkfor){
			case "get_by_string":
				
				for($i=0;$i<count($par);$i+=1)
				{
					if(strstr($par[$i],$filterby)){
						$fres[]=$par[$i];
					}else{}
				}
				break;
			default:
				$fres=$xnar;
			break;
		}
		$jeb = $this->gettheme($theme);
		if($from==""){$from=0;}else{$from=$from;}
		if($to==""){$to=count($fres);}else{$to=$to;}
		$far=array();
		for($i=0;$i<$to;$i+=1){
			$far[$i][0]=$i;
			$far[$i][1]=$fres[$i];
			$job= $this->s_replace($flds,$far[$i],$jeb);
			$jxd=$this->jdec($job);
			$this->inblock($jxd,"");
		}

	}
	public function sendjson($v){
		$headers=$this->json_key_set($v,"headers");
		$payloads=$this->json_key_set($v,"payloads");
		$error=$this->json_key_set($v,"error");
		$config= $this->json_key_set($v,"config");
		$storekey= $this->json_key_set($v,"storekey");
		if(isset($error) and is_object($error)){echo json_encode($error);}else{
			if(isset($headers) and is_object($headers) and isset($payloads) and is_object($payloads))
			{
				$cfg = explode("_",$config);
				if(file_exists($cfg[0]."/".$cfg[1].".php")){
					include $cfg[0]."/".$cfg[1].".php";
					$key=$skey;
				}
				else{
					$key="DefaultKey!@#123GONULL123";
				}
				$jwt = $this->generate_jwt($headers, $payloads,$key);
				if(isset($storekey) and is_object($storekey))
				{
					$to = $storekey->to;
					$key = $storekey->key;
					switch($to)
					{
						case "session"; $_SESSION[$key]=$jwt; break;
						default: 
							echo json_encode(array("token"=>$jwt)); 
						break;
					}
				}else{
	
				}
			}else
			{
				echo json_encode(array("token"=>"Invalid Json Objects"));
			}
		}
		
	}
	public function postjson($v){
		$url=$this->json_key_set($v,"url");
		$fields= $this->json_key_set($v,"postdata");
		$headers= $this->json_key_set($v,"headers");
		$dtyp= $this->json_key_set($v,"dtyp");
		$ptyp= $this->json_key_set($v,"ptyp");
		$htyp= $this->json_key_set($v,"htyp");
		$flds= $this->json_key_set($v,"flds");
		$vals= $this->json_key_set($v,"vals");
		$theme= $this->json_key_set($v,"theme");
		$show= $this->json_key_set($v,"show");
		$config= $this->json_key_set($v,"config");
		$runcode= $this->json_key_set($v,"runcode");
		$viewconfig= $this->json_key_set($v,"viewconfig");
		$display_payload_data=$this->json_key_set($v,"display_payload_data");
		$display_headers_data=$this->json_key_set($v,"display_headers_data");	
		$display_payload_raw_data=$this->json_key_set($v,"display_payload_raw_data");
		$res = $this->cur_two($url,$fields,$dtyp,$ptyp,$htyp,$flds,$vals,$theme,$headers,$show,$display_payload_data,$display_headers_data,$config,$display_payload_raw_data,$runcode,$viewconfig);
		return $res;
	}
	public function json_array_filter($fld,$config)
	{
		$ndata = array();
		for($i=0;$i<count($fld);$i+=1)
		{
			$vl=$fld[$i];
			switch($vl)
			{
				case is_object($vl):
					$ndata[$i]=$this->json_filter($vl,$config);
				break;
				case is_array($vl):
					$ndata[$key]=$this->json_array_filter($vl,$config);
				break;
				case is_string($vl):
					$fex = explode("_",$vl);
					if(count($fex)>1){	
						if($fex[0]=="CFG")
						{
							$vl=$fex[1];
							if($config==""){}else{include $config;}
							$ndata[$i]=$$vl;
						}else
						{
							$ndata[$i]=$vl;
						}
					}
					else{
						$ndata[$i]=$vl;
					}
				break;
				default:
					$ndata[$i]=$vl;
				break;
			}
		}
		return $ndata;
	}
	public function json_filter($fields,$config)
	{
		$ndata = array();
		foreach($fields as $key=>$value) 
		{
			if($value==""){
				$ndata[$key]="";
			}else{
				switch($value)
				{
					case is_object($value):
						if($value=="0"){$ndata[$key]=$value;}else{$ndata[$key]=$this->json_filter($value,$config);}	
					break;
					case is_array($value):
						$ndata[$key]=$this->json_array_filter($value,$config);
					break;
					default:
						$fex = explode("_",$value);
						if(count($fex)>1){	
							if($fex[0]=="CFG")
							{
								$value=$fex[1];
								if($config==""){}else{include $config;}
								$ndata[$key]=$$value;
							}else
							{
								$ndata[$key]=$value;
							}
						}
						else{
							$ndata[$key]=$value;
						}
					break;
				}
			}
		}
		return $ndata;
	}
	public function cur_two($url,$fields,$dtyp,$ptyp,$htyp,$flds,$vals,$theme,$headers,$show,$display_payload_data,$display_headers_data,$config,$display_payload_raw_data,$runcode,$viewconfig)
	{
		if($viewconfig=="yes"){
			var_dump($config);
		}else{}

		if($config==""){}else
		{
			include_once $config->file;				
			foreach($config->keys as $kk)
			{
				if($config->display=="yes"){
					echo $kk.": ".$$kk."<br/>";
				}
				$kk = $$kk;				
			}			
		}
		
		$jb=$this->gettheme($theme);
		if($runcode=="yes")
		{					
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		}
		
		switch($dtyp)
		{
			case "json":
				$ndata=$this->json_filter($fields,$config->file);
				$data=json_encode($ndata);
				break;
			case "jsondecode":
				$data=json_decode($fields);
				break;
			case "jsonencode":
				$data=array();
				foreach($fields as $key=>$value) 
				{ 
					$fex = explode("_",$value);
					if($fex[0]=="CFG")
					{
						$data[$key]=$$value;
					}else
					{
						$data[$key]=$value;
					}
				}
				$data=json_encode($fields);
				break;
			case "serverdata":
				foreach($fields as $key=>$value) { $data[]=$key.":".$value; }
				break;
			case "enc_post":
					$enc_headers=array();$enc_payloads=array();
					foreach($fields->headers as $kk=>$vv){ $enc_headers[$kk]=$vv;}
					foreach($fields->payloads as $kk=>$vv){ $enc_payloads[$kk]=$vv;}
					$data = $this->generate_jwt($enc_headers, $enc_payloads,$skey);					
				break;
			case "array":
				$data=array();
				foreach($fields as $key=>$value) { 
					if(is_object($value)){
						foreach($value as $vk=>$vv)
						{
							$data[$key][$vk]=$vv;
						}
					}else{
						$fex = explode("_",$value);
						if($fex[0]=="CFG")
						{
							$da=$fex[1];
							$data[$key]=$$da;
						}else
						{
							$data[$key]=$value;
						}
					}
				}
				break;
			default:
				$data="";
				$data=http_build_query($fields);
			break;
		} 
		
		switch($ptyp)
		{
			case "post":
				if($runcode=="yes")
				{
					curl_setopt($ch, CURLOPT_POST, 1);
					curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
				}
				break;
			case "postget":
					
				if($runcode=="yes")
				{
					curl_setopt($ch, CURLOPT_POST, 1);
					curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
									
					curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
				}
				break;
			case "get":
				if($runcode=="yes")
				{
					curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
				}
				break;
			default: 
			
				break;
		}
		if($runcode=="yes")
		{
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		}
		
		switch($htyp)
		{
			case "headers_with_enc64":
				$header=array();
				
				$auth=base64_encode($keyId. ":" .$keySecret);
				foreach($headers as $key=>$value) { 
					$fex = explode("_",$value);
						if($fex[0]=="CFG")
						{
							$da=$fex[1];
							$header[]=$key.":".$$da;
						}else
						{
							$header[]=$key.":".$value; 
						}
					
				}
				$header[]="Authorization: Basic ".$auth;
				if($runcode=="yes")
				{
					curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
				}
				break;
			case "headers":
				$header=array();
				foreach($headers as $key=>$value) { $header[]=$key.":".$value; }
				if($runcode=="yes")
				{
					curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
				}
				break;
			default:
			if($runcode=="yes")
			{
				curl_setopt($ch, CURLOPT_HTTPHEADER, 0);
			}
			break;
		}
		if($display_headers_data=="yes"){echo "<hr/>Headers "; var_dump($header);}else{}
		if($display_payload_raw_data=="yes"){echo "<hr/>Payloads<br/><br/> Headers Raw "; var_dump($enc_headers); echo "</br></br>Payloads Raw "; var_dump($enc_payloads); }else{}
		if($display_payload_data=="yes"){echo "<hr/>Payloads "; var_dump($data);}else{}
		
				
		
		if($runcode=="yes")
		{
			$response=curl_exec($ch);
			$res=json_decode($response);
			if($show=="yes"){
				if(is_array($response)){var_dump($response);}
				elseif(is_object($response)){var_dump($response);}
				else{echo $response;}
			}else{}
			
			if(is_object($res))
			{
				$vars=array();
				for($i=0;$i<count($flds);$i+=1)
				{
					$fv=$flds[$i];
					if(isset($res->$fv))
					{
						$mres=$res->$fv;
						if($res->$fv===false){$mres="false";}
						if($res->$fv===true){$mres="true";}
						$vars[$i]=$mres;
					}
					else
					{
						if($fv=="data"){
							foreach($res as $kk=>$vv)
							{
								if($kk=="error"){
									$vars[$i]=$this->escapeJsonString(json_encode($vv));
								}else
								{
									$vars[$i]=$this->escapeJsonString(json_encode($res));
								}
							}							

						}else{
							$vars[$i]="";
						}
					}
				}
			}
			else
			{
				if($response==""){
					$vars=array("status"=>"Error","message"=>"Data not Found");
					echo json_encode($vars);
				}else{
    				$tokenParts = explode('.', $response);
    				$header = base64_decode($tokenParts[0]);
    				$payload = base64_decode($tokenParts[1]);
    				$pays = json_decode($payload);
    				foreach($pays as $kk=>$vv){$vars[$kk]=$vv;}
				}
			}
			$job= $this->s_replace($vals,$vars,$jb);
			$jxd=$this->jdec($job);
			$this->inblock($jxd,"");
			
			curl_close($ch);
		}else{}
	}
	public function jwtdecode($v){
		$response = $v->response;
		$config = $v->config;
		$cfg = explode("_",$config);
		if(file_exists($cfg[0]."/".$cfg[1].".php")){
			include $cfg[0]."/".$cfg[1].".php";
			$key=$skey;
		}
		else{
			$key="DefaultKey!@#123GONULL123";
		}
		$tokenParts = explode('.', $response);
		$header = base64_decode($tokenParts[0]);
		$payload = base64_decode($tokenParts[1]);
		$signature_provided = $tokenParts[2];
		var_dump($payload);
	}
	
	public function generate_jwt($headers, $payload, $secret = 'secret') {
		$headers_encoded = base64url_encode(json_encode($headers));
		
		$payload_encoded = base64url_encode(json_encode($payload));
		
		$signature = hash_hmac('SHA256', "$headers_encoded.$payload_encoded", $secret, true);
		$signature_encoded = base64url_encode($signature);
		
		$jwt = "$headers_encoded.$payload_encoded.$signature_encoded";
		
		return $jwt;
	}
	public function is_jwt_valid($jwt, $secret = 'secret') {
		// split the jwt
		$tokenParts = explode('.', $jwt);
		$header = base64_decode($tokenParts[0]);
		$payload = base64_decode($tokenParts[1]);
		$signature_provided = $tokenParts[2];
	
		// check the expiration time - note this will cause an error if there is no 'exp' claim in the jwt
		$expiration = json_decode($payload)->exp;
		$is_token_expired = ($expiration - time()) < 0;
	
		// build a signature based on the header and payload using the secret
		$base64_url_header = base64url_encode($header);
		$base64_url_payload = base64url_encode($payload);
		$signature = hash_hmac('SHA256', $base64_url_header . "." . $base64_url_payload, $secret, true);
		$base64_url_signature = base64url_encode($signature);
	
		// verify it matches the signature provided in the jwt
		$is_signature_valid = ($base64_url_signature === $signature_provided);
		
		if (!$is_signature_valid) {
			return FALSE;
		} else {
			return TRUE;
		}
	}
	public function base64url_encode($data) {
		return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
	}
	public function get_authorization_header(){
		$headers = null;
		
		if (isset($_SERVER['Authorization'])) {
			$headers = trim($_SERVER["Authorization"]);
		} else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
			$headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
		} else if (isset($_SERVER['HTTP_AUTHENTICATION'])) { //Nginx or fast CGI
			$headers = trim($_SERVER["HTTP_AUTHENTICATION"]);
		} else if (function_exists('apache_request_headers')) {
			$requestHeaders = apache_request_headers();
			// Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
			$requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
			//print_r($requestHeaders);
			if (isset($requestHeaders['Authorization'])) {
				$headers = trim($requestHeaders['Authorization']);
			}
		}
		
		return $headers;
	}
	public function get_bearer_token() {
		$headers = $this->get_authorization_header();
		//$headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
		//echo $headers;
		// HEADER: Get the access token from the header
		if (!empty($headers)) {
		   if (preg_match('/bearer\s(\S+)/', $headers, $matches)) {
				return $matches[1];
			}
		}
		return null;
	}
	public function tableformat($v)
	{
		for($i=0;$i<count($v);$i+=1)
		{
			?><td><?=$v[$i]?></td><?php
		}
	}
	public function onoff($v){
		$type=$this->json_key_set($v,'type');
		$on=$this->json_key_set($v,'on');
		$off=$this->json_key_set($v,'off');
		$err="Please Set On or Off Values (sec|trigger class name|trigger text|trigger text to class name) Ex. 5|.red|ON|.switch b";
		if($on=="" or $off==""){$res=$err;}else
		{
			$onex = explode("|",$on);
			$offex = explode("|",$off);
			if(count($onex)<4 or count($offex)<4){echo $err;}else{
				?><?php
			}
		}
	}
	public function data_to_session_as_json($v){
		$session_key=$this->json_key_set($v,'session_key');
		$view=$this->json_key_set($v,'view');
		$type=$this->json_key_set($v,'type');
		$fld=$this->json_key_set($v,'fld');
		$val=$this->json_key_set($v,'val');
		$data = $this->json_key_set($v,'data');
		if(isset($session_key)){$key=$session_key;}else{$key="untitled";}
		
		if(isset($_SESSION[$key])){
			if(isset($_SESSION[$key][$fld])){	
			foreach($_SESSION[$key] as $kk=>$vv){
				if((int)$val>0){
					if($fld==$kk){
						$_SESSION[$key][$kk]=$val;
					}else
					{
						$_SESSION[$key][$fld]=$val;
					}
			}else{unset($_SESSION[$key][$fld]);}
			}
		}else
		{
			if((int)$val>0){
			$_SESSION[$key][$fld]=$val;
			}else{unset($_SESSION[$key][$fld]);}
		}
			
	    if($type=="remove"){unset($_SESSION[$key][$fld]);}else{}
	}else{
				$_SESSION[$key][$fld]=$val;
	}
		if($view=="yes"){
			var_dump($_SESSION[$key]);
		}
	}
	public function view_json_session($v){
		$key=$this->json_key_set($v,'key');
		$vals=$this->json_key_set($v,'vals');
		$theme=$this->json_key_set($v,'theme');
		$theme = $this->gettheme($theme);
		if(isset($_SESSION[$key])){
			foreach($_SESSION[$key] as $kk=>$vv){
				$job= $this->s_replace($vals,array($kk,$vv),$theme);	
				$jxd=$this->jdec($job);
				$this->inblock($jxd,'');
			}
		}else
		{
			echo "Session Not Defined ".$key;
		}
		
	}
	public function add_delim($v){
		$content=$this->json_key_set($v,'content');
		$splix=$this->json_key_set($v,'splix');
		$adsplix=$this->json_key_set($v,'adsplix');
		$dfor=$this->json_key_set($v,'dfor');
		$delim=$this->json_key_set($v,'delim');
		$vars=$this->json_key_set($v,'vars');
		$theme=$this->json_key_set($v,'theme');
		$theme = $this->gettheme($theme);
		$res="";
		if($splix==""){
			$res= str_replace($dfor,$delim,$content);
		}else{
			$ex = explode($splix,$content);
			for($i=0;$i<count($ex);$i+=1)
			{
				$res.=str_replace($dfor,$delim,$ex[$i]).$adsplix;
			}
			$res = substr($res,0,-1);
		}
		$job= $this->s_replace($vars,$res,$theme);	
		$jxd=$this->jdec($job);
		$this->inblock($jxd,'');
	}
	public function install_database($v){
				$db = $v->db;
				$tabs = $v->tables;
				$con = con("dbcon.json",$db);
				$get_tables = qry($con,"show tables from ".$db, 'data','suc','err');
				$new_tables=array();
				for($i=0;$i<count($get_tables);$i+=1)
					{
						$new_tables[$i] = $get_tables[$i][0];
					}
				var_dump($new_tables); 
				foreach($tabs as $kk=>$vv){
					 $tab=$kk;$cols='';$tcols='';
						if(in_array($kk,$new_tables)){
							$table_columns = qry($con,"show columns in ".$kk, 'data','suc','err');
							$x=0;$ncol='';
							foreach($vv as $ck=>$cv){								
								if($ck==$table_columns[$x]['Field']){
										//echo $ck." exits<br/>";
										$col_spl = explode(" ",strtolower($cv));
										if($col_spl[0]==$table_columns[$x]['Type'])
											{ }else{
												$tcols.='CHANGE '.$ck.' '.$ck.' '.$cv.', ';
												}
									}else{
										//echo $ck." No<br/>";										
										$cols.=$ck.' '.$cv.', ';
									}
								$x+=1;
							}
							if($tcols){
								$qry = 'ALTER TABLE '.$tab.' '.substr($tcols,0,-2);
								$res.= qry($con,$qry,'run','Table Updated '.$tab.'<hr/>','Error Updating Table '.$tab.'<br/>'.$qry.'<hr/>');
							}else{}
							if($cols){
								$qry = 'ALTER TABLE '.$tab.' ADD '.substr($cols,0,-2).' AFTER '.$table_columns[count($table_columns)-1]['Field'];
								$res.= qry($con,$qry,'run','Table Updated '.$tab.'<hr/>','Error Updating Table '.$tab.'<br/>'.$qry.'<hr/>');
							}else{}
							
							var_dump($table_columns);
						}else{
							foreach($vv as $ck=>$cv){
								$cols.=$ck.' '.$cv.', ';
							}
							$qry ='CREATE TABLE IF NOT EXISTS '.$tab.'('.substr($cols,0,-2).');';
							$res.= qry($con,$qry,'run','Table Created '.$tab.'<hr/>','Error Creating Table '.$tab.'<br/>'.$qry.'<hr/>');
						}
					}
					echo $res;
}

	public function html_keys($j)
	{
		$axr="";
		if(!isset($j->class)){}else{?><div class="<?=$j->class?>" <?=$this->set_attrs($j,"attr",$axr)?> ><?php }
		foreach($j as $k=>$v)
		{
			switch($k)
			{
				
				case "a": $ar=array("content"); ?><a <?=$this->set_attrs($v,"",$ar)?>><?=$this->json_key_set($v,"content")?></a><?php break;
				case "add_count_insession": $this->add_count_insession($v); break;
				case "add_delim": $this->add_delim($v); break;
				case "aimg": $ar=array("content"); ?><a <?=$this->set_attrs($v->a,"",$ar)?> ><img <?=$this->set_attrs($v->image,"",$ar)?> /><span><?=$this->json_key_set($v->a,"content")?></span></a><?php break;
				case "apicall": $this->apicall($v); break;				
			    case "appdefine": $this->appdefine($v); break;
				case "arraydata": echo $this->arraydata($v); break;
				case "arrayval": echo $this->arrayval($v); break;
				case "audio": $ar=array(); ?><audio <?=$this->set_attrs($v,"empattr",$ar)." ".$this->set_attrs($v,"audioattr",$ar)?>  > <source <?=$this->set_attrs($v,"source",$ar)?> /> Your browser does not support the audio element.</audio><?php break;
				case "block": $this->web($v); break;
				case "bulkimages": $this->bulkimages($v); break;
				case "calendar": $this->calendar($v); break;
				case "calwidget": $this->calwidget($v); break;
				case "code": echo "<pre>".htmlentities($v)."</pre>"; break;
				case "combinearray": $this->combineArray($v);break;
				case "content": echo $v; break;
				case "esc_content": echo html_entity_decode($v); break;
				case "content_limit": echo $this->content_limit($v); break;
				case "create_folder": if(file_exists($v)){}else{if(mkdir($v,0777)){}else{echo "File Not Created";}} break;
				case "cropimg": $cimg = $this->cropimg($v); echo $cimg; break;
				case "css": $this->css($v); break;
				case "csv_fld_combine": echo $this->csv_fld_combine($v); break;
				case "csv_fld_combine_tojson": echo $this->csv_fld_combine_tojson($v); break;
				case "csvdata": $this->csvdata($v); break;
				case "csvdatareport": $this->csvdatareport($v); break;
				case "cur": echo $this->cur($v); break;
				case "currency": echo $this->currencyformat($v); break;
				case "data_content": echo $this->data_content($v); break;
				case "date": echo $this->sdate($v);break;
				case "days_from_dates": echo $this->days_from_dates($v); break;
				case "days_from_number": $this->days_from_number($v); break;
				case "dbdata_from_db": $this->dbdata_from_db($v); break;
				case "delfile": $this->delfile($v); break;
				case "datentime": echo $this->datentime($v); break;
				case "data_to_session_as_json": $this->data_to_session_as_json($v); break;
				case "encdec_content": echo $this->encdec_content($v); break;
				case "encdec_content_html": echo $this->encdec_content_html($v); break;
				case "escapeJsonString": echo $this->escapeJsonString($v); break;
				case "fieldset": $arx = $this->fieldset($v); ?><fieldset <?=$arx[0]?>><legend><?=$arx[1]?></legend> <?=$this->inblock($arx[2],"")?></fieldset> <?php break;
				case "filegetcontents": $fc = file_get_contents($v); echo $fc;break;
				case "filetags": echo $this->filetags($v); break;
				case "filter_folder": $this->filter_folder($v); break;
				case "form": $ar=array("theme"); $theme = $this->json_key_set($v,"theme"); ?><form <?=$this->set_attrs($v,"",$ar)?>><?php $this->inblock($theme,"");?></form><?php break;
				case "input": $ar=array(); ?><input <?=$this->set_attrs($v,"",$ar)?> style=" outline:none" /><?php break;
				case "textarea": $ar=array("value"); ?><div id="editer" class="editer <?=$this->json_key_set($v,"class")?>xx" contenteditable="true" style="border:1px solid #ccc; background:#fff; padding:10px; height:<?=$this->json_key_set($v,"fieldheight")?>px; overflow-y:auto;" onkeyup="vl=$(this).html();  $(this).parent().find('textarea').val(vl);" ><?=htmlspecialchars_decode($this->json_key_set($v,"value"))?></div><textarea  style=" outline:none" <?=$this->set_attrs($v,"",$ar)?>><?=$this->json_key_set($v,"value")?></textarea><script>$('textarea').val($('textarea').val().trimStart().trimEnd());</script><?php break;
				case "emptextarea": $ar=array("value"); ?><textarea  style=" outline:none" <?=$this->set_attrs($v,"",$ar)?>><?=$this->json_key_set($v,"value")?></textarea><?php break;
				case "select": $ar=array("options"); ?><select  style=" outline:none" <?=$this->set_attrs($v,"",$ar)?>><?=$this->option($v,"option")?></select><?php break;
				case "get_value_from_array_session_new": echo $this->get_value_from_array_session_new($v); break;
				case "getstring": echo $this->getstring($v); break;
				case "h1": $ar=array("content"); ?><h1 <?=$this->set_attrs($v,"",$ar)?> ><?=$v->content?></h1><?php break;
				case "htmlcont": echo htmlentities($v); break;		
				case "htmlcontent": echo htmlspecialchars_decode(html_entity_decode($v),ENT_NOQUOTES); break;
				case "escjsoncontent": echo $this->escapeJsonString($v); break;
				case "htmlraw": echo $this->htmlraw($v); break;
				case "ifelse": echo $this->ifelse($v); break;
				case "iframe": $ar=array("content"); ?><iframe <?=$this->set_attrs($v,"",$ar)?>></iframe><?php break;
				case "image": $ar=array(); ?><img <?=$this->set_attrs($v,"",$ar)?> /><?php break;
				case "inblock": $this->inblock($j,$v); break;
				case "include":  $vars = $v->vars;  $param = $vars; require_once $v->url; break;
				case "injs": $this->scripts($v); break;	
				case "langgethtml": $fc = file_get_contents($v); echo $fc;break;
				case "logout": session_destroy();break;
				case "json_record": $this->json_record($v); break;
				case "json_record_curd": $this->json_record_curd($v); break;
				case "json_record_files_curd": $this->json_record_files_curd($v); break;
				case "json_data_to_database": $this->json_data_to_database($v); break;
				case "jwtdecode": $this->jwtdecode($v);break;
				case "maths": echo $this->maths($v); break;
				case "numbers": echo $this->numbers($v); break;
				case "numbertodate": $this->numbertodate($v); break;
				case "para": $this->para($v);break;
				case "paracontent": $this->paracontent($v); break;
				case "postjson": $this->postjson($v); break;
				case "print": echo "<pre>".$this->read_csv_html_file($v)."</pre>"; break;
				case "read_array_file": $this->read_array_file($v); break;
				case "read_txt_file": $this->read_txt_file($v); break;
				case "redir": $this->redir($v); break;
				case "time_redir": ?><script>setTimeout(function(){ window.location='<?=$v->redir?>';}, <?=$v->dur?>);</script><?php break;
				case "refresh": ?><script>setTimeout(function(){ window.location.reload();}, <?=$v->dur?>);</script><?php break;
				case "remove_array_session": $this->remove_array_session($v); break;
				case "remove_id_array_session": $this->removesessionarray($v); break;
				case "remove_session": $this->remove_session($v); break;
				case "renamefile": $this->renamefile($v); break;
				case "resize_image": var_dump($this->resize_image($v)); break;
				case "require": if(file_exists($v)){require $v;}else{ echo "Not Found ".$v;} break;
				case "save_to_file": $this->save_to_file($v); break;
				case "scatter": $this->scatter($v); break;
				case "send_results": $this->send_results($v); break;
				case "send_results_new": $this->send_results_new($v); break;
				case "sendjson": $this->sendjson($v); break;
				case "send_mail":
					
					$rx=0;
					$ks='{}';
					$to = $this->json_key_set($v,"to");
					$cc = $this->json_key_set($v,"cc");
					$bcc = $this->json_key_set($v,"bcc");
					$to_name = $this->json_key_set($v,"to_name");
					$from_name = $this->json_key_set($v,"from_name");
					$from_email = $this->json_key_set($v,"from_email");
					$subject = $this->json_key_set($v,"subject");
					$email_body=$this->json_key_set($v,"email_body");
					$suc_theme=$this->json_key_set($v,"suc_theme");
					$err_theme=$this->json_key_set($v,"err_theme");
					$showemail = $this->json_key_set($v,"showemail");
					$sendemail = $this->json_key_set($v,"sendemail");
					if($showemail=="yes"){ echo $email_body; }else { }
					$headers  = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					$headers .= 'From: '.$from_name.'<'.$from_email.'>' . "\r\n";
					if($sendemail=="yes")
					{
						if(mail($to,$subject,$email_body,$headers))
						{ 
							$this->inblock($suc_theme,"");
						}
						else 
						{
							$this->inblock($err_theme,"");
						}
					}
					else
					{
						echo "Send Email Set to No";
					}
				break;
				case "session_to_json": echo $this->session_to_json($v); break;
				case "sessionarraydata": $this->sessionarraydata($v); break;
				case "set_id_array_session": $this->setsessionarray($v); break;
				case "setsessiontoarray": $this->setsessiontoarray($v); break;
				case "setsession": $this->setsession($v); break;
				case "set_session": $_SESSION[$v->skey]=$v->val; break;
				case "svg": 
				$ar=array();
				$elm=$this->json_key_set($v,"elements");
				$styles=$this->json_key_set($v,"styles");
				$frm=$this->json_key_set($v,"frame"); 
				?><svg <?=$this->set_attrs($frm,"",$ar)?> > <?php $this->svg($elm); ?> <?php $this->svgcss($styles); ?>Your browser does not support SVG  </svg><?php break;
				case "swichcase": $this->swichcase($v); break;
				case "css_style": $this->css_style($v); break;
				case "tableformat": $this->tableformat($v);break;
				case "timestamp": echo $this->stime($v);break;
				case "totalcount": $this->totalcount($v); break;
				case "varblock": echo $this->varblock($v); break;
				case "video": $ar=array(); ?><video <?=$this->set_attrs($v,"empattr",$ar)." ".$this->set_attrs($v,"videoattr",$ar)?>  > <source <?=$this->set_attrs($v,"source",$ar)?> /> Your browser does not support the audio element.</video><?php break;
				case "viewbyarray": echo $this->viewbyarray($v); break;
				case "viewfiles": $this->viewfiles($v); break;
				case "view_json_session": echo $this->view_json_session($v); break;
				case "unlink": unlink($v); break;
				case "webres": echo $this->webres($v); break;
				case "webtheme": echo $this->webtheme($v); break;
				case "writecsv": $this->writecsv($v); break;
				case "writetxtfile": $this->writetxtfile($v); break;
				case "writetxtfile_two": $this->writetxtfile_two($v); break;
				case "onoff": $this->onoff($v); break;
				case "databse": $this->install_database($v); break;
				default:
				break;
			}
		}
		if(!isset($j->class)){}else{?></div><?php }
	}	
}
?>