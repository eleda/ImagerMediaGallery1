<!-- // SILVERLIGHT LEJÁTSZÓ			
			// echo "<p class='war'>Figyelem! A lejátszó ismeretlen okokból kifolyólag 'leadarálja' a lejátszandó műsort. A hiba kijavításáig használják a Letöltés lehetőséget. Köszönjük.</p>";
			?> -->
			<div><object data='data:application/x-silverlight,' type='application/x-silverlight' style='height: 441px; width: 548px'>
			<param name='source' value='MediaPlayerTemplate.xap'/>
			<param name='onerror' value='onSilverlightError' />
			<param name='autoUpgrade' value='true' />
			<param name='minRuntimeVersion' value='4.0.0.0' />
			<param name='enableHtmlAccess' value='true' />
			<param name='enableGPUAcceleration' value='true' />
			<param name='initparams' value='playerSettings =
			        <Playlist>
				    <AutoLoad>true</AutoLoad>
			        <AutoPlay>true</AutoPlay>";
			        <DisplayTimeCode>true</DisplayTimeCode>
			<EnableOffline>true</EnableOffline>
			<EnablePopOut>true</EnablePopOut>
			<EnableCaptions>true</EnableCaptions>
			<EnableCachedComposition>true</EnableCachedComposition>
			<StretchNonSquarePixels>NoStretch</StretchNonSquarePixels>
			<StartMuted>false</StartMuted>
			<StartWithPlaylistShowing>false</StartWithPlaylistShowing>
			<Items>
			<PlaylistItem>
			<AudioCodec>WmaProfessional</AudioCodec>
			<Description></Description>
			<IsAdaptiveStreaming>false</IsAdaptiveStreaming>
			<MediaSource><?php echo $file; ?></MediaSource>
			<ThumbSource></ThumbSource>
			<Title>Imager Videólejátszó</Title>
			<DRM>false</DRM>
			<VideoCodec>VC1</VideoCodec>
			<AspectRatioWidth>4</AspectRatioWidth>
			<AspectRatioHeight>3</AspectRatioHeight>
			</PlaylistItem>
			</Items>
			</Playlist>'/>
			<div onMouseOver='highlightDownloadArea(true)' onMouseOut='highlightDownloadArea(false)'>
			<img src='' style='position:relative;width:100%;height:100%;border-style:none;' onerror='this.style.display='none''/>
			<img src=Preview.png style='position:relative;width:100%;height:100%;border-style:none;' onerror='this.style.display='none''/> 
			<div id='overlay' class='fadeLots' style='position:relative;width:100%;height:100%;border-style:none;background-color:white;'/></div>
			<table width='100%' height='100%' 
			style='position:relative;'><tr><td align='center' valign='middle'>
			<img src='http://go2.microsoft.com/fwlink/?LinkId=108181' alt='Get Microsoft Silverlight'> "</td></tr></table>
			<a href='http://go2.microsoft.com/fwlink/?LinkID=149156'>
			<img src='' class='fadeCompletely'
				  style='position:relative;width:100%;height:100%;border-style:none;' alt='Get Microsoft Silverlight'/>
			</a></object></div>