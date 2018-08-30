<p>
      <span>{{ $activity->subject->created_at->diffForHumans() }},</span>
      <i>{{$user->name}}</i>
      <b>created a comment</b>
      to article
      <a href="/articles/show/{{$activity->subject->commentable->id}}">
            <b>{{$activity->subject->commentable->title}}</b>
      </a>
</p>

<div class="card comment-card mt-4 mb-4">
      <div class="row">
            <div class="col-auto">
                  <img class="comment-img" src="http://theadvertplace.com/wp-content/themes/classified/img/placeholder/blogpost-placeholder-100x100.png" class="img-fluid" alt="Profile Pic">
            </div>

            <div class="col">
                  <div class="card-block px-2">
                        <div class="card-title comment-meta">
                              <span class="comment-username">{{ $activity->subject->user->name }}</span>  <span class="comment-date">{{ $activity->subject->created_at->diffForHumans() }}</span>
                        </div>

                        <p class="card-text comment-body">
                              {{ $activity->subject->body }}
                        </p>

                  </div>
            </div>
      </div>
</div>

