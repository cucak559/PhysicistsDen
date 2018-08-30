
<p>
      <span>{{ $activity->subject->created_at->diffForHumans() }},</span><i> {{$user->name}}</i>
      <b>created a topic:</b>
</p>

<div class="card article-card mt-4 mb-4">
      <div class="row">
            <div class="col-auto">
                  <img src="//placehold.it/200" class="img-fluid" alt="">
            </div>

            <div class="col">
                  <div class="card-block px-2">
                        <h4 class="card-title article-topic">
                              <a href="/{{$activity->subject->id}}/show">
                                    {{ $activity->subject->title }}
                              </a>
                        </h4>

                        <p class="card-text article-description">
                              {{ $activity->subject->description }}
                        </p>

                  </div>
            </div>
      </div>
</div>
