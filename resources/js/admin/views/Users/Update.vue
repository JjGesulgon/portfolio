<template>
    <div class="main_content">
        <div class="info">
            <div class="mr-auto mt-5 lettering">
                Users
            </div>
            <div>
                <div class="d-flex flex-row-reverse">
                    <button type="button"  class="btn btn-secondary" @click.prevent.default="viewUsers">Back</button>
                </div>
                <div class="card">
                    <div class="card-header">
                        Edit User
                    </div>
                    <div class="card-body">
                        <div v-if="ifReady">
                            <form v-on:submit.prevent="editAdmin">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" v-model="name" autocomplete="off" minlength="2" maxlength="255" required>
                                </div>
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input type="email" class="form-control" v-model="email" disabled>
                                </div>
                                <div v-if="errors != []">
                                    <div class="alert alert-danger" v-for="error in errors">
                                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                                        <strong>Error!</strong> {{ error[0] }}
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary btn-sm" @click.prevent.default="updateUser">Update User</button>
                            </form>
                        </div>
                        <div v-else>
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                ifReady: false,
                id: '',
                name: '',
                email: '',
                errors: []
            };
        },

        mounted() {
            let promise = new Promise((resolve, reject) => {
                axios.get('/api/users/' + this.$route.params.id).then(res => {
                    console.log()
                    this.id    = res.data.user.id;
                    this.name  = res.data.user.name;
                    this.email = res.data.user.email;
                    resolve();
                });
            });

            promise.then(() => {
                this.ifReady = true;
            });
        },

        methods: {
            viewUser() {
                this.$router.push({
                    name: 'user.index'
                });
            },
            updateUser() {
                this.ifReady = false;
                this.errors = [];
                let formData = new FormData();
                formData.append('_method','PATCH');
                formData.append('name', this.name);
                // formData.append('email', this.email);

                axios.post('/api/users/' + this.$route.params.id, formData).then(res => {
                    this.$router.push({
                        name: 'users.index'
                    });
                    }).catch(err => {
                        this.errors = err.response.data.errors;
                        this.ifReady = true;
                        console.log(err);
                    });
            }
        }
    }
</script>
<style scoped>
    .display-flex{
         display: flex;
    }

    .navi-item{
        margin-right: 210px !important;
    }

    .lettering{
        font-size: 45px;
    }
    .header{
        padding-top: 5px !important;
        padding-bottom: 5px !important;
        padding-left: 20px !important;
        padding-right: 20px !important;
        background: #fff;
        color: #717171;
        border-bottom: 1px solid #e0e4e8;
    }

    .info{
        margin: 20px;
        color: #717171;
        line-height: 25px;
    }

    .main_content{
        width: auto;
    }

    .main_content .header{
        padding: 20px;
        background: #fff;
        color: #717171;
        border-bottom: 1px solid #e0e4e8;
    }

    .main_content .info{
        margin-left: 40px;
        margin-right: 40px;
        margin-top: 20px;
        color: #717171;
        line-height: 25px;
    }

    .main_content .info div{
        margin-bottom: 20px;
    }

</style>