<script setup>
import { router } from '@inertiajs/vue3'
import { ref } from 'vue'

const isLoaded = ref(false)

const defColor = () => {
    const colorsNames = ['bg-sky-200', 'bg-violet-500', 'bg-orange-300', 'bg-rose-700']
    return colorsNames[Math.floor(Math.random() * colorsNames.length)];
}

const props = defineProps({
    user: Object,
});

// Request to delete student after confirming
const removeStudent = (id) => {
    let isBoss = confirm("Are you sure ?");
    if (isBoss) {
        router.delete(route('students.destroy', id));
    }
}

</script>

<template>
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 items-center border-2 border-violet-400 p-6 rounded-lg">
        <div class="flex items-center gap-2">
            <!--      Random color to student avatar if image not loaded       -->
            <div :class="`${defColor()}`"
                 class="rounded-full w-10 h-10 sm:w-20 sm:h-20 overflow-hidden">
                <!--      Random image for the student         -->
                <img v-show="isLoaded" @load="isLoaded = true" :src="`https://i.pravatar.cc/300?u=${user.id}`" :alt="`Avatar - ${user.id}`">
            </div>
            <p>
                {{ user?.username }}
            </p>
        </div>
        <p class="truncate">
            {{ user?.email }}
        </p>
        <button title="Delete" @click="removeStudent(user.id)" class="p-2 ml-auto font-base text-white font-medium bg-red-600 max-w-20 rounded-lg">
            Delete
        </button>
    </div>
</template>

