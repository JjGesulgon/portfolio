<template>
    <div class="main_content">
        <div class="info">
            <div class="mr-auto mt-5 lettering">
                Experience
            </div>
            <div>
                <div class="card">
                    <div class="card-header clearfix">
                        <div class="d-flex flex-row-reverse header-margin">
                            <label class="text-secondary clickableText header-margin" @click.prevent.default="createExperience">
                                <i class="fas fa-plus-square"></i>&nbsp;
                                <strong>Add Experience</strong>
                            </label>
                            &nbsp; | &nbsp;
                            <label class="text-secondary clickableText header-margin" @click.prevent.default="openSearchModal">
                                <i class="fas fa-search"></i>&nbsp;
                                <strong>Search</strong>
                            </label>
                        </div>  
                    </div>
                    <div class="card-body table-responsive header-margin">
                        <table class="table table-hover table-sm">
                            <caption>
                                <div class="row header-margin">
                                    <div class="col-md-9 header-margin">
                                        List of Experiences - Total Items {{ this.meta.total }}
                                    </div>
                                    <div class="col-md-3 header-margin">
                                        <div v-if="showProgress">
                                            <div class="container loader"></div>
                                        </div>
                                    </div>
                                </div>
                            </caption>
                            <thead>
                                <tr>
                                    <th scope="col">Role</th>
                                    <th scope="col">Company Name</th>
                                    <th scope="col">Employment Type</th>
                                    <th scope="col">Location</th>
                                    <th scope="col">Start Date</th>
                                    <th scope="col">End Date</th>
                                    <th scope="col">Options</th>
                                </tr>
                            </thead>
                            <tbody v-if="experiences">
                                <tr v-for="{ id, role, company_name, employment_type, location, start_date, end_date } in experiences">
                                    <td>{{ role }}</td>
                                    <td>{{ company_name }}</td>
                                    <td>{{ employment_type }}</td>
                                    <td>{{ location }}</td>
                                    <td>{{ start_date }}</td>
                                    <td v-if="end_date">{{ end_date }}</td>
                                    <td v-else>N/A</td>
                                    <td>
                                        <router-link class="text-secondary" :to="{ name: 'experience.view', params: { id: id }}">
                                            <i class="fas fa-eye"></i>&nbsp;
                                            <strong>View</strong>
                                        </router-link>
                                        &nbsp; | &nbsp;
                                        <router-link class="text-secondary" :to="{ name: 'experience.update', params: { id: id }}">
                                            <i class="fas fa-edit"></i>&nbsp;
                                            <strong>Edit</strong>
                                        </router-link>
                                        &nbsp; | &nbsp;
                                        <label class="text-danger clickableText" @click.prevent.default="openDeleteExperienceModal(id)">
                                            <i class="fas fa-trash-alt"></i>&nbsp;
                                            <strong>Delete</strong>
                                        </label>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="modal fade" id="deleteExperienceModal" tabindex="-1" role="dialog" aria-labelledby="deleteExperienceTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">You're about to delete this Experience</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete this Experience?
                            </div>
                            <div class="modal-footer header-margin">
                                <label class="text-danger clickableText header-margin" @click.prevent.default="deleteExperience">
                                    <i class="fas fa-trash-alt"></i>&nbsp;
                                    <strong>Confirm Delete</strong>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="clearfix">
                    <div v-if="pageCount">
                        <nav class="float-left">
                            <ul class="pagination">
                                <li class="page-item" v-bind:class="isPrevDisabled">
                                    <a class="page-link" href="#" @click.prevent="goToPreviousPage" disabled>Previous</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#" @click.prevent="goToFirstPage">First</a>
                                </li>
                                <li class="page-item" v-for="pageNumber in pageNumbers" v-bind:class="isPageActive(pageNumber)">
                                    <a class="page-link" href="#" @click.prevent="goToPage(pageNumber)">{{ pageNumber }}</a>
                                </li>
                                <li class="page-item" v-bind:class="isNextDisabled">
                                    <a class="page-link" href="#" @click.prevent="goToLastPage">Last</a>
                                </li>
                                <li class="page-item" v-bind:class="isNextDisabled">
                                    <a class="page-link" href="#" @click.prevent="goToNextPage">Next</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <div v-else>
                        <nav class="float-left">
                            <ul class="pagination">
                                <li class="page-item" v-bind:class="isPrevDisabled">
                                    <a class="page-link" href="#" @click.prevent="goToPreviousPage" disabled>Previous</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#" @click.prevent="goToFirstPage">First</a>
                                </li>
                                <li class="page-item" v-for="pageNumber in pageNumbers" v-bind:class="isPageActive(pageNumber)">
                                    <a class="page-link" href="#" @click.prevent="goToPage(pageNumber)">{{ pageNumber }}</a>
                                </li>
                                <li class="page-item" v-bind:class="isNextDisabled">
                                    <a class="page-link" href="#" @click.prevent="goToLastPage">Last</a>
                                </li>
                                <li class="page-item" v-bind:class="isNextDisabled">
                                    <a class="page-link" href="#" @click.prevent="goToNextPage">Next</a>
                                </li>
                            </ul>
                        </nav>
                    </div>

                    <div class="float-right">
                        <form class="form-inline">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Items per page</div>
                                </div>
                                <select class="custom-select" id="number_of_items" v-model="meta.per_page" v-on:change="changePerPage">
                                    <option value="15">15</option>
                                    <option value="20">20</option>
                                    <option value="25">25</option>
                                    <option value="30">30</option>
                                </select>
                            </div>
                        </form>
                    </div>

                    <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchexperiences" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Search Experiences</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label><strong>Role</strong></label>
                                        <input type="text" class="form-control" v-model="searchColumnRole" autocomplete="off" minlength="2" maxlength="255" required>
                                    </div>
                                    <div class="form-group">
                                        <label><strong>Company Name</strong></label>
                                        <input type="email" class="form-control" v-model="searchColumnCompanyName" autocomplete="off" minlength="2" maxlength="255" required>
                                    </div>
                                    <div class="form-group">
                                        <label><strong>Order By</strong></label>
                                        <select class="form-control" v-model="order_by">
                                            <option value="desc">Newest</option>
                                            <option value="asc">Oldest</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer header-margin">
                                    <label class="text-secondary clickableText header-margin" @click.prevent.default="clear">
                                        <i class="fas fa-redo-alt"></i>&nbsp;
                                        <strong>Clear</strong>
                                    </label>
                                    &nbsp; | &nbsp;
                                    <label class="text-secondary clickableText header-margin" @click.prevent.default="search">
                                        <i class="fas fa-search"></i>&nbsp;
                                        <strong>Search</strong>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    const getExperience = (page, per_page, searchColumnRole, searchColumnCompanyName, order_by, callback) => {
        const params = { page, per_page, searchColumnRole, searchColumnCompanyName, order_by };

        axios.get('/api/experience', { params }).then(res => {
            callback(null, res.data);
        }).catch(error => {
            if (error.response.status == 401) {
                location.reload();
            }

            if (error.response.status == 500) {
                alert('Kindly report this issue to the devs.');
            }
        });
    };
    export default {
        data() {
            return {
                experiences: null,
                experienceID: null,
                searchColumnRole: '',
                searchColumnCompanyName: '',
                order_by: 'desc',
                meta: {
                    current_page: null,
                    from: null,
                    last_page: null,
                    path: null,
                    per_page: 10,
                    to: null,
                    total: null
                },
                links: {
                    first: null,
                    last: null,
                    next: null,
                    prev: null,
                },
                error: null,
                showProgress: false,
                pageNumbers: []
            };
        },

        beforeRouteEnter (to, from, next) {
            if (to.query.per_page == null) {
                getExperience(to.query.page, 15, to.query.searchColumnRole, to.query.searchColumnCompanyName, to.query.order_by, (err, data) => {
                    next(vm => vm.setData(err, data));
                });
            } else {
                getExperience(to.query.page, to.query.per_page, to.query.searchColumnRole, to.query.searchColumnCompanyName, to.query.order_by, (err, data) => {
                    next(vm => vm.setData(err, data));
                });
            }
        },

        beforeRouteUpdate (to, from, next) {
            getExperience(to.query.page, this.meta.per_page, to.query.searchColumnRole, to.query.searchColumnCompanyName, to.query.order_by, (err, data) => {
                this.setData(err, data);
                next();
            });
        },

        computed: {
            nextPage() {
                return this.meta.current_page + 1;
            },

            prevPage() {
                return this.meta.current_page - 1;
            },

            paginatonCount() {
                if (! this.meta) { return; }
                const { current_page, last_page } = this.meta;
                return `${current_page} of ${last_page}`;
            },

            pageCount() {
                if (this.meta.last_page > 10) { return false; }
                return true;
            },

            isPrevDisabled() {
                if (this.links.prev == null) { return 'disabled'; }
                return;
            },

            isNextDisabled() {
                if (this.links.next == null) { return 'disabled'; }
                return;
            }
        },

        methods: {
            viewExperiences(experienceId) {
                this.$router.push({
                        name: 'experience.view', 
                        params: { id: experienceId } 
                    })
            },

            updateExperiences(experienceId) {
                this.$router.push({
                        name: 'experience.update', 
                        params: { id: experienceId } 
                    })
            },

            createExperience() {
                this.$router.push({
                    name: 'experience.create'
                });
            },

            openDeleteExperienceModal(id) {
                $('#deleteExperienceModal').modal('show');
                this.experienceID = id
            },
            
            deleteExperience() {
                $('#deleteExperienceModal').modal('hide');
                axios.delete('/api/experience/' + this.experienceID).then(res => {
                    this.$router.go()
                }).catch(err => {
                    console.log(err);
                    alert("Unable to remove this user because of conflicts to other modules.");
                });
            },

            goToFirstPage() {
                this.showProgress = true;
                this.$router.push({
                    name: 'experience.index',
                    query: {
                        page: 1,
                        per_page: this.meta.per_page,
                        searchColumnRole: this.searchColumnRole,
                        searchColumnCompanyName: this.searchColumnCompanyName,
                        order_by: this.order_by
                    }
                });
            },

            goToPage(page = null) {
                this.showProgress = true;
                this.$router.push({
                    name: 'experience.index',
                    query: {
                        page,
                        per_page: this.meta.per_page,
                        searchColumnRole: this.searchColumnRole,
                        searchColumnCompanyName: this.searchColumnCompanyName,
                        order_by: this.order_by
                    }
                });
            },

            goToLastPage() {
                this.showProgress = true;
                this.$router.push({
                    name: 'experience.index',
                    query: {
                        page: this.meta.last_page,
                        per_page: this.meta.per_page,
                        searchColumnRole: this.searchColumnRole,
                        searchColumnCompanyName: this.searchColumnCompanyName,
                        order_by: this.order_by
                    }
                });
            },

            goToNextPage() {
                this.showProgress = true;
                this.$router.push({
                    name: 'experience.index',
                    query: {
                        page: this.nextPage,
                        per_page: this.meta.per_page,
                        searchColumnRole: this.searchColumnRole,
                        searchColumnCompanyName: this.searchColumnCompanyName,
                        order_by: this.order_by
                    }
                });
            },

            goToPreviousPage() {
                this.showProgress = true;
                this.$router.push({
                    name: 'experience.index',
                    query: {
                        page: this.prevPage,
                        per_page: this.meta.per_page,
                        searchColumnRole: this.searchColumnRole,
                        searchColumnCompanyName: this.searchColumnCompanyName,
                        order_by: this.order_by
                    }
                });
            },

            setData(err, { data: experiences, links, meta }) {
                this.pageNumbers = [];

                if (err) {
                    this.error = err.toString();
                } else {
                    this.experiences = experiences;
                    this.links = links;
                    this.meta = meta;
                }

                this.showProgress = false;
                this.populatePages();
            },

            populatePages() {
                if (this.pageCount) {
                    for (let i = 1; i <= this.meta.last_page; i++) { this.pageNumbers.push(i); }
                } else if (this.meta.current_page <= 6) {
                    let page = 1;
                    this.pageNumbers.push(page);
                    this.pageNumbers.push(page + 1);
                    this.pageNumbers.push(page + 2);
                    this.pageNumbers.push(page + 3);
                    this.pageNumbers.push(page + 4);
                    this.pageNumbers.push(page + 5);
                    this.pageNumbers.push(page + 6);
                    this.pageNumbers.push('...');
                    this.pageNumbers.push(this.meta.last_page - 1);
                    this.pageNumbers.push(this.meta.last_page);
                } else if ((this.meta.current_page + 6) >= this.meta.last_page) {
                    this.pageNumbers.push(1);
                    this.pageNumbers.push(2);
                    this.pageNumbers.push('...');
                    this.pageNumbers.push(this.meta.last_page - 7);
                    this.pageNumbers.push(this.meta.last_page - 6);
                    this.pageNumbers.push(this.meta.last_page - 5);
                    this.pageNumbers.push(this.meta.last_page - 4);
                    this.pageNumbers.push(this.meta.last_page - 3);
                    this.pageNumbers.push(this.meta.last_page - 2);
                    this.pageNumbers.push(this.meta.last_page - 1);
                    this.pageNumbers.push(this.meta.last_page);
                } else {
                    this.pageNumbers.push(1);
                    this.pageNumbers.push(2);
                    this.pageNumbers.push('...');
                    this.pageNumbers.push(this.meta.current_page - 2);
                    this.pageNumbers.push(this.meta.current_page - 1);
                    this.pageNumbers.push(this.meta.current_page);
                    this.pageNumbers.push(this.meta.current_page + 1);
                    this.pageNumbers.push(this.meta.current_page + 2);
                    this.pageNumbers.push('...');
                    this.pageNumbers.push(this.meta.last_page - 1);
                    this.pageNumbers.push(this.meta.last_page);
                }
            },

            isPageActive(page) {
                if (page == this.$route.query.page || (page == 1 && this.$route.query.page == null)) { return 'active'; }
                return;
            },

            changePerPage() {
                this.showProgress = true;
                this.$router.push({
                    name: 'experience.index',
                    query: {
                        page: 1,
                        per_page: this.meta.per_page,
                        searchColumnRole: this.searchColumnRole,
                        searchColumnCompanyName: this.searchColumnCompanyName,
                        order_by: this.order_by
                    }
                });
            },

            search() {
                $('#searchModal').modal('hide');
                this.showProgress = true;
                this.$router.push({
                    name: 'experience.index',
                    query: {
                        page: 1,
                        per_page: this.meta.per_page,
                        searchColumnRole: this.searchColumnRole,
                        searchColumnCompanyName: this.searchColumnCompanyName,
                        order_by: this.order_by
                    }
                });
            },

            clear() {
                this.searchColumnRole = '';
                this.searchColumnCompanyName = '';
                this.order_by = 'desc';
            },

            openSearchModal() {
                $('#searchModal').modal('show');
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