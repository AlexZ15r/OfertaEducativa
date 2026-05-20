<section x-cloak x-show="open" class="fixed z-10 top-0 start-0 w-screen h-screen bg-[rgba(0,0,0,0.7)] flex justify-center items-center">
    <article class="max-h-[98%] w-[98%] md:w-[75%] lg:w-[30%] rounded-xl p-3 bg-white overflow-y-auto">
        <header class="py-5 border-b-2 border-(--azul-buap-l) flex justify-between items-center text-xl">
            <b>
                Seleccione las imágenes a integrar en:
                <br>
                {{ $offerName }}
            </b>
            <button @click="toggleOpen" type="button" class="text-gray-500 cursor-pointer p-1">
                <i class="fa-regular fa-circle-xmark"></i>
            </button>
        </header>

        <form action="{{ route('dashboard.upload-images', ['offer' => $offer]) }}" method="post" enctype="multipart/form-data">
            @csrf
            <label for="images" class="sr-only">Imágenes</label>
            <input required type="file" multiple accept="image/*" name="images[]" id="images" class="w-full my-3 p-3 bg-gray-200 hover:bg-gray-300 rounded-lg">
            <button type="submit" class="p-1 px-3 rounded-md bg-(--azul-buap-h) hover:bg-(--azul-buap-l) text-white">
                Guardar
                <i class="fa-solid fa-cloud-arrow-up"></i>
            </button>
        </form>
    </article>
</section>
