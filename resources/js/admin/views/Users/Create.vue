<template>
    <div class="main_content">
        <div class="info">
            <div class="mr-auto mt-5 lettering">
                Users
            </div>
            <div>
                <div class="d-flex flex-row-reverse">
                    <label class="text-secondary clickableText header-margin" @click.prevent.default="viewUsers">
                        <i class="fas fa-long-arrow-alt-left"></i>&nbsp;
                        <strong>Back</strong>
                    </label>
                </div>
                <div class="card">
                    <div class="card-header">
                        <router-link to="/users">Users</router-link>&nbsp;>> Add User
                    </div>
                    <div class="card-body header-margin">
                        <div v-if="ifReady">
                            <form v-on:submit.prevent="createNewAdmin">
                                <div class="form-group">
                                    <label><strong>Name</strong></label>
                                    <input id="name" type="text" class="form-control" v-model="name" autocomplete="off" minlength="2" maxlength="255" required>
                                </div>
                                <div class="form-group">
                                    <label><strong>Email Address</strong></label>
                                    <input type="email" class="form-control" v-model="email" autocomplete="off" minlength="2" maxlength="255" required>
                                </div>
                                <div class="form-group">
                                    <label><strong>Password</strong></label>
                                    <input type="password" class="form-control" v-model="password" autocomplete="off" minlength="6" maxlength="255" required>
                                </div>
                                <div class="form-group">
                                    <label><strong>Password Confirmation</strong></label>
                                    <input type="password" class="form-control" v-model="password_confirmation" autocomplete="off" minlength="6" maxlength="255" required>
                                </div>
                                <div v-if="errors != []">
                                    <div class="alert alert-danger" v-for="error in errors">
                                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                                        <strong>Error!</strong> {{ error[0] }}
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-secondary btn-sm">Add User</button>
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
                ifReady: true,
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
                errors: []
            };
        },

        mounted() {

        },

        methods: {
            createNewAdmin() {
                this.ifReady = false;
                this.errors = [];

                axios.post('/api/users', this.$data).then(res => {
                    this.toast('Success','User added', 'Successfully submitted the request', 'secondary')
                    this.$router.push({ name: 'users.index' });
                }).catch(err => {
                    this.errors = err.response.data.errors
                    this.ifReady = true;
                    console.log(err.response);
                    this.toast('Error','Failed to submit', 'Unable to process request!', 'danger')
                });
            },

            viewUsers() {
                this.$router.push({
                    name: 'users.index'
                });
            },

            toast(title, subtitle, body, variant) {
                // Toast element
                const h = this.$createElement

                // Increment the toast count
                this.count++

                // Create the message
                const vNodesMsg = h(
                'p',
                { class: ['text-center', 'mb-0'] },
                [
                    h('b-spinner', { props: { type: 'grow', small: true } }),
                    `  `,
                    h('strong', { class: 'text-muted' }, body),
                    `  `,
                    // ` ${body} `,
                    h('b-spinner', { props: { type: 'grow', small: true } })
                ]
                )

                // Create the title
                const vNodesTitle = h(
                'div',
                { class: ['d-flex', 'flex-grow-1', 'align-items-baseline', 'mr-2'] },
                [
                    h('strong', { class: 'mr-2' }, title),
                    h('small', { class: 'ml-auto text-italics' }, subtitle)
                ]
                )
                // Pass the VNodes as an array for message and title
                this.$bvToast.toast([vNodesMsg], {
                    title: [vNodesTitle],
                    solid: true,
                    toaster: 'b-toaster-bottom-right',
                    variant: variant
                })
            },
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