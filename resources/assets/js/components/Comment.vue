<template>
    <div class="card comment-card mt-4 mb-4">
        <div class="row">

            <div class="col-auto">
                <img class="comment-img img-fluid"
                     src="//placehold.it/200"
                     alt="Profile Pic" height="100" width="100">
            </div>

            <div class="col">
                <div class="card-block px-2">
                    <div class="card-title comment-meta">
                        <div class="row">
                            <div class="col-sm-6">
                                <span class="comment-username" v-text="data.user.name"></span>
                                <span class="comment-date" v-text="ago"></span>

                            </div>

                            <div class="col-sm-6 text-right" v-if="isOwner">

                                <button @click="editing = !editing" class="icon-button" type="button"><i
                                        class="far fa-edit mr-2"></i></button>

                                <button @click="remove()" class="icon-button" type="submit"><i
                                        class="fas fa-trash mr-2"></i></button>

                            </div>
                        </div>
                    </div>

                    <div class="card-text comment-body">
                        <div v-if="editing" class="mt-3">

                            <form @submit.prevent="update">
                                <div class="row">
                                    <div class="col-sm-9">
                                        <textarea name="body" v-model="body" required></textarea>
                                    </div>

                                    <div class="col-sm-3 text-right">
                                        <button class="btn btn-outline-success" type="submit">Update
                                        </button>
                                    </div>

                                </div>


                            </form>


                        </div>

                    </div>

                    <div v-if="!editing" v-html="body"></div>

                </div>


            </div>
        </div>
    </div>
</template>


<script>
    import moment from 'moment';

    export default {
        props: ['data'],

        data() {
            return {
                editing: false,
                body: this.data.body
            }
        },

        computed: {
            isOwner() {
                return this.authorize(user => this.data.user_id == user.id);
            },
            ago() {
                return moment(this.data.created_at).fromNow();
            }
        },

        methods: {
            update() {
                axios.patch('/comments/' + this.data.id + '/update', {
                        body: this.body
                    })
                    .then(({data}) => {
                        flash('Comment has been updated');
                    })
                    .catch(error => {
                        flash(error.response.data.message,true);
                    });

                this.editing = false;

            },

            remove() {
                axios.delete('/comments/' + this.data.id + '/delete');

                this.$emit('deleted', this.data.id);

                flash('Comment has been removed');

            },
        }

    }
</script>

<style>

</style>
