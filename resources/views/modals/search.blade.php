

<div class="modal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-full" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close search-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" id="result">
                  <div class="container">

                        <div class="row parent text-center">
                              <div class="col-md-12">
                                    <p class="search-caption">SEARCH ANYTHING AND HIT ENTER</p>

                                       <form class="form-inline comment-add justify-content-center" action="/articles/search" method="GET">
                                                <div class="row form-row">
                                                      {{csrf_field()}}
                                                      <div class="col-md-12">
                                                           <div class="input-group col-md-12">
                                                                  <input class="form-control" name="search" type="search" placeholder="What are you looking for?">
                                                                  <span class="input-group-append">
                                                                    <button class="btn btn-outline-secondary" type="submit">
                                                                        <i class="fa fa-search"></i>
                                                                    </button>
                                                                  </span>
                                                            </div>

                                                      </div>

                                                     {{--  <div class="col-md-2 text-right">
                                                             <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                                                      </div> --}}

                                                 </div>

                                          </form>

                              </div>
                          </div>
                    </div>
            </div>

        </div>
    </div>
</div>
