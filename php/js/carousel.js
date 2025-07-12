const cardsData = [
  {
    title: "Hotel Copacabana",
    rating: "8.9 - Excelente (232)",
    location: "Rio de Janeiro",
    offerText: "Por pouco tempo!",
    price: "R$ 398",
    images: ["assets/imagem1.jpg", "assets/imagem2.jpeg"]
  },
  {
    title: "Hotel Lago Negro",
    rating: "9.4 - Excelente (632)",
    location: "Gramado",
    offerText: "Por pouco tempo!",
    price: "R$ 653",
    images: ["assets/imagem3.jpeg", "assets/imagem1.jpg"]
  },
  {
    title: "Hotel Morro da Cruz",
    rating: "1.9 - Péssimo (32)",
    location: "Porto Alegre",
    offerText: "Por pouco tempo!",
    price: "R$ 199",
    images: ["assets/imagem3.jpeg", "assets/imagem2.jpeg"]
  },
  {
    title: "Hotel das Águas",
    rating: "9.1 - Excelente (412)",
    location: "Caldas Novas",
    offerText: "Oferta exclusiva!",
    price: "R$ 420",
    images: ["assets/imagem1.jpg", "assets/imagem3.jpeg"]
  },
  {
    title: "Pousada do Sol",
    rating: "8.0 - Muito bom (290)",
    location: "Fortaleza",
    offerText: "Últimas vagas!",
    price: "R$ 310",
    images: ["assets/imagem2.jpeg", "assets/imagem1.jpg"]
  },
  {
    title: "Hotel Aurora",
    rating: "9.7 - Incrível (912)",
    location: "Campos do Jordão",
    offerText: "Recomendado!",
    price: "R$ 758",
    images: ["assets/imagem1.jpg", "assets/imagem2.jpeg"]
  }
];

const visibleCount = 3;
const cardWidthWithGap = 280 + 15;
const carouselInner = document.getElementById("carouselInner");
const prevBtn = document.getElementById("prevBtn");
const nextBtn = document.getElementById("nextBtn");

let startIndex = 0;
let isAnimating = false;

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
        <a href="#" class="btn btn-info">Conferir oferta</a>
      </div>
    </div>
  `;
}

function renderCards() {
  const cardsToRender = [];
  for (let i = 0; i < visibleCount; i++) {
    const idx = (startIndex + i) % cardsData.length;
    cardsToRender.push(cardsData[idx]);
  }
  carouselInner.innerHTML = cardsToRender
    .map((card, i) => createCardHTML(card, (startIndex + i) % cardsData.length))
    .join("");
}

function slide(direction) {
  if (isAnimating) return;
  isAnimating = true;

  const moveDistance = cardWidthWithGap;
  const translateXValue = direction === "next" ? -moveDistance : moveDistance;

  carouselInner.style.transition = "transform 0.5s ease";
  carouselInner.style.transform = `translateX(${translateXValue}px)`;

  carouselInner.addEventListener(
    "transitionend",
    () => {
      carouselInner.style.transition = "none";
      carouselInner.style.transform = `translateX(0)`;

      if (direction === "next") {
        startIndex = (startIndex + 1) % cardsData.length;
      } else {
        startIndex = (startIndex - 1 + cardsData.length) % cardsData.length;
      }

      renderCards();
      isAnimating = false;
    },
    { once: true }
  );
}

prevBtn.addEventListener("click", () => slide("prev"));
nextBtn.addEventListener("click", () => slide("next"));
renderCards();
