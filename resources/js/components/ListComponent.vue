<template>
    <div id="">
        <table class="table table-striped" ref="usersList" v-if="refresh">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col-2">Name</th>
                    <th scope="col-3">Email</th>
                    <th scope="col">Private</th>
                    <th scope="col">Added On</th>
                    <th scope="col"></th>
                </tr>
            </thead>

            <tbody>
                <tr v-for="member in members">
                    <td> {{ member.id }} </td>
                    <td> {{ member.name }} </td>
                    <td> {{ member.email }} </td>
                    <td> {{ member.private }} </td>
                    <td> {{ member.date }} </td>
                    <td>
                        <a href="#" id="toggle-edit" @click="edit(member.id)"><i class="fa fa-edit"></i></a>
                        <a href="#" id="toggle-remove" @click="remove(member.id)"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Modal Component -->
        <b-modal ref="editModalRef" hide-footer title="Edit User">
            <form class="form-horizontal" method="post">
                <div class="d-block text-left">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control"
                            id="name"
                            name="name"
                            v-model="member.name"
                            aria-describedby="nameHelp"
                            placeholder="Enter name">
                        <span v-if="errors.name" class="help-block text-danger">{{ errors.name[0] }}</span>
                    </div>

                    <div class="form-group">
                        <label for="emai">Email address</label>
                        <input type="email" class="form-control"
                            id="email"
                            name="email"
                            v-model="member.email"
                            aria-describedby="emailHelp"
                            placeholder="Enter email">
                        <span v-if="errors.email" class="help-block text-danger">{{ errors.email[0] }}</span>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control"
                            id="password"
                            name="password"
                            v-model="member.password"
                            placeholder="Password">
                        <span v-if="errors.password" class="help-block text-danger">{{ errors.password[0] }}</span>
                    </div>

                    <div class="form-group">
                        <label for="confirm-password">Confirm Password</label>
                        <input type="password" class="form-control"
                            id="confirm-password"
                            name="confirm_password"
                            v-model="member.confirm_password"
                            placeholder="Confirm Password">
                        <span v-if="errors.confirm_password" class="help-block text-danger">{{ errors.confirm_password[0] }}</span>
                    </div>

                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input"
                            id="private"
                            v-model="member.private"
                            name="is_private">
                        <label class="form-check-label" for="private">Private Account</label>
                    </div>

                    <div class="form-group">
                        <label for="confirm-password">Added On</label>
                        <input type="text" class="form-control"
                            v-model="member.date"
                            disabled>
                    </div>
                </div>

                <div class="text-right">
                    <button type="button" class="mt-6 btn btn-primary" @click="update(member.id)">Update</button>
                    <button type="button" class="mt-6 btn btn-link" @click="hideModal">Cancel</button>
                </div>

                <input type="hidden" name="_method" value="PATCH">
            </form>
        </b-modal>

    </div>
</template>

<script>
    export default {

        data() {
            return {
                members: [],
                member: [],
                errors: [],
                refresh: false
            };
        },

        created() {
            this.refresh = true;
            this.fetch();
        },

        methods: {
            fetch() {
                axios.get('/api/members')
                    .then( ( { data } ) => {
                        this.members = data.data;
                    });
            },

            edit(id) {
                axios.get('/api/members/' + id)
                    .then( ( { data } ) => {
                        this.member = data;
                        this.$refs.editModalRef.show();
                    });
            },

            update(id) {
                axios.patch('/api/members/' + id, this.member)
                    .then( ( {data} ) => {
                        if (data.success) {
                            swal({
                                type: 'success',
                                title: 'Member Updated',
                                text: 'Selected member has been successfully updated'
                            }).then( ( { data } ) => {
                                this.fetch();
                                this.refresh = true;

                                this.$refs.editModalRef.hide();
                            });
                        }
                    })
                    .catch( ( { response } ) => {
                        this.errors = response.data.errors;
                    });
            },

            remove(id) {
                swal({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                }).then((result) => {
                    if (result.value) {
                        this.refresh = false;
                        axios.delete('/api/members/' + id)
                            .then( ( { data } ) => {
                                if (data.success) {
                                    this.fetch();
                                    this.refresh = true;
                                    swal({
                                        type: 'success',
                                        title: 'Member Deleted',
                                        text: 'Selected member has been successfully deleted'
                                    })
                                }
                            });
                    }
                });
            },

            hideModal() {
                this.$refs.editModalRef.hide();
            }
        }

    }
</script>
