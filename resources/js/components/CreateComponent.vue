<template>
    <div id="create-container">
        <div class="alert alert-success" v-if="saved">
            <strong>Success!</strong> New member has been saved successfully.
        </div>

        <div id="form">
            <form class="form-horizontal" method="post" @submit.prevent="onSubmit">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control"
                        id="name"
                        name="name"
                        v-model="member.name"
                        aria-describedby="nameHelp"
                        placeholder="Enter name">
                    <span v-if="errors.name" class="help-block text-danger">{{ errors.name[0] }}</span>
                    <small id="nameHelp" class="form-text text-muted">This will be your alias</small>
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
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
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
                        name="is_private"
                        v-model="member.private">
                    <label class="form-check-label" for="private">Private Account</label>
                </div>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-link" @click="cancel">Cancel</button>
                    <!-- <router-link :to="{ name: 'home' }" class="btn btn-link">Cancel</router-link> -->

                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            errors: [],
            saved: false,
            member: {
                name: null,
                email: null,
                password: null,
                confirm_password: null,
                is_private: 0
            }
        };
    },

    methods: {
        onSubmit() {
            this.saved = false;
            axios.post('/api/members', this.member)
                 .then(({data}) => this.setSuccessMessage())
                 .catch(({response}) => this.setErrors(response));
        },

        setErrors(response) {
            this.errors = response.data.errors;
        },

        setSuccessMessage() {
            this.reset();
            this.saved = true;
        },

        reset() {
            this.errors = [];
            this.signature = {
                name: null,
                email: null,
                password: null,
                confirm_password: null,
                is_private: 0
            }
        },

        cancel() {
            // this.$router.go('/');
            this.$router.push({ name: 'home' });
        }
    }
}
</script>

<style lang="css">
</style>
