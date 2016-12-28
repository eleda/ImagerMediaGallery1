<!-- // WINDOWS MEDIA PLAYERES LEJÁTSZÓ
			// echo "Most szkripptel mennek a dolgok"; -->
	<script type='text/javascript'>
		AC_AX_RunContent( 'id','mediaPlayer','width','480','height','460','classid','CLSID:22d6f312-b0f6-11d0-94ab-0080c74c7e95','codebase','http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=5,1,52,701','standby','A Microsoft Windows Media Player összetevõinek betöltése...','type','application/x-oleobject','pluginspage','http://microsoft.com/windows/mediaplayer/en/download/','name','mediaPlayer','displaysize','4','autosize','-1','bgcolor','darkblue','showcontrols','true','showtracker','-1','showdisplay','0','showstatusbar','-1','videoborder3d','-1','src','<?php echo $file; ?>','autostart','true','designtimesp','5311','loop','false','filename','" . $file . "','animationatstart','true','transparentatstart','false' )
		</script><noscript><OBJECT id='mediaPlayer' width=480 height=460";
	classid='CLSID:22d6f312-b0f6-11d0-94ab-0080c74c7e95'
	codebase='http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=5,1,52,701'
	standby='A Microsoft Windows Media Player összetevõinek betöltése...' type='application/x-oleobject'>
	<param name='fileName' value="<?php echo $file; ?>">
	<param name='animationatStart' value='true'>
	<param name='transparentatStart' value='false'>
	<param name='autoStart' value=true>
	<param name='showControls' value=true>
	<param name='loop' value=false>
	<EMBED type='application/x-mplayer2'
	pluginspage='http://microsoft.com/windows/mediaplayer/en/download/'
	id='mediaPlayer' name='mediaPlayer' displaysize='4' autosize='-1'
	bgcolor='darkblue' showcontrols=true showtracker='-1'
	showdisplay='0' showstatusbar='-1' videoborder3d='-1' width=320 height=285
	src="<?php echo $file; ?>" autostart=true designtimesp='5311' loop=true>				
	</EMBED>
	</OBJECT></noscript>