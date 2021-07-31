<template>
   

    <div class="col-md-12 edit-board">
        <h3 class="header mt-3">Add Board</h3>
        <label v-if="message">{{message}}</label>
        <input v-model="board.title" type="text" class="form-control" required>
        <button class="btn btn-info float-right m-2" @click="add()">Add</button>
        <!-- <button class="btn btn-primary float-right m-2" @click="hide()">Close</button> -->
        

    </div>
       
    <!-- </modal> -->
  
</template>

<script>
    export default {
        name: 'AddBoardModal',
        mounted() {
             console.log('Component mounted222')
        },
        data(){
            return {
                board:{
                    title: this.title,
                },
                message:'',
            }
        },

        methods:{

            hide () {
                this.$modal.hide();
            },

            async add(){
                try{
                    console.log(this.board);
                    const response = await axios.post(base_url+'/board',this.board);
                    if(response.data.STATUS_CODE == 'OK'){
                        this.message = response.data.message;
                        this.$emit('board-updated');
                        
                    }
                    if(response.data.STATUS_CODE == "VALIDATION_ERROR"){
                        this.message = response.data.ERROR.title[0];
                    }
                    
                    //console.log(response.data);
                   


                }catch(error){
                    console.log(error);
                }
            }
        },

       
    }
</script>
