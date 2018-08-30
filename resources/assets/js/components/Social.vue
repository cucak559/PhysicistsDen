<script>
      export default {
            props : ['attributes'],

            data() {
                  return {
                        editing : false,
                        body : this.attributes.body,
                        isLiked: this.attributes.isLiked,
                        isDisliked: this.attributes.isDisliked,
                        isFavourited: this.attributes.isFavourited
                  }
            },

            computed: {
                  fclasses(){
                        return ['icon-button',this.isFavourited ? 'active-button' : ''];
                  },
                  lclasses(){
                        return ['icon-button',this.isLiked ? 'active-button' : ''];
                  },
                  dclasses(){
                        return ['icon-button',this.isDisliked ? 'active-button' : ''];
                  },
            },

            methods: {
                  favourite(){
                        if (this.isFavourited) {
                              axios.delete('/favourites/' + this.attributes.id);
                              flash('Article has been already removed from favourites');
                        }else{
                              axios.post('/favourites/' + this.attributes.id);
                              flash('Article has been added to favourites');
                        }

                  this.isFavourited = !this.isFavourited;

                  },

                  like(){
                        if (this.isLiked) {
                              flash('Article has been already liked',true);


                        }else{
                              axios.post('/'+ this.attributes.id + '/like');
                              this.isLiked = true;
                              this.isDisliked = false;
                              flash('Article has been liked');
                        }

                  },

                  dislike(){
                        if (this.isDisliked) {
                              flash('Article has been already disliked',true);

                        }else{
                              axios.post('/'+ this.attributes.id + '/dislike');
                              this.isDisliked = true;
                              this.isLiked = false;
                              flash('Article has been disliked');
                        }
                  }

            }
      }
</script>

<style>

</style>
