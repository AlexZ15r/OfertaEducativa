<section @click="toggleOpenViewer" x-cloak x-show="openViewer" class="fixed z-10 top-0 start-0 w-screen h-screen bg-[rgba(0,0,0,0.7)] flex justify-center items-center">
    <article class="max-h-[98%] w-[98%] md:w-[75%] rounded-xl p-3 bg-white overflow-y-auto">
        <header x-text="alt" class="py-5 border-b-2 border-(--azul-buap-l)"></header>

        <div>
            <img :src="src" :alt="alt" :title="alt" class="w-full">
        </div>
    </article>
</section>
