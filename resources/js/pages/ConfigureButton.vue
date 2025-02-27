<script setup lang="ts">
import { reactive, defineEmits } from 'vue';
import { router } from '@inertiajs/vue3';

const emit = defineEmits(['update', 'delete', 'close']);

const props = defineProps<{
    button: {
        id: number;
        label: string;
        color: string | null;
        link: string | null;
    };
}>();

const form = reactive({
    label: props.button.label,
    color: props.button.color || '',
    link: props.button.link || '',
});

function saveConfiguration() {
    router.post(`/configure-button/${props.button.id}`, form, {
        onSuccess: () => {
            emit('update', { ...form, id: props.button.id });
        },
    });
}

function deleteButton() {
    if (confirm('Are you sure you want to delete this button?')) {
        router.delete(`/configure-button/${props.button.id}`, {
            onSuccess: () => {
                emit('delete', props.button.id);
            },
        });
    }
}

function cancel() {
    emit('close');
}
</script>

<template>
    <div class="max-w-lg mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Configure Button</h1>
        <form @submit.prevent="saveConfiguration">
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-2">Label</label>
                <input v-model="form.label" type="text" class="w-full px-4 py-2 border rounded-md" />
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold mb-2">Color</label>
                <select v-model="form.color" class="w-full px-4 py-2 border rounded-md">
                    <option value="red-500">Red</option>
                    <option value="blue-500">Blue</option>
                    <option value="green-500">Green</option>
                    <option value="yellow-500">Yellow</option>
                    <option value="purple-500">Purple</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold mb-2">Hyperlink</label>
                <input
                    v-model="form.link"
                    type="url"
                    placeholder="https://example.com"
                    class="w-full px-4 py-2 border rounded-md"
                />
            </div>

            <div class="flex items-center justify-between mt-6">
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">
                    Save
                </button>
                <button
                    type="button"
                    @click="deleteButton"
                    class="px-4 py-2 bg-red-500 text-white rounded-md"
                >
                    Delete
                </button>
                <button
                    type="button"
                    @click="cancel"
                    class="px-4 py-2 bg-gray-500 text-white rounded-md"
                >
                    Cancel
                </button>
            </div>
        </form>
    </div>
</template>
