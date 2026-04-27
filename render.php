<?php
class rend{
    function __construct(){

    }
    function __destruct(){
        
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
    public function pregs($c){
        $preg = "'/\[%S\](.*?)\=(.*?)\[%E\]/s'";
        preg_match_all($preg, $c, $matches);
        return $matches;
    }
    public function showHtml($a){
        if(is_array($a))
        {
            foreach($a as $k=>$v)
            {
                echo $this->mats($v);
            }
        }
        else
        {
            echo "Invalid Page Object";
        }
    }
    public function keys()
    {
        $keys =array("EndSwitch","case","break","Maths","EndPage","EndDataLoop","DataVars","DataTheme","EndApiLoop","ApiVars","ApiTheme","EndNumLoop","NumVar","NumTheme");
        return $keys;
    }
    public function mats($a)
    {
        $res="";
        $keys = $this->keys();
        $ex = explode("|",$a);
            $fv = $ex[0];
            switch($fv){
                case "Switch":
                    break;
                case "Maths":
                    break;
                case "Page":
                    break;
                case "DataLoop":
                    break;
                case "ApiLoop":
                    break;
                case "NumLoop":
                    break;
                default:
                    if(in_array($fv,$keys)){}else{
                        $res=$a;
                    }
                break;
            }
            return $res;
    }
    public function html($a)
    {
        $res="";
        for($i=0;$i<count($a);$i+=1)
        {
            $res.=$this->mats($a[$i]);
        }
        return $res;
    }
    public function get_php($a,$s,$e)
    {
        $sx=0;
        $ex=0;
        $nar=array();
        for($i=0;$i<count($a);$i+=1)
        {
            if($a[$i]==$s){
                $sx=$i;
                $nar[$sx]=$sx;
            }
            if($a[$i]==$e){
                $ex=$i;
                $nar[$ex]=$ex;
            }
            
        }
        $bm=""; $sm=array();
        $t=0;
        foreach($nar as $tk=>$tv)
        {
            $sm[$t]=$tv;
            $t+=1;
        }
        $nx=0;
        
        for($p=0;$p<count($sm);$p+=1)
        {
            if($p % 2 == 0) {
                for($y=$sm[$p]+1;$y<$sm[$p+1];$y+=1)
                    {
                        $bm.=$a[$y];
                    }
            }
        }
        return eval($bm);
    }
    public function get_string($a,$s,$e,$x)
    {
        $sx=0;
        $ex=0;
        $nar=array();
        for($i=0;$i<count($a);$i+=1)
        {
            $se = explode($x,ltrim(rtrim($a[$i])));
            //var_dump($se);
            if($se[0]==$s){
                $sx=$i;
                $nar[$sx]=$sx;
            }
            if($se[0]==$e){
                $ex=$i;
                $nar[$ex]=$ex;
            }
            
        }
        $bm=array(); $sm=array();
        $t=0;
        foreach($nar as $tk=>$tv)
        {
            $sm[$t]=$tv;
            $t+=1;
        }
        $nx=0;
        for($p=0;$p<count($sm);$p+=1)
        {
            if($p % 2 == 0) {
                $itmx = explode("|",$a[$sm[$p]]);
                if(count($itmx)>1){
                    for($y=$sm[$p]+1;$y<$sm[$p+1];$y+=1)
                    {
                        $bm[$itmx[1]][]=$a[$y];
                    }
                    //$bm[$nx]=$sm[$p].":".$sm[$p+1];
                    $nx+=1;
                }
            }
        }
        return $bm;
    }
    public function swch($a){
        $res="";
        $sc = $this->get_string($a,"switch","switchend","|");
        $cs = $this->get_string($a,"case","break","|");
        //var_dump($cs);
        foreach($sc as $kk=>$vv)
        {
            if(isset($cs[$kk])){
                $vl=$cs[$kk];
                if(is_array($vl)){                
                    for($i=0;$i<count($vl);$i+=1)
                    {
                        $res.=$vl[$i];
                    }
                }
            }
            else{
                $vl=$cs['def'];
                if(is_array($vl)){                
                    for($i=0;$i<count($vl);$i+=1)
                    {
                        $res.=$vl[$i];
                    }
                } 
            }
        }
       return $res;
    }
    public function xhtml($a){
        $res="";
        $sc = $this->get_string($a,"switch","switchend","|");
        for($i=0;$i<count($sc);$i+=1)
        {
            $sp = explode(":",$sc[$i]);
            $st = explode("|",$a[$sp[0]]);
            $cs[$i] = $this->get_string($a,"case","break","|");
            var_dump($cs);

        }
       return $res;
    }
}
$rend = new rend();
$rf = $rend->read_file_to_arraY("new.html");
$gs = $rend->swch($rf);
echo $gs;

//$html=$rend->html($rf);
//echo $html;

//$sc = $rend->get_php($rf,"<%","%>");
//var_dump($sc);

//$pg=(isset($sc[$_REQUEST['page']])) ? $sc[$_REQUEST['page']]: "";
//echo $rend->showHtml($pg);
?>