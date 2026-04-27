window.onresize=function(){window.location.reload();}
//* waw.js freeware *//
//* All Rights Reserved @ Manjunath, 9343945143 *//
//*created - 2020 , WAW Js to handle the font-size, padding & margin size stability*//
function waw(ccid,chd){
	el=$("."+ccid);
	ell = el.length;
	for(i=0;i<ell;i+=1)
	{
		if(ww>wh){
			atx=ww/parseInt(el.eq(i).attr(ccid));
		}else
		{
			atx=wh/parseInt(el.eq(i).attr(chd));
		}
		vf(el.eq(i),{17:atx+"px"});
	}
}
function wafw(ccid,chd){
	el=$("."+ccid);
	ell = el.length;
	for(i=0;i<ell;i+=1)
	{
		if(ww>wh){
			atx=parseInt(el.eq(i).attr(ccid));
		}else
		{
			atx=parseInt(el.eq(i).attr(chd));
		}
		vf(el.eq(i),{12:ww/atx+"px"});
	}
}
function wpaw(ccid,chd){
	el=$("."+ccid);
	ell = el.length;
	for(i=0;i<ell;i+=1)
	{
		alp='';
		if(ww>wh){			
			ap=el.eq(i).attr(ccid).split(",");
		}else
		{
			ap=el.eq(i).attr(chd).split(",");
		}		
		for(j=0;j<ap.length;j+=1)
			{
				if(ap[j]==0){alp+='0px ';}else{alp+=ww/parseInt(ap[j])+'px ';}
			}
		vf(el.eq(i),{3:alp});
	}	
}
function wmaw(ccid,chd){
	el=$("."+ccid);
	ell = el.length;
	for(i=0;i<ell;i+=1)
	{
		alp='';
		if(ww>wh){			
			ap=el.eq(i).attr(ccid).split(",");
		}else
		{
			ap=el.eq(i).attr(chd).split(",");
		}		
		for(j=0;j<ap.length;j+=1)
			{
				if(ap[j]==0){alp+='0px ';}else{alp+=ww/parseInt(ap[j])+'px ';}
			}
		vf(el.eq(i),{4:alp});
	}
}
function wraw(ccid,chd){
	el=$("."+ccid);
	ell = el.length;
	for(i=0;i<ell;i+=1)
	{
		alp='';
		if(ww>wh){			
			ap=el.eq(i).attr(ccid).split(",");
		}else
		{
			ap=el.eq(i).attr(chd).split(",");
		}		
		for(j=0;j<ap.length;j+=1)
			{
				if(ap[j]==0){alp+='0px ';}else{alp+=ww/parseInt(ap[j])+'px ';}
			}
		vf(el.eq(i),{10:alp});
	}
}
waw("waw","wah");
wmaw("wmaw","wmah");
wpaw("wpaw","wpah");
wraw("wraw","wrah");
wafw("wfaw","wfah");