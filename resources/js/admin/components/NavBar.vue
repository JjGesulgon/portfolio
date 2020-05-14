<template>
    <div>
        <b-navbar toggleable="lg" type="dark" variant="dark">
            <b-button v-b-toggle.sidebar-variant v-if="isSmallScreen"><i class="fas fa-bars"></i></b-button>
                <b-sidebar id="sidebar-variant" title="Sidebar" bg-variant="dark" text-variant="light" shadow>
                    <b-list-group>
                        <b-list-group-item variant="dark">
                            <router-link to="/"><i class="fas fa-home"></i>&nbsp; Overview</router-link>
                        </b-list-group-item>
                        <b-list-group-item variant="dark">
                            <router-link to="/users"><i class="fas fa-user"></i>&nbsp; Users</router-link>
                        </b-list-group-item>
                        <b-list-group-item variant="dark">
                            <router-link to="/intro"><i class="fas fa-address-card"></i>&nbsp; Intro</router-link>
                        </b-list-group-item>
                        <b-list-group-item variant="dark">
                            <router-link to="/about"><i class="fas fa-skull"></i>&nbsp; About</router-link>
                        </b-list-group-item>
                        <b-list-group-item variant="dark">
                            <router-link to="/experience"><i class="fas fa-briefcase"></i>&nbsp; Experiences</router-link>
                        </b-list-group-item>
                        <b-list-group-item variant="dark">
                            <router-link to="/skills"><i class="fas fa-dice-six"></i>&nbsp; Skills</router-link>
                        </b-list-group-item>
                        <b-list-group-item variant="dark">
                            <router-link to="/projects"><i class="fas fa-project-diagram"></i>&nbsp; Projects</router-link>
                        </b-list-group-item>
                    </b-list-group>
                </b-sidebar>
            <b-navbar-nav class="ml-auto">
                <b-nav-item-dropdown right>
                    <!-- Using 'button-content' slot -->
                    <template v-slot:button-content>
                        <em>{{user.name}}</em>
                    </template>
                    <b-dropdown-item href="#" v-on:click.stop.prevent="logout">Sign Out</b-dropdown-item>
                </b-nav-item-dropdown>
            </b-navbar-nav>
        </b-navbar>
    </div>
</template>
<script>
export default {
    data() {
        return {
            user: '',
            isSmallScreen: false
        };
    },

    mounted() {
        this.$nextTick(function() {
            window.addEventListener('resize', this.getWindowWidth);
            window.addEventListener('resize', this.getWindowHeight);

            //Init
            this.getWindowWidth()
        })

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
        },

        getWindowWidth(event) {
            this.windowWidth = document.documentElement.clientWidth;
            if(this.windowWidth <= 768){
                this.isSmallScreen = true
            } else{
                this.isSmallScreen = false
            }
        },
    },

    beforeDestroy() {
        window.removeEventListener('resize', this.getWindowWidth);
    }
}
</script>
<style scoped>
    .display-flex{
         display: flex;
    }

    .navbarStyle {
        background: #252525;
        height: 95px !important;
    }

    .header{
        /* padding-top: 5px !important;
        padding-bottom: 5px !important;
        padding-left: 20px !important;
        padding-right: 20px !important; */
        /* height: 500px !important; */
        /* background: #fff; */
        /* color: #717171; */
        border-bottom: 1px solid #e0e4e8;
    }

    .main_content .header{
        padding: 20px;
        background: #fff;
        color: #717171;
        border-bottom: 1px solid #e0e4e8;
    }
</style>