function jcv(el,ex) {	rs={}; switch(ex[0]) { case "bg": rs={0:c[ex[1]]};break; case "bimg": rs={0:'url('+ex[1]+') '}; break; case "c": rs={1:c[ex[1]]};break; case "brd": rs={2:ex[1]+" "+ex[2]+" "+c[ex[3]]};break; case "pad": rs={3:ex[1]};break;  case "m": rs={4:ex[1]};break; case "pr": rs={5:'relative'};break; case "pa": rs={5:'absolute'};break; case "pf": rs={5:'fixed'};break; case "l": rs={6:ex[1]};break; case "t": rs={7:ex[1]};break; case "mt": rs={7:'-'+ex[1]};break; case "b": rs={8:ex[1]};break; case "r": rs={9:ex[1]};break; case "rnd": rs={10:ex[1]};break; case "f": rs={11:f[ex[1]]};break; case "fs": rs={12:ex[1]};break; case "afs": ww=$(window).width(); if(ww<1000){xn=ex[1]/2;}else{xn=ex[1]}	rs={12:ww/xn}; break; case "tl": rs={13:'left'};break; case "tr": rs={13:'right'};break; case "tc": rs={13:'center'};break; case "tj": rs={13:'justify'};break; case "ls": rs={14:ex[1]}; break; case "ofya": rs={15:'auto'};break; case "ofyh": rs={15:'hidden'};break; case "of": rs={16:ex[1]};break; case "w": rs={17:ex[1]};break; case "aw": pw=$(el).parent().width(); rs={17:pw/ex[1]};break;
 /*JCSS V1.0 CREATED BY KMANJUNATH 9343945143 FREE WARE */ case "ah": ph=$(window).height(); rs={18:ph/ex[1]};break;  case "h": rs={18:ex[1]};break; case "brdb": rs={19:ex[1]+" "+ex[2]+" "+c[ex[3]]};break; case "brdt": rs={20:ex[1]+" "+ex[2]+" "+c[ex[3]]};break; case "brdl": rs={21:ex[1]+" "+ex[2]+" "+c[ex[3]]};break; case "brdr": rs={22:ex[1]+" "+ex[2]+" "+c[ex[3]]};break; case "fl": rs={23:'left'};break; case "fr": rs={23:'right'};break; case "db": rs={24:'block'};break; case "dn": rs={24:'none'};break; case "clb": rs={26:'both'};break; case "cp": rs={27:'pointer'};break; case "shod": rs={28:ex[1]+" "+ex[2]+" "+ex[3]+" "+c[ex[4]]};break; case "fcen": rs={29:'translate(-50%,-50%)',6:'50%',7:'50%',5:'fixed'};break; case "rot": rs={29:'rotate('+ex[1]+')'};break; case "mrot": rs={29:'rotate(-'+ex[1]+')'};break; case "pcen": rs={29:'translate(-50%,-50%)',6:'50%',7:'50%',5:'absolute'};break; case "hcen": rs={29:'translate(-50%,0%)',6:'50%'};break; case "vcen": rs={29:'translate(0%,-50%)',7:'50%'};break; case "txd": rs={30:ex[1]};break; case "tns": rs={34:ex[1]};break; case "bgs": rs={44:ex[1]};break; case "flt": rs={45:ex[1]};break; case "ofxa": rs={46:'auto'};break; case "ofxh": rs={46:'hidden'};break; case "z": rs={47:ex[1]};break; rs={51:ex[1]};break; case "lihp": rs={51:ex[1]+'%'};break; case "upc": rs={56:'uppercase'};break; case "pt": rs={66:ex[1]};break; case "pb": rs={67:ex[1]};break; case "pl": rs={68:ex[1]};break; case "pdr": rs={69:ex[1]};break; case "op": rs={43:ex[1]};break; case "rndbl": rs={70:ex[1]};break; case "rndbr": rs={71:ex[1]};break; case "rndtl": rs={72:ex[1]};break; case "rndtr": rs={73:ex[1]};break; default: rs={}; break; case "lih":  } vf(el,rs); } function runc(){ssx=$(".jcss"); for(o=0;o<ssx.length;o+=1){ss(ssx[o]);}} runc(); window.onresize=function(){runc();}
$(".fifo").click(function(){dis=$(this).attr("fifo");spl=dis.split("|");elhs(spl[0],spl[1],spl[2]);});$(".fofi").click(function(){dis=$(this).attr("fofi");spl=dis.split("|");elhs(spl[0],spl[1],spl[2]);}); $(".ani_left").click(function(){dis=$(this).attr("ani_left");s=dis.split("|");vf(s[0],{6:s[2],34:s[3]});});function minmaxint(){$(".minmaxint").click(function(){par=$(this).attr("par");def=parseInt($(this).attr("def"));ope=$(this).attr("ope");vla=parseInt($(this).attr("val"));pv=parseInt($(par).val());switch(ope){case "min": if(pv<2){nval=def;}else{ nval=pv-vla;} break;case "max": nval=pv+vla; break;default:break;}$(par).val(nval);});}minmaxint();function adcart(){$(".addcart").click(function(){cf=$(this).attr("default").split("|");$(cf[5]).html(cf[6]);mar={};par=cf[1].split(",");for(i=0;i<par.length;i+=1){gvm=$(this).attr(par[i]).split("||");switch(gvm[0]){case "value":mar[par[i]]=$(gvm[1]).val();break;default:mar[par[i]]=$(this).attr(par[i]);break;}} $.post(cf[0],mar,function(d){$(cf[5]).html(d);}); });}adcart();function valfromtotxt(){$(".valfromtotxt").click(function(){valfrom=$($(this).attr("valfrom")).val();$($(this).attr("valto")).text(valfrom);});}valfromtotxt();function addupnumberto(){$(".addupnumberto").click(function(){getn=$(this).attr("addupnumberto").split("|");nn=parseInt($(getn[0]).text());switch(getn[2]){case "m":nns=nn-parseInt(getn[1]);break;default:nns=nn+parseInt(getn[1]);break;}$(getn[0]).text(nns);});}addupnumberto();function getcount(el){dis=$(el);vl=0; for(i=0;i<dis.length;i+=1){gcc=dis.eq(i).attr("getcount");  for(j=0;j<$(gcc).length;j+=1){vl+=parseInt($(gcc).eq(j).text());} dis.eq(i).text(vl);} }getcount(".getcount");function cartpay(){$(".cartpay").click(function(){dis=$(this);po=dis.attr("cartpay").split("|");postfle(po[0],po[1],po[2],po[3]);});}cartpay();function activewithvalues(){$(".activewithvalues").mouseover(function(){alert();});}activewithvalues();function sendata(){$(".senddata").click(function(){dis=$(this); par = dis.attr("senddata").split("|");spa={};dae=par[1].split(",");for(i=0;i<dae.length;i+=1){spa[dae[i]]=$(par[0]).attr(dae[i]);}$(par[3]).html(par[4]);$.post(par[2],spa,function(d){$(par[3]).html(d);});});}sendata();function imgchange(){var x=0; $(".imgchange").click(function(){if(x==0){$(this).attr("src",$(this).attr("imgchange"));x=1; return true;}else if(x==1){$(this).attr("src",$(this).attr("imgorg"));x=0;return true;} });}imgchange();
function attrtoval(){$(".attrtoval").click(function(){txt = $(this).attr("attrtoval").split("|");$(txt[0]).val($(txt[1]).attr(txt[2]));});}attrtoval();
function passopen(){$(".passopen").click(function(){ dd=$(this).attr("passopen").split("|");if(dd[1]=="1"){$(dd[0]).attr("type","text");}else{$(dd[0]).attr("type","password");}});}passopen();function finfo(){$(".finfo").click(function(){fnf=$(this).attr("finfo").split("|"); fnfr=$(this).attr("finfor").split("|");fndr=$(this).attr("findur").split("|");for(i=0;i<fnf.length;i+=1){elhs(fnf[i],fnfr[i],fndr[i]);}});}finfo();function getsearchResults(){$(".getsearchResults").keyup(function(){par=$(this).attr("getsearchResults").split("|");$(par[2]).html(par[3]);$.post(par[1],{"sval":$(par[0]).val()},function(d){$(par[2]).html(d);}); });}getsearchResults();function txttoval(){$(".txttoval").click(function(){txt = $(this).attr("txttoval").split("|");$(txt[1]).val($(txt[0]).text());});}txttoval();function multiple(){$(".multiplex").click(function(){dis=$(this); disv=dis.attr("multiplex").split("|"); pval = $(disv[0]).val(); if(pval==""){$(disv[0]).val(disv[1]+","); vf(dis,{0:'var(--0)'}); } else { pvalser = pval.search(disv[1]); if(pvalser==-1){ $(disv[0]).val(disv[1]+","+pval); vf(dis,{0:'var(--0)'}); } else{ $(disv[0]).val(pval.replace(disv[1]+",","")); vf(dis,{0:c[0]}); } }});}multiple();

function multisel(){$(".multisel").click(function(){ dis=$(this).attr("multisel");disval=$(this).val(); disv=dis.split("|");$(disv[3]).val(disval);itc=$(disv[0]).length;for(i=0;i<itc;i+=1){sfi=disval.search($(disv[0]).eq(i).text());if(sfi==-1){vf($(disv[0]).eq(i),{0:c[disv[2]]});}else{vf($(disv[0]).eq(i),{0:c[disv[1]]});}}});}multisel();

function multiselbg(){el = $('.multiselbg'); el.click(function(){ dis=$(this);dar=dis.attr('multiselbg').split("|"); cel=$(dar[0]); celn=dis.attr('mbgn'); if(celn==0){ vf(cel,{0:c[dar[1]]}); dis.attr('mbgn',1); return false; }else if(celn==1){  vf(cel,{0:c[dar[2]]}); dis.attr('mbgn',0); return false; } });}multiselbg();

function getnumber(){dis = $(".getnumber").length;if(dis>0){for(i=0;i<dis;i+=1){
	disa = $(".getnumber").eq(i).attr("getnumber");
	diss = disa.split("|");
	getv = diss[2].split(";");nn=new Array();
	res = diss[3];
	atrv=diss[1];
	//alert(atrv);
	for(j=0;j<getv.length;j+=1)
	{
		nn[j]=$("."+getv[j]).attr(getv[j]);
	}
	
	switch(diss[0])
	{
		case "minus":
			y=nn[0]-nn[1];
			if(y<0){bn=0;}else{bn=y;}
			$(res).text(bn);
		break;
		default: break;
	}
}}else{}}getnumber();
function addattrnums(n){}function alladdnums(){ds = $(".addattrnums").length;for(x=0;x<ds;x+=1){ dats = $(".addattrnums").eq(x).attr("addattrnums"); dspl = dats.split("|"); var als=0; nums = $(dspl[0]).length;for(i=0;i<nums;i+=1){ atts = parseInt($(dspl[0]).eq(i).attr(dspl[1])); als+=atts;  } 
$(dspl[2]).html(als); }}alladdnums();
function addtextnums(){ds = $(".addtextnums").length;for(x=0;x<ds;x+=1){ dats = $(".addtextnums").eq(x).attr("addtextnums"); dspl = dats.split("|");  var als=0; 
nums = $(dspl[0]).length;
for(i=0;i<nums;i+=1){ atts = parseInt($(dspl[0]).eq(i).text()); als+=atts;  } 
$(dspl[1]).html(als);  } }addtextnums();
function trim_add_comma_last(){var ix = $(".trim_add_comma_last"); ixl = ix.length;for(i=0;i<ixl;i+=1){ixv=ix.eq(i).val();if(ix==""){}else{ix.val(ixv.replace(", ",","));}}}trim_add_comma_last(); function range(){var ran=$(".range");var ranl = ran.length;for(i=0;i<ranl;i+=1){ran.eq(i).change(function(){dis =$(this);disa=dis.attr("range");$(disa).html(dis.val());});}}range();
function countprice(){$('.countprice').click(function(){dis=$(this);disat=dis.attr('countprice').split("|");tot=parseInt($(disat[1]).val());prc=parseInt(disat[2]);tx=tot*prc;$(disat[0]).html(disat[3]+tx+disat[4]);});}countprice();
function sendata_by_type(){$(".sendata_by_type").click(function(){dis=$(this); par = dis.attr("sendata_by_type").split("|");spa={};parv=par[0].split(",");dae=par[1].split(",");dt=par[2].split(",");for(i=0;i<dae.length;i+=1){
	sv=dae[i];
	switch(dt[i]){
		case "attr":
			spa[sv]=$(parv[i]).attr(sv);
		break;
		case "val":
			spa[sv]=$(parv[i]).val();
		break;
		default:
			spa[sv]=$(parv[i]).attr(sv);
		break;
	}
}$(par[4]).html(par[5]);$.post(par[3],spa,function(d){$(par[4]).html(d);});});}sendata_by_type();

function multiplewith(){$(".multiplexwith").click(function(){dis=$(this); disv=dis.attr("multiplexwith").split("|"); dsv1=disv[1].replace("(","").replace(")",""); pval = $(disv[0]).val();  if(pval==""){ $(disv[0]).val(disv[2]+""+dsv1+disv[2]+""); vf(dis,{0:'var(--0)'}); } else {pvalser = pval.search(disv[2]+""+dsv1+""+disv[2]); inof = pval.indexOf(disv[2]+""+dsv1+""+disv[2]); pv = pval.split(",");if(pvalser==-1){ $(disv[0]).val(pval+","+disv[2]+""+dsv1+disv[2]); vf(dis,{0:'var(--0)'});} else{ if(inof==0 && pv.length>1){$(disv[0]).val(pval.replace(disv[2]+""+dsv1+disv[2]+",",""));}else{if(inof==0 && pv.length==1){$(disv[0]).val(pval.replace(disv[2]+""+dsv1+disv[2],""));}else {$(disv[0]).val(pval.replace(","+disv[2]+""+dsv1+disv[2],""));}}vf(dis,{0:c[0]}); } }});}multiplewith();
function toattr(){$(".toattr").click(function(){dis=$(this);tosa=dis.attr("toattr").split("--");if(tosa.length>1){	for(xi=0;xi<tosa.length;xi+=1){ toatr(dis,tosa[xi]); }}else{toatr(dis,tosa[0]);}});}toattr();
function toatr(par,vla){toa = vla.split("|");switch(toa[0]){ case "disval": vlx=par.val(); break; case "disatr": vlx=par.attr(toa[1]); break; default: vlx=toa[1]; break;} switch(toa[3]) { case "atr": $(toa[2]).attr(toa[4],vlx); break; default: $(toa[2]).text(toa[4],vlx); break; }}function changeSendVal(){$(".changeSendVal").change(function(){stores($(this),"changeSendVal",'vla');});}changeSendVal();function postdata(url,fld,val){ els="";for(i=0;i<fld.length;i+=1){els+='<input type="hidden" name="'+fld[i]+'" value="'+val[i]+'" />';}$("body").append('<form method="post" class="thispost" action="'+url+'">'+els+'</form>');$(".thispost").submit();}function chknum(){$('.chknum').keyup(function(){dis=matchnumber($(this).val()); if(dis==null){$(this).val('');$(this).focus();}else{} });}chknum();function removespace(v){return v.replace(/ /g,'');}function matchemail(v){ma=/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;return v.match(ma);}function matchnumber(v){ma=/^[0-9]+$/;return v.match(ma);}function clickStoreInSes(){$(".clickStoreInSes").click(function(){stores($(this),"clickStoreInSes",'atr');});}clickStoreInSes();function stores(el,atx,frm){dis=el.attr(atx).split("|");par=dis[3].split("=");mm=new Array();for(i=0;i<par.length;i+=1){ switch(frm){ case "txt": gnn=gnn=$(par[i]).text(); break; case "atr": atrv=par[i].replace(".",""); gnn=$(par[i]).attr(atrv); break;default: gnn=$(par[i]).val(); break;} mm[i]=gnn;} dik=$(dis[1]);dik.html(dis[2]);$.post(dis[0],{"dat":mm},function(d){dik.html(d);});}$(".lightbox .cls,.lightbox .bg").click(function(){$(".lightbox").fadeOut(300);});function popupimage(){$(".popupimage").click(function(){dis=$(this).attr("popupimage").split("|");$(dis[0]).fadeIn(300); $(dis[1]).html('Loading...'); $.get(dis[2],function(d){$(dis[1]).html(d);});}); }popupimage();function percent(){els = $(".percent");aels=els.length;for(i=0;i<aels;i+=1){dis = els.eq(i).attr("percent");spl=dis.split("|");per=Math.round((spl[1]/spl[0])*100);cirp=Math.round(360*per / 100);ncrp=Math.round(360*cirp/100);fncrp=360-ncrp; ncirp=cirp+5; vf(els.eq(i),{0:'conic-gradient(transparent '+cirp+'deg, var(--8) '+ncirp+'deg)'});}}percent();function percentheight(){els = $(".percentheight");aels=els.length;for(i=0;i<aels;i+=1){dis = els.eq(i).attr("percentheight");spl=dis.split("|");per=Math.round((spl[1]/spl[0])*100);cirp=Math.round(spl[2]*per / 100); vf(els.eq(i),{18:cirp+'px'});}}percentheight();
function hscroll(){els = ($(".hscroll").attr("hscroll")).split("|");rit=els[2];lft=els[0];blk=els[1];dur=els[3];$(rit).click(function(){
clearInterval(ani);	ann();	ani = setInterval(ann,dur);});$(lft).click(function(){clearInterval(ani);anl();ani = setInterval(ann,dur);
});


function txt_to_attr(){$(".txt_to_attr").click(function(){dis=$(this); atr=dis.attr("txt_to_attr"); sar=atr.split("/"); 
for(i=0;i<sar.length;i+=1){
		atrs=sar[i].split("|");
		$(atrs[0]).attr(atrs[1],atrs[2]);
	} 
});
} txt_to_attr();

function moveup(){
$(".moveup").click(function(){
		dis=$(this);
		atr=dis.attr("moveup").split("|");
		switch(atr[1])
		{
			case "up":
				itm=$(atr[0]);
				itml = itm.length;
				lst = itml-1;
				itm.eq(0).stop().slideUp(300,function(){
					itm.eq(0).insertAfter(itm.eq(lst));
					itm.eq(0).stop().fadeIn(430);
					
				});
			break;
			case "down":
				itm=$(atr[0]);
				itml = itm.length;
				lst = itml-1;
				itm.eq(lst).stop().fadeOut(100,function(){
					itm.eq(lst).insertBefore(itm.eq(0));
					itm.eq(lst).stop().slideDown(430);
					
				});
			break;
			case "right":
				itm=$(atr[0]);
				itml = itm.length;
				lst = itml-1;
				itmw = itm.eq(lst).width();
				itm.eq(lst).stop().fadeOut(100,function(){
					itm.eq(lst).insertBefore(itm.eq(0));
					itm.eq(lst).stop().slideDown(430);
					
				});
			break;
			default: break;
		}
		
	});
}moveup();
function ann(){$(blk+":first").insertAfter($(blk+":last"));}function anl(){$(blk+":last").insertBefore($(blk+":first"));}clearInterval(ani);var ani = setInterval(ann,dur);}hscroll();

function hscroll_anim(){
els = $(".hscroll_anim").attr("hscroll_anim").split("|");
vrit=els[1];vlft=els[0];vblk=els[2];vdur=els[3];
function aa(){
	vf($(vblk+":last"),{6:'-100%'});
	$(vblk+":last").insertBefore($(vblk+":first"));
	vf($(vblk+":last"),{6:'0%'});
}
function bb(){
	vf($(vblk+":fist"),{6:'100%'});
	$(vblk+":first").insertAfter($(vblk+":last"));
	vf($(vblk+":first"),{6:'0%'});
}

clearInterval(hani);var hani = setInterval(aa,vdur);}hscroll_anim();



