<template>
    <div>
        <h1>Products</h1><br>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>SKU</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Reference</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(product, index) in products" :key="index">
                        <td><b>{{ index + 1 }}</b></td>
                        <td>{{ product.sku }}</td>
                        <td>{{ product.name }}</td>
                        <td>{{ product.price }}</td>
                        <td>{{ product.reference }}</td>
                        <td>{{ formatDate(product.created_at) }}</td>
                        <td>
                            <button class="btn btn-primary" @click="buyProduct(product.id)">Beli</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    import DefaultLayout from '@/Layouts/DefaultLayout.vue';
    import axios from 'axios';
    import Swal from 'sweetalert2';

    export default {
        layout: DefaultLayout,
        props: ['products'],
        setup() {

            const formatDate = (date) => {
                return new Date(date).toLocaleString();
            };

            const buyProduct = async (productId) => {
                try {
                    const response = await axios.post(`/api/createTransaction/${productId}`);
                    console.log('Transaction created successfully:', response.data);

                    Swal.fire({
                        icon: 'success',
                        title: 'Transaksi Berhasil',
                        text: `Transaksi berhasil dibuat!`,
                    }).then(() => {
                        window.location.href = '/invoices';
                    });
                    console.log('Transaction created successfully:', response.data);

                } catch (error) {
                    console.error('Error creating transaction:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Transaksi Gagal',
                        text: 'Terjadi kesalahan saat membuat transaksi. Silakan coba lagi.',
                    });

                }
            };

            return {
                formatDate,
                buyProduct
            };
        }
    };

</script>
