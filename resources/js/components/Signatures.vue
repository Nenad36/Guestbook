<template>
    <div class="mt-5">
        <div class="card" v-for="signature in signatures">
            <div class="card-header">
                <i class="fas fa-user-tie"></i>
                <label id="started">By</label> {{ signature.name }}
            </div>
            <div class="card-body">
                <div class="col-md-2">
                   <img :src="signature.avatar" :alt="signature.name" class="img-thumbnail">
                </div>
                <p class="ml-3 mt-2">{{ signature.body }}</p>
            </div>
            <div class="card-footer">
                <i class="fas fa-calendar-times"></i> {{ signature.date }} |
                <i class="fab fa-font-awesome-flag"></i>
                <a href="#" id="comments" @click="report(signature.id)">Report</a>
            </div>
        </div>

        <paginate
            :page-count="pageCount"
            :click-handler="fetch"
            :prev-text="'Prev'"
            :next-text="'Next'"
            :container-class="'pagination'">
        </paginate>
    </div>
</template>

<script>

    export default {
        name: "Signatures",
        data() {
            return {
                signatures: [],
                pageCount: 1,
                endpoint: 'api/signatures?page='
            };
        },
        created() {
            this.fetch();
        },
        methods: {
            fetch(page = 1) {
                axios.get(this.endpoint + page)
                    .then(({data}) => {
                        this.signatures = data.data;
                        this.pageCount = data.meta.last_page;
                    });
            },
            report(id) {
                if(confirm('Are you sure you want to report this signature?')) {
                    axios.put('api/signatures/'+id+'/report')
                        .then(response => this.removeSignature(id));
                }
            },
            removeSignature(id) {
                this.signatures = _.remove(this.signatures, function (signature) {
                    return signature.id !== id;
                });
            }
        }
    }
</script>

<style scoped>

</style>
