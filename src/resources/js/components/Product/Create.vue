<template>
    <div class="form">
        <a href="/">Back to products</a>
        <div class="row" v-if="message.length > 0">
            <div class="col-12">{{message}}</div>
        </div>
        <div class="row" v-if="errors.length > 0">
            <div class="col-12">
                <ol class="list-group list-unstyled">
                    <li class="list-group-item-danger" v-for="(error, i) in errors">{{ error }}</li>
                </ol>
            </div>
        </div>
        <div class="form-group">
            <label for="sku" class="label-control">Sku</label>
            <input type="text" v-model="sku" id="sku" class="form-control" />
        </div>

        <div class="form-group">
            <label class="label-control">Add Attributes</label>
            <div class="row">
                <div class="col-5">
                    <label>Key</label>
                    <input type="text" v-model="key" ref="key" class="form-control" />
                </div>
                <div class="col-5">
                    <label>Value</label>
                    <input type="text" v-model="value" ref="value" class="form-control"  />
                </div>
                <div class="col-2">
                    <div class="mt-4">
                        <button v-on:click="addAttribute()" class="btn btn-primary">Add</button>
                    </div>
                </div>
            </div>
            <div class="row" v-if="attributes.length > 0">
                <div class="col-12">
                    <h2>Attributes</h2>
                    <table class="table table-bordered" width="100%">
                        <thead>
                        <tr>
                            <th>Key</th>
                            <th>Value</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(attr, index) in attributes">
                            <td>{{ attr.key }}</td>
                            <td>{{ attr.value }}</td>
                            <td><button v-on:click="deleteAttribute(index)" class="btn btn-sm btn-danger">Delete</button></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <input type="submit" value="Submit" class="btn btn-success" v-on:click="submit" />
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Create",
        data: () => ({
            'sku': '',
            'key': '',
            'value': '',
            'attributes': [],
            'message': '',
            'errors': []
        }),
        methods: {
            addAttribute: function() {
                if (this.key !== '' && this.value !== '') {
                    let attribute = {'key': this.key, 'value': this.value};
                    this.attributes.push(attribute);
                    this.key = '';
                    this.value = '';
                }
            },

            getAttributes: function(){
                let attributes = {};
                this.attributes.map(function(attr){
                    attributes[attr['key']] = attr['value'];
                });
                return attributes;
            },

            getPayload: function(){
                let attributes = this.getAttributes();
                let payload = {
                    sku: this.sku,
                    attributes: attributes
                };
                return payload;
            },

            submit: function(){
                let payload = this.getPayload();
                let self = this;
                self.errors = [];
                self.message = 'Processing ...';
                axios
                    .post('api/products/create', payload)
                    .then(function(res){
                        console.log(res)
                        if (res.status === 201) {
                            self.message = "Product saved successfully";
                            self.clearForm();
                        } else {
                            console.log("Status")
                            console.log(res)
                            self.errors = res.data['errors'];
                        }
                    }).catch(function (error) {
                        if ('errors' in error.response.data) {
                            var errors = Object.values(error.response.data['errors']);
                            errors.map(function(err){
                               err.map(function(er){
                                   self.errors.push(er);
                               })
                            });
                        }
                        self.message = 'Product could not be saved. Please try again.'
                    });
            },

            deleteAttribute: function(attributeIndex){
                let results = this.attributes.filter(function(data, index){
                    return (attributeIndex !== index);
                });
                this.attributes = results;
            },

            clearForm: function(){
                this.sku = '';
                this.key = '';
                this.value = '';
                this.attributes = [];
                setTimeout(function(){
                    this.message = ''
                }, 2000);
            }
        }
    }
</script>

<style scoped>

</style>
