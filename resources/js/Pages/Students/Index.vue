<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import StudentCard from "@/Cards/StudentCard.vue";
import Pagination from "@/Components/Pagination.vue";
import {useForm} from '@inertiajs/vue3'

const props = defineProps({
    studentsData: Object
})

const form = useForm({
    username: '',
    email: '',
})

const submit = () => {
    form.post('/students', {
        // reset form after a successful request to delete
        onSuccess: () => {
            form.reset()
        }
    })
}

</script>

<template>
    <AppLayout title="Students">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Students
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white p-6 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="flex flex-col md:flex-row gap-2 justify-between items-center">
                        <h1 class="text-2xl font-bold">Student List</h1>
                        <!--     Using the inertia form function to create a student                   -->
                        <form class="flex w-full md:w-auto flex-col md:flex-row gap-2 items-center md:items-start" @submit.prevent="submit">
                            <!-- username -->
                            <div class="flex flex-col gap-0.5 w-full">
                                <input name="Student Name" class="rounded-xl focus:border-violet-400" :class="{'border-red-500': form.errors.username}" type="text" placeholder="Student" v-model="form.username">
                                <div class="text-red-500" v-if="form.errors.username">{{ form.errors.username }}</div>
                            </div>
                            <!-- email -->
                            <div class="flex flex-col gap-0.5 w-full">
                                <input name="Email" class="rounded-xl focus:border-violet-400" :class="{'border-red-500': form.errors.email}" type="email" placeholder="Email" v-model="form.email">
                                <div class="text-red-500" v-if="form.errors.email">{{ form.errors.email }}</div>
                            </div>
                            <button title="Create User" class="p-2 max-h-20 text-lg whitespace-pre text-white font-bold bg-green-400 max-w-40 rounded-lg" type="submit" :disabled="form.processing">+ Create User</button>
                        </form>
                    </div>

                    <h3 v-if="!studentsData.data.length"
                        class="text-2xl mt-4 font-medium"
                    >
                        Create first student
                    </h3>

                    <div v-else class="students mt-4 grid gap-2 grid-flow-row auto-rows-max">
                        <StudentCard
                            v-for="data in studentsData.data"
                            :key="data.id"
                            :user="data"
                        />
                        <Pagination :links="studentsData?.links" />
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

