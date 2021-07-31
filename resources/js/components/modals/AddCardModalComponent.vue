<template>
   

    <div class="col-md-12 add-card">
        <form>
        <h3 v-if="this.board_id && card.board_id" class="header mt-3">Add Card</h3>
        <h3 v-if="card.id" class="header mt-3">Update Card</h3>

        <label v-if="message">{{message}}</label>
        <div class="form-group">
            <label>Title</label>
            <input v-model="card.title" type="text" class="form-control"  required>
        </div>

        <div class="form-group">
            <label>Description</label>
            <input v-model="card.description" type="text" class="form-control" required>

        </div>
       

        <button v-if="this.board_id && card.board_id" class="btn btn-info float-right m-2" @click.prevent="add()">Add</button>
        <button v-if="card.id" class="btn btn-info float-right m-2" @click.prevent="update(card.id)">Update</button>

        </form>
        <!-- <button class="btn btn-primary float-right m-2" @click="hide()">Close</button> -->
        

    </div>
       
    <!-- </modal> -->
  
</template>

<script>
    export default {
        name: 'AddCardModal',
        props:['board_id','get_card'],

        mounted() {
             console.log('Crad add MODAL Component')
        },
        data(){
            return {
                card:{
                    id:this.get_card?this.get_card.id:null,
                    board_id: this.board_id??(this.get_card?this.get_card.board_id:null),
                    title: this.get_card?this.get_card.title:null,
                    description:this.get_card?this.get_card.description:null,
                },
                message:'',
            }
        },

        methods:{

            hide () {
                // this.$modal.hide();
            },

            async add(){
                try{
                    console.log(this.card);
                    const response = await axios.post(base_url+'/board/'+this.board_id+'/card',this.card);
                    if(response.data.STATUS_CODE == 'OK'){
                        this.message = response.data.message;
                        // this.$root.$emit('card-updated');
                        
                    }
                    if(response.data.STATUS_CODE == "VALIDATION_ERROR"){
                        this.message = response.data.ERROR.title[0];
                    }

                }catch(error){
                    console.log(error);
                }
            },

            async update(id){
                try{
                    console.log(this.card);
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
