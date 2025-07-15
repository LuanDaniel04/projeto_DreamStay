document.addEventListener("DOMContentLoaded", function () {
  const campoBusca = document.getElementById("campoBusca");
  const botaoBusca = document.getElementById("botaoBusca");
  const resultadoBusca = document.getElementById("resultadoBusca");
  const resultadoCards = document.getElementById("resultadoCards");
  const secaoOfertas = document.getElementById("secaoOfertas");
  const secaoMelhores = document.getElementById("secaoMelhores");
  const secaoTalvez = document.getElementById("secaoTalvez");

  function criarCard(hotel) {
    const form = document.createElement("form");
    form.action = "detalhes.php";
    form.method = "post";
    form.style.cursor = "pointer";

    form.innerHTML = `
      <input type="hidden" name="id" value="${hotel.id}">
      <div class="card hotel-card h-100">
        <img src="${hotel.images[0]}" class="card-img-top" alt="${hotel.title}" />
        <div class="card-body d-flex flex-column justify-content-between text-center">
          <h5 class="card-title">${hotel.title}</h5>
          <p class="avaliacao-text"><strong>Avaliação:</strong> ${hotel.rating}</p>
          <p class="local-text">${hotel.location}</p>
          <h5 class="text-danger">${hotel.price}</h5>
          <button type="submit" class="btn btn-info mt-2">Ver Detalhes</button>
        </div>
      </div>
    `;

    form.addEventListener("click", () => form.submit());

    const col = document.createElement("div");
    col.className = "col-md-4 mb-4";
    col.appendChild(form);

    return col;
  }

  function exibirResultados(dados) {
    resultadoCards.innerHTML = "";

    if (dados.length === 0) {
      resultadoCards.innerHTML = '<p class="text-muted aviso-sem-anuncio">Nenhum resultado encontrado.</p>';
    } else {
      dados.forEach(hotel => {
        resultadoCards.appendChild(criarCard(hotel));
      });
    }

    resultadoBusca.style.display = "block";
    secaoOfertas.style.display = "none";
    secaoMelhores.style.display = "none";
    secaoTalvez.style.display = "none";
  }

  function carregarSecao(secaoElement, tag) {
    const container = secaoElement.querySelector(".row, #carouselInner");
    if (!container) return;

    container.innerHTML = "";

    const url = `anuncios.php?tag=${encodeURIComponent(tag)}`;

    fetch(url)
      .then(res => res.json())
      .then(dados => {
        if (dados.length === 0) {
          container.innerHTML = `<p class="aviso-sem-anuncio">Nenhum anúncio para ${tag}.</p>`;
          return;
        }

        if (tag === "ofertas imperdiveis" && container.id === "carouselInner") {
          dados.forEach((hotel, i) => {
            const wrapper = document.createElement("div");
            wrapper.innerHTML = createCardHTML(hotel, i);
            container.appendChild(wrapper.firstElementChild);
          });
        } else {
          dados.forEach(hotel => {
            const col = criarCard(hotel);
            container.appendChild(col);
          });
        }
      })
      .catch(() => {
        container.innerHTML = `<p class="text-danger">Erro ao carregar anúncios.</p>`;
      });
  }

  function buscar() {
    const termo = campoBusca.value.trim();

    if (termo.length === 0) {
      resultadoBusca.style.display = "none";
      secaoOfertas.style.display = "block";
      secaoMelhores.style.display = "block";
      secaoTalvez.style.display = "block";
      return;
    }

    const url = `anuncios.php?search=${encodeURIComponent(termo)}`;

    fetch(url)
      .then(res => res.json())
      .then(dados => exibirResultados(dados))
      .catch(() => {
        resultadoCards.innerHTML = '<p class="text-danger">Erro ao buscar os dados.</p>';
        resultadoBusca.style.display = "block";
      });
  }

  // Carrega as seções ao iniciar
  carregarSecao(secaoOfertas, "ofertas imperdiveis");
  carregarSecao(secaoMelhores, "melhores avaliados");
  carregarSecao(secaoTalvez, "talvez voce goste");

  campoBusca.addEventListener("keyup", buscar);
  botaoBusca.addEventListener("click", buscar);
});
