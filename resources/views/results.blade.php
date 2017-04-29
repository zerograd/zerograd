@foreach ($postings as $posting)
                            <li class="col-sm-12">
                                <div class="col-sm-6"><h5>Title: <strong>{{$posting->title}}</strong></h5></div>
                                <div class="col-sm-6"><h5>Posted: <strong>{{$posting->posted_date}}</strong></h5></div>
                                <div class="col-sm-12 keywords"><h5>Keywords: <strong>{{$posting->keywords}}</strong></h5></div>
                            </li>
@endforeach