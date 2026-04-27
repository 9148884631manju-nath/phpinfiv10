<?php
	foreach($_REQUEST as $k=>$v)
	{
		//echo $v."<hr/>";
		$v=strtolower($v);
		switch($v)
		{
			case strpos($v, 'delete'):
				?><div class="hkr"><?php echo "Yeh! What r u dng man? Are You Authorised Person or What?<br/><h1>What Do You Want</h1>";?></div><?php
				exit;
			break;
			case strpos($v, 'update'):
				?><div class="hkr"><?php echo "Yeh! What r u Updating?<br/><h1>What Do You Want</h1>";?></div><?php
				exit;
			break;
			case strpos($v, 'insert'):
				?><div class="hkr"><?php echo "Yeh! What r u Inserting?<br/><h1>?</h1>";?></div><?php
				exit;
			break;
			case strpos($v, ' union select '):
				?><div class="hkr"><?php echo "Yeh! Is this is Programmer ?<br/><h1>?</h1>";?></div><?php
				exit;
			break;
			case strpos($v, ' or '):
				?><div class="hkr"><?php echo "Yeh! Is this is Programmer ?<br/><h1>?</h1>";?></div><?php
				exit;
			break;
			default: break;
		}
	}
	foreach($_POST as $k=>$v)
	{
		//echo $v."<hr/>";
		$v=strtolower($v);
		switch($v)
		{
			case strpos($v, "'--"):
				?><div class="hkr"><?php echo "Hey! Whats wrong with You?<br/><h1>What Do You Want</h1>";?></div><?php
				exit;
			break;
			case strpos($v, " or 1=1 "):
				?><div class="hkr"><?php echo "Hey! Whats wrong with You?<br/><h1>What Do You Want</h1>";?></div><?php
				exit;
			break;
			case strpos($v, " union select "):
				?><div class="hkr"><?php echo "Hey! Whats wrong with You?<br/><h1>What Do You Want</h1>";?></div><?php
				exit;
			break;
			case strpos($v, " or "):
				?><div class="hkr"><?php echo "Hey! Whats wrong with You?<br/><h1>What Do You Want</h1>";?></div><?php
				exit;
			break;
			default: break;
		}
	}
?>