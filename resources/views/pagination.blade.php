
<div class="pagination">
  <a href="javascript:pagination(1);">First</a>
  @if($page > 1)
  <a href="javascript:pagination({{$page - 1}});">&laquo;</a>
  @endif

  <?php
     $upperBound = (($page + 10) <= $numberOfPages)? ($page + 10):$numberOfPages;
  ?>
  @for($i = $page ; $i < $upperBound  ; $i++)
  		@if($i == $page)
  			<a href="javascript:pagination({{$i}});" class="page active">{{$i}}</a>
  		@else
			<a href="javascript:pagination({{$i}});" class="page">{{$i}}</a>
  		@endif
  @endfor

  @if($page < $numberOfPages)
  <a href="javascript:pagination({{$page + 1}});">&raquo;</a>
  @endif
  <a href="javascript:pagination({{$numberOfPages}});">Last</a>
</div>