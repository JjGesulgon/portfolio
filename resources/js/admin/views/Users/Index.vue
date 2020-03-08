<template>
    <div class="main_content">
        <div class="info">
            <div class="mr-auto mt-5 lettering">
                Users
            </div>
            <div>
                <div class="d-flex flex-row-reverse">
                    <button type="button"  class="btn btn-success ml-2" @click.prevent.default="createUsers"><i class="fas fa-user"></i>Create User</button>
                    <button type="button" class="btn btn-primary" @click.prevent.default="openSearchModal">Search</button>
                </div>
                <div class="card">
                    <div class="card-header clearfix">
                        
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-hover table-sm">
                            <caption>
                                <div class="row">
                                    <div class="col-md-9">
                                        List of Users - Total Items {{ this.meta.total }}
                                    </div>
                                    <div class="col-md-3">
                                        <div class="progress" height="30px;" v-if="showProgress">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                                        </div>
                                    </div>
                                </div>
                            </caption>
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Options</th>
                                </tr>
                            </thead>
                            <tbody v-if="users">
                                <tr v-for="{ id, name, email } in users">
                                    <td>{{ name }}</td>
                                    <td>{{ email }}</td>
                                    <td>
                                        <!-- <router-link class="text-info" :to="{ name: 'admins.view', params: { id: id }}">View</router-link> -->
                                        <button type="button" class="btn btn-primary ml-2" @click.prevent.default="viewUsers(id)">View</button>
                                        <button type="button" class="btn btn-warning ml-2" @click.prevent.default="updateUsers(id)">Edit</button>
                                        <button type="button" class="btn btn-danger ml-2" @click.prevent.default="openDeleteUserModal(id)">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="modal fade" id="deleteUserModal" tabindex="-1" role="dialog" aria-labelledby="deleteUserTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">You're about to delete this User?</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete this User?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger btn-sm" @click.prevent.default="deleteUser">Confirm Delete</button>
                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
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

                    <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchUsers" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Search Users</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control" v-model="searchColumnName" autocomplete="off" minlength="2" maxlength="255" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Email Address</label>
                                        <input type="email" class="form-control" v-model="searchColumnEmail" autocomplete="off" minlength="2" maxlength="255" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Order By</label>
                                        <select class="form-control" v-model="order_by">
                                            <option value="desc">Newest</option>
                                            <option value="asc">Oldest</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-success btn-sm" @click.prevent.default="clear">Clear</button>
                                    <button type="button" class="btn btn-danger btn-sm" @click.prevent.default="search">Search</button>
                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
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
    const getUsers = (page, per_page, searchColumnName, searchColumnEmail, order_by, callback) => {
        const params = { page, per_page, searchColumnName, searchColumnEmail, order_by };

        axios.get('/api/users', { params }).then(res => {
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
                users: null,
                userID: null,
                searchColumnName: '',
                searchColumnEmail: '',
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
                getUsers(to.query.page, 15, to.query.searchColumnName, to.query.searchColumnEmail, to.query.order_by, (err, data) => {
                    next(vm => vm.setData(err, data));
                });
            } else {
                getUsers(to.query.page, to.query.per_page, to.query.searchColumnName, to.query.searchColumnEmail, to.query.order_by, (err, data) => {
                    next(vm => vm.setData(err, data));
                });
            }
        },

        beforeRouteUpdate (to, from, next) {
            getUsers(to.query.page, this.meta.per_page, to.query.searchColumnName, to.query.searchColumnEmail, to.query.order_by, (err, data) => {
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
            viewUsers(userId) {
                this.$router.push({
                        name: 'users.view', 
                        params: { id: userId } 
                    })
            },

            updateUsers(userId) {
                this.$router.push({
                        name: 'users.update', 
                        params: { id: userId } 
                    })
            },

            createUsers() {
                this.$router.push({
                    name: 'users.create'
                });
            },

            openDeleteUserModal(id) {
                $('#deleteUserModal').modal('show');
                this.userID = id
            },
            
            deleteUser() {
                $('#deleteUserModal').modal('hide');
                axios.delete('/api/users/' + this.userID).then(res => {
                    this.$router.go()
                }).catch(err => {
                    console.log(err);
                    alert("Unable to remove this user because of conflicts to other modules.");
                });
            },

            goToFirstPage() {
                this.showProgress = true;
                this.$router.push({
                    name: 'users.index',
                    query: {
                        page: 1,
                        per_page: this.meta.per_page,
                        searchColumnName: this.searchColumnName,
                        searchColumnEmail: this.searchColumnEmail,
                        order_by: this.order_by
                    }
                });
            },

            goToPage(page = null) {
                this.showProgress = true;
                this.$router.push({
                    name: 'users.index',
                    query: {
                        page,
                        per_page: this.meta.per_page,
                        searchColumnName: this.searchColumnName,
                        searchColumnEmail: this.searchColumnEmail,
                        order_by: this.order_by
                    }
                });
            },

            goToLastPage() {
                this.showProgress = true;
                this.$router.push({
                    name: 'users.index',
                    query: {
                        page: this.meta.last_page,
                        per_page: this.meta.per_page,
                        searchColumnName: this.searchColumnName,
                        searchColumnEmail: this.searchColumnEmail,
                        order_by: this.order_by
                    }
                });
            },

            goToNextPage() {
                this.showProgress = true;
                this.$router.push({
                    name: 'users.index',
                    query: {
                        page: this.nextPage,
                        per_page: this.meta.per_page,
                        searchColumnName: this.searchColumnName,
                        searchColumnEmail: this.searchColumnEmail,
                        order_by: this.order_by
                    }
                });
            },

            goToPreviousPage() {
                this.showProgress = true;
                this.$router.push({
                    name: 'user.index',
                    query: {
                        page: this.prevPage,
                        per_page: this.meta.per_page,
                        searchColumnName: this.searchColumnName,
                        searchColumnEmail: this.searchColumnEmail,
                        order_by: this.order_by
                    }
                });
            },

            setData(err, { data: users, links, meta }) {
                this.pageNumbers = [];

                if (err) {
                    this.error = err.toString();
                } else {
                    this.users = users;
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
                    name: 'users.index',
                    query: {
                        page: 1,
                        per_page: this.meta.per_page,
                        searchColumnName: this.searchColumnName,
                        searchColumnEmail: this.searchColumnEmail,
                        order_by: this.order_by
                    }
                });
            },

            search() {
                $('#searchModal').modal('hide');
                this.showProgress = true;
                this.$router.push({
                    name: 'users.index',
                    query: {
                        page: 1,
                        per_page: this.meta.per_page,
                        searchColumnName: this.searchColumnName,
                        searchColumnEmail: this.searchColumnEmail,
                        order_by: this.order_by
                    }
                });
            },

            clear() {
                this.searchColumnName = '';
                this.searchColumnEmail = '';
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