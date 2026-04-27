var hml="";
	for(i=0;i<c.length;i+=1)
	{
		$(".colors").append('<div class="s'+i+'">'+i+" "+c[i]+'</div>');
		vf(".s"+i,{3:15,4:1,27:'pointer',0:c[i],1:c[0],23:'left',11:f[0],12:'90%'});
	}
		for(i=0;i<f.length;i+=1)
	{
		$(".fonts").append('<div class="f'+i+'">'+i+" - "+f[i]+'</div>');
		vf(".f"+i,{3:15,4:10,2:'1px dotted '+c[3],27:'pointer',23:'left',12:'200%',11:f[i]});
	}
	vf(".cuscolors",{24:'flex',57:'wrap'});
	vf(".cuscolors .col",{3:10,17:100});
	