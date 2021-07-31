<template>

    <div class="row" >
        <div class="col-md-12">
            <span class="float-right" @click="addCard()"><i class="fa fa-plus"></i></span>
        </div>

        <div class="col-md-12">
            <div  v-for="card in cards" :key="card.id" class="col-md-12 mt-3">
            <div  class="card">
                <div class="card-header">
                {{card.title}}
              
                    
                <!-- <div class="col-md-6"> -->
                    <span class="fa fa-minus float-right" @click="removeCard(card.id)"></span>
                    <span class="fa fa-pencil float-right" @click="editCard(card)"></span>
                    
                <!-- </div> -->
                  
                </div>
                

                <div class="card-body">
                     {{card.description}}
                </div>
               
            </div>
        </div>
           

        </div>

    </div>
       
</template>

<script>
 
    import AddCardModal from './modals/AddCardModalComponent.vue';
    import EditBoardModal from './modals/EditBoardModalComponent.vue';
    import RemoveCardModal from './modals/RemoveCardModalComponent.vue';
    Vue.use(VModal);
    
    export default {
        props:['board_id'],

        mounted() {
            // console.log(this.board_id,this.card.board_id);
            this.getCards();
        
        },
        beforeDestroy() {
            // this.$root.$off('card-updated')
        },
        components: { 
        },
        
       

        data(){
            return {
                cards:{
                } 
            }
        },
      

        
        methods: {
            //  showEditCardModal(id,title){
            //     this.$modal.show(EditBoardModal, {
            //         id: id,
            //         title:title,
            //     },
              
            //     {
            //     height: 'auto'
            //     }
            // )
            // },

            // removeCardModal(id){
            //     this.$modal.show(RemoveBoardModal, 
            //         {
            //             id: id,
            //         },
                
            //         {
            //         height: 'auto'
            //         }
            //     )
    
            // },

            addCard(){
                this.$modal.show(AddCardModal, 
                    {
                        board_id:this.board_id
                    },

                    {
                    'card-updated':this.getCards(),
                    },

                    {
                        height: 'auto'
                    }
                )
    
            },
            removeCard(id){
                this.$modal.show(RemoveCardModal, 
                    {
                        id: id,
                    },

                    {
                    'card-updated':this.getCards(),
                    },
                
                    {
                    height: 'auto'
                    }
                )

            },
             editCard(card){
                this.$modal.show(AddCardModal, {
                    get_card:card,
                    },
                    {
                    'card-updated':this.getCards(),
                    },
              
                    {
                    height: 'auto'
                    }
                )
            },

            async getCards(){
                    try{
                            // console.log('Card Component get.')
                            const response = await axios.get(base_url+'/board/'+this.board_id+'/card');
                            if(response.data.STATUS_CODE =='OK'){
                                this.cards = response.data.data;

                            }
                        }
                        catch(error){
                            console.log(error);
                        }
            },

        },
    }
</script>
