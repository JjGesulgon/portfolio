<template>
    <div class="main_content">
        <div class="info">
            <div class="mr-auto mt-5 lettering">
                About
            </div>
            <div>
                <div class="card">
                    <div class="card-header">
                        View About
                    </div>
                    <div class="card-body">
                        <div v-if="ifReady">
                            <p class="text-center" v-if="!hasAbout"> No About Yet</p>
                            <br>
                            <div class="body" v-html="about.body"></div>
                            <br>
                            <br>
                            <button type="button" v-if="!hasAbout" class="btn btn-primary btn-sm" @click.prevent.default="addAbout">Add About</button>
                            <button type="button" v-if="hasAbout" class="btn btn-primary btn-sm" @click.prevent.default="editAbout">Edit About</button>
                            <button type="button" v-if="hasAbout" class="btn btn-danger btn-sm" @click.prevent.default="openDeleteAboutModal">Delete About</button>
                        </div>
                        <div v-else>
                            <div class="container loader"></div>
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
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger btn-sm" @click.prevent.default="deleteAbout">Confirm Delete</button>
                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
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
                ifReady: true,
                about: '',
                hasAbout: false,
            };
        },
        mounted() {
            let promise = new Promise((resolve, reject) => {
                axios.get('/api/about').then(res => {
                    this.about = res.data.about;
                    this.hasAbout = true
                    resolve();
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