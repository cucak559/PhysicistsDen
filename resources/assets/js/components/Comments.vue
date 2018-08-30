<template>
      <div>
            <div v-if="count === 0 " class="row">
                  <div class="col-md-12">
                        <div class="alert-danger">
                              No Comments... please add some.
                        </div>
                  </div>
            </div>

            <div :key="comment.id" v-for="(comment,index) in items">
                  <comment :data="comment" @deleted="remove(index)"></comment>
            </div>

           <new-comment @created="add"></new-comment>

           <paginator :dataSet="dataSet" @updated="fetch"></paginator>
      </div>
</template>

<script>
      import Comment from './Comment.vue';
      import NewComment from './NewComment.vue';

      import collection from '../mixins/collection';

      export default {

            compontents: {Comment,NewComment},

            mixins: [collection],

            data() {
                  return {
                        dataSet: false,
                        items : []
                  }
            },

            created(){
                  this.fetch();
            },

            methods: {
                  fetch(page){
                        axios.get(this.url(page))
                              .then(this.refresh);

                        //window.scrollTo(0,0);
                  },

                  url(page){
                        if (! page){
                              let query = location.search.match(/page=(\d+)/);

                              page = query ? query[1] : 1;
                        }

                        return location.pathname + '/comments?page=' + page;
                  },

                  refresh({data}){
                        this.dataSet = data;
                        this.items = data.data;
                  }
            },

            computed: {
                count: function () {
                  return this.items.length;
                }
            }

      }
</script>

<style>

</style>
