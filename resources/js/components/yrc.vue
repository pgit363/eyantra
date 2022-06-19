<template>
<div>
    <div class="text-center" style="margin: 10px 0px 10px 0px;">
        <span class="text-secondary">
            <h1> E-YRC Registration Form</h1>
        </span>
    </div>
    <div class="card-body">
        <div class="row justify-content-center" style="margin: 20px 0px 20px 0px;">
            <div class="col-md-8">
                <div class="card">
                    <div class="form-group">
                        <label>Select Country:</label>
                        <select class='form-control' v-model='country' @change='getColleges()'>
                            <option value='0'>Select Country</option>
                            <option v-for="(country, index) in countries" :value='country.id' :key="index">{{ country.name }}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Select College:</label>
                        <select class='form-control' v-model='college'>
                            <option value='0'>Select College</option>
                            <option v-for="(college, i) in colleges" :value='college.id' :key="i">{{ college.name }}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label>Name:</label>
                            <input v-model="form.name" class='form-control' type="text" placeholder="Text input" />
                        </div>
                        <span class="text-danger">
                            <small>
                                {{"name" in errors ? errors.name.join(", ") : ""}}
                            </small>
                        </span>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label>Email:</label>
                            <input v-model="form.email" class='form-control' type="email" placeholder="Enter Your Email" />
                        </div>
                        <span class="text-danger">
                            <small>
                                {{"email" in errors ? errors.email.join(", ") : ""}}
                            </small>
                        </span>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label>Contact Number:</label>
                            <input v-model="form.phone" class='form-control' type="number" maxlength="10" placeholder="Contact Number" />
                        </div>
                        <span class="text-danger">
                            <small>
                                {{"phone" in errors ? errors.phone.join(", ") : ""}}
                            </small>
                        </span>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label>Gender:</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="gender-male" value="male" v-model="form.gender" required>
                                <label class="form-check-label" for="gender">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="gender-female" value="female" v-model="form.gender">
                                <label class="form-check-label" for="gender">Female</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-group">
                            <label>Year:</label>
                            <input v-model="form.year" class="form-control" type="date" placeholder="Enter Your Birth Year" />
                        </div>
                        <span class="text-danger">
                            <small>
                                {{"year" in errors ? errors.year.join(", ") : ""}}
                            </small>
                        </span>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label>Department:</label>
                            <input v-model="form.department" class='form-control' type="text" placeholder="Text input" />
                        </div>
                        <span class="text-danger">
                            <small>
                                {{"department" in errors ? errors.department.join(", ") : ""}}
                            </small>
                        </span>
                    </div>
                    <div class="form-group">
                    </div>
                </div>
                <button @click="submitForm">Submit</button>
                <div v-for="(errorArray, index) in notifmsg" :key="index">
                    <span class="text-danger">{{ errorArray}} </span>
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
            form: {
                name: "",
                phone: "",
                gender: "",
                email: "",
                year: "",
                department: "",
            },
            notifmsg: '',
            country: 0,
            countries: [],
            college: 0,
            colleges: [],
            errors: [],
        };
    },
    created: function () {
        this.getCountries()
    },
    methods: {
        getCountries: function () {
            axios.get('/get_countries')
                .then(function (response) {
                    this.countries = response.data;
                }.bind(this));
        },
        getColleges: function () {
            axios.post('/get_colleges', {
                country_id: this.country
            }).then(function (response) {
                this.colleges = response.data;
            }.bind(this));
        },
        async submitForm() {
            alert("here");
            // if (this.show) {
            //     return;
            // }
            // this.show = true;
            // let this_ = this;
            this.errors = {
                name: [],
                email: [],
                phone: [],
                year: [],
                department: [],
            };
            Object.keys(this.errors).forEach((error) => {
                if (document.getElementById(error)) {
                    document
                        .getElementById(error)
                        .setAttribute("style", "border-color: #f4f9fe;");
                }
            });
            let error = false;
            if (this.form.name.length == 0) {
                this.errors["name"].push("Name is required");
                error = true;
            }
            if (this.form.email.length == 0) {
                this.errors["email"].push("Email is required");
                error = true;
            }
            if (
                !RegExp(
                    /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/
                ).test(this.form.email)
            ) {
                this.errors["email"].push("Please enter a valid email address");
                error = true;
            }
            if (this.form.phone.length == 0) {
                this.errors["phone"].push("Phone number is required");
                error = true;
            }
            if (this.form.phone.length >= 9) {
                this.errors["phone"].push("Phone number must be of 10 digits");
                error = true;
            }
            if (this.form.department.length == 0) {
                this.errors["department"].push("Department is required");
                error = true;
            }
            if (!error) {
                axios.post('/api/user', {
                    country_id: this.country,
                    college_id: this.college,
                    name: this.form.name,
                    phone: this.form.phone,
                    email: this.form.email,
                    gender: this.form.gender,
                    year: this.form.year,
                    department: this.form.department
                }).then(function (response) {
                    alert(response.data.message);
                }).catch(e => {
                    this.notifmsg = e.response.data
                    alert("Something Went Wrong..!");
                });
            } else {
                alert("Please fill valid data");
            }
        }
    }
};
</script>
