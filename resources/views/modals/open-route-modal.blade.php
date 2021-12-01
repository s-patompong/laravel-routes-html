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

            if(this.route.domain !== null) {
                url = `${location.protocol}//${this.route.domain}/${url}`;
            }

            window.open(url);
        },
        closeModal() {
            if(!this.showModal) {
                return;
            }

            this.showModal = false;
            setTimeout(() => {this.route = null}, 100);
        }
    }"
    @selected-route.window="
        route = $event.detail;
        showModal = true;
    "
    x-show="route !== null"
    @keyup.escape.window="closeModal()"
    class="fixed top-0 left-0 w-screen h-screen bg-gray-900 bg-opacity-50 flex justify-center items-center"
>
    <div
        class="max-w-xl bg-white p-6 rounded"
        @click.outside="closeModal()"
        x-show="showModal"
        x-trap="showModal"
        x-transition
    >
        <form
            class="flex flex-col gap-4 w-full"
            @submit.prevent="onSubmittedRouteForm($event)"
        >
            <h1>
                <span class="text-gray-500">Open</span>
                <span class="font-semibold" x-text="route?.uri"></span>
                <span x-show="route?.domain !== null" x-text="`on ${route?.domain}?`"></span>
            </h1>
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
                <button type="submit" class="bg-gray-800 text-white py-1 rounded w-14">Go</button>
            </div>
        </form>
    </div>
</div>
