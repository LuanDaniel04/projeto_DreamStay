// Configurações do carrossel
const MAX_VISIBLE = 3;  // Máximo de cards visíveis por vez
const cardWidthWithGap = 280 + 15;

// Pega os elementos do html
const carouselInner = document.getElementById("carouselInner");
const prevBtn = document.getElementById("prevBtn");
const nextBtn = document.getElementById("nextBtn");

// Variáveis
let cardsData = [];
let visibleCount = 0;
let startIndex = 0;
let isAnimating = false;

// Função para criar as imagens de cada card
function createCarouselInnerHTML(images, index) {
  let inner = images
    .map((img, i) => `
      <div class="carousel-item ${i === 0 ? 'active' : ''}">
        <img src="${img}" class="d-block w-100" alt="Imagem ${i + 1}">
      </div>
    `).join('');

  return `
    <div id="carouselCard${index}" class="carousel slide">
      <div class="carousel-inner">
        ${inner}
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselCard${index}" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselCard${index}" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
      </button>
    </div>
  `;
}

// Função para criar cada card
function createCardHTML(card, index) {
  return `
    <div class="card hotel-card">
      ${createCarouselInnerHTML(card.images, index)}
      <div class="card-body">
        <h5 class="card-title">${card.title}</h5>
        <p class="avaliacao-text"><strong>Avaliação:</strong> ${card.rating}</p>
        <p class="local-text">${card.location}</p>
        <p class="btn-oferta">${card.offerText}</p>
        <p class="cancelamento-text">Cancelamento gratuito</p>
        <h5 class="text-danger">${card.price}</h5>

        <form action="detalhes.php" method="post">
          <input type="hidden" name="id" value="${card.id}">
          <button type="submit" class="btn btn-info">Ver Detalhes</button>
        </form>

      </div>
    </div>
  `;
}

// Função que renderiza os cards visíveis no carrossel
function renderCards() {
  
  //Define o numero de cards exibidos
  visibleCount = Math.min(MAX_VISIBLE, cardsData.length);

  const cardsToRender = [];
  for (let i = 0; i < visibleCount; i++) {
    const idx = (startIndex + i) % cardsData.length;
    cardsToRender.push(cardsData[idx]);
  }

  carouselInner.innerHTML = cardsToRender
    .map((card, i) => createCardHTML(card, (startIndex + i) % cardsData.length))
    .join('');
}

// Função para controlar o deslizamento do carrossel
function slide(direction) {
  if (isAnimating || cardsData.length === 0) return;
  isAnimating = true;

  const moveDistance = cardWidthWithGap;
  const translateXValue = direction === "next" ? -moveDistance : moveDistance;

  carouselInner.style.transition = "transform 0.5s ease";
  carouselInner.style.transform = `translateX(${translateXValue}px)`;

  carouselInner.addEventListener("transitionend", () => {
    carouselInner.style.transition = "none";
    carouselInner.style.transform = `translateX(0)`;

    if (direction === "next") {
      startIndex = (startIndex + 1) % cardsData.length;
    } else {
      startIndex = (startIndex - 1 + cardsData.length) % cardsData.length;
    }

    renderCards();
    isAnimating = false;
  }, { once: true });
}

// Eventos dos botões de navegação
prevBtn.addEventListener("click", () => slide("prev"));
nextBtn.addEventListener("click", () => slide("next"));


 window.createCardHTML = createCardHTML;

