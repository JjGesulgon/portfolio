<template>
    <div class="main_content">
        <div class="info">
            <div class="mr-auto mt-5 lettering">
                Intro
            </div>
            <div>
                <div class="card">
                    <div class="card-header">
                        View Intro
                    </div>
                    <div class="card-body">
                        <div v-if="ifReady">
                            <p class="text-center" v-if="!hasIntro"> No Intro Yet</p>
                            <div class="row">
                                <div v-if="intro.image" class="offset-md-3 col-md-6">
                                    <img class="img-fluid" :src="'/storage/images/' + intro.image">
                                </div>
                            </div>
                            <h1 class="text-center">{{ intro.name }}</h1>
                            <br>

                            <div class="body" v-html="intro.body"></div>
                            <br>
                            <br>
                            <button type="button" v-if="!hasIntro" class="btn btn-primary btn-sm" @click.prevent.default="addIntro">Add Intro</button>
                            <button type="button" v-if="hasIntro" class="btn btn-primary btn-sm" @click.prevent.default="editIntro">Edit Intro</button>
                            <button type="button" v-if="hasIntro" class="btn btn-danger btn-sm" @click.prevent.default="openDeleteIntroModal">Delete Intro</button>
                        </div>
                        <div v-else>
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="deleteIntroModal" tabindex="-1" role="dialog" aria-labelledby="deleteIntro" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">You're about to delete this Intro?</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete this Intro?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger btn-sm" @click.prevent.default="deleteIntro">Confirm Delete</button>
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
                intro: '',
                hasIntro: false,
            };
        },
        mounted() {
            let promise = new Promise((resolve, reject) => {
                axios.get('/api/intro').then(res => {
                    this.intro = res.data.intro;
                    this.hasIntro = true
                    resolve();
                });
            });
        },
        methods: {
            addIntro() {
                this.$router.push({ name: 'intro.create' });
            },
            editIntro() {
                // this.$router.push({
                //     name: 'mayors.edit',
                //     params: { id: this.mayor.id }
                // });
            },
            openDeleteIntroModal() {
                $('#deleteIntroModal').modal('show');
            },
            deleteIntro() {
                $('#deleteIntroModal').modal('hide');
                axios.delete('/api/intro/' + this.intro.id).then(res => {
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
        margin-left: 200px;
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