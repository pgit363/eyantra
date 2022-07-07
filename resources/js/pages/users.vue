<template>
<div>
    <div class="text-center" style="margin: 10px 0px 10px 0px;">
        <span class="text-secondary">
            <h1> E-YRC User's By Name Drop Down</h1>
        </span>
    </div>
    <div class="card-body">
        <div class="row justify-content-center" style="margin: 20px 0px 20px 0px;">
            <div class="col-md-8">
                <div class="card">
                    <label><strong>Select Name:</strong></label>
                    <select class='form-control' v-model='name' @change='getUsers()'>
                        <option value='0'>Select Name</option>
                        <option v-for="(name, index) in names" :value='name.id' :key="index">{{ name.name }}</option>
                    </select>
                </div>
                <div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Country Id</th>
                                <th>College ID</th>
                                <th>Year</th>
                                <th>Department</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{users.name }}</td>
                                <td>{{users.phone }}</td>
                                <td>{{users.email }}</td>
                                <td>{{users.country_name }}</td>
                                <td>{{users.college_name }}</td>
                                <td>{{users.year }}</td>
                                <td>{{users.department }}</td>
                            </tr>
                        </tbody>
                    </table>
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
            notifmsg: '',
            name: 0,
            names: [],
            user: 0,
            users: [],
            errors: [],
        };
    },
    watch: {
        name: function (val) {
            this.getUsers()
        }
    },
    created: function () {
        this.getNames()
    },
    methods: {
        getNames: function () {
            axios.get('/api/get_names')
                .then(function (response) {
                    this.names = response.data;
                }.bind(this));
        },
        getUsers() {
            axios.post('/api/get_users', {
                id: this.name
            }).then(function (response) {
                this.users = JSON.parse(JSON.stringify(response.data['0']));
            }.bind(this));
        },
    }
}
</script>
