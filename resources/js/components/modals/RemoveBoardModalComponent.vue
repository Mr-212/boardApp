<template>
   
    <!-- <modal name="edit-board"
         :width="300"
         :height="150"
    > -->
         
        
    <!-- <div slot="top-right">
        <button @click="hide()">
                ❌
        </button>
    </div> -->
    <div class="col-md-12 edit-board">
        <h6 class="header mt-2">Are you sure you want to delete this board?</h6>
        <label v-if="message">{{message}}</label>
        <!-- <input v-model="board.title" type="text" class="form-control"> -->
        <button class="btn btn-danger float-right m-2" @click="update()">Delete</button>
        <!-- <button class="btn btn-primary float-right m-2" @click="hide()">Close</button> -->
        

    </div>
       
    <!-- </modal> -->
  
</template>

<script>
    export default {
        name: 'RemoveBoardModal',
        props: [
            'id',
        ],
        mounted() {
             console.log('Component mounted removeBoard')
            // this.init();
            //  console.log(this.board,this.id);
        },
        data(){
            return {
                
                id: this.id,
                message:'',
            }
        },
        //  computed:{
        //         this.form.id = this.id,
        //         this.form.title = this.title,
        // },

        methods:{
            // show () {
            //     this.$modal.show('edit-board');
            // },
            hide () {
                this.$modal.hide();
            },

            // init() { 
            //     this.board.id = this.id;
            //     this.board.title = this.title;
            // },

            async update(){
                try{
                    console.log(this.board);
                    const response = await axios.delete(base_url+'/board/'+this.id,);
                    if(response.data.STATUS_CODE == 'OK'){
                        this.message = response.data.message;
                        this.$root.$emit('board-updated');
                        
                    }
                    
                    //console.log(response.data);
                   


                }catch(error){
                    console.log(error);
                }
            }
        },

       
    }
</script>
