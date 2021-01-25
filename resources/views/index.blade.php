<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Quiz 2</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>

</head>
<body>
    <div id="app">
        <input type="text" name="addName" id="addName" placeholder="Masukkan Nama" v-model="addName"> <button @click="tambah_item">@{{ namaTombol }}</button>
        <ul v-for="(user, index) in users">
            <li>@{{ user.name }} - @{{ user.email }} <button @click="ubah_data(index, user)">Edit</button> || <button @click="hapus_item(index, user)">Delete</button></li>
        </ul>
    </div>  
    
    <script src="{{ asset('/js/vue.js') }}"></script>
    <script src="{{ asset('/js/vue-resource@1.5.1') }}"></script>
    <script>
        let vm = new Vue({
            el : '#app',
            data : {
                namaTombol : 'Add',
                addName    : '',
                aindex     : '',
                users      : [],
                aid        : '',
            },

            methods : {
                tambah_item : function(){
                    if(this.namaTombol=="Add"){
                        if(this.addName.trim()==false){
                           confirm("Nama Jangan Kosong");
                        }
                        else{
                            this.$http.post('/api/user/store', {name:this.addName, email : this.addName.replaceAll(" ","_") + "@gmail.com", password : "12345"} ).then(response => {
                                this.users.unshift(
                                    {name : this.addName, email : this.addName.replaceAll(" ","_") + "@gmail.com"}
                                );
                                this.addName = '';
                            });
                        }                       
                    }
                    else{
                        this.$http.post('/api/user/update/'+this.aid, {name:this.addName, email : this.addName.replaceAll(" ","_") + "@gmail.com", password : "12345"} ).then(response => {
                            this.users[this.aindex].name  = this.addName;
                            this.namaTombol = 'Add';
                            this.addName = ''; 
                        });
                    };
                }, 

                hapus_item : function(index, user){
                    if(confirm('Anda Yakin Hapus Data ?')){
                        this.$http.delete('/api/user/delete/'+user.id).then(response => {
                            this.users.splice(index,1);
                        });
                    };
                }, 

                ubah_data : function(index, user){
                    this.namaTombol = 'Update';
                    this.addName    = this.users[index].name;
                    this.aindex     = index;
                    this.aid        = user.id;
                    console.log(this.aid);
                }
            }, 

            mounted : function(){
                this.$http.get('/api/user/list').then(response => {
                    // console.log(response.body.data);
                    let result = response.body.data;
                    this.users = result;
                })
            }
        })
    </script>
</body>
</html>