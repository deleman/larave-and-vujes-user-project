<template>
    <div class="m-auto col-sm-11 bg-dark py-3">

        <div class="m-auto col-md-6 col-sm-8">
            <form action="" method="post" v-on:submit.prevent="onSubmit">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" v-model="search" v-on:keyup="searchPost()" placeholder="search name or email of user..." aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">search</span>
                    </div>
                </div>
            </form>
        </div>

        <div class="card" v-for="name in users" v-bind:key="name.user_id">
            <div class="card-body">
                <li class="card-title d-inline mx-2" v-for="one in name" v-bind:key="one.user_id">{{one}}
                </li>

                    <!--start modal edit user  -->
                    <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary float-right" v-on:click="getInfoEditUser(name.user_id,name.name,name.email)"  data-toggle="modal" data-target="#exampleModaledit">
                        edit
                        </button>

                        <!-- Modal -->
                        <div class="modal fade"  id="exampleModaledit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabeledit" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header bg-danger">
                                <h5 class="modal-title" id="exampleModalLabeledit">Edit User?</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post" v-on:submit.prevent="onSubmit">
                                    <div class="form-group" id="editname">
                                        <label>Email address</label>
                                        <input type="text" class="form-control"  aria-describedby="emailHelp for name ser" v-bind:value="user_name_edit" placeholder="you name ...">
                                        <small id="emailHelp1" class="form-text text-muted">We'll never share your email with anyone else.</small>
                                    </div>
                                    <div class="form-group" id="editemail">
                                        <label>Email address</label>
                                        <input type="email" class="form-control" v-bind:value="user_email_edit" aria-describedby="emailHelp for email one" placeholder="your email ...">
                                        <small id="emailHelp2" class="form-text text-muted">We'll never share your email with anyone else.</small>
                                    </div>
                                    <div class="form-group" id="editpass">
                                        <label>Password</label>
                                        <input type="password" class="form-control" v-model="user_password_edit" placeholder="Password">
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal"  v-on:click="editUser(userIdDelete)">Save</button>
                            </div>
                            </div>
                        </div>
                        </div>
                    <!--end modal edit user  -->

                    <!--start modal delete user  -->
                    <!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger float-right" v-on:click="getIdDeleteUser(name.user_id)"  data-toggle="modal" data-target="#exampleModal">
                        delete
                        </button>

                        <!-- Modal -->
                        <div class="modal fade"  id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header bg-danger">
                                <h5 class="modal-title" id="exampleModalLabel">Delete User?</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Are You Sure Delete User <b>{{name.name}}</b></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal"  v-on:click="deleteUser(userIdDelete)">Delete</button>
                            </div>
                            </div>
                        </div>
                        </div>
                    <!--end modal delete user  -->
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
            userIdDelete:'',

            // for edits user
            user_id_edit:'',
            user_name_edit:'',
            user_email_edit:'',
            user_password_edit:'',
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
        },
        //delete user and update informations
        deleteUser:function(id){
            fetch(`/delete/${id}`)
            .then(ref=> {ref.json();
                if(ref.status == 200){
                    this.getInfo();
                    this.search ='';
                }
            })
        },
        //set user id for delete
        getIdDeleteUser:function(id){
            this.userIdDelete = id;
        },

        //method for searchpost
        searchPost:function(){

            let link = 'search/'+this.search;
            fetch(link)
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

        //edit user and update informations
        editUser:function(id){
            let bodyFormData = new FormData();
            bodyFormData.set('id', this.user_id_edit);
            bodyFormData.set('name', this.user_name_edit);
            bodyFormData.set('email', this.user_email_edit);
            bodyFormData.set('password', this.user_password_edit);
            let updateUrl= 'http://localhost:8000/update';
            alert(updateUrl);
            axios({
                method: 'post',
                url: updateUrl,
                data: bodyFormData,
                // `headers` are custom headers to be sent
                headers: {'X-Requested-With': 'XMLHttpRequest'},
                xsrfCookieName: 'XSRF-TOKEN', // default

                })
                .then(function (response) {
                    //handle success
                    alert(response.status);
                    console.log(response);
                })
                .catch(function (response) {
                    //handle error
                    alert(response);
                    console.log(response);
                });
        },
        getInfoEditUser:function(id,name,email){
            this.user_id_edit = id;
            this.user_name_edit = name;
            this.user_email_edit = email
            alert(id,name,email);
            alert(this.user_id_edit);
            alert(this.user_name_edit);
            alert(this.user_email_edit);
        }

    }
}


</script>
