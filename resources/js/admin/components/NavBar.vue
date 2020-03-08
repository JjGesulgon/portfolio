<template>
    <div>
        <div class="header">
            <div class="display-flex">
                <ul class="navbar-nav ml-auto mr-5">
                    <li class="nav-item mr-5 dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ user.name }} <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#" v-on:click.stop.prevent="logout">Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>  
    </div>
</template>
<script>
export default {
    data() {
        return {
            user: ''
        };
    },

    created() {
        axios.get('/api/user').then(res => {
            this.user = res.data.user;
        }).catch(err => {
            console.log(err);
        });
    },

    methods: {
        logout() {
            axios.post('/logout').then(res => {}).catch(err => {
            location.reload();
            });
        }
    }
}
</script>
<style scoped>
    .display-flex{
         display: flex;
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

    .main_content .header{
        padding: 20px;
        background: #fff;
        color: #717171;
        border-bottom: 1px solid #e0e4e8;
    }
</style>