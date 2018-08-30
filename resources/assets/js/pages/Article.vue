<script>
      import Comments from '../components/Comments.vue'

      export default{
            props : ['data'],

            components: {Comments},

            data() {
                  return {
                        comment: this.comment
                  }
            }
      }
</script>
