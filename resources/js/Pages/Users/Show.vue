<template>
    <Head :title="user.name"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ user.name }}</h2>
        </template>

        <div class="py-12">
            <div class="py-3 flex justify-center">
                <button class="text-sm text-indigo-700" type="button" @click="loadComments">Load comments
                </button>
            </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div v-for="post in posts" :key="post.id">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg my-3">
                        <div class="p-6 text-gray-900">
                            <div class="font-semibold">{{ post.user.name }}</div>
                            <p class="mt-1">{{ post.body }} </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head, router} from "@inertiajs/vue3";

const props = defineProps({
    user: Object,
    posts: Array
})

const loadComments = () => {
    router.get(route('user.show', props.user.id), {}, {
        preserveState: true,
        preserveScroll: true,
        only: ['posts']
    });
}
</script>
