<template>
    <div>
        <h2>Create New User</h2>
        <form @submit.prevent="addUser" class="mb-3">
            <p class="alert alert-danger"  v-if="errors.length">

                <ul>
                    <li v-for="error in errors">
                        {{ error }}
                    </li>
                </ul>
            </p>
             <vue-upload-component
             name="files" @input="updatetValue" >                
              <i class="btn btn-info">Upload Profile</i>
              </vue-upload-component>
            <div class="row">
                <div class="form-group col-md-6">
                   
                    <input type="text" class="form-control form-control-sm" placeholder="Profile Picture" v-model="user.profile_picture">
                </div>                
                <div class="form-group col-md-6">
                    <input type="text" class="form-control form-control-sm" placeholder="Name" v-model="user.name">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <input type="text" class="form-control form-control-sm" placeholder="Phone" v-model="user.phone">
                </div>            
                <div class="form-group col-md-6">
                    <select class="form-control form-control-sm" v-model="user.gender">
                        <option value="">Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <input type="text" class="form-control form-control-sm" placeholder="Email" v-model="user.email">
                </div>            
                <div class="form-group col-md-6">
                    <label>Date of Birth</label>
                    <date-picker v-model="user.date_of_birth" format="yyyy-MM-dd hh:mm:ss" type="datetime" lang="en"></date-picker>
                    <input type="hidden" class="form-control form-control-sm" placeholder="date_of_birth" v-model="user.date_of_birth">
                </div>   
            </div>       
            <div class="row">  
                <div class="form-group col-md-12">
                    <textarea type="text" class="form-control form-control-sm" placeholder="Biography" v-model="user.biography"></textarea>                    
                </div>
            </div>       
            <button type="submit" class="btn btn-success btn-block">Save</button>                 
        </form>
        <h2>Users</h2>
        <div class="row">
            <div class="col-md-4" v-for="user in users" v-bind:key="user.id">
            <div class="card card-body" >
                <h3>{{ user.name }}</h3>
                <!--<p>{{ user.profile_picture }}</p>-->
                <p><strong>Phone</strong> {{ user.phone }}</p>
                <p><strong>Gender</strong> {{ user.gender }}</p>
                <p><strong>Email</strong> {{ user.email }}</p>
                <p><strong>Date of Birth</strong> {{ user.date_of_birth }}</p>
                <p><strong>Biography</strong> {{ user.biography }}</p>
                <button @click="editUser(user)" class="btn btn-warning">Edit</button>
                <button @click="deleteUser(user.id)" class="btn btn-danger">Delete</button>
            </div>
            </div>
        </div>
    </div>
</template>

<script>
import DatePicker from 'vue2-datepicker'
import VueUploadComponent from 'vue-upload-component'
export default {
    components: { DatePicker, VueUploadComponent},
    data(){
        return{
            users : [],
            user: {
                id: '',
                name: '',
                phone: '',
                gender: '',
                email: '',
                date_of_birth: '',
                biography: '',
                profile_picture: ''
            },
            user_id: '',
            edit: false,
            errors : []
        }
    },
    created() {
        this.fetchUsers();
    },
    methods: {
        fetchUsers(){
            fetch('api/user')
            .then(res => res.json())
            .then(res => {
                this.users = res;
            })
        },
        addUser(){
            this.checkForm();
            if(this.errors.length){
                this.erros = [];
            } else{
                if(this.edit == false){
                    fetch('api/user',{
                        method: 'post',
                        body: JSON.stringify(this.user),
                        headers: {
                            'content-type' : 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        this.user.name = '';
                        this.user.phone = '';
                        this.user.gender = '';
                        this.user.email = '';
                        this.user.date_of_birth = '';
                        this.user.biography = '';
                        this.user.profile_picture = '';
                        alert("User Added");
                        this.fetchUsers();
                    })
                    .catch(err => console.log(err));
                } else {
                    var id = this.user.id;
                    fetch(`api/user/${id}`,{
                        method: 'put',
                        body: JSON.stringify(this.user),
                        headers: {
                            'content-type' : 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        this.user.name = '';
                        this.user.phone = '';
                        this.user.gender = '';
                        this.user.email = '';
                        this.user.date_of_birth = '';
                        this.user.biography = '';
                        this.user.profile_picture = '';
                        alert("User Updated");
                        this.fetchUsers();
                        this.edit = false;
                    })
                    .catch(err => console.log(err));                
                }
            }
        },
        editUser(user){
            this.edit = true;
            this.user.id = user.id;
            this.user.name = user.name;
            this.user.phone = user.phone;
            this.user.gender = user.gender;
            this.user.email = user.email;
            this.user.date_of_birth = user.date_of_birth;
            this.user.biography = user.biography;
            this.user.profile_picture = user.profile_picture;
        },
        deleteUser(id){
            if(confirm('Are you sure ?')){
                fetch(`api/user/${id}`,{
                    method: 'delete',

                })
                .then(res => res.json())
                .then(data => {
                    alert('user Removed!');
                    this.fetchUsers();
                })
                .catch(err => console.log(err));     
            }
        },
        checkForm() {
            this.errors = [];
            if(this.user.name == '') this.errors.push("Name field is required!");
            if(this.user.phone == '') this.errors.push("Phone phone is required!");
            
            if(this.user.gender == '') this.errors.push("Gender field is required!");
            if(this.user.email == '') this.errors.push("Email field is required!");
            if(!this.validEmail(this.user.email)) this.errors.push("Enter valid email address");
            if(this.user.date_of_birth == '') this.errors.push("Date of birth field is required!");
            if(this.user.biography == '') this.errors.push("biography field is required!");
        },
        validEmail(email) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
        },
        updatetValue(value) {
            this.user.profile_picture = value[0].name;
        }

    }
}

</script>

