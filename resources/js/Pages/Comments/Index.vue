<script setup>

import {Head, useForm, router, Link, usePage} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {useToast} from "vue-toastification";
import {watch} from "vue";

defineProps({
    posts: Object,
    can: Object
});

const form = useForm('StoreComments', {
    body: ''
});

const page = usePage();
//const toast = useToast();

//watch(() => page.props.message, (value) => {

//   if (value) {
//       toast(value.content, {type: value.type});

//    }

//});

//form.setError('body', 'We need a body for the post');

const createPost = () => {
    form.post(route('comments.store'), {
        // esse parametro é para manter o scroll da página após a requisição
        preserveScroll: true,
        // esse metodo é chamado após o sucesso da requisição. E recebe um callback
        onSuccess: () => {

            //resetou o formulário após o sucesso da requisição
            form.reset();
        }
    });
}

const refreshComments = () => {
    // essa função é do inertiajs que faz uma requisição para a mesma página
    // e atualiza os dados da página
    //alert('refreshing comments');
    router.get(route('comments.index'), {}, {
        preserveState: true,
        preserveScroll: true,
        only: ['posts']
    });
}

</script>

<template>
    <Head title="Comments"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Comments</h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-3">

                <form class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6" @submit.prevent="createPost"
                      v-if="can.create"
                >
                    <label for="body" class="sr-only">Body</label>
                    <textarea
                        v-model="form.body"
                        v-on:focus="form.clearErrors('body')"
                        name="body" id="body" cols="30" rows="5"
                        class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200
                        focus:ring-opacity-50 rounded-md shadow-sm w-full"

                    ></textarea>

                    <div class="text-red-500" v-if="form.errors.body" v-text="form.errors.body"></div>
                    <!-- desabilita o botão enquanto o formulário está sendo processado -->
                    <button
                        :disabled="form.processing"
                        :class="{ 'opacity-25': form.processing }"
                        type="submit"
                        class="mt-2 bg-gray-700 px-4 py-2 rounded-md font-medium text-white">Post
                    </button>
                </form>
                <div class="py-3 flex justify-center">
                    <button class="text-sm text-indigo-700" type="button" v-on:click="refreshComments">Refresh
                        comments
                    </button>

                    <!--<Link :href="route('comments.index')" preserve-scroll :only="['posts']"
                          class="text-sm text-indigo-700">Refresh comments
                    </Link> -->
                </div>

                <div v-for="post in posts" :key="post.id">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <div class="font-semibold">
                                <Link :href="route('user.show', post.user.id)" preserve-scroll> {{
                                        post.user.name
                                    }}
                                </Link>
                            </div>
                            <p class="mt-1">{{ post.body }} </p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

