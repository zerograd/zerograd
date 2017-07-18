
<div class="pagination">

  @if($page > 1)
  <a href="javascript:pagination({{$page - 1}});">&laquo;</a>
  @endif
  @for($i = $page ; $i < ($page + 10) ; $i++)
  		@if($i == $page)
  			<a href="javascript:pagination({{$i}});" class="page active">{{$i}}</a>
  		@else
			<a href="javascript:pagination({{$i}});" class="page">{{$i}}</a>
  		@endif
  @endfor

  @if($page < $numberOfPages)
  <a href="javascript:pagination({{$page + 1}});">&raquo;</a>
  @endif
</div>