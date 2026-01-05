const openBook = document.getElementById("openBook");
const modal = document.getElementById("modalBook");
const closeBook = document.getElementById("closeBook");
const flipbook = document.getElementById("flipbook");

// BUKA POPUP
openBook.onclick = () => {
  modal.style.display = "flex";
  loadPDF();
};

// TUTUP POPUP
closeBook.onclick = () => {
  modal.style.display = "none";
  location.reload();
};

async function loadPDF() {
  const url = "buku.pdf"; // nama file PDF kamu

  // Kosongkan dulu flipbook kalau dibuka ulang
  flipbook.innerHTML = `
    <div id="pageInfo" style="text-align:center; margin-bottom:10px;">
      Halaman <span id="currentPage">1</span> / <span id="totalPage">0</span>
    </div>
  `;

  const pdf = await pdfjsLib.getDocument(url).promise;

  totalPages = pdf.numPages;
  document.getElementById("totalPage").textContent = totalPages;

  for (let i = 1; i <= totalPages; i++) {
    const page = await pdf.getPage(i);

    const canvas = document.createElement("canvas");
    const context = canvas.getContext("2d");

    const viewport = page.getViewport({ scale: 1.3 });
    canvas.width = viewport.width;
    canvas.height = viewport.height;

    await page.render({
      canvasContext: context,
      viewport: viewport
    }).promise;

    const pageDiv = document.createElement("div");
    pageDiv.className = "page";
    pageDiv.appendChild(canvas);
    flipbook.appendChild(pageDiv);
  }

  // Aktifkan Turn.js SETELAH semua halaman selesai dibuat
  $("#flipbook").turn({
    width: 800,
    height: 500,
    autoCenter: true,
    when: {
      turned: function (event, page) {
        document.getElementById("currentPage").textContent = page;
      }
    }
  });
}

