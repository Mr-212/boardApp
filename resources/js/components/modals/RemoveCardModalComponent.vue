<template>
   
    <div class="col-md-12 remove-card">
        <h6 class="header mt-2">Are you sure you want to delete this card?</h6>
        <label v-if="message">{{message}}</label>
        <!-- <input v-model="board.title" type="text" class="form-control"> -->
        <button class="btn btn-danger float-right m-2" @click="update()">Delete</button>
        <!-- <button class="btn btn-primary float-right m-2" @click="hide()">Close</button> -->
        

    </div>
       
    <!-- </modal> -->
  
</template>

<script>
    export default {
        name: 'RemoveCardModal',
        props: [
            'id',
        ],
        mounted() {
             console.log('Component mounted remove Card')
            // this.init();
            //  console.log(this.board,this.id);
        },
        data(){
            return {
                
                id: this.id,
                message:'',
            }
        },
      

        methods:{
            // show () {
            //     this.$modal.show('edit-board');
            // },
            hide () {
                // this.$modal.hide();
            },


            async update(){
                try{
                    const response = await axios.delete(base_url+'/card/'+this.id,);
                    if(response.data.STATUS_CODE == 'OK'){
                        this.message = response.data.message;
                        this.$emit('card-updated');
                    }

                }catch(error){
                    console.log(error);
                }
            }
        },

       
    }
</script>
