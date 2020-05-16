<template>
    <div class="main_content">
        <div class="info">
            <div class="mr-auto mt-5 lettering">
                About
            </div>
            <div>
                <div class="card">
                    <div class="card-header header-margin">
                        View About
                    </div>
                    <div class="card-body header-margin">
                        <div v-if="ifReady">
                            <p class="text-center" v-if="!hasAbout"> No About Yet</p>
                            <br>
                            <div class="body" v-html="about.body"></div>
                            <br>
                            <label v-if="!hasAbout" class="text-secondary clickableText header-margin" @click.prevent.default="addAbout">
                                <i class="fas fa-plus-square"></i>&nbsp;
                                <strong>Add About</strong>
                            </label>
                            <div v-if="hasAbout" class="header-margin">
                                <router-link class="text-secondary" :to="{ name: 'about.edit'}">
                                    <i class="fas fa-edit"></i>&nbsp;
                                    <strong>Edit About</strong>
                                </router-link>
                                &nbsp; | &nbsp;
                                <label class="text-danger clickableText" @click.prevent.default="openDeleteAboutModal">
                                    <i class="fas fa-trash-alt"></i>&nbsp;
                                    <strong>Delete About</strong>
                                </label>
                            </div>
                        </div>
                        <div v-else>
                            <div class="d-flex justify-content-center mb-3">
                                <b-spinner label="Loading..."></b-spinner>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="deleteAboutModal" tabindex="-1" role="dialog" aria-labelledby="deleteAbout" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">You're about to delete this About?</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete this About?
                            </div>
                            <div class="modal-footer header-margin">
                                <label class="text-danger clickableText header-margin" @click.prevent.default="deleteAbout">
                                    <i class="fas fa-trash-alt"></i>&nbsp;
                                    <strong>Confirm Delete</strong>
                                </label>
                            </div>
                        </div>
                    </div>`
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
                about: '',
                hasAbout: false,
            };
        },
        mounted() {
            let promise = new Promise((resolve, reject) => {
                axios.get('/api/about').then(res => {
                    console.log(res);
                    this.about = res.data.about;
                    this.hasAbout = true
                    this.ifReady = true
                    resolve();
                }).catch(error => {
                    this.ifReady = true
                });
            });
        },
        methods: {
            addAbout() {
                this.$router.push({ name: 'about.create' });
            },
            editAbout() {
                this.$router.push({
                    name: 'about.edit',
                    // params: { id: this.mayor.id }
                });
            },
            openDeleteAboutModal() {
                $('#deleteAboutModal').modal('show');
            },
            deleteAbout() {
                this.ifReady = false;
                $('#deleteAboutModal').modal('hide');
                axios.delete('/api/about/' + this.about.id).then(res => {
                    this.$router.go()
                }).catch(err => {
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