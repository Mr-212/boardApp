<template>

    <div class="row" >
        <div class="col-md-12">
            <!-- <div v-on:board-updated="eventListion"></div> -->
            <!-- <edit-board-modal/> -->
            <button class="btn btn-info float-right" @click="addBoardModal()">Add Board</button>
            
        </div>

        <div  v-for="board in boards" :key="board.id" class="col-md-3 mt-3">
            <div  class="card">
                <div class="card-header">
                {{board.title}}
              
                    
                <!-- <div class="col-md-6"> -->
                    <span class="fa fa-minus float-right" @click="removeBoardModal(board.id)"></span>
                    <span class="fa fa-pencil float-right" @click="showEditBoardModal(board.id,board.title)"></span>
                    
                <!-- </div> -->
                  
                </div>
                

                <div class="card-body">
                    <div class="row">
                        <card-component :board_id="board.id"></card-component>
                    </div>
                     
                </div>
               
            </div>
        </div>
    </div>
       
</template>

<script>
    import EditBoardModal from './modals/EditBoardModalComponent.vue';
    import RemoveBoardModal from './modals/RemoveBoardModalComponent.vue';
    import AddBoardModal from './modals/AddBoardModalComponent.vue';
    import CardComponent from './CardComponent.vue';


    Vue.use(VModal);
    
    export default {

        created() {
            // this.$vueEventBus.$on('board-updated', this.getBoards());
             this.$root.$on('board-updated', function(){
                // try{
                //             console.log('Component mounted.')
                //             const response = await axios.get(base_url+'/board');
                //             if(response.data.STATUS_CODE =='OK'){
                //                 this.boards = response.data.data;

                //             }
                //     }
                //     catch(error){
                //         console.log(error);
                //     }
                //   self.eventListion();
                  this.getBoards();
             });
        },
        beforeDestroy() {
            this.$root.$off('board-updated')
        },
     components: { 
        //  EditBoardModal
        CardComponent,
     },
        
       
    mounted(){
        this.getBoards();
    },

        data(){
            return {
                boards: null,
            }
        },
        computed:{

        },
        // events:{
        //     boardUpdated: this.getBoards(),
        // },

        
        methods: {
             showEditBoardModal(id,title){
                this.$modal.show(EditBoardModal, {
                    id: id,
                    title:title,
                },
              
                {
                height: 'auto'
                }
            )
            },

            removeBoardModal(id){
                this.$modal.show(RemoveBoardModal, 
                    {
                        id: id,
                    },
                
                    {
                    height: 'auto'
                    }
                )
    
            },

            addBoardModal(){
                this.$modal.show(AddBoardModal, 
                    {
                        height: 'auto'
                    }
                )
    
            },

            async getBoards(){
                    try{
                            console.log('Component mounted.')
                            const response = await axios.get(base_url+'/board');
                            if(response.data.STATUS_CODE =='OK'){
                                this.boards = response.data.data;

                            }
                        }
                        catch(error){
                            console.log(error);
                        }
            },


            eventListion(){
                console.log('in event');
                this.getBoards();
            }

        },
    }
</script>
