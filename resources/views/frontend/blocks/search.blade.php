<div class="aa-search-box">
	<form action="{!! route('getTimkiem') !!}" method="POST">
    	<input type="hidden" name="_token" value="{!! csrf_token() !!}" />
	  	<input type="text" name="txtSearch" id="txtserach" placeholder="Tìm kiếm..." value="{!! isset($keyword) ? $keyword : '' !!}">
	  	<button type="submit"><span class="fa fa-search"></span></button>
	</form>
</div>