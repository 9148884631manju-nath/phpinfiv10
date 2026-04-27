$(window).scroll(function(){
st=$(this).scrollTop();
elanim(st);elanimx(st);
autoscrl(st);
});
function autoscrl(st){
    var wh=$(window).height();
    var lh = $(".SLeft .SFRAME").height();
    var rh = $(".SRight .SFRAME").outerHeight();
    var nlh = lh-wh;
    var nrh = rh-wh;
    var lt = st-$(".SLeft .SFRAME").offset().top;
    var rt = st-$(".SRight .SFRAME").offset().top;
    if(lh<rh)
    {
        if(st>=nlh){
            if(st>nrh){}else{
                if(nlh<0){newlh=st;}else{newlh=st-nlh;}
                vf('.SLeft .SFRAME',{7:newlh});
            }
        }else{vf('.SLeft .SFRAME',{7:0});}
    }
    if(lh>rh)
    {
        if(st>=nrh){
            if(st>nlh){}else{
                if(nrh<0){newrh=st;}else{newrh=st-nrh;}
                vf('.SRight .SFRAME',{7:newrh});
            }
        }else{vf('.SRight .SFRAME',{7:0});}
    }
    //$('.lcol').text(lh+' '+nlh+' '+lt);
    //$('.rcol').text(rh+' '+nrh+' '+rt);
}
function elanim(v){
	s=$('.scrl_anim');
	sl=s.length;
	
	for(i=0;i<sl;i+=1)
	{
		el=s.eq(i);
		se=parseInt(s.eq(i).attr('scrl_anim'));
		sfrm=s.eq(i).attr('sfrom');
		sto=s.eq(i).attr('sto');
		if(v>se)
		{
			el.removeClass(sfrm);
			el.addClass(sto);
		}
		if(v<se)
		{
			el.removeClass(sto);
			el.addClass(sfrm);
		}
	}
}
function elanimx(v){
	s=$('.scrl_animx');

                sl=s.length;      

                for(i=0;i<sl;i+=1)
                {
                                el=s.eq(i);
                                //se=parseInt(s.eq(i).attr('scrl_anim'));
                                se=el.offset().top/2;
                                whx = $(window).height()/2;
                                xwhx = parseInt(s.eq(i).attr('slen'));
                                sfrm=s.eq(i).attr('sfrom');
                                sto=s.eq(i).attr('sto');
                                re = (v-se)+whx+xwhx;
                                if(re>se)
                                {
                                                el.removeClass(sfrm);
                                                el.addClass(sto);
                                }
                                if(re<se)
                                {
                                                el.removeClass(sto);
                                                el.addClass(sfrm);
                                }
                }
}



$('a[href^="#"]').click(function () { 
	otp=$('[name="' + $.attr(this, 'href').substr(1) + '"]').offset().top;
	
    $('body, html').animate({scrollTop:otp}, 500);
    return false;
});