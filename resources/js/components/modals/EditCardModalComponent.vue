<template>
   
    <div class="col-md-12 edit-card">
        <h3 class="header">Edit Card</h3>
        <label v-if="message">{{message}}</label>
        <input v-model="board.title" type="text" class="form-control">
        <button class="btn btn-info float-right m-2" @click="update()">update</button>
        <!-- <button class="btn btn-primary float-right m-2" @click="hide()">Close</button> -->
        

    </div>
       
    <!-- </modal> -->
  
</template>

<script>
    export default {
        name: 'EditBoardModal',
        props: [
            'id',
            'title'
        ],
        mounted() {
             console.log('Component mounted222')
            // this.init();
            //  console.log(this.board,this.id);
        },
        data(){
            return {
                board:{
                    id: this.id,
                    title: this.title,
                },
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
                    const response = await axios.put(base_url+'/board/'+this.board.id,this.board);
                    if(response.data.STATUS_CODE == 'OK'){
                        this.message = response.data.message;
                        
                    }
                    
                    this.$root.$emit('board-updated');
                    //console.log(response.data);
                   


                }catch(error){
                    console.log(error);
                }
            },
            async update(id){
                try{
                    console.log(id);
                    const response = await axios.put(base_url+'/card/'+id,this.card);
                    if(response.data.STATUS_CODE == 'OK'){
                        this.message = response.data.message;
                        
                    }
                    
                    this.$root.$emit('card-updated');
                    //console.log(response.data);
                   


                }catch(error){
                    console.log(error);
                }
            }
        },

       
    }
</script>
