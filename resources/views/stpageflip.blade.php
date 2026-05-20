<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>StPageFlip Ultra HD</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/page-flip/dist/css/page-flip.css"> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/page-flip/dist/js/page-flip.browser.min.js"></script> --}}
    @vite( ['resources/css/app.css'] )
    <style>
        body {
            background: #111;
            color: #eee
        }
        #flipbook {
            width: 1000px;
            height: 650px;
            margin: 24px auto
        }
        #pages {
            display: none
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <h2 class="text-center">Flipbook StPageFlip + PDF.js Ultra HD</h2>
        <div id="flipbook"></div>
        <div id="pages"></div>
    </div>

    @vite( ['resources/js/app.js'] )
    <script type="module">
        const url = "{{ asset('storage/fgu-fhs/fgu-fhs.pdf') }}"
        // const pdfjsLib = window['pdfjs-dist/build/pdf']
        // pdfjsLib.GlobalWorkerOptions.workerSrc = "https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.worker.min.js"

        const container = document.getElementById("flipbook")
        const pagesContainer = document.getElementById("pages")
        const pageFlip = new PageFlip(container, {
            width: 500,
            height: 650,
            size: "stretch",
            minWidth: 400,
            maxWidth: 1600,
            minHeight: 500,
            maxHeight: 2000,
            drawShadow: true,
            flippingTime: 800,
            showCover: false
        })

        async function renderPDF() {
            const pdf = await pdfjsLib.getDocument(url).promise
            for (let i = 1; i <= pdf.numPages; i++) {
                const page = await pdf.getPage(i)
                const viewport = page.getViewport({
                                scale: 1
                })
                const scale = (4000 / viewport.width) * window.devicePixelRatio
                const highResViewport = page.getViewport({
                                scale
                })
                const canvas = document.createElement("canvas")
                canvas.width = highResViewport.width
                canvas.height = highResViewport.height
                const ctx = canvas.getContext("2d", {
                                alpha: false
                })
                await page.render({
                                canvasContext: ctx,
                                viewport: highResViewport
                }).promise
                const div = document.createElement("div")
                div.className = "page"
                div.innerHTML =
                                `<img src="${canvas.toDataURL("image/png",1.0)}" style="width:100%;height:100%;object-fit:contain;">`
                pagesContainer.appendChild(div)
            }
            pageFlip.loadFromHTML(pagesContainer.querySelectorAll(".page"))
        }
        renderPDF()
    </script>
</body>

</html>
