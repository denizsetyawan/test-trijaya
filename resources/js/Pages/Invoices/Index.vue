<template>
    <div>
        <h1>Invoices</h1>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Product</th>
                        <th>Tripay Reference</th>
                        <th>Buyer Email</th>
                        <th>Buyer Phone</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(invoice, index) in invoices" :key="index">
                        <td><b>{{ index + 1 }}</b></td>
                        <td>{{ invoice.product['name'] }}</td>
                        <td>{{ invoice.tripay_reference }}</td>
                        <td>{{ invoice.buyer_email }}</td>
                        <td>{{ invoice.buyer_phone }}</td>
                        <td>
                            <a :href="`/showRawResponse/${invoice.id}`" target="_blank" class="btn btn-primary">raw response</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    import DefaultLayout from '@/Layouts/DefaultLayout.vue';

    export default {
        layout: DefaultLayout,
        props: {
            invoices: Array,
        },
        setup(props) {
            return {};
        },
    };

</script>
