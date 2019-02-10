<template>
    <div class="m-auto col-sm-11 bg-dark py-3">

        <div class="m-auto col-6">
            <form action="" method="post" v-on:submit.prevent="onSubmit">
                <div class="input-group mb-3">
                    <!-- v-on:keyup="searchPost" -->
                    <input type="text" class="form-control" v-model="search"  aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">Default</span>
                    </div>
                </div>
            </form>
        </div>

        <div class="card" v-for="name in users" v-bind:key="name.user_id">
            <div class="card-body">
                <li class="card-title d-inline mx-2" v-for="one in name" v-bind:key="one.user_id">{{one}}
                </li>
                    <button class="float-right btn btn-danger" v-on:key>delete </button>
            </div>
        </div>

        <div class="w-100">
            <div class="m-auto d-flex justify-content-center">
                <div class="mt-3">
                    <nav aria-label="Page navigation example m-atuo bg-info">
                        <ul class="pagination">
                            <li class="page-item" v-bind:class="{ 'disabled': isDisabled(prev_page) }" ><a class="page-link" v-bind:class="{ 'bg-secondary text-light': isDisabled(prev_page) }"  v-on:click="getInfo(prev_page)" href="#">Previous</a></li>
                            <li class="page-item disabled"><a class="page-link " href="#">page {{ current_page}} from {{last_page}}</a></li>
                            <li class="page-item"  v-bind:class="{ disabled: isDisabled(next_page) }"><a class="page-link" v-bind:class="{ 'bg-secondary text-light': isDisabled(next_page) }"  v-on:click="getInfo(next_page)" href="#">Next</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</template>


<script>

export default {
    data(){
        return {
            users:{},
            current_page:'',
            last_page:'',
            next_page:'',
            prev_page:'',
            search:'',
        }
    },
    beforeMount(){
        this.getInfo();
    },
    methods:{
        getInfo:function($link=''){
            if(($link)==''){
                $link = '/vuejs';
            }else{
                $link= $link;
            }
            fetch($link)
            .then(ref=> ref.json())
            .then(ref=>{
                this.users = ref.data;
                this.current_page =ref.current_page;
                this.last_page= ref.last_page;
                this.next_page= ref.next_page_url;
                this.prev_page= ref.prev_page_url;
            }).catch(err => {
                console.log(err);
            })
        },
        isDisabled(text){
            if(text==null){
                return true;
            }else{
                return false;
            }
        }
    }
}


</script>
