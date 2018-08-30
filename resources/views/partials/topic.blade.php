<div class="card article-card mt-4 mb-4">
      <div class="row">
            <div class="col-auto">
                  <img src="//placehold.it/200" class="img-fluid" alt="">
            </div>

            <div class="col">
                  <div class="card-block px-2">
                        <h4 class="card-title article-topic">
                        <a href="/{{$topic->id}}/show">
                              {{ $topic->title }}
                        </a>
                        </h4>

                        <p class="card-text article-description">
                              {{ $topic->description }}
                        </p>

                  </div>
            </div>
      </div>
</div>
