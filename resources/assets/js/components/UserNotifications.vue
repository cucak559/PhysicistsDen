<template>
    <div v-if="notifications.length">

        <li class="nav-item dropdown">
            <a id="notificationsDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false" v-pre>
                <i class="fas fa-bell"></i>
            </a>

            <ul class="dropdown-menu notifications-menu" aria-labelledby="notificationsDropdown">
                <li v-for="notification in notifications" class="mb-2">
                    <a :href="notification.data.link" v-text="notification.data.message" @click="markAsRead(notification)"></a>
                </li>

            </ul>
        </li>
    </div>


</template>

<script>
    export default {
        data() {
            return {
                notifications: false
            }
        },
        created() {
            axios.get('/api/user/notifications')
                .then(response => this.notifications = response.data);
        },

        methods: {
            markAsRead(notification){
                axios.delete('/api/user/notifications/' + notification.id);
            }
        }
    }
</script>

<style scoped>

</style>