<table class="table table-striped" style="margin-top: 30px;">
  <thead class="thead-inverse">
    <tr>
      <th>IP Address</th>
      <th>Searches</th>
      <th>Search Time</th>
    </tr>
  </thead>
  <tbody>
  @if(sizeof($historySize) > 0)
    @foreach($searchHistory as $history)
      <tr>
        <td>{{$history->ip_address}}</td>
        <td>{{$history->searches}}</td>
        <td>{{$history->search_time}}</td>
      </tr>
    @endforeach
  @else
    <tr>
      <td colspan="3">No History</td>
    </tr>
  @endif
  </tbody>
</table>