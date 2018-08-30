<template>
      <div id="flash" class="row alert" v-bind:class="{ 'alert-success': isSuccess, 'alert-danger': isError }" role="alert" v-show="show">
            <div class="col-sm-">
                  {{ body }}
                  <i @click="close" id="flash-close" class="ml-3 fas fa-times text-right"></i>
            </div>
      </div>
</template>

<script>
      export default {
            props: ['message','error'],

            data() {
                  return {
                        body: '',
                        show: false,
                        isSuccess: false,
                        isError: false
                  }
            },

            created(){

                  if (this.error) {
                        this.flash(this.error,true);
                  }

                   if (this.message) {
                        this.flash(this.message,false);
                  }

                  window.events.$on('flash', (message,error) => {
                        this.flash(message,error);
                  });

            },

            methods: {
                  close(event){
                        this.show = false;
                  },

                  hide(){
                        setTimeout(() => {
                              this.show = false;
                        },3000);
                  },

                  flash(message,error = false){
                        if (error) {
                              this.isError = true;
                              this.isSuccess = false;
                        }else{
                              this.isError = false;
                              this.isSuccess = true;
                        }

                        this.body = message;
                        this.show = true;
                        this.hide();
                  },

            }
      }
</script>

<style>
      .alert-flash{
         position:fixed;
         right: 40px;
         bottom: 30px;
      }

</style>
