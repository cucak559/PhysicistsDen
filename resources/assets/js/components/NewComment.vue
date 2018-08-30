<template>
    <div>
        <div class="row form-row">
            <div class="col-md-10">
                <div class="form-group">
                    <textarea name='body'
                           id="body"
                           type="text"
                           class="form-control comment-input"
                           placeholder="React on this article..."
                              v-model="body" required></textarea>
                </div>
            </div>

            <div class="col-md-2 text-right">
                <button @click="addComment()" type="submit" class="btn btn-outline-success ml-4">Add Comment</button>
            </div>

        </div>

    </div>


</template>


<script>

    export default {
        data() {
            return {
                body: ''
            }
        },

        methods: {
            addComment() {
                axios.post(location.pathname + '/comments', {body: this.body})
                    .then(({data}) => {
                        this.body = '';

                        flash('Comment has been posted');

                        this.$emit('created', data);
                    })
                    .catch(error => {
                        flash(error.response.data,true);
                    });
            }

        },

        mounted(){
            $('#body').atwho({
                at: "@",
                delay: 750,
                callbacks: {
                    remoteFilter: function(query,callback){
                        console.log('sss');
                        $.getJSON("/api/users",{name : query},function(usernames){
                            callback(usernames)
                        })
                    }
                }
            });
        }
    }
</script>

<style>

</style>
