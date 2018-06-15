const app = new Vue({
    el: '#app',
    data: {
        errors: [],

        email: null,
        name: null,
        subject: null,
        body: null,
        
        newItem:'',
        searchVar: '',
        searchResult: '',
        test: ''
    },
    watch: {
        searchVar: function() {
            this.searchResult = ''
            if (this.searchVar.length > 4) {
                this.lookupForResult()
            }
        }
    },
    methods: {
        // Create or Update User
        submitForm() {
            var app = this;

            axios.post('http://localhost/Laravel_5.6_RESTful_web-service/Laravel_5.6_RESTful_web-service/public/api/user',
                {
                    email: this.email,
                    name: this.name,
                    subject: this.subject,
                    body: this.body
                }, {
                    headers: {
                        "Content-Type": "application/json"
                    }
                })
                .then(function (response) {
                    // null variables again after use
                    app.name = null,
                    app.email = null,
                    app.subject = null,
                    app.body = null

                    app.test = response.data;
                    console.log('What we got from Response ', JSON.stringify(app.test, null, 4))
                    app.newItem=response.data;
                })
                .catch(function (error) {
                    console.log(" We have an error" + error);

                });
        },
        // Form Validation
        checkForm: function (e) {

            this.errors = [];
            if (!this.name) this.errors.push("Name required.");
            if (!this.email) {
                this.errors.push("Email required.");
            } else if (!this.validEmail(this.email)) {
                this.errors.push("Valid email required.");
            }
            if (!this.subject) this.errors.push("Subject required.");
            if (!this.body) this.errors.push("Message-Body required.");
            if (!this.errors.length) {
                // After form validation we are able for submitting the form
                this.submitForm();
                return true;
            }
            e.preventDefault();
        },
        validEmail: function (email) {
            var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        },
        lookupForResult: _.debounce(function () {
            var app = this;
            
            app.searchResult = "Searching..."
            axios.get("http://localhost/Laravel_5.6_RESTful_web-service/Laravel_5.6_RESTful_web-service/public/api/user/"+ app.searchVar)
                .then(function (response) {
                    console.log(response);
                    app.searchResult = response.data;
                })
                .catch(function (error) {
                    app.searchResult = "Invalid"
                })
        }, 500)


    }
})