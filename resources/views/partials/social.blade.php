<social :attributes='{{$article}}' inline-template v-cloak>
      <div class="article-r-buttons">

                  <button @click="favourite()" v-bind:class="fclasses" type="submit">
                        <i class="far fa-heart mr-2"></i>
                  </button>

                  <button @click="like()" v-bind:class="lclasses" type="submit">
                        <i class="far fa-thumbs-up like mr-2"></i>
                  </button>

                  <button @click="dislike()" v-bind:class="dclasses" type="submit">
                        <i class="far fa-thumbs-down dislike"></i>
                  </button>


      </div>
</social>
