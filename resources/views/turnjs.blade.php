<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Turn.js</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/blasten/turn.js/turn.min.js"></script>
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

        #flipbook .page {
            width: 500px;
            height: 650px
        }

    </style>
</head>

<body>
    <div class="container mt-4 text-center">
        <h2 class="mb-3">Flipbook Turn.js + PDF.js</h2>
        <div id="flipbook"></div>
        <div class="mt-3">
            <button id="prev" class="btn btn-light">◀</button>
            <button id="next" class="btn btn-light">▶</button>
        </div>
    </div>
    <script>
        const url = "{{ asset('storage/fgu-fhs/fgu-fhs.pdf') }}"
        const pdfjsLib = window['pdfjs-dist/build/pdf']
        pdfjsLib.GlobalWorkerOptions.workerSrc = "https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.worker.min.js"

        async function renderPDF() {
            const pdf = await pdfjsLib.getDocument(url).promise
            const flipbook = document.getElementById("flipbook")

            for (let i = 1; i <= pdf.numPages; i++) {
                const page = await pdf.getPage(i)
                const desiredWidth = 2000
                const viewport = page.getViewport({
                    scale: 1
                })
                const scale = desiredWidth / viewport.width
                const highResViewport = page.getViewport({
                    scale
                })
                const canvas = document.createElement("canvas")
                canvas.width = highResViewport.width
                canvas.height = highResViewport.height
                const ctx = canvas.getContext("2d")
                await page.render({
                    canvasContext: ctx
                    , viewport: highResViewport
                }).promise

                const pageDiv = document.createElement("div")
                pageDiv.className = "page"
                pageDiv.innerHTML =
                    `<img src="${canvas.toDataURL("image/png")}" style="width:100%;height:100%;object-fit:contain;">`
                flipbook.appendChild(pageDiv)
            }

            $("#flipbook").turn({
                width: 1000
                , height: 650
                , autoCenter: true
                , display: 'double'
            })
            document.getElementById("prev").onclick = () => $("#flipbook").turn("previous")
            document.getElementById("next").onclick = () => $("#flipbook").turn("next")
        }

        renderPDF()

    </script>
</body>

</html>
