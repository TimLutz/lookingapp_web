@extends('layout')
@section('title')
3 D Shed Designer
@endsection
@section('content')
<main id="main" role="main">
			<section class="block-faqs">
				
				<div class="container">
					<div class="row">
						<div class="col-3 info-box">
							<h1>Size Your Shed</h1>
							
						</div>
<div class="col-9 accordion-area">
<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="https://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="685" height="760" id="shedsize" align="middle">
<param name="allowScriptAccess" value="sameDomain" />
<param name="movie" value="{{ url('flash/shed_v7.swf') }}" />
<param name="quality" value="best" />
<param name="bgcolor" value="#ffffff" />
<param name="wmode" value="transparent">
<embed src="{{ url('flash/shed_v7.swf') }}" quality="best" bgcolor="#ffffff" width="685" height="760" name="shedsize" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" wmode="transparent" />
</object>
</div>
</div>
</div>
</section>
</main>

@endsection

