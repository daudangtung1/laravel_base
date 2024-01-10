<template>
    <div>
        <h3 class="text-center">FAQ</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Question</th>
                    <th>Answer</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="faq in faqs" :key="faq.id">
                    <td>{{ faq.id }}</td>
                    <td>{{ faq.question }}</td>
                    <td>{{ faq.answer }}</td>
                    <td>{{ faq.created_at }}</td>
                    <td>{{ faq.updated_at }}</td>
                    <td>
                        <div class="btn-group">
                            <!-- <router-link :to="{ name: edit, param: { id: faq.id } }"
                                class="btn btn-primary">Edit</router-link>
                            <button class="btn btn-danger" @click="" deleteFaq(faq.id)></button> -->
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script setup>
import useFaqs from '../../composables/faqs';
import { onMounted } from 'vue';

const { faqs, getFaqs } = useFaqs();
onMounted(getFaqs)
</script>