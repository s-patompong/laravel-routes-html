<div
    x-cloak
    x-data="{
        route: null,
        showModal: false,
        onSubmittedRouteForm(event) {
            let url = this.route.uri;
            for(const parameter of this.route.parameters) {
                const value = event.currentTarget.elements.namedItem(parameter).value;
                url = url.replace(`{${parameter}}`, value)
            }
            window.open(url);
        }
    }"
    @selected-route.window="
        route = $event.detail
        showModal = true;
    "
    x-show="route !== null"
    class="fixed top-0 left-0 w-screen h-screen bg-gray-900 bg-opacity-50 flex justify-center items-center"
>
    <div
        class="max-w-xl bg-white p-4 rounded"
        @click.outside="
            showModal = false;
            setTimeout(() => {route = null}, 100);
        "
        x-show="showModal"
        x-transition
    >
        <form
            class="flex flex-col gap-4 w-full"
            @submit.prevent="onSubmittedRouteForm($event)"
        >
            <h1><span class="text-gray-500">Open</span> <span class="font-semibold" x-text="route?.uri"></span></h1>
            <template x-for="parameter in route?.parameters">
                <div>
                    <label x-text="parameter"></label>
                    <input
                        type="text"
                        :name="parameter"
                        class="rounded-md px-2 py-1 w-full shadow focus:ring-2 focus:ring-blue-600 focus:ring-opacity-50 focus:outline-none border border-transparent focus:border-blue-600"
                    >
                </div>
            </template>
            <div class="text-right">
                <button type="submit" class="bg-gray-800 text-white py-1 px-3 rounded">Go</button>
            </div>
        </form>
    </div>
</diva>
